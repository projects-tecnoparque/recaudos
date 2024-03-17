<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $customers = Customer::query()
        ->allowedIncludes(['user'])
        ->allowedFilters(['document', 'names', 'surnames', 'email', 'status', 'code'])
        ->jsonPaginate();
        return CustomerResource::collection($customers);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return JsonResource
     */
    public function show($id): JsonResource
    {
        $customers = Customer::query()
        ->allowedIncludes(['user'])
        ->findOrFail($id);
        return CustomerResource::make($customers);
    }
}
