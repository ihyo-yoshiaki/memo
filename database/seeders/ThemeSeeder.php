<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('themes')->insert([
                    'name' => 'AAAに関する論文',
                    'user_id' => 1,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('themes')->insert([
                    'name' => '企業調べ',
                    'user_id' => 1,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
            DB::table('themes')->insert([
                    'name' => 'CCCに関する論文',
                    'user_id' => 2,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
            ]);
    }    
}
