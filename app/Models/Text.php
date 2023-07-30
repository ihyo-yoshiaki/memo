<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
	use HasFactory;

	protected $torches = ['memo'];

	public function memo()
	{
		return $this->belongsTo(Memo::class);
	}

	public function format()
        {
		return $this->belongsTo(Format::class);
	}
}
