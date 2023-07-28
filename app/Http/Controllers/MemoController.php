<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Theme;
use App\Models\Format;
use App\Models\Tag;

class MemoController extends Controller
{
	public function show(Memo $memo)
	{
		$theme = $memo->theme()->first();
		$formats = $theme->formats()->orderby('order', 'asc')->with(['item', 'tag_rels', 'texts']);
		return view('memos.show')->with(['memo' => $memo, 'formats' => $formats->get()]);
	}

	public function select_tags(Format $format, Memo $memo)
	{
		//
	}



}
