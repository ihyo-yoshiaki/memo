<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Theme;
use App\Models\Format;
use App\Models\Tag;
use App\Models\TagRel;

class MemoController extends Controller
{
	public function show(Theme $theme, Memo $memo)
	{
		$formats = $this->getFormats($theme);
		return view('memos.show')->with(['memo' => $memo, 'formats' => $formats]);
	}

	public function createFirst(Theme $theme)
	{

		$formats = $this->getFormats($theme);
		$memo = array('title' => "");
		foreach ($formats as $format){
			if ($format->item_id === 1){
				$remains = $format->tag_rels;
				$memo[$format->order-1] = array('newTags' => [], 'oldTagIds' => [], 'remainIds' => $remains);
			}else{
				$memo[$format->order-1] = array('text' => "");
			}
		
		}
		//dd($memo);
		
		return view('memos.create')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
	}

	public function createSecond(Request $request, Theme $theme){
		$formats = $this->getFormats($theme);
		$actions = $request['action'];
		$memo = $request['memo'];
		$newTags = $request['newTags'];
		$oldTagIds = $request['oldTagIds'];
		//dd($request->input());
	//	dd($memo);
		// array_keys($memo) -> ['title', 0, 1, 2, ...]
		// $memo[0] -> ['newTags' => [...], 'oldTags' => ...[]] or ['text' => "..."]
		if ($actions === "confirm"){
			return view('memos.confirm')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
		}elseif ($actions === "store"){
			return redirect(route('theme.index', ['theme' => $theme->id]));
         	}else{
		foreach ($actions as $idx => $action){
			if ($action === "newTag"){
				$memo[$idx]['newTags'][] =  $newTags[$idx];
			}elseif ($action === "oldTag"){
				if (!($oldTagIds[$idx] === "-----")){
					$memo[$idx]['oldTagIds'][] =  $oldTagIds[$idx];
				}
			}elseif ($action === "None"){
				//
			}else{
				foreach ($action as $delete => $val){
					if ($delete === "deleteOld" ){
						$memo[$idx]['oldTagIds'] = array_diff($memo[$idx]['oldTagIds'], array($val));
						$memo[$idx]['oldTagIds'] = array_values($memo[$idx]['oldTagIds']);
					}else{
						$memo[$idx]['newTags'] = array_diff($memo[$idx]['newTags'], array($val));
						$memo[$idx]['newTags'] = array_values($memo[$idx]['newTags']);
					}
				}
			}
		}
		}
		return view('memos.create')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
	}

	public function select_tags(Format $format, Memo $memo)
	{
		//
	}

	public function getFormats(Theme $theme)
	{
                $formats = $theme->formats()->with(['item', 'tag_rels', 'texts'])->get()->sortBy('order');
		return $formats;
	}

	public function store(Format $format, $theme_id, $memo){
		//
	}


}
