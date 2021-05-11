<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            /* because user id 1 is admin, and then are 10 fakes users created
            I use random in a range and then unique in order to have only one
            appointment per active user */
            'user_id' => $this->faker->unique()->numberBetween(2, 11),
            'treatment' => $this->faker->sentence(3),
            //'date' => $this->faker->date('Y_m_d','now'),
            'date' => $this->faker->dateTimeBetween('now', '+1 week')->format('Y_m_d'),
            /* in the next field, hour field is important to use unique() in
            order to avoid having multiple appointments in the same hour,
            then I multiply the integer to get hours insted of seconds */
            'hour' => $this->faker->unique()->numberBetween(8, 16),
        ];
    }
}
