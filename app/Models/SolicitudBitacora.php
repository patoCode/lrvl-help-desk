<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class SolicitudBitacora extends ModelBase
{
    use HasFactory;
    protected $table = 'solicitud_bitacoras';
    protected $fillable = [
        'nro_evento',
        'evento',
        'observacion',
        'registry_by',
        'usuario_id',
        'category_id',
        'solicitud_id',
        'tecnico_id',
        'status_bitacora',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }
}
