<?php

namespace App\Events;

use App\Models\Cola;
use App\Models\Solicitud;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AsignarIncidente
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */

    public Solicitud $solicitud;
    public Cola $cola;

    public function __construct(Solicitud $solicitud, Cola $cola)
    {
        $this->solicitud = $solicitud;
        $this->cola = $cola;
    }

}

