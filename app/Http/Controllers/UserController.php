<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $users = User::query()
        ->allowedSorts([
            'document', 'name', 'surname', 'email', 'status'
        ])
        //->allowedFilters(['document', 'name', 'surname', 'email', 'status'])
        ->allowedSorts([
            'document', 'name', 'surname', 'email', 'status'
        ])
        ->sparseFielset()
        ->jsonPaginate();

        return UserResource::collection($users);
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
    public function show($id): JsonResource
    {
        $user = User::query()
        ->sparseFielset()
        ->findOrFail($id);
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
            'document_type_id' => $request->get('document_type_id'),
            'document' => $request->get('document'),
            'names' =>  $request->get('names'),
            'surnames' =>  $request->get('surnames'),
            'phone' =>  $request->get('phone'),
            'email' =>  $request->get('email'),
            'status' => $request->get('status')
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
            'document_type_id' => 'required',
            'document' => 'required|min:1|max:20|' . Rule::unique('users', 'document')->ignore($request->route('id')),
            'names' => 'required|min:1|max:50',
            'surnames' => 'required|min:1|max:50',
            'phone' => 'required|min:1|max:20',
            'email' => 'required|min:1|max:255|email|' . Rule::unique('users', 'email')->ignore($request->route('id')),
            'password' => 'required|min:1|max:255',
            'status' => 'required',
        ]);
    }
}
