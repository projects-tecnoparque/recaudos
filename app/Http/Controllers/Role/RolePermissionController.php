<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Models\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return array
     */
    public function index($id): array
    {
        $role = Role::query()->where('id', $id)->firstOrFail();
        return PermissionResource::collectionIdentifiers($role->permissions);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AnonymousResourceCollection
     */
    public function show($id): AnonymousResourceCollection
    {
        $role = Role::query()->where('id', $id)->firstOrFail();
        return PermissionResource::newCollection($role->permissions);
    }
}
