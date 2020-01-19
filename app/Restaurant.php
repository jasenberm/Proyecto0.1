<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function category_restaurant()
    {
        return $this->belongsTo('App\CategoryRestaurant');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Security\User');
    }

    public function sliders()
    {
        return $this->hasMany('App\Slider');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
}
