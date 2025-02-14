<?php

namespace App\Listeners;

use App\Constants\BasicConstants;
use App\Events\CategoriaCreada;
use App\Models\Cola;
use Illuminate\Support\Facades\Log;

class CrearColaParaCategoria
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CategoriaCreada $event): void
    {
        if(!Cola::where('category_id', $event->categoria->id)->where('status', BasicConstants::STATUS_ACTIVE)->exists()){
            $cola = Cola::create([
                'category_id' => $event->categoria->id,
                'ultima_asignacion' => 0,
                'status' => BasicConstants::STATUS_ACTIVE
            ]);
        }
    }
}
