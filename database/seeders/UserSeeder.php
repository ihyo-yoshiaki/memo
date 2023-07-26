<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('users')->insert([
		    'name' => 'user1',
		    'email' => 'user1@gmail.com',
		    'password' => Hash::make('password1'),
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);

	    DB::table('users')->insert([
		    'name' => 'user2',
		    'email' => 'user2@gmail.com',
		    'password' => Hash::make('password2'),
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);

	    DB::table('users')->insert([
		    'name' => 'user3',
		    'email' => 'user3@gmail.com',
		    'password' => Hash::make('password3'),
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
    }
}
