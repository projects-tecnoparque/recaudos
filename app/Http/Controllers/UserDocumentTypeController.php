<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentTypeResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return JsonResource
     */
    public function index($id): array
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return DocumentTypeResource::identifier($user->documentType);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function show($id): JsonResource
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return DocumentTypeResource::make($user->documentType);
    }
}
