<?php

namespace Tests\Feature;

use App\Models\Requisition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthRoutesTest extends TestCase
{
    public function test_check_auth_routes(){

        $requisition = Requisition::factory()->create();
        $requisitionMake = Requisition::factory()->makeOne();

        $this->put(
            '/api/requisitions/' . $requisition['uuid'] . '/'
        )->assertStatus(401);

        $this->post(
            '/api/requisitions/',
            $requisitionMake->getAttributes()
        )->assertStatus(401);
    }
}
