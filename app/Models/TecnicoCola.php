<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class TecnicoCola extends Model
{
    /** @use HasFactory<\Database\Factories\TecnicoColaFactory> */
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

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }
    public function cola()
    {
        return $this->belongsTo(Cola::class);
    }
}
