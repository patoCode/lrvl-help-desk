<?php

namespace App\Http\Controllers;

use App\Constants\BasicConstants;
use App\Http\Resources\ColaResource;
use App\Models\Cola;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ColaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = (new Cola)->newQuery();

        if(request()->filled('status')){
            $query->where('status', request('status'));
        }

        if(request()->filled('category')){
            $query->where('category_id', request('category'));
        }

        if (request()->filled('order_by')) {
            $direction = request('direction', 'asc'); // Si no se envía dirección, por defecto es ASC
            $query->orderBy(request('order_by'), $direction);
        }

        $perPage = request('per_page', 10);


        $list = $query->with('categoria')->paginate($perPage);
        return ColaResource::collection($list);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['cola' => new ColaResource(Cola::with('categoria')->findOrFail($id))], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */

//    ::::::::::::: its implementation is not necessary :::::::::::::
//    public function edit(string $id)
//    {
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cola = Cola::with('categoria')->findOrFail($id);
        $cola->status = BasicConstants::STATUS_IN_ACTIVE;
        $cola->save();
        return response()->json(['msg' => 'Elimnación correcta', 'cola' => new ColaResource($cola)], Response::HTTP_OK);
    }
}
