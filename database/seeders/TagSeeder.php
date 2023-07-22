<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('tags')->insert([
		    'name' => 'ZZZZZ',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'YYY',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'WWW',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'abcd',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'efghi',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'klmn',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'VVV',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'XXX',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'jkl',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'メーカー',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'BtoB',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'サービス業',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'BtoB',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => 'Web系',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tags')->insert([
		    'name' => '独立系',
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
    }
}
