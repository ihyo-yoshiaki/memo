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
				$memo['oldTags'][$format->order] = null;
			        $memo['newTags'][$format->order] = [];
			}else{
				$memo['text'][$format->order] = "";
			}		
		}
		return view('memos.create')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
	}

	public function createSecond(MemoRequest $request, Theme $theme){
		$formats = $this->getFormats($theme);
		$actions = $request['action'];
		$memo = $request['memo'];
		$newTag = $request['newTag'];
		$oldTagId = $request['oldTagId'];
		// array_keys($memo) -> ['title', 0, 1, 2, ...]
		// $memo[0] -> ['newTags' => [...], 'oldTags' => ...[]] or ['text' => "..."]
		if ($actions === "confirm"){
			return view('memos.createConfirm')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
		}elseif ($actions === "store"){
			$this->store($formats, $theme->id, $memo);
			return redirect(route('theme.index', ['theme' => $theme->id]));
		}else{
			foreach ($actions as $idx => $action){
				if ($action === "newTag"){
					$memo['newTags'][$idx][] =  $newTag[$idx];
				}elseif ($action === "oldTag"){
					if (!($oldTagId[$idx] == -1)){
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

	public function editFirst(Theme $theme, Memo $memo)
	{
		$formats = $this->getFormats($theme);
		$newMemo = array('id' => $memo->id, 'title' => $memo->title);
		$tag_rels = $memo->tag_rels;
		$texts = $memo->texts;
		foreach ($formats as $format){
			if ($format->item_id === 1){
				$tmp_tag_rels = $tag_rels->where('format_id', $format->id);
				$newMemo['oldTags'][$format->order] = array();
				foreach ($tmp_tag_rels as $tag_rel){
					$newMemo['oldTags'][$format->order][$tag_rel->tag->id] = array('name' => $tag_rel->tag->name, 'label' => 'rem');  // label \in {'rem', 'del', 'new'}
				}
				$newMemo['newTags'][$format->order] = null;
			}else{
				$text =  $texts->where('format_id', $format->id)->first()->toArray();
				$newMemo['text'][$format->order] = $text['content'];
			}
		}
                return view('memos.edit')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $newMemo]);
        }


	public function editSecond(MemoRequest $request, Theme $theme, $memo_id){
		$formats = $this->getFormats($theme);
		$actions = $request['action'];
		$memo = $request['memo'];
		$memo['id'] = (int)$memo_id;
		$newTag = $request['newTag'];
		$oldTagId = $request['oldTagId'];
		// array_keys($memo) -> ['title', 0, 1, 2, ...]
                // $memo[0] -> ['newTags' => [...], 'oldTags' => ...[]] or ['text' => "..."]
                if ($actions === "confirm"){
			return view('memos.editConfirm')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
		}elseif ($actions === "update"){
			$this->update($formats, $theme->id, $memo);						
			return redirect(route('theme.index', ['theme' => $theme->id]));
		}elseif ($actions === "back"){
			//
		}else{
			foreach ($actions as $idx => $action){
				if ($action === "newTag"){
					$memo['newTags'][$idx][] =  $newTag[$idx];
				}elseif ($action === "oldTag"){
					if (!($oldTagId[$idx] == -1)){
						$tagName = Tag::find($oldTagId[$idx])->name;
						$memo['oldTags'][$idx][$oldTagId[$idx]] = array('name' => $tagName, 'label' => 'new');
					}
				}elseif ($action === "None"){
					//
				}else{
					foreach ($action as $delete => $val){
						if ($delete === "deleteOld" ){
							if ($memo['oldTags'][$idx][$val]['label'] === 'rem'){
								$memo['oldTags'][$idx][$val]['label'] = 'del';
							}else{
								unset($memo['oldTags'][$idx][$val]);
							}
						}elseif ($delete === "recoverOld"){
							$memo['oldTags'][$idx][$val]['label'] = 'rem';
						}else{
							$memo['newTags'][$idx] = array_diff($memo['newTags'][$idx], array($val));
							$memo['newTags'][$idx] = array_values($memo['newTags'][$idx]);
						}
					}
				}	                                                                                                                                                                                                                             
			}
		}
		return view('memos.edit')->with(['formats' => $formats, 'theme_id' => $theme->id, 'memo' => $memo]);
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
			$idx = $format->order;
			if ($format->item_id == 1){
				// add new tag
				if (! is_null($memo['newTags'][$idx])){
					foreach ($memo['newTags'][$idx] as  $newTagName){
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

				// add existing tag
				if (! is_null($memo['oldTags'][$idx])){
					foreach ($memo['oldTags'][$idx] as $oldTagId => $oldTagName){
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
				$content = $memo['text'][$idx];
				if (is_null($content)){
					$content = "";
				}
				$newText->fill([
					'memo_id' => $newMemoId,
					'format_id' => $format->id,
					'content' => $content,
				])->save();
			}	
		}

	}

	public function update($formats, $theme_id, $memo){
		// add new data to memos table
			$newMemo = Memo::find($memo['id']);
			$newMemo->fill([
 				'title' => $memo['title'],
				'theme_id' => $theme_id,
			])->save();
			// add to texts, tags, tag_rels 
				foreach ($formats as $format){
					$idx = $format->order;
					if ($format->item_id == 1){
						// add new tag
		                                 if (! is_null($memo['newTags'][$idx])){
							 foreach ($memo['newTags'][$idx] as  $newTagName){
								 // add new data to tags table
                                                                 $newTag = new Tag;
								 $newTag->fill([
									 'name' => $newTagName,
								 ])->save();
								 //add new data to tag_rels table
								 $newTagRel = new TagRel;
								 $newTagRel->fill([
									 'format_id' => $format->id,
									 'memo_id' => $memo['id'],
									 'tag_id' => $newTag->id,
								 ])->save();
							 }
						 }
						 // add existing tag
						 if (! is_null($memo['oldTags'][$idx])){
							 // label \in {'rem', 'new', 'del'}
							 // if label is 'rem', nothing to do
							 // if label is 'new', add new tag_rel to tag_rels table
							 // if label is 'del', remove tag_rel from tag_rels table and need to remove tag from tags table in case subject tag doesn't have related data in tag_rels table
							 foreach ($memo['oldTags'][$idx] as $oldTagId => $oldTagArray){
								 $tmpTagRels = $format->tag_rels;
								 if ($oldTagArray['label'] === 'new'){
								 $newTagRel = new TagRel;
								 $newTagRel->fill([
									 'format_id' => $format->id,
									 'memo_id' => $memo['id'],
									 'tag_id' => $oldTagId,
								 ])->save();
								 }elseif ($oldTagArray['label'] === 'del'){
									 $delTagRels = $tmpTagRels->where('tag_id', $oldTagId);
									 $tagRelCount = count($delTagRels);
									 if ($tagRelCount == 1){
										 Tag::destroy($oldTagId);
									 }elseif ($tagRelCount > 1){
										 $delTagRel = $delTagRels->where('memo_id', $memo['id'])->first();
										 $delTagRel->delete();
									 }else{
										 dd($tagRelCount);
									 }
								 }
							 }
						 }
					}else{
						// add new data to texts table
						$newText = new Text;
						$content = $memo['text'][$idx];
						if (is_null($content)){
							$content = "";
						}
						$newText->fill([
							'memo_id' => $memo['id'],
							'format_id' => $format->id,
							'content' => $content,
						])->save();
					}
				}
	}

        public function delete(Theme $theme, Memo $memo)
        {
		$memo->delete();
		return redirect(route('theme.index', ['theme' => $theme->id]));
	}


}
