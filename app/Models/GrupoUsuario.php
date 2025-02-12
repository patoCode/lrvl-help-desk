<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class GrupoUsuario extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoUsuarioFactory> */
    use HasFactory;
    public $incrementing = false; // No es autoincrementable
    protected $keyType = 'string'; // Es un string (UUID)
    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if($model->id){
                $model->id = (string) Uuid::uuid4();
            }
        });
    }
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
