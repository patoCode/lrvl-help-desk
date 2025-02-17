<?php

namespace App\Listeners;

use App\Constants\BasicConstants;
use App\Events\BitacoraRegister;
use App\Models\SolicitudBitacora;

class BitacoraActionRegister
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
    public function handle(BitacoraRegister $event): void
    {
        $ultima_linea = SolicitudBitacora::where('solicitud_id',$event->solicitud->id)
                                         ->first();
        SolicitudBitacora::create([
            'nro_evento' => $ultima_linea ? $ultima_linea->nro_evento + 1: 1,
            'evento' => $event->evento,
            'observacion' => $event->observacion,
            'registry_by' => "denis",
            'usuario_id' => $event->solicitud->usuario_id,
            'category_id' => $event->solicitud->category_id,
            'solicitud_id' => $event->solicitud->id,
            'tecnico_id' => $event->solicitud->tecnico_id ? $event->solicitud->tecnico_id : null,
            'status_bitacora' => $event->status,
            'status' => BasicConstants::STATUS_ACTIVE,
        ]);
    }
}
