<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_of_origin',
        'is_prime_contractor',
        'website_url'
    ];

    public function weapons(){
        return $this->hasMany(Weapon::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
