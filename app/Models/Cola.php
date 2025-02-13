<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cola extends ModelBase
{
    /** @use HasFactory<\Database\Factories\ColaFactory> */
    use HasFactory;
    protected $table = 'colas';
    protected $fillable = ['id','ultima_asignacion','category_id','status'];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id','id');
    }

}
