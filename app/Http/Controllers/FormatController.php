<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class FormatController extends Controller
{
	public function createFirst()	
	{
		return view('formats.create')->with(['tmpItems' => []]);
	}

	public function createSecond(Request $request)
	{
		$action = $request['action'];
		if($action === 'add'){
			$items = Item::all();
			$tmpItems = $request['tmpItems'];
			$newItem = array('name' => "", 'itemId' => 1);
			if (is_null($tmpItems)){
				$tmpItems = [$newItem];
			}else{
				array_push($tmpItems, $newItem);
			}
			return view('formats.create')->with(['tmpItems' => $tmpItems, 'items' => $items ]);
		}elseif($action === 'store'){
			redirect (route('theme.store'))->with(['tmpItems' => $request['tmpItems']]);
		}else{
			$deleteId = $request['action'];
                        $tmpItems = $request['tmpItems'];
			unset($tmpItems[$deleteId]);
			$items = Item::all();
			return view('formats.create')->with(['tmpItems' => $tmpItems, 'items' => $items]);
		}
	}

	public function store($tmp_items)
	{
		return redirect(route('theme.select'));
	}

	public function edit(Request $request)
	{
		$request = [];
		return view('themes.edit')->with(['items' => $request]);
	}
			
}

// array_key_exists('Mike', $array)
