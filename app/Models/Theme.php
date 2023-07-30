<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
	use HasFactory;

	public function memos()
	{
		return $this->hasMany(Memo::class);
	}

	public function Formats()
	{
		return $this->hasMany(Format::class);
	}

	protected $fillable = [
		'name',
		'user_id',
	];
}
