<?php

namespace App\Services;
use App\Constants\BasicConstants;
use App\Models\Categoria;
use App\Models\TecnicoCola;

class SolicitudValidationService
{
    public static function validateCategoryActive($categoria){
        if (!Categoria::where('id', $categoria)
            ->where('status', BasicConstants::STATUS_ACTIVE)
            ->exists()
        ) {
            throw new \InvalidArgumentException("La categoria no esta activa");
        }

    }
    public static function validateColaHasTechnician($cola){
        if (!TecnicoCola::where('cola_id', $cola)
            ->where('status', BasicConstants::STATUS_ACTIVE)
            ->exists()
        ) {
            throw new \InvalidArgumentException("No existen tecnicos asignados a esta categoria.Consulte con el administrador");
        }
    }
}
