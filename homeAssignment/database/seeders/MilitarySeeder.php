<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Manufacturer;
use App\Models\Vehicle;
use App\Models\Weapon;

class MilitarySeeder extends Seeder
{
    public function run(): void
    {
        $gd = Manufacturer::create([
            'name' => 'General Dynamics',
            'country_of_origin' => 'USA',
            'is_prime_contractor' => true,
            'website_url' => 'https://www.gd.com'
        ]);

        $rheinmetall = Manufacturer::create([
            'name' => 'Rheinmetall',
            'country_of_origin' => 'Germany',
            'is_prime_contractor' => true,
            'website_url' => 'https://www.rheinmetall.com'
        ]);

        $fnHerstal = Manufacturer::create([
            'name' => 'FN Herstal',
            'country_of_origin' => 'Belgium',
            'is_prime_contractor' => false,
            'website_url' => 'https://www.fnherstal.com'
        ]);

        $cannon = Weapon::create([
            'manufacturer_id' => $rheinmetall->id,
            'weapon_name' => 'R120mm L/55 Tank Gun',
            'slug' => Str::slug('r120mm-l55-tank-gun'),
            'weapon_type' => 'Cannon',
            'caliber' => '120mm'
        ]);

        $machineGun = Weapon::create([
            'manufacturer_id' => $fnHerstal->id,
            'weapon_name' => 'M240 Coaxial Machine Gun',
            'slug' => Str::slug('m240-coaxial-mg'),
            'weapon_type' => 'Machine Gun',
            'caliber' => '7.62mm'
        ]);

        $abrams = Vehicle::create([
            'manufacturer_id' => $gd->id,
            'model_name' => 'M1A2 Abrams SEPv3',
            'slug' => Str::slug('m1a2-abrams-sepv3'),
            'vehicle_type' => 'MBT',
            'unit_cost' => 12500000
        ]);

        $leopard = Vehicle::create([
            'manufacturer_id' => $rheinmetall->id,
            'model_name' => 'Leopard 2A7',
            'slug' => Str::slug('leopard-2a7'),
            'vehicle_type' => 'MBT',
            'unit_cost' => 15000000
        ]);

        $abrams->weapons()->attach($cannon->id, ['location' => 'Main Turret', 'quantity' => 1]);
        $abrams->weapons()->attach($machineGun->id, ['location' => 'Coaxial Mount', 'quantity' => 1]);

        $leopard->weapons()->attach($cannon->id, ['location' => 'Main Turret', 'quantity' => 1]);

        echo "Military Database Seeded Properly cro";
    }
}
