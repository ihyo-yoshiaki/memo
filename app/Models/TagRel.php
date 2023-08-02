<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRel extends Model
{
	use HasFactory;

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
