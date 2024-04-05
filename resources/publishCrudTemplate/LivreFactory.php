<?php

namespace Database\Factories;

use App\Models\Livre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LivreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Livre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        do {
            $word = fake()->unique->word()  . ' ' . Str::random(6);
        } while (Livre::whereTitle($word)->count() > 0);

        return [
            'title' => $word,
            'author' => $this->faker->name,
            'description' => $this->faker->text,
            'release_date' => $this->faker->dateTimeInInterval('-10 years', '+2 years'),
            'price' => $this->faker->randomFloat(2, 1, 999999),

            'user_id_creation' => User::factory()->create(),

            // 'telephone_mobile' => str_pad(str_replace([' ', '+33', '(', ')'], '', $this->faker->phoneNumber), 10, '0', STR_PAD_LEFT),
        ];
    }
}
