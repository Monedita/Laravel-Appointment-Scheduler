<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create the test admin user for the site
        User::factory()->create([
            'name' => 'Dentist Jorge Emanuel',
            'email' => 'admin@admin.com',
            'admin' => true,
        ]);
        
        //create 10 fake users for testing
        User::factory(10)->create();

        //create specific test user for the site
        User::factory()->create([
            'name' => 'Jhon Something',
            'email' => 'user@user.com',
        ]);
        
        //create 5 fake appointments for testing
        Appointment::factory(5)->create();
    }
}
