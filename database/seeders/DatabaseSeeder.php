<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\Service;
use App\Models\Stylist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name' => 'Muhammad Rizky',
            'email' => 'rizkysafdila@gmail.com',
            'is_admin' => 1
        ]);
        
        User::factory(1)->create([
            'name' => 'Tajul',
            'email' => 'tajul@gmail.com'
        ]);
        
        Service::create([
            'service' => 'Regular Haircut',
            'price' => 40000
        ]);
        
        Service::create([
            'service' => 'Kids Haircut',
            'price' => 35000
        ]);
        
        Service::create([
            'service' => 'Shave',
            'price' => 20000
        ]);
        
        Service::create([
            'service' => 'Basic Hair Colour',
            'price' => 60000
        ]);
        
        Service::create([
            'service' => 'Hairstyling',
            'price' => 25000
        ]);
        
        Service::create([
            'service' => 'Creambath/Mask',
            'price' => 45000
        ]);
        
        Service::create([
            'service' => 'Facial Treatment',
            'price' => 75000
        ]);

        Customer::factory(7)->create();

        Stylist::factory(5)->create();

        PaymentMethod::create([
            'method' => 'Cash',
        ]);

        PaymentMethod::create([
            'method' => 'Shopeepay',
            'rek_number' => '608082361002021',
        ]);

        PaymentMethod::create([
            'method' => 'Link Aja',
            'rek_number' => '082361002021',
        ]);
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
