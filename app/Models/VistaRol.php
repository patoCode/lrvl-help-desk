<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class VistaRol extends Model
{
    /** @use HasFactory<\Database\Factories\VistaRolFactory> */
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


    public function vista()
    {
        return $this->belongsTo(Vista::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
