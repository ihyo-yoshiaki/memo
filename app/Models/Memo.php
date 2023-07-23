<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
	use HasFactory;

	public function theme()
	{
		return $this->belongsTo(Theme::class);
	}
}
