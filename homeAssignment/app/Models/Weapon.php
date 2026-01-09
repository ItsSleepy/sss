<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_id',
        'weapon_name',
        'slug',
        'weapon_type',
        'caliber'
    ];

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }

    public function armamentconfig(){
        return $this->hasMany(ArmamentConfig::class);
    }

    public function vehicles(){
        return $this->belongsToMany(Vehicle::class, 'armament_configs')
                    ->withPivot('location', 'quantity')
                    ->withTimestamps();
    }
}
