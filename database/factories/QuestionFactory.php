<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'option_1'=>$this->faker->sentence(),
            'option_2'=>$this->faker->sentence(),
            'option_3'=>$this->faker->sentence(),
            'option_4'=>$this->faker->sentence(),
            'right_ans'=>$this->faker->numberBetween(1,4),
        ];
    }
}
