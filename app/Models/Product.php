<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // inverse many to many 
    public function cars() {
        return $this->belongsToMany(Car::class);
    }
}
