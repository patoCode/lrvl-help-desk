<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class UsuarioRol extends ModelBase
{
    use HasFactory;
    protected $table = "usuario_rols";
    protected $fillable = ['id','usuario_id','rol_id','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

}
