<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'title'=>$this->faker->sentence(3,false),
            'slug'=>$this->faker->unique()->slug,
            'summary'=>$this->faker->text,
            'description'=>$this->faker->text,
            'stock'=>$this->faker->numberBetween(2,10),
            'brand_id'=>$this->faker->randomElement(Brand::pluck('id')->toArray()),
            'category_id'=>$this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_cat_id'=>$this->faker->randomElement(Category::where('is_parent',0)->pluck('id')),
            'photo'=>$this->faker->imageUrl('100','100'),
            'price'=>$this->faker->numberBetween(5000,10000),
'offer_price'=>$this->faker->numberBetween(3000,10000),
'discount'=>$this->faker->numberBetween(10,90),
'size'=>$this->faker->randomElement(['s','m','l']),
'condition'=>$this->faker->randomElement(['new','hot','popular']),
'vendor_id'=>$this->faker->randomElement(User::pluck('id')->toArray()),
'status'=>$this->faker->randomElement(['active','inactive']),
        ];
    }
}
