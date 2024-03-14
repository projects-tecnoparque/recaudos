<?php

use App\Models\DocumentType;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteDocumentTypeTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function can_delete_document_types()
    {
        $user = User::factory()->create();

        $documentType = DocumentType::factory()->create();
        $this
        ->actingAs($user)
        ->json('DELETE', '/tipos-documentos/'.$documentType->getRouteKey())->seeStatusCode(204);

    }
}
