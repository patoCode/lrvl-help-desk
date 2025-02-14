<?php

namespace App\Services;
use App\Constants\BasicConstants;
use App\Models\Rol;

class RolValidationService
{
    public static function validateDefaultRols(): void
    {
        if (!Rol::where('default', BasicConstants::TRUE_VALUE)->where('status', BasicConstants::STATUS_ACTIVE)->exists()) {
            throw new \InvalidArgumentException("No existen roles por defecto. Por favor verifique he intente nuevamente. Contacte con el Administrador.");
        }
    }

}
