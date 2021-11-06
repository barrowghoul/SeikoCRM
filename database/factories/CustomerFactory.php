<?php

namespace Database\Factories;

use App\Models\Customer;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'contact' => $this->faker->name(),
            'mobile' => $this->faker->phoneNumber(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->email(),
            'status' =>$this->faker->randomElement([1,2]),
            'approval_status' =>$this->faker->randomElement([1,2,3]),
            'started_at' => Carbon::now()->toDateTimeString(),
            'created_by' => User::factory(),            
        ];
    }
}
