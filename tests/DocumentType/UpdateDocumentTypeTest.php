<?php

use App\Models\DocumentType;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateDocumentTypeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_updated_document_types()
    {
        $documentType = DocumentType::factory()->create();
        $response = $this->json('PUT', '/tipos-documentos/'.$documentType->getRouteKey() , [
            'data' => [
                'type' => 'TipoDocumentos',
                'attributes' => [
                    'abreviatura' => 'UCC',
                    'nombre' => 'update documento ciudadania',
                ],
            ]
        ]);

        $response->seeStatusCode(200);


        $response->seeJson([
            'data' => [
                'type' => 'TipoDocumentos',
                'id' => (string) $documentType->getRouteKey(),
                'attributes' => [
                    'abreviatura' => 'UCC',
                    'nombre' => 'update documento ciudadania',
                ],
                'links' => [
                    'self' => url('/tipos-documentos/' . $documentType->getRouteKey())
                ]
            ]
        ]);
    }

    /** @test */
    public function abreviature_is_required()
    {
        $documentType = DocumentType::factory()->create();
        $response = $this->json('PUT', '/tipos-documentos'.$documentType->getRouteKey(), [
            'data' => [
                'attributes' => [
                    'nombre' => 'Cedula de ciudadadania',
                ],
            ]
        ]);

        $response->seeJsonDoesntContains([
            'data' => [
                'attributes' => [
                    'abrevitura' => 'CC',
                ],
            ]
        ]);
    }

    public function name_is_required()
    {
        $documentType = DocumentType::factory()->create();
        $response = $this->json('PUT', '/tipos-documentos'.$documentType->getRouteKey(), [
            'data' => [
                'attributes' => [
                    'abreviatura' => 'CC',
                ],
            ]
        ]);

        $response->seeJsonDoesntContains([
            'data' => [
                'attributes' => [
                    'nombre' => 'Cedula de ciudadadania',
                ],
            ]
        ]);

        $response->seeJsonStructure([
            'errors' => [
                [
                    'title', 'detail', 'source' => ['pointer']
                ]
            ]
        ]);
    }
}
