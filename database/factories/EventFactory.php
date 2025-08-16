<?php
namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'plan_number' => $this->faker->unique()->word,
            'eventstart_date' => $this->faker->date,
            'eventend_date' => $this->faker->date,
            'detail' => $this->faker->sentence,
        ];
    }
}
