<?php

namespace App\Http\Controllers\DocumentType;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentTypeResource;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): AnonymousResourceCollection
    {
        $documentTypes = DocumentType::query()
            ->allowedIncludes(['users'])
            ->allowedFilters(['name', 'abbreviation', 'month', 'year'])
            ->allowedSorts(['name', 'abbreviation'])
            ->sparseFielset()
            ->jsonPaginate();

        return DocumentTypeResource::collection($documentTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request): DocumentTypeResource
    {

        $this->saveDocumentTypeRequest($request);

        $documentType = DocumentType::create([
            'abbreviation' => $request->get('abbreviation'),
            'name' =>  $request->get('name')
        ]);

        return DocumentTypeResource::make($documentType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): JsonResource
    {
        $documentType = DocumentType::query()
        ->allowedIncludes(['users'])
        ->sparseFielset()
        ->findOrFail($id);
        return DocumentTypeResource::make($documentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id): DocumentTypeResource
    {
        $documentType = DocumentType::findOrFail($id);

        $this->saveDocumentTypeRequest($request);

        $documentType->update([
            'abbreviation' => $request->get('abbreviation'),
            'name' =>  $request->get('name')
        ]);

        return DocumentTypeResource::make($documentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $documentType = DocumentType::findOrFail($id);
        $documentType->delete();
        return response(null, 204);
    }

    protected function saveDocumentTypeRequest(Request $request): void
    {
        $this->validate($request, [
            'abbreviation' => 'required|alpha_num|min:1|max:3|' . Rule::unique('document_types', 'abbreviation')->ignore($request->route('id')),
            'name' => 'required|min:1|max:50|' . Rule::unique('document_types', 'name')->ignore($request->route('id')),
        ]);
    }
}
