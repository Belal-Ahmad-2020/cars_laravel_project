<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    
    protected $table = 'car_models';
    protected $primaryKey = "id";
    public $timestamps = true;
    // protected $dateFormat = "h:i:s";

    // when using Car::create  
    protected $fillable = ['car_id', 'model'];

    // one to many
    // one car model belongs to many cars
    public function cars() {
        return $this->belongsTo(Car::class);
    }
}
