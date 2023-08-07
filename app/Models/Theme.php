<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
	use HasFactory;
	use SoftDeletes;

	public function memos()
	{
		return $this->hasMany(Memo::class);
	}

	public function formats()
	{
		return $this->hasMany(Format::class);
	}
	public static function booted()
	{
		static::deleted(function ($theme){
			$theme->memos()->delete();
			$theme->formats()->delete();
		});
	}

	protected $fillable = [
		'name',
		'user_id',
	];
}
