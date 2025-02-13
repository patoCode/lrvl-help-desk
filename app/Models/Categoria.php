<?php

namespace App\Models;

use App\Models\base\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Categoria extends ModelBase
{
    use HasFactory;
    public $table = "categoria";
    public $fillable = ['id','nombre','is_public','is_promediable','is_schedulable','status'];
}
