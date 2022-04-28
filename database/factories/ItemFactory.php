<?php

namespace Database\Factories;

use Domain\Items\Models\Item;
use Domain\Requisitions\Models\Requisition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Items\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'requisition_id' => function() {
                return Requisition::factory()->create()->first()->id;
            }
        ];
    }
}
