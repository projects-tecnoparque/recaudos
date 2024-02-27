<?php

use App\Http\Middleware\ValidateJsonApiHeaders;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ValidateJsonApiHeadersTest extends TestCase
{
    /** @test */
    public function accept_header_must_be_present_in_all_request()
    {


        $this->get('test_route')->seeStatusCode(406);
        $this->get('test_route', [
            'accept' => 'application/vnd.api+json'
        ])->seeStatusCode(200);
    }
}
