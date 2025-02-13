<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class VistaRol extends ModelBase
{
    use HasFactory;

    public function vista()
    {
        return $this->belongsTo(Vista::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
