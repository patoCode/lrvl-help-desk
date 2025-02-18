<?php

namespace App\Http\Controllers;

use App\Constants\BasicConstants;

use App\Constants\BitacoraStatusEnum;
use App\Constants\SolicitudEventoEnum;
use App\Events\AsignarIncidente;
use App\Events\BitacoraRegister;
use App\Http\Requests\EventSolicitudRequest;
use App\Http\Requests\SolicitudRequest;
use App\Models\Cola;
use App\Models\Solicitud;
use App\Models\TecnicoCola;
use App\Services\ConfigSystemService;
use App\Services\SolicitudValidationService;
use Illuminate\Http\Response;

class SolicitudController extends Controller
{
    private ConfigSystemService $config;
    public function __construct(ConfigSystemService $config)
    {
        $this->config = $config;
    }
    public function index()
    {
        // TODO ADD FILTERS
        return response()->json([ 'list' => Solicitud::all()
        ], Response::HTTP_OK);
    }

    public function store(SolicitudRequest $req)
    {
        try{
            $event = SolicitudEventoEnum::CREATED;

            $valid = $req->validated();
            SolicitudValidationService::validateCategoryActive($req->category_id);
            $cola = Cola::findColaInCategory($req->category_id);
            SolicitudValidationService::validateColaHasTechnician($cola->id);
            $valid = $this->aditionals($valid);
            $valid['code'] = $this->createCode($cola);
            $toPersist = Solicitud::create($valid);

            if($this->config->autoAssign()){
                event(new AsignarIncidente($toPersist, $cola));
            }

            if ($toPersist->tecnico_id == null) {
                $event = SolicitudEventoEnum::CREATED_NOT_ASSIGNED;
            }

            event(new BitacoraRegister($toPersist,
                "Solicitud Creada",
                $event,
                BitacoraStatusEnum::INITIAL));

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
        $array['registry_by'] = auth()->user()->username;
        $array['updated_by'] = auth()->user()->username;
        $array['usuario_id'] = auth()->user()->id;
        $array['status'] = SolicitudEventoEnum::CREATED;
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

    public function event(EventSolicitudRequest $req)
    {
        try{
            $valid = $req->validated();
            $incident = Solicitud::findOrFail($valid['incidente']);

            if($this->isAvailable($incident)){
                return response()->json([
                    'msg' => 'Error! La solicitud ya esta cerrada',
                ], Response::HTTP_ACCEPTED);
            }

            event(new BitacoraRegister($incident,
                "Evento registrado",
                SolicitudEventoEnum::ATTENTION,
                BitacoraStatusEnum::PARTIAL));

            return response()->json([
                'msg' => 'registro Ok',
                'detalle' => $valid
            ], Response::HTTP_OK);
        }catch( \Exception $e ){
            return response()->json([
                'msg' => "EXCEPTION",
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function solve(EventSolicitudRequest $req)
    {
        try{
            $valid = $req->validated();
            $incident = Solicitud::findOrFail($valid['incidente']);

            if($this->isAvailable($incident)){
                return response()->json([
                    'msg' => 'Error! La solicitud ya esta cerrada',
                ], Response::HTTP_ACCEPTED);
            }

            event(new BitacoraRegister($incident,
                "Incidente solucionado",
                SolicitudEventoEnum::CLOSE,
                BitacoraStatusEnum::FINISH));

            $incident->status = SolicitudEventoEnum::CLOSE;
            $incident->save();

            return response()->json([
                'msg' => 'registro Ok',
                'detalle' => $valid
            ], Response::HTTP_OK);
        }catch( \Exception $e ){
            return response()->json([
                'msg' => "EXCEPTION",
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function reject(EventSolicitudRequest $req)
    {
        try{
            $valid = $req->validated();
            $incident = Solicitud::findOrFail($valid['incidente']);

            if($this->isAvailable($incident)){
                return response()->json([
                    'msg' => 'Error! La solicitud ya esta cerrada',
                ], Response::HTTP_ACCEPTED);
            }

            event(new BitacoraRegister($incident,
                "Incidente solucionado",
                SolicitudEventoEnum::REJECT,
                BitacoraStatusEnum::FINISH));

            $incident->status = SolicitudEventoEnum::REJECT;
            $incident->save();

            return response()->json([
                'msg' => 'registro Ok',
                'detalle' => $valid
            ], Response::HTTP_OK);
        }catch( \Exception $e ){
            return response()->json([
                'msg' => "EXCEPTION",
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    private function isAvailable($incident): bool
    {
        return $incident->status === SolicitudEventoEnum::CLOSE->value || $incident->status === SolicitudEventoEnum::REJECT->value;
    }
}
