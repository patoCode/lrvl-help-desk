<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Cola extends ModelBase
{
    /** @use HasFactory<\Database\Factories\ColaFactory> */
    use HasFactory;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

}
