<?php

namespace App\Listeners;

use App\Constants\BasicConstants;
use App\Events\AsignarRoles;
use App\Models\UsuarioRol;


class AsignarRolAlUsuario
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
    public function handle(AsignarRoles $event): void
    {
        foreach($event->rols as $rol){
            UsuarioRol::create([
                'rol_id' => $rol,
                'usuario_id' => $event->user->id,
                'status' => BasicConstants::STATUS_ACTIVE
            ]);
        }

    }
}
