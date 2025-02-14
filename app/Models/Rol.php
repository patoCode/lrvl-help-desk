<?php

namespace App\Models;

use App\Constants\BasicConstants;
use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends ModelBase
{
    use HasFactory;
    protected $table = "rols";
    protected $fillable = ['id', 'nombre', 'status','padre' ];

    public static function getDefaultRols() : array
    {
        return self::where('status', BasicConstants::STATUS_ACTIVE)
                    ->where('default', BasicConstants::TRUE_VALUE)
                    ->pluck('id')
                    ->toArray();
    }
}
