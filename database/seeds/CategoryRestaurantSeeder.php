<?php

use App\CategoryRestaurant;
use Illuminate\Database\Seeder;

class CategoryRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "platos tipicos";
        $category_restaurant->slug = "platos_tipicos";
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "comida china";
        $category_restaurant->slug = "comida_china";
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "comida italiana";
        $category_restaurant->slug = "comida_italiana";
        $category_restaurant->save();
    }
}
