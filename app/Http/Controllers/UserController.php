<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        $users = User::allowedSorts([
            'document', 'name', 'surname', 'email', 'status'
        ])->jsonPaginate();

        return UserCollection::make($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request): UserResource
    {
        $this->saveUserRequest($request);

        $user = User::create([
            'document_type_id' => $request->get('tipo_documento_id'),
            'document' => $request->get('documento'),
            'names' =>  $request->get('nombres'),
            'surnames' =>  $request->get('apellidos'),
            'phone' =>  $request->get('telefono'),
            'email' =>  $request->get('correo'),
            'password' =>  bcrypt($request->get('password')),
            'status' => \App\Enums\BooleanStatus::True->value
        ]);

        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id): UserResource
    {
        $user = User::findOrFail($id);
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(Request $request, $id): UserResource
    {
        $user = User::findOrFail($id);

        $this->saveUserRequest($request);

        $user->update([
            'document_type_id' => $request->get('tipo_documento_id'),
            'document' => $request->get('documento'),
            'names' =>  $request->get('nombres'),
            'surnames' =>  $request->get('apellidos'),
            'phone' =>  $request->get('telefono'),
            'email' =>  $request->get('correo'),
            'password' =>  bcrypt($request->get('password')),
            'status' => $request->get('estado')
        ]);

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response(null, 204);
    }

    protected function saveUserRequest(Request $request): void
    {
        $this->validate($request, [
            'tipo_documento_id' => 'required',
            'documento' => 'required|min:1|max:20|' . Rule::unique('users', 'document')->ignore($request->route('id')),
            'nombres' => 'required|min:1|max:50',
            'apellidos' => 'required|min:1|max:50',
            'telefono' => 'required|min:1|max:20',
            'correo' => 'required|min:1|max:255|email|' . Rule::unique('users', 'email')->ignore($request->route('id')),
            'password' => 'required|min:1|max:255',
            'estado' => 'required',
        ]);
    }
}
