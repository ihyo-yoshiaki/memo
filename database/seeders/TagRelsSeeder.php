<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
class TagRelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('tag_rels')->insert([
		    'format_id' => 1,
		    'memo_id' => 1,
		    'tag_id' => 1,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 1,
		    'memo_id' => 1,
		    'tag_id' => 2,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 1,
		    'memo_id' => 1,
		    'tag_id' => 3,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 2,
		    'memo_id' => 1,
		    'tag_id' => 4,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 2,
		    'memo_id' => 1,
		    'tag_id' => 5,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 1,
		    'memo_id' => 2,
		    'tag_id' => 3,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 2,
		    'memo_id' => 2,
		    'tag_id' => 6,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 1,
		    'memo_id' => 3,
		    'tag_id' => 7,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 1,
		    'memo_id' => 3,
		    'tag_id' => 8,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 2,
		    'memo_id' => 3,
		    'tag_id' => 5,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 2,
		    'memo_id' => 3,
		    'tag_id' => 9,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 4,
		    'memo_id' => 4,
		    'tag_id' => 10,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 4,
		    'memo_id' => 4,
		    'tag_id' => 11,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 4,
		    'memo_id' => 5,
		    'tag_id' => 12,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 4,
		    'memo_id' => 6,
		    'tag_id' => 13,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 4,
		    'memo_id' => 6,
		    'tag_id' => 14,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 6,
		    'memo_id' => 7,
		    'tag_id' => 10,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
	    DB::table('tag_rels')->insert([
		    'format_id' => 6,
		    'memo_id' => 7,
		    'tag_id' => 14,
		    'created_at' => new DateTime(),
		    'updated_at' => new DateTime(),
	    ]);
    }
}
