<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => Hash::make("123456"),
            'email_verified_at' => $this->faker->dateTime(),
            'last_login_datetime' => $this->faker->dateTime(),
            'last_login_os' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'last_login_ip' => $this->faker->ipv4(),
            'last_login_useragent' => $this->faker->text(),
        ];
    }
}
