<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Models\Memo;
use App\Models\Theme;
use App\Models\Format;
use App\Models\Tag;
use App\Models\TagRel;
use App\Models\Text;

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
				$memo['oldTags'][$format->order-1] = null;
			        $memo['newTags'][$format->order-1] = [];
			}else{
				$memo['text'][$format->order-1] = "";
			}
		
		}
		//dd($memo);
		
		return view('memos.create')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
	}

	public function createSecond(MemoRequest $request, Theme $theme){
		$formats = $this->getFormats($theme);
		$actions = $request['action'];
		$memo = $request['memo'];
		$newTag = $request['newTag'];
		$oldTagId = $request['oldTagId'];
		//dd($request->input());
	//	dd($memo);
		// array_keys($memo) -> ['title', 0, 1, 2, ...]
		// $memo[0] -> ['newTags' => [...], 'oldTags' => ...[]] or ['text' => "..."]
		if ($actions === "confirm"){
			return view('memos.confirm')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
		}elseif ($actions === "store"){
			$this->store($formats, $theme->id, $memo);
			return redirect(route('theme.index', ['theme' => $theme->id]));
         	}else{
		foreach ($actions as $idx => $action){
			if ($action === "newTag"){
				$memo['newTags'][$idx][] =  $newTag[$idx];
			}elseif ($action === "oldTag"){
				if (!($oldTagId === "-----")){
					$tagName = Tag::find($oldTagId[$idx])->name;
					$memo['oldTags'][$idx][$oldTagId[$idx]] = $tagName;
				}
			}elseif ($action === "None"){
				//
			}else{
				foreach ($action as $delete => $val){
					if ($delete === "deleteOld" ){
						unset($memo['oldTags'][$idx][$val]);
					}else{
						$memo['newTags'][$idx] = array_diff($memo['newTags'][$idx], array($val));
						$memo['newTags'][$idx] = array_values($memo['newTags'][$idx]);
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

	public function store($formats, $theme_id, $memo){
		// add new data to memos table
		$newMemo = new Memo;
		$newMemo->fill([
			'title' => $memo['title'],
			'theme_id' => $theme_id,
		])->save();
		$newMemoId = $newMemo->id;

		// add to texts, tags, tag_rels 
		foreach ($formats as $format){
			$idx = $format->order - 1;
			if ($format->item_id == 1){

				// add new tag
				if (! is_null($memo[$idx]['newTags'])){
					foreach ($memo[$idx]['newTags'] as  $newTagName){
						// add new data to tags table
						$newTag = new Tag;
						$newTag->fill([
							'name' => $newTagName,
						])->save();

						//add new data to tag_rels table
						$newTagRel = new TagRel;
						$newTagRel->fill([
							'format_id' => $format->id,
							'memo_id' => $newMemo->id,
							'tag_id' => $newTag->id,
						])->save();
					}
				}

				// add existed tag
				if (! is_null($memo[$idx]['oldTags'])){
					foreach ($memo[$idx]['oldTags'] as $oldTagId => $oldTagName){
						$newTagRel = new TagRel;
						$newTagRel->fill([
							'format_id' => $format->id,
							'memo_id' => $newMemo->id,
							'tag_id' => $oldTagId,
						])->save();
					}
				}
			}else{
				// add new data to texts table
				$newText = new Text;
				$newText->fill([
					'memo_id' => $newMemoId,
					'format_id' => $format->id,
					'content' => $memo[$idx]['text'],
				])->save();
			}	
		}

	}


}
