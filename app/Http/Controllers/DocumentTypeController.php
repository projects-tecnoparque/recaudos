<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentTypeCollection;
use App\Http\Resources\DocumentTypeResource;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): DocumentTypeCollection
    {
        return DocumentTypeCollection::make(DocumentType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): DocumentTypeResource
    {
        $this->validate($request, [
            'data.attributes.abreviatura' => 'required',
            'data.attributes.nombre' => 'required',
        ]);
        
        $documentType = DocumentType::create([
            'abbreviation' => $request->input('data.attributes.abreviatura'),
            'name' =>  $request->input('data.attributes.nombre')
        ]);

        return DocumentTypeResource::make($documentType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): DocumentTypeResource
    {
        $documentType = DocumentType::findOrFail($id);
        // dd($documentType);
        return DocumentTypeResource::make($documentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
