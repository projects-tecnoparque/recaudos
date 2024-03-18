<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return JsonResource
     */
    public function index($id)
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return RoleResource::collectionIdentifiers($user->roles);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return RoleResource::newCollection($user->roles);
    }
}
