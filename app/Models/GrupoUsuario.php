<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupoUsuario extends ModelBase
{
    use HasFactory;

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
