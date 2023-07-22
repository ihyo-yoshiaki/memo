<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTIme;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('formats')->insert([
                    'theme_id' => 1,
                    'item_id' => 1,
                    'name' => '著者',
                    'order' => 1,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
	    ]);
	    DB::table('formats')->insert([
                    'theme_id' => 1,
                    'item_id' => 1,
                    'name' => 'キーワード',
		    'order' => 2,
		    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('formats')->insert([
                    'theme_id' => 1,
                    'item_id' => 2,
                    'name' => '概要',
                    'order' => 3,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('formats')->insert([
                    'theme_id' => 2,
                    'item_id' => 1,
                    'name' => '業種',
                    'order' => 1,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('formats')->insert([
                    'theme_id' => 2,
                    'item_id' => 2,
                    'name' => '概要',
                    'order' => 2,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('formats')->insert([
                    'theme_id' => 3,
                    'item_id' => 1,
                    'name' => '著者',
                    'order' => 1,
                    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
            DB::table('formats')->insert([
                    'theme_id' => 3,
                    'item_id' => 2,
                    'name' => '概要',
                    'order' => 2,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
            ]);
    }
}
