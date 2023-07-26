<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
	    // ]);
	    //
	$this->call(UserSeeder::class);
	$this->call(ItemSeeder::class);
	$this->call(TagSeeder::class);
	$this->call(ThemeSeeder::class);
	$this->call(FormatSeeder::class);
	$this->call(MemoSeeder::class);
	$this->call(TagRelSeeder::class);
	$this->call(TextSeeder::class);
    }
}
