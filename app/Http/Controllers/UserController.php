<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = (new User())->newQuery();

        if(request()->filled('status')){
            $query->where('status', request('status'));
        }

        if(request()->filled('fullname')){
            $query->where('fullname','LIKE', '%'.request('fullname').'%');
        }

        if(request()->filled('username')){
            $query->where('username','LIKE', '%'.request('username').'%');
        }

        if(request()->filled('email')){
            $query->where('email','LIKE', '%'.request('email').'%');
        }

        if(request()->filled('ldap')){
            $query->where('ldap', request('ldap'));
        }


        $perPage = request('per_page', 10);
        $list = $query->paginate($perPage);

        return UserResource::collection($list);
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
    public function store(UserRequest $req)
    {
        try{
            $user = User::create($req->validated());
            return response()->json(['user' => new UserResource($user)], Response::HTTP_OK);
        }catch(\Exception $e){
            return response()->json(['msg' => $e->getMessage(), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            return response()->json([new UserResource(User::findOrFail($id))], Response::HTTP_OK);
        }catch(\Exception $e){
            return response()->json(['msg' => 'Exception!','error'=> $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRequest $req, string $id)
    {
        $user = User::findOrFail($id);
        $user->fill($req->validated());

        $changedFields = $user->getDirty();

        if(!empty($changedFields)){
            $user->save();
            return response()->json(['user' => new UserResource($user),'changed' => $changedFields], Response::HTTP_OK);
        }else{
            return response()->json(['msg' => 'Error al actualizar usuario'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

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
        //
    }
}
