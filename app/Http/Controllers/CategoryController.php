<?php

namespace App\Http\Controllers;

use App\Events\CategoriaCreada;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Categoria;
use Illuminate\Http\Response;

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
    public function show($id)
    {
        return response()->json(['category' => Categoria::findOrFail($id)], Response::HTTP_OK);
    }
    public function store(CategoryRequest $req)
    {
        try {
            $categoria = Categoria::create($req->validated());
            event(new CategoriaCreada($categoria));
            return response()->json(['category' => new CategoryResource($categoria)], Response::HTTP_OK);
        }catch(\Exception $e){
            return response()->json(['msg' => $e->getMessage(), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function edit(CategoryRequest $req, string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->fill($req->validated());
        if($categoria->save()){
            return response()->json(['category' => new CategoryResource($categoria)], Response::HTTP_OK);
        }else{
            return response()->json(['msg' => 'Error al actualizar categoría'], response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(
            ['msg' => 'Categoría eliminada correctamente'],
            Response::HTTP_OK
        );
    }

}
