<?php
namespace Database\Factories;

use App\Models\Storelayout;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorelayoutFactory extends Factory
{
    protected $model = Storelayout::class;

    public function definition()
    {
        return [
            'areanumber' => $this->faker->unique()->word,
            'price' => $this->faker->numberBetween(100, 1000),
            'status' => true,
            'comment' => $this->faker->sentence,
            'useridbooking' => 3,
            'nameuserbooking' => 'Test User',
            'storedetail' => $this->faker->paragraph,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'confirmbooking' => true,
            'image_path' => null,
            'event_id' => null, // เชื่อมโยงกับ Event
        ];
    }
}
