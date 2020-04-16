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
        // $category_restaurant = new CategoryRestaurant();
        // $category_restaurant->name = "platos tipicos";
        // $category_restaurant->slug = "platos_tipicos";
        // $category_restaurant->save();

        // $category_restaurant = new CategoryRestaurant();
        // $category_restaurant->name = "comida china";
        // $category_restaurant->slug = "comida_china";
        // $category_restaurant->save();

        // $category_restaurant = new CategoryRestaurant();
        // $category_restaurant->name = "comida italiana";
        // $category_restaurant->slug = "comida_italiana";
        // $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida arabe";
        $category_restaurant->slug = "comida_arabe";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida china";
        $category_restaurant->slug = "comida_china";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida rapida";
        $category_restaurant->slug = "comida_rapida";
        $category_restaurant->status = true;
        $category_restaurant->save();

        // $category_restaurant = new CategoryRestaurant();
        // $category_restaurant->name = "restaurante de especialidades";
        // $category_restaurant->slug = "restaurante_de_especialidades";
        // $category_restaurant->status = true;
        // $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida francesa";
        $category_restaurant->slug = "comida_francesa";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida gourmet";
        $category_restaurant->slug = "comida_gourmet";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida italiana";
        $category_restaurant->slug = "comida_italiana";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida japonesa";
        $category_restaurant->slug = "comida_japonesa";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida libanesa";
        $category_restaurant->slug = "comida_libanesa";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida local";
        $category_restaurant->slug = "comida_local";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida mexicana";
        $category_restaurant->slug = "comida_mexicana";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida peruana";
        $category_restaurant->slug = "comida_peruana";
        $category_restaurant->status = true;
        $category_restaurant->save();

        $category_restaurant = new CategoryRestaurant();
        $category_restaurant->name = "Comida tailandesa";
        $category_restaurant->slug = "comida_tailandesa";
        $category_restaurant->status = true;
        $category_restaurant->save();
    }
}
