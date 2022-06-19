<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */
    protected $model = Coupon::class;
    public function definition()
    {
        return [
            //
                'coupon_code' => Str::random(6),
                'discount' => $this->faker->randomDigit,
                'expiry_date' => $this->faker->date(),
                'status' => $this->faker->boolean()     
        ];
    }
}
