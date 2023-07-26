<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('texts')->insert([
		    'format_id' => 3,
		    'memo_id' => 1,
		    'content' => 'あああああああああああああ',
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('texts')->insert([
		    'format_id' => 3,
		    'memo_id' => 2,
		    'content' => '？？？？？？？？',
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('texts')->insert([
		    'format_id' => 3,
		    'memo_id' => 3,
		    'content' => 'いい',
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('texts')->insert([
		    'format_id' => 5,
		    'memo_id' => 4,
		    'content' => '元気',
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('texts')->insert([
		    'format_id' => 5,
		    'memo_id' => 5,
		    'content' => 'すごい',
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('texts')->insert([
		    'format_id' => 5,
		    'memo_id' => 6,
		    'content' => 'やりがい',
		    'updated_at' => new DateTime(),
	    ]);
    }
}
