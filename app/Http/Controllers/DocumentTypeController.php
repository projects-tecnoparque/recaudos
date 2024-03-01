<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentTypeCollection;
use App\Http\Resources\DocumentTypeResource;
use App\Models\DocumentType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): DocumentTypeCollection
    {
        $documentTypes = DocumentType::allowedSorts(['name', 'abbreviation']);

        return DocumentTypeCollection::make(
            $documentTypes->paginate(
                $perPage = request('page.size', 15),
                $columns = ['*'],
                $pageName = 'page[number]',
                $page = request('page.number', 1)
            )->appends(request()->only('sort','page.size'))
        );
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
            'abbreviation' => $request->get('abreviatura'),
            'name' =>  $request->get('nombre')
        ]);

        return DocumentTypeResource::make($documentType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id): DocumentTypeResource
    {
        $documentType = DocumentType::findOrFail($id);
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
            'abbreviation' => $request->get('abreviatura'),
            'name' =>  $request->get('nombre')
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
            'abreviatura' => 'required|alpha_num|min:1|max:3|' . Rule::unique('document_types', 'abbreviation')->ignore($request->route('id')),
            'nombre' => 'required|min:1|max:50|' . Rule::unique('document_types', 'name')->ignore($request->route('id')),
        ]);
    }
}
