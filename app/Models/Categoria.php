<?php

namespace App\Models;

use App\Constants\BasicConstants;
use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Categoria extends ModelBase
{
    use HasFactory;
    public $table = "categoria";
    public $fillable = ['id',
                        'nombre',
                        'is_public',
                        'is_promediable',
                        'is_schedulable',
                        'publica',
                        'promediable',
                        'cronogramable',
                        'status'];


    protected $attributes = [
        'is_public' => true,
        'is_promediable' => true,
        'is_schedulable' => false,
        'status' => BasicConstants::STATUS_ACTIVE,
    ];

    public function setPublicaAttribute($value)
    {
        $this->attributes['is_public'] = strtolower($value) === 'si';
    }
    public function setPromediableAttribute($value)
    {
        $this->attributes['is_promediable'] = strtolower($value) === 'si';
    }
    public function setCronogramableAttribute($value)
    {
        $this->attributes['is_schedulable'] = strtolower($value) === 'si';
    }
}
