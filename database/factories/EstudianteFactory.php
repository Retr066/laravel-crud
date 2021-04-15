<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstudianteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estudiante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastname,
            'fecha_de_nacimiento' => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null) ,
            'correo' => $this->faker->email,
            'curso' => $this->faker->bs ,
        ];

    }
}
