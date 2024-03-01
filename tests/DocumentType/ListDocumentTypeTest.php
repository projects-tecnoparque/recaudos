<?php

use App\Models\DocumentType;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class ListDocumentTypeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_fetch_a_single_document_type()
    {
        $this->assertFalse(false);
    }
    /** @test */
    // public function can_fetch_a_single_document_type()
    // {
    //     $documentType = DocumentType::factory()->create();

    //     $response = $this->json('GET', "/tipos-documentos/{$documentType->getRouteKey()}");
    //     $response->seeJson([
    //         'data' => [
    //             'type' => 'TipoDocumentos',
    //             'id' => (string) $documentType->getRouteKey(),
    //             'attributes' => [
    //                 'abreviatura' => $documentType->abbreviation,
    //                 'nombre' => $documentType->name,
    //             ],
    //             'links' => [
    //                 'self' => url('/tipos-documentos/' . $documentType->getRouteKey())
    //             ]
    //         ]
    //     ]);
    // }

    /** @test */
    // public function can_fetch_all_document_types()
    // {
    //     $documentTypes = DocumentType::factory()->count(3)->create();
    //     $response = $this->json('GET', "/tipos-documentos/");
    //     $response->seeJson([
    //         'data' => [
    //             [
    //                 'type' => 'TipoDocumentos',
    //                 'id' => (string) $documentTypes[0]->getRouteKey(),
    //                 'attributes' => [
    //                     'abreviatura' => $documentTypes[0]->abbreviation,
    //                     'nombre' => $documentTypes[0]->name,
    //                 ],
    //                 'links' => [
    //                     'self' => url('/tipos-documentos/' . $documentTypes[0]->getRouteKey())
    //                 ]
    //             ],
    //             [
    //                 'type' => 'TipoDocumentos',
    //                 'id' => (string) $documentTypes[1]->getRouteKey(),
    //                 'attributes' => [
    //                     'abreviatura' => $documentTypes[1]->abbreviation,
    //                     'nombre' => $documentTypes[1]->name,
    //                 ],
    //                 'links' => [
    //                     'self' => url('/tipos-documentos/' . $documentTypes[1]->getRouteKey())
    //                 ]
    //             ],
    //             [
    //                 'type' => 'TipoDocumentos',
    //                 'id' => (string) $documentTypes[2]->getRouteKey(),
    //                 'attributes' => [
    //                     'abreviatura' => $documentTypes[2]->abbreviation,
    //                     'nombre' => $documentTypes[2]->name,
    //                 ],
    //                 'links' => [
    //                     'self' => url('/tipos-documentos/' . $documentTypes[2]->getRouteKey())
    //                 ]
    //             ]
    //         ],
    //         'links' => [
    //             'self' => url('/tipos-documentos')
    //         ]
    //     ]);
    // }
}
