<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Theme;
use App\Models\Format;
use App\Http\Requests\FormatRequest;

class FormatController extends Controller
{
	public function createFirst()	
	{
		return view('formats.create')->with(['tmpItems' => [], 'themeName' => ""]);
	}

	public function createSecond(Request $request)
	{
		$action = $request['action'];
		$themeName = $request['themeName'];
		$tmpItems = $request['tmpItems'];
		if($action === 'add'){
			$items = Item::all();
			$newItem = array('name' => "", 'itemId' => 1);
			if (is_null($tmpItems)){
				$tmpItems = [$newItem];
			}else{
				array_push($tmpItems, $newItem);
			}
			return view('formats.create')->with(['themeName' => $themeName, 'tmpItems' => $tmpItems, 'items' => $items ]);
		}elseif($action === 'store'){
			$this->store($themeName, $tmpItems);
			return redirect()->route('theme.select');
		}else{
			$items = Item::all();
			$deleteId = $request['action'];
			unset($tmpItems[$deleteId]);
			return view('formats.create')->with(['themeName' => $themeName, 'tmpItems' => $tmpItems, 'items' => $items]);
		}
	}

	public function store($newThemeName, $newItems)
	{
		// formats, themes
		$theme = new Theme;

		$user_id = Auth::user()->id;
		$theme->fill([
			'name' => $newThemeName,
			'user_id' => $user_id,
		])->save();
		$theme_id = Theme::latest()->first()->id;
		$count = 1;
		if (! is_null($newItems)){
		foreach ($newItems as $newItem){
			$format = new Format;
			$format->fill([
				'item_id' => $newItem['itemId'],
				'theme_id' => $theme_id,
				'name' => $newItem['name'],
				'order' => $count,
			])->save();
			$count += 1;
		}
		}
	}

	public function edit(Request $request)
	{
		$request = [];
		return view('themes.edit')->with(['items' => $request]);
	}
			
}

// array_key_exists('Mike', $array)
