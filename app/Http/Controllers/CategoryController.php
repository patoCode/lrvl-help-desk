<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{

    public function index()
    {
        $query = (new Categoria)->newQuery();
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        // Filtrar por nombre si está presente
        if (request()->filled('nombre')) {
            $query->where('nombre', 'ILIKE', '%' . request('nombre') . '%');
        }

        // Filtrar por fecha de creación (rango de fechas)
        if (request()->filled('fecha_inicio') && request()->filled('fecha_fin')) {
            $query->whereBetween('created_at', [request('fecha_inicio'), request('fecha_fin')]);
        }

        // Ordenación dinámica
        if (request()->filled('order_by')) {
            $direction = request('direction', 'asc'); // Si no se envía dirección, por defecto es ASC
            $query->orderBy(request('order_by'), $direction);
        }

        $perPage = request('per_page', 10);

        // Ejecutar la consulta con paginación
        $list = $query->paginate($perPage);
        return CategoryResource::collection($list);
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'nombre' => 'required|min:4',
        ]);

        try {
            $toPersist = $req->all();
            $categoria = Categoria::create($toPersist);
            return new CategoryResource($categoria);
        }catch(\Exception $e){
            return response()->json(['msg' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        return Categoria::findOrFail($id);
    }
}
