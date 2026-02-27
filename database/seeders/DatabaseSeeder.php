<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'nasir ali',
            'email' => 'nasiralibaloch110@gmail.com'
        ]);
        Listing::factory(5)->create([
            'user_id'=>$user->id
        ]);

        // Listing::create([
        //     'title' => 'Backend Developer',
        //     'tags' => 'laravel, php, api',
        //     'company' => 'Skynet Systems',
        //     'location' => 'Newark, NJ',
        //     'email' => 'email4@email.com',
        //     'website' => 'https://www.skynet.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
        // ]);
        // Listing::create([
        //     'title' => 'Junior Developer',
        //     'tags' => 'laravel, php, javascript',
        //     'company' => 'Wonka Industries',
        //     'location' => 'Boston, MA',
        //     'email' => 'email4@email.com',
        //     'website' => 'https://www.wonka.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minim'
        // ]);
        Listing::factory(6)->create();
    }
}
