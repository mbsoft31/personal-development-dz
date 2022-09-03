<?php

namespace Database\Factories;

use App\Models\Course;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    #[ArrayShape(["title" => "array|string", "slug" => "string", "content" => "string", "price" => "int", "status" => "mixed", "thumb" => "string"])]
    public function definition(): array
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
