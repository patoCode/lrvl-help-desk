<?php

namespace App\Http\Controllers;

use App\Http\Resources\TecnicoResource;
use App\Models\Cola;
use App\Models\Tecnico;
use App\Models\TecnicoCola;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TecnicoController extends Controller
{
    public function index()
    {
        //TODO ADD FILTERS
        return Tecnico::with('user')->paginate(10);
    }

    public function show(string $id)
    {
        return response()->json(['user' => new TecnicoResource(Tecnico::with('user')->findOrFail($id))], Response::HTTP_OK);
    }

    public function notInCategory(string $category)
    {
        $result = collect();
        $colas = Cola::findColaInCategoryArray($category);
        foreach($colas as $cola){
            $tecnicos = TecnicoCola::where('cola_id', $cola->id)->pluck('tecnico_id')->toArray();
            $availables = Tecnico::whereNotIn('id', $tecnicos)->with('user')->get();
            $result = $result->merge($availables);
        }
        return TecnicoResource::collection($result);
    }

}
