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

	public function createSecond(FormatRequest $request)
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

	public function editFirst(Theme $theme)
	{
		// process
		//   1. edit format in edit page
		//   2. show new format in confirm page
		//   3. update related tables once after user complete to edit and confirm
		//      <-> update related tables each time when user edit one of items of format 
		// need to reorder if delItems is not null, existing item is deleted
		// need to reorder if newItems is inserted into exiting items. implement if possible
		// need to reorder if order of existing items is changed. implement if possible
		$formats = $theme->formats()->get()->sortby('order');
		$newFormats = array();  // key is order, values contain name, item_id, label \in {new, old, del}
		foreach ($formats as $format){
			$item_name = Item::find($format->item_id)->name;
			$newFormats[(int)$format->order] = array('name' => $format->name, 'item_id' => $format->item_id, 'format_id' => $format->id, 'label' => 'old');
		}
		return view('formats.edit')->with(['theme' => $theme, 'newFormats' => $newFormats, 'items' => Item::all()]);
	}

	public function editSecond(Request $request, Theme $theme)
	{
		$actions = $request['action'];
		$newFormats = $request['newFormats'];
		$n = count($newFormats);
		if ($actions === 'store'){

			//
		}else{
			foreach ($actions as $order => $action){
				if ($action === 'new'){
					for ($i=$n+1; $i>$order; $i--){ // tail is $n+1
						$newFormats[$i] = $newFormats[$i-1];
					} 
					$newFormats[$order] = array('name' => "", 'item_id' => 1, 'format_id' => null,  'label' => 'new');
				}elseif ($action === 'del'){
					if ( $newFormats[$order]['label'] === 'new'){
						for ($i=$order; $i<$n; $i++){
							$newFormats[$i] = $newFormats[$i+1];
						}
						unset($newFormats[$n]);
					}else{
						$newFormats[$order]['label'] = 'del';
					}
				}elseif ($action === 'rec'){
					$newFormats[$order]['label'] = 'old';
				}
			}
		}
		//dd($newFormats);
                return view('formats.edit')->with(['theme' => $theme, 'newFormats' => $newFormats, 'items' => Item::all()]);
	}
			
}

// array_key_exists('Mike', $array)
