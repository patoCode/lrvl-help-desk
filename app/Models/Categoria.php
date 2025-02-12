<?php

namespace App\Models;

use App\Http\Controllers\Utils\STATUS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;


class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;


    public $table = "categoria";
    public $fillable = ['id','nombre','is_public','is_promediable','is_schedulable','status'];
    public $incrementing = false;
    protected $keyType = 'string';

    protected $attributes = [
        'is_public' => true,
        'is_promediable' => true,
        'is_schedulable' => false,
        'status' => STATUS::ACTIVO,
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if(empty($model->id)){
                $model->id = (string) Uuid::uuid4();
            }
        });
    }



}
