<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Theme;
use App\Models\Format;

class MemoController extends Controller
{
	public function show(Theme $theme, Memo $memo)
	{
		$texts = $memo->texts();
		//$tags = $memo->tags();
		return view('memos.show')->with(['memo' => $memo->first(), 'theme' => $theme->first(), 'texts' => $texts->get()]);//, 'tags' => $tags->get()]);
	}

}
