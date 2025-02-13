<?php

namespace App\Events;

use App\Models\Categoria;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoriaCreada
{
    use Dispatchable, SerializesModels;

    public Categoria $categoria;
    /**
     * Create a new event instance.
     */
    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

}
