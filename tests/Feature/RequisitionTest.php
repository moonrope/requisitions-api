<?php

namespace Tests\Feature;

use App\Models\Requisition;
use App\Models\User;
use Database\Factories\RequisitionFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response as STATUS;
use Tests\TestCase;
use Throwable;

class RequisitionTest extends TestCase
{
    use RefreshDatabase;

    private Authenticatable $user;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_requisition()
    {
        $data = Requisition::factory()->count(15)->create();
        $firstRecord = $data->first();
        $this->get('/api/requisitions')
            ->assertJsonCount(15, 'data')
            ->assertStatus(STATUS::HTTP_OK)
            ->assertSeeText($firstRecord->name)
            ->assertSeeText($firstRecord->description)
            ->assertSeeText($firstRecord->uuid);
    }

    public function test_create_requisition()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        $requisition = RequisitionFactory::new()->makeOne()->getAttributes();
        $this->post('/api/requisitions', $requisition)
            ->assertStatus(STATUS::HTTP_CREATED)
            ->assertJsonFragment(
                [
                    'name' => $requisition['name'],
                    'description' => $requisition['description'],
                ]
            );
    }

    public function test_destroy_requisition()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        $requisition = RequisitionFactory::new()->create()->getAttributes();

        $this->delete('/api/requisitions/'. $requisition['uuid'] .'/')
            ->assertStatus(STATUS::HTTP_OK)
            ->assertSeeText('Success: requisition deleted');
    }

    /**
     * @throws Throwable
     */
    public function test_destroy_non_existing_requisition()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());

        $fakeRequisitionUuid = Str::uuid();

        $this->delete('/api/requisitions/'. $fakeRequisitionUuid .'/')
        ->assertStatus(STATUS::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonFragment(
            [
                'message' => 'The selected requisition uuid is invalid.'
            ]
        );
    }

    public function test_update_requisition()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        Requisition::factory()->create();
        $response = $this->get('/api/requisitions')
            ->assertStatus(STATUS::HTTP_OK)
            ->assertJsonCount(1, 'data');

        $requisitionUpdated = $response->json('data.0');
        $requisitionUpdated['name'] = 'updated';
        $requisitionUpdated['description'] = 'updated description';

        $this->put(
            '/api/requisitions/' . $requisitionUpdated['uuid'] . '/',
            [
                'name' => $requisitionUpdated['name'],
                'description' => $requisitionUpdated['description'],
            ])
            ->assertStatus(STATUS::HTTP_OK)
            ->assertJson(
                [
                    'data' => [
                        'name' => $requisitionUpdated['name'],
                        'description' => $requisitionUpdated['description'],
                    ]
                ]
            );
    }

    public function test_update_non_existing_requisition()
    {
        $this->user = Sanctum::actingAs(User::factory()->create());
        $fakeRequisitionUuid = Str::uuid();
        $this->put('/api/requisitions/'. $fakeRequisitionUuid .'/')
            ->assertStatus(STATUS::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonFragment(['message' => 'The selected requisition uuid is invalid.']);
    }
}