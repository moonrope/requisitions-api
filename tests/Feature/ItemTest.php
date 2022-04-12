<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as STATUS;
use Tests\TestCase;
use Throwable;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    private Authenticatable $user;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_item()
    {
        $requisitions = Requisition::factory()->createOne();

        $items = Item::factory()
            ->count(15)
            ->create(
                [
                    'requisition_id' => $requisitions->id
                ]
            );

        $firstRecord = $items->first();
        $this->get('/api/items')
            ->assertJsonCount(15, 'data')
            ->assertStatus(STATUS::HTTP_OK)
            ->assertSeeText($firstRecord->name)
            ->assertSeeText($firstRecord->requisition_id)
            ->assertSeeText($firstRecord->reference);
    }

    public function test_create_item()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        $requisition = Requisition::factory()->createOne();
        $item = Item::factory()->makeOne(['requisition_id' => $requisition->id]);

        $this->post(
            '/api/items',
            [
                'name' => $item->name,
                'requisition_uuid' => $requisition->uuid
            ])
            ->assertStatus(STATUS::HTTP_CREATED)
            ->assertJsonFragment(
                [
                    'name' => $item->name,
                    'uuid' => $requisition->uuid
                ]
            );
    }

    public function test_destroy_item()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        $item = Item::factory()->create()->getAttributes();

        $this->delete('/api/items/'. $item['reference'] .'/')
            ->assertStatus(STATUS::HTTP_OK)
            ->assertSeeText('Success: Item deleted');
    }

    /**
     * @throws Throwable
     */
    public function test_destroy_non_existing_item()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());

        $fakeItemUuid = Str::uuid();

        $this->delete('/api/items/'. $fakeItemUuid .'/')
        ->assertStatus(STATUS::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonFragment(
            [
                'message' => 'The selected item uuid is invalid.'
            ]
        );
    }

    public function test_update_item()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        Item::factory()->create();

        $response = $this->get('/api/items')
            ->assertStatus(STATUS::HTTP_OK)
            ->assertJsonCount(1, 'data');

        $item = $response->json('data.0');
        $item['name'] = 'updated item';

        $this->put(
            '/api/items/' . $item['reference'] . '/',
            [
                'name' => $item['name'],
            ])
            ->assertStatus(STATUS::HTTP_OK)
            ->assertJson(
                [
                    'data' => [
                        'name' => $item['name']
                    ]
                ]
            );
    }

    public function test_update_non_existing_item()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        $fakeItemUuid = Str::uuid();
        $this->put('/api/items/'. $fakeItemUuid .'/')
            ->assertStatus(STATUS::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonFragment(['itemUuid' => ['The selected item uuid is invalid.']]);
    }
}
