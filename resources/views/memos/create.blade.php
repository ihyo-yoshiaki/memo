<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Memo</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <form action="{{ route('memo.createSecond', ['theme' => $theme_id]) }}" method="post">
	@csrf
	<input type="text" name="memo[title]" placeholder="タイトルを入力してください" value="{{ $memo['title'] }}"></input>
    	   @foreach ($formats as $format)
	       <?php $idx=$format->order-1; ?>
	       <h4>{{ $format->name }}({{ $format->item->name }})</h4>
	       @if ($format->item->id === 1)
		   <div class="newTag"> 
                      <input type="hidden" name="action[{{ $idx }}]" value="None" />    
	              <h5>新規タグを追加</h5>
		      <input type="text" name="newTags[{{ $idx }}]" placeholder="新規タグを入力してください" />
                      <button type="submit" name="action[{{ $idx }}]" value="newTag">追加</button>
                   </div>
                   <div class="oldTag">
		      <h5>既存タグから選択</h5>
		      <select name="oldTagIds[{{ $idx }}]">
		       <option select="selected">-----</option>
		       @foreach ($format->tag_rels as $tag_rel)
		          @if (! isset($memo[$idx]['oldTags'][$tag_rel->tag->id]))
			      <option value="{{ $tag_rel->tag->id }}">{{ $tag_rel->tag->name }}</option>
			  @endif
		       @endforeach
		       </select>
                       <button type="submit" name="action[{{ $idx }}]" value="oldTag">追加</button>
                   </div>
　　　　　　　　　　<div class="tags">
		       <input type="hidden" name="memo[{{ $idx }}][newTags]" />
                       @if (! is_null($memo[$idx]['newTags']))
		       @foreach ($memo[$idx]['newTags'] as $newTag)
			  <input type="hidden" name="memo[{{ $idx }}][newTags][]" value="{{ $newTag }}" />
                          <button type="submit" name="action[{{ $idx }}][deleteNew]" value="{{ $newTag }}">{{ $newTag }}</button>
			  @endforeach
		       @endif
		       <input type="hidden" name="memo[{{ $idx }}][oldTags]" />
                       @if (! is_null($memo[$idx]['oldTags']))
                       @foreach ($memo[$idx]['oldTags'] as $oldTagId => $oldTagName)
			  <input type="hidden" name="memo[{{ $idx }}][oldTags][{{ $oldTagId }}]" value="{{ $oldTagName }}" />
                          <button type="submit" name="action[{{ $idx }}][deleteOld]" value="{{ $oldTagId }}">{{ $oldTagName }}</button>
			  @endforeach
		       @endif
		  </div>
	       @else
		      <textarea name="memo[{{ $idx }}][text]">{{ $memo[$idx]['text'] }}</textarea>
               @endif
           @endforeach
	</div>
	<div class submit-button>
            <button type="submit" name="action" value="confirm">新規メモを作成</button>
        </div>
        </form>
	<div class='footer'>
            <a href="{{ route('theme.index', ['theme' => $theme_id]) }}">戻る</a>
        </div>
    </body>
</html>

