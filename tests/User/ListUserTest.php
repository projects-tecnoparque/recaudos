<?php

use App\Models\DocumentType;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class ListUserTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function can_fetch_a_single_document_type()
    {
        DocumentType::factory()->create();
        $user = User::factory()->create();

        $response = $this->json('GET',"/usuarios/{$user->getRouteKey()}");
        $response->seeJson([
            'data' => [
                'type' => 'Usuarios',
                'id' => (string) $user->getRouteKey(),
                'attributes' => [
                    'documento' => $user->document,
                    'nombres' => $user->names,
                    'apellidos' => $user->surnames,
                    'correo' => $user->email,
                ],
                'links' => [
                    'self' => url('/usuarios/' . $user->getRouteKey())
                ]
            ]
        ]);
    }
}
