<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = "id";
    public $timestamps = true;
    // protected $dateFormat = "h:i:s";

    // when using Car::create  
    protected $fillable = ['name', 'founded', 'description', 'image', 'user_id'];

    // one to many 
    // one car has many cor_models
    public function carModels() {
        return $this->hasMany(CarModel::class);
    }

    // HasManyThrough 
    // one car has many car_models
    // one car models has many engines 
    public function engines() {
        // return $this->hasManyThrough('main model', 'intermediate model', 'FK_intermediate_Model', 'FK_main_model');
        return $this->hasManyThrough(
            Engine::class,
            CarModel::class,
            'car_id',  // FK in car_models  table
            'car_model_id'  // fk In engines table
            );
    }



    // HasONeThrough 
    //one car has one model
    // one model related to one productDate
    public function productionDate() {
        return $this->hasOneThrough(
            CarProductDate::class,
            CarModel::class,
            'car_id',  // fk in car_models
            'car_model_id' // fk in car_product_date
        );
    }

    // Many To Many Relationship 
    // one car belongs to many products
    // one products related to many cars
    public function products() {
        return $this->belongsToMany(Product::class);
    }

}
