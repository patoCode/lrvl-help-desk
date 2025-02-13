<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tecnico extends ModelBase
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
