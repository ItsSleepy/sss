<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArmamentConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'weapon_id',
        'vehicle_id',
        'location',
        'quantity'
    ];

    public function weapon(){
        return $this->belongsTo(Weapon::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
