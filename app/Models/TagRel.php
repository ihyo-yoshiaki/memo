<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagRel extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $torches = ['memo'];

	protected $fillable = [
		'format_id',
		'memo_id',
		'tag_id',
	];

	public function memo()
	{
		return $this->belongsTo(Memo::class);
	}

	public function format()
	{
		return $this->belongsTo(Format::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
