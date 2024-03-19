<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $roles = Role::query()
        ->allowedIncludes(['permissions'])
        ->allowedFilters(['name'])
        ->allowedSorts(['name'])
        ->sparseFielset()
        ->jsonPaginate();

        return RoleResource::collection($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return JsonResource
     */
    public function show($id): JsonResource
    {
        $role = Role::query()
        ->allowedIncludes(['permissions'])
        ->sparseFielset()
        ->findOrFail($id);
        return RoleResource::make($role);
    }
}
