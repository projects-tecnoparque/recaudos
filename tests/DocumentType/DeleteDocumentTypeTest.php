<?php

use App\Models\DocumentType;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteDocumentTypeTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function can_delete_document_types()
    {
        $documentType = DocumentType::factory()->create();
        $this->json('DELETE', '/tipos-documentos/'.$documentType->getRouteKey())->seeStatusCode(204);

    }
}
