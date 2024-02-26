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
        $documentType = DocumentType::factory()->create();
        // dd($documentType->getRouteKey());
       
        $response = $this->json('GET',"/tipos-documentos/{$documentType->getRouteKey()}");
        $response->seeJson([
            'data' => [
                'type' => 'TipoDocumentos',
                'id' => $documentType->getRouteKey(),
                'attributes' => [
                    'abreviatura' => $documentType->abbreviation,
                    'nombre' => $documentType->name,
                ],
                'links' => [
                    'self' => url('/tipos-documentos/'.$documentType->getRouteKey())
                ]
            ]
        ]);
    }
}
