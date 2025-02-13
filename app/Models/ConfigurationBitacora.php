<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class ConfigurationBitacora extends ModelBase
{
    use HasFactory;

    public function configuration()
    {
        return $this->belongsTo(Configuration::class);
    }
}
