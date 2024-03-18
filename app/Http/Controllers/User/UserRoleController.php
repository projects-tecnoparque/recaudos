<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return array
     */
    public function index($id): array
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return RoleResource::collectionIdentifiers($user->roles);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AnonymousResourceCollection
     */
    public function show($id): AnonymousResourceCollection
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return RoleResource::newCollection($user->roles);
    }
}
