<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_id',
        'model_name',
        'slug',
        'vehicle_type',
        'unit_cost'
    ];

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }

    public function armamentconfig(){
        return $this->hasMany(ArmamentConfig::class);
    }

    public function weapons(){
        return $this->belongsToMany(Weapon::class, 'armament_configs')
                    ->withPivot('id', 'location', 'quantity')
                    ->withTimestamps();
    }
}
