<?php

namespace App\Events;

use App\Constants\BitacoraStatusEnum;
use App\Constants\SolicitudEventoEnum;
use App\Models\Solicitud;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BitacoraRegister
{
    use Dispatchable, SerializesModels;

    public Solicitud $solicitud;
    public string $observacion;
    public SolicitudEventoEnum $evento;
    public BitacoraStatusEnum $status;

    public function __construct(Solicitud $solicitud,
                                string $observacion,
                                SolicitudEventoEnum $evento,
                                BitacoraStatusEnum $status)
    {
        $this->solicitud = $solicitud;
        $this->observacion = $observacion;
        $this->evento = $evento;
        $this->status = $status;
    }

}
