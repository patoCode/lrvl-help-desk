<?php

namespace App\Models;

use App\Constants\BasicConstants;
use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cola extends ModelBase
{
    /** @use HasFactory<\Database\Factories\ColaFactory> */
    use HasFactory;
    protected $table = 'colas';
    protected $fillable = [
                            'id',
                            'ultima_asignacion',
                            'max_value',
                            'category_id',
                            'status'
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id','id');
    }

    public static function findByCategory(string $id)
    {
        return self::where('category_id', $id)
                    ->where('status', BasicConstants::STATUS_ACTIVE)
                    ->orderBy('created_at', 'desc')
                    ->pluck('id')
                    ->toArray();
    }

    public static function findColaInCategory(string $id)
    {
        return self::where('category_id', $id)
            ->where('status', BasicConstants::STATUS_ACTIVE)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public static function findColaInCategoryArray(string $id)
    {
        return self::where('category_id', $id)
            ->where('status', BasicConstants::STATUS_ACTIVE)
            ->orderBy('created_at', 'desc')
            ->get();
    }



}
