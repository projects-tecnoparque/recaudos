<?php

use App\Models\DocumentType;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateDocumentTypeTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function can_create_document_types()
    {
        $response = $this->json('POST', '/tipos-documentos', [
            'data' => [
                'type' => 'TipoDocumentos',
                'attributes' => [
                    'abreviatura' => 'CC',
                    'nombre' => 'Cedula de ciudadadania',
                ],
            ]
        ]);

        $response->seeStatusCode(201);

        $documentType = DocumentType::first();

        // $response->seeHeader(
        //     'Location',
        //     url('/tipos-documentos/' . $documentType->getRouteKey())
        // );

        $response->seeJson([
            'data' => [
                'type' => 'TipoDocumentos',
                'id' => (string) $documentType->getRouteKey(),
                'attributes' => [
                    'abreviatura' => 'CC',
                    'nombre' => 'Cedula de ciudadadania',
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
        $response = $this->json('POST', '/tipos-documentos', [
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
        $response = $this->json('POST', '/tipos-documentos', [
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
