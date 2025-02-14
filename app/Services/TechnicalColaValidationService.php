<?php

namespace App\Services;

use App\Models\TecnicoCola;
use App\Constants\BasicConstants;
class TechnicalColaValidationService
{
    public static function validateTechnicalNotIn($tecnico, $cola): void
    {
        if (TecnicoCola::where('tecnico_id', $tecnico)
                        ->where('cola_id',$cola)
                        ->where('status', BasicConstants::STATUS_ACTIVE)
                        ->exists()
        ) {
            throw new \InvalidArgumentException("El tecnico $tecnico ya esta activo en esta categoria");
        }
    }

    public static function validateTechnicianIn($tecnico, $cola): void
    {
        if( !TecnicoCola::where('tecnico_id', $tecnico)
                        ->where('id',$cola)
                        ->exists()
        ){
            throw new \InvalidArgumentException("El tecnico $tecnico no esta asignado a esta categoria.");
        }
    }
}
