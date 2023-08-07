<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Format extends Model
{
	use HasFactory;
	use SoftDeletes;
	
	public function theme()
	{
		return $this->belongsTo(Theme::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function tag_rels()
	{
		return $this->hasMany(TagRel::class);
	}

	public function texts()
	{
		return $this->hasMany(Text::class);
	}

	public static function booted()
	{
		static::deleted(function ($format){
			$format->texts()->delete();
			$format->tag_rels()->delete();
		});
	}

	protected $fillable = [
		'theme_id',
		'item_id',
		'name',
		'order',
	];
}
