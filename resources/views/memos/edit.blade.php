<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Memo</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <x-slot name="header">
        メモ編集
    </x-slot>
    <body>
        <form action="{{ route('memo.createSecond', ['theme' => $theme_id]) }}" method="post">
	@csrf
	@if ($errors->any())
	<input type="text" name="memo[title]" placeholder="タイトルを入力してください" value="{{ old('memo.title') }}" />
	<p class="title__error" style="color:red">{{ $errors->first('memo.title') }}</p>
        @else
        <input type="text" name="memo[title]" placeholder="タイトルを入力してください" value="{{ $memo['title'] }}" />
        @endif
    	   @foreach ($formats as $format)
	       <?php $idx=$format->order-1; ?>
	       <h4>{{ $format->name }}({{ $format->item->name }})</h4>
	       @if ($format->item->id === 1)
		   <div class="newTag"> 
                      <input type="hidden" name="action[{{ $idx }}]" value="None" />    
	              <h5>新規タグを追加</h5>
		      <input type="text" name="newTag[{{ $idx }}]" placeholder="新規タグを入力してください" />
		      <button type="submit" name="action[{{ $idx }}]" value="newTag">追加</button>
                      <p class="newTag__error" style="color:red">{{ $errors->first("newTag") }}</>
                   </div>
                   <div class="oldTag">
		      <h5>既存タグから選択</h5>
		      <select name="oldTagId[{{ $idx }}]">
		       <option value="-1" select="selected">-----</option>
		       @foreach ($format->tag_rels as $tag_rel)
		          @if (! isset($memo['oldTags'][$idx][$tag_rel->tag->id]))
			      <option value="{{ $tag_rel->tag->id }}">{{ $tag_rel->tag->name }}</option>
			  @endif
		       @endforeach
		       </select>
                       <button type="submit" name="action[{{ $idx }}]" value="oldTag">追加</button>
                   </div>
　　　　　　　　　　<div class="tags">
		       <input type="hidden" name="memo[newTags][{{ $idx }}]" />
                       @if ($errors->any())
		       @if (! is_null(old("memo.newTags.$idx")))
		           @foreach ( old("memo.newTags.$idx")  as $newTag)
			       <input type="hidden" name="memo[newTags][{{ $idx }}][]" value="{{ $newTag }}">
			       <button type="submit" name="action[{{ $idx }}][deleteNew]" value="{{ $newTag }}">{{ $newTag }}</button>
			   @endforeach
			   @endif 
		       @endif
		       @if (! is_null($memo['newTags'][$idx]))
		       @foreach ($memo['newTags'][$idx] as $newTag)
			  <input type="hidden" name="memo[newTags][{{ $idx }}][]" value="{{ $newTag }}" />
                          <button type="submit" name="action[{{ $idx }}][deleteNew]" value="{{ $newTag }}">{{ $newTag }}</button>
			  @endforeach
		       @endif
		       <input type="hidden" name="memo[oldTags][{{ $idx }}]" />
                       @if ($errors->any())
		       @if (! is_null(old("memo.oldTags.$idx")))
		       @foreach (old("memo.oldTags.$idx") as $oldTagId => $oldTagName)
		          <input type="hidden" name="memo[oldTags][{{ $idx }}][$oldTagId]" value="{{ $oldTagName }}" />
			  <button type="submit" name="action[{{ $idx }}][deleteOld]" value="{{ $oldTagId }}">{{ $oldTagName }}</button>
                       @endforeach
                       @endif
                       @endif
                       @if (! is_null($memo['oldTags'][$idx]))
                       @foreach ($memo['oldTags'][$idx] as $oldTagId => $oldTagName)
			  <input type="hidden" name="memo[oldTags][{{ $idx }}][{{ $oldTagId }}]" value="{{ $oldTagName }}" />
                          <button type="submit" name="action[{{ $idx }}][deleteOld]" value="{{ $oldTagId }}">{{ $oldTagName }}</button>
			  @endforeach
		       @endif
		  </div>
		  @else
	              @if ($errors->any())
			  <textarea name="memo[text][{{ $idx }}]">{{ old("memo.text.$idx" )}}</textarea>
                      @else
		          <textarea name="memo[text][{{ $idx }}]">{{ $memo['text'][$idx] }}</textarea>
		      @endif
                      <p class="text__error" style="color:red">{{ $errors->first("memo.text.$idx") }}
               @endif
           @endforeach
	</div>
	<div class submit-button>
            <button type="submit" name="action" value="confirm">メモを保存/button>
        </div>
        </form>
	<div class='footer'>
            <a href="{{ route('theme.index', ['theme' => $theme_id]) }}">戻る</a>
        </div>
    </body>
　  </x-app-layout>
</html>

