<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentTypeResource;
use App\Models\User;
use App\Models\DocumentType;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id user
    //  * @return UserResource
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required|exists:document_types,id'
        ]);

        $user = User::query()->where('id', $id)
        ->firstOrFail();
        $documentTypeId = $request->input('id');
        $documentType = DocumentType::query()->where('id', $documentTypeId)->first();

        $user->update([
            'document_type_id' => $documentType->id
        ]);

        return DocumentTypeResource::identifier($user->documentType);

    }
}
