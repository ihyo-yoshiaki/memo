<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRel extends Model
{
	use HasFactory;

	public function memo()
	{
		return $this->belongsTo(Memo::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
