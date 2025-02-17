<?php

namespace App\Http\Controllers;

use App\Constants\BasicConstants;
use App\Events\Assignation;
use App\Http\Requests\SolicitudRequest;
use App\Listeners\AssignIncident;
use App\Models\Cola;
use App\Models\Solicitud;
use App\Models\TecnicoCola;
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

            $valid = $this->aditionals($valid);
            $valid['code'] = $this->createCode($cola);

            $toPersist = Solicitud::create($valid);

            event(new Assignation($toPersist));
//            dd($toPersist);

            return response()->json(['msg' => 'Solicitud Creada',
                'solicitud' => $toPersist ], Response::HTTP_OK);

        }catch( \Exception $e ){
            return response()->json(['msg' => $e->getMessage(), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }catch( \InvalidArgumentException $e){
            return response()->json(['msg' => $e->getMessage(), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    private function aditionals($array)
    {
        $array['is_promediable'] = true;
        $array['registry_by'] = "Denis";
        $array['updated_by'] = "Denis";
        $array['usuario_id'] = "bc6043b0-10e0-4712-95e0-6795d2555aef";
        $array['status'] = BasicConstants::STATUS_ACTIVE;
        return $array;
    }

    private function assignation($array){
        $cola = Cola::findByCategory($array['category_id']);
        $order = Cola::where('id', $cola[0])->first();
        $tecnico = TecnicoCola::where('cola_id', $cola[0])->where('order', $order->ultima_asignacion)->first();
        $array['tecnico_id'] = $tecnico->tecnico_id;
        $array['cola_id'] = $tecnico->cola_id;
        return $array;
    }

    private function createCode($array){
        return date("dd/mm/YYYYHHiis");
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
