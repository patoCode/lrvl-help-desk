<?php

namespace App\Models\base;

use App\Constants\BasicConstants;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ModelBase extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';

    protected $attributes = [
        'status' => BasicConstants::STATUS_ACTIVE,
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
