<?php

namespace App\Http\Controllers;

use App\Http\Resources\TecnicoResource;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function showCategories(string $id)
    {
        return response()->json(['user' => new TecnicoResource(Tecnico::with('user')->findOrFail($id))], Response::HTTP_OK);
    }


}
