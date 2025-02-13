<?php

namespace App\Models\base;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ModelBase extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';

    protected $attributes = [
        'is_public' => true,
        'is_promediable' => true,
        'is_schedulable' => false,
        'status' => 'activo',
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
