<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Memo extends Model
{
	use HasFactory;
	use SoftDeletes;

	public function theme()
	{
		return $this->belongsTo(Theme::class);
	}

	public function texts()
	{
		return $this->hasMany(Text::class);
	}

	public function tag_rels()
	{
		return $this->hasMany(TagRel::class);
	}

	public static function booted()
	{
		static::deleted(function ($memo){
			$memo->texts()->delete();
			$memo->tag_rels()->delete();
		});
	}

	protected $fillable = [
		'title',
		'theme_id',
	];
}
