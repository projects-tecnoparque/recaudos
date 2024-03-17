<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $permissions = Permission::query()
        ->allowedIncludes(['users', 'roles'])
        ->allowedFilters(['name'])
        ->allowedSorts(['name'])
        ->sparseFielset()
        ->jsonPaginate();

        return PermissionResource::collection($permissions);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return JsonResource
     */
    public function show($id): JsonResource
    {
        $permission = Permission::query()
        ->allowedIncludes(['users', 'roles'])
        ->sparseFielset()
        ->findOrFail($id);

        return PermissionResource::make($permission);
    }
}
