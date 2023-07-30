<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
	use HasFactory;
	
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

	protected $fillable = [
		'theme_id',
		'item_id',
		'name',
		'order',
	];
}
