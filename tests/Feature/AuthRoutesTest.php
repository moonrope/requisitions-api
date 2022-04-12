<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Requisition;
use Tests\TestCase;

class AuthRoutesTest extends TestCase
{
    public function test_check_auth_routes_requisition(){

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

    public function test_check_auth_routes_items(){

        $item = Item::factory()->create();
        $itemMake = Requisition::factory()->makeOne();

        $this->put(
            '/api/items/' . $item['reference'] . '/'
        )->assertStatus(401);

        $this->post(
            '/api/items/',
            $itemMake->getAttributes()
        )->assertStatus(401);
    }
}
