<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Diagnostic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiagnosticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diagnostic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::count() ? Customer::pluck('id')->random() : Customer::factory()->create(),
            'created_by' => User::count() ? User::pluck('id')->random() : User::factory()->create(), 
            'legal_name' => $this->faker->company(),
            'branches' => $this->faker->sentence(),
            'brands' => $this->faker->sentence(),
            'competitors' => $this->faker->paragraph(),
            'competitor_products' => $this->faker->paragraph(),
            'products' => $this->faker->paragraph(),
            'started_at' => Carbon::now()->toDateTimeString(),
        ];
    }
}
