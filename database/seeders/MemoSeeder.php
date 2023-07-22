<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('memos')->insert([
                    'theme_id' => 1,
                    'title' => 'CCC and DDD',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('memos')->insert([
                    'theme_id' => 1,
                    'title' => 'CCC or DDD or EEE',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('memos')->insert([
                    'theme_id' => 1,
                    'title' => 'EEE',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('memos')->insert([
                    'theme_id' => 2,
                    'title' => 'ABC',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]); 
            DB::table('memos')->insert([
                    'theme_id' => 2,
                    'title' => 'DEFG',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]); 
 	    DB::table('memos')->insert([
                    'theme_id' => 2,
                    'title' => 'HIJK',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
        ]);
    }
}
