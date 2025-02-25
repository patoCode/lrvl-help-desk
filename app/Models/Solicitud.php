<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Solicitud extends ModelBase
{
    use HasFactory;
    protected $table = "solicitud";
    protected $fillable = [
                            'id',
                            'description',
                            'code',
                            'priority',
                            'registry_by',
                            'updated_by',
                            'category_id',
                            'usuario_id',
                            'tecnico_id',
                            'cola_id',
                            'status',
                            'is_promediable'
                            ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function cola()
    {
        return $this->belongsTo(Cola::class);
    }

}
