<?php

namespace App\Models;

use App\Constants\BasicConstants;
use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class TecnicoCola extends ModelBase
{
    use HasFactory;
    protected $table = "tecnico_colas";
    protected $fillable = ['id','order','tecnico_id','cola_id','status','registry_by'];
    public static function getOrderCola(string $id)
    {
        return self::where('cola_id', $id)
            ->where('status', BasicConstants::STATUS_ACTIVE)
            ->orderBy('order', 'desc')
            ->limit(1)
            ->pluck('order')
            ->toArray();
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
