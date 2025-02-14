<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolicitudRequest;
use App\Models\Cola;
use App\Models\Solicitud;
use App\Services\SolicitudValidationService;
use Illuminate\Http\Response;

class SolicitudController extends Controller
{
    public function index()
    {
        // TODO ADD FILTERS
        return response()->json([ 'list' => Solicitud::all()
        ], Response::HTTP_OK);
    }

    public function store(SolicitudRequest $req)
    {
        try{
            $valid = $req->validated();
            SolicitudValidationService::validateCategoryActive($req->category_id);
            $cola = Cola::findByCategory($req->category_id);
            SolicitudValidationService::validateColaHasTechnician($cola[0]);
            dd($valid);
        }catch( \Exception $e ){
            return response()->json(['msg' => $e->getMessage(), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }catch( \InvalidArgumentException $e){
            return response()->json(['msg' => $e->getMessage(), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
