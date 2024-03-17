<?php

namespace App\Http\Controllers;

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
        $users = Role::query()
        ->allowedIncludes(['users'])
        ->allowedFilters(['name'])
        ->allowedSorts(['name'])
        ->sparseFielset()
        ->jsonPaginate();

        return RoleResource::collection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return JsonResource
     */
    public function show($id): JsonResource
    {
        $user = Role::query()
        ->allowedIncludes(['users'])
        ->sparseFielset()
        ->findOrFail($id);
        return RoleResource::make($user);
    }
}
