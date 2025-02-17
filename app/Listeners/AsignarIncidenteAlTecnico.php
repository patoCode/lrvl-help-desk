<?php

namespace App\Listeners;

use App\Constants\BasicConstants;
use App\Events\AsignarIncidente;
use App\Models\TecnicoCola;
use Illuminate\Support\Facades\DB;

class AsignarIncidenteAlTecnico
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AsignarIncidente $event): void
    {
        $tecnico = null;
        $ultimo_tecnico_asignado = $event->cola->ultima_asignacion;
        $counter = 1;
        while ($tecnico == null && $counter <= $event->cola->max_value) {
            $ultimo_tecnico_asignado = $ultimo_tecnico_asignado +1;
            if($ultimo_tecnico_asignado > $event->cola->max_value){
                $ultimo_tecnico_asignado = 1;
            }
            $tecnico = TecnicoCola::where('cola_id', $event->cola->id)
                ->where('order', $ultimo_tecnico_asignado)
                ->where('status', BasicConstants::STATUS_ACTIVE)
                ->first();
            $counter++;
        }

        if(!$tecnico){
            throw new \InvalidArgumentException("No existen tecnicos validos para esta categoria. Por favor verifique he intente nuevamente. Contacte con el Administrador.");
        }

        $solicitud = $event->solicitud;
        $solicitud->update([
            'tecnico_id' => $tecnico->tecnico_id,
            'cola_id' => $event->cola->id
        ]);
        $cola = $event->cola;

        $cola->update([
            'ultima_asignacion' => $ultimo_tecnico_asignado
       ]);
    }
}
