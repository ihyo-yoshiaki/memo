<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
	use HasFactory;

	const CREATED_AT = NULL;
	const DELETED_AT = NULL;

	protected $torches = ['memo'];
         
	protected $fillable = [
		'memo_id',
		'format_id',
		'content',
	];

	public function memo()
	{
		return $this->belongsTo(Memo::class);
	}

	public function format()
        {
		return $this->belongsTo(Format::class);
	}
}
