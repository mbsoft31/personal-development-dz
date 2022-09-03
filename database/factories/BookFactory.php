<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        $title = $this->faker->words(random_int(3,5), true);
        $content = "# Random content for Model\n\nthis is a random text written for demonstration purpose.";
        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "content" => $content,
            "price" => 0,
            "status" => $this->faker->randomElement(["draft", "published"]),
            "thumb" => "images/image.png",
        ];
    }
}
