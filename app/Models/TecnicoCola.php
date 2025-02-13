<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class TecnicoCola extends ModelBase
{
    use HasFactory;

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }
    public function cola()
    {
        return $this->belongsTo(Cola::class);
    }
}
