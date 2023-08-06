<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        // Generate a temporary image using Faker
        $tempImagePath = $this->faker->image(storage_path('app/public'), 100, 100, null, false);

        // Define the target directory and file name
        $targetDirectory = 'profile_pictures/';
        $targetFileName = uniqid() . '.jpg';

        // Move the generated image to the target directory
        File::move(storage_path('app/public') . '/' . basename($tempImagePath), storage_path('app/public') . '/' . $targetDirectory . $targetFileName);

        return [
            'name' => $this->faker->name,
            'father_name' => $this->faker->name,
            'cnic' => $this->faker->unique()->regexify('\d{5}-\d{7}-\d{1}'),
            'dob' => $this->faker->date,
            'contact_no' => $this->faker->regexify('^\d{4}-\d{7}$'),
            'street_address' => $this->faker->optional()->address,
            'city' => $this->faker->city,
            'state' => $this->faker->optional()->state,
            'country' => $this->faker->country,
            'experience' => $this->generateExperienceData(),
            // 'profile_picture' => $this->faker->image(storage_path('app/public/profile_pictures'), 100, 100, null, false),
            'profile_picture' => $targetDirectory . $targetFileName,
            'status' => $this->faker->randomElement([0, 1])
        ];
    }

    private function generateExperienceData()
    {
        $experienceData = [];

        for ($i = 0; $i < rand(0, 2); $i++) {
            $experienceData[] = [
                'title' => $this->faker->jobTitle,
                'description' => $this->faker->optional()->text(20),
                'from' => $this->faker->date,
                'to' => $this->faker->date
            ];
        }

        return $experienceData;
    }
}
