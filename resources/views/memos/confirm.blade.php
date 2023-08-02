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
	<input type="hidden" name="memo[title]" value="{{ $memo['title'] }}">
	<h2>{{ $memo['title'] }}</h2>
    	   @foreach ($formats as $format)
	       <?php $idx=$format->order-1; ?>
	       <h4>{{ $format->name }}({{ $format->item->name }})</h4>
		  @if ($format->item->id === 1)
                  <input type="hidden" name="action[{{ $idx }}]" value="None" /> 
　　　　　　　　　　<div class="tags">
		       <input type="hidden" name="memo[{{ $idx }}][newTags]">
                       @if (! is_null($memo[$idx]['newTags']))
		       @foreach ($memo[$idx]['newTags'] as $newTag)
			  <input type="hidden" name="memo[{{ $idx }}][newTags][]" value="{{ $newTag }}" />
                          <p>{{ $newTag }}</p>
			  @endforeach
		       @endif
		       <input type="hidden" name="memo[{{ $idx }}][oldTags]">
                       @if (! is_null($memo[$idx]['oldTags']))
                       @foreach ($memo[$idx]['oldTags'] as $oldTagId => $oldTagName)
			  <input type="hidden" name="memo[{{ $idx }}][oldTags][{{ $oldTagId}}]" value="{{ $oldTagName }}" />
                          <p>{{ $oldTagName }}</p>
			  @endforeach
		       @endif
		  </div>
		  @else
		     <input type="hidden" name="memo[{{ $idx }}][text]" value="{{ $memo[$idx]['text'] }}" /> 
		     <p>{{ $memo[$idx]['text'] }}</p>
               @endif
           @endforeach
	</div>
	<div class=submit-button>
            <button type="submit" name="action" value="store">新規メモを作成する</button>
	</div>
	<div class=back-button>
            <button type="submit" value="back">メモ作成画面に戻る</button>
        </div>
        </form>
	<div class='footer'>
            <a href="{{ route('theme.index', ['theme' => $theme_id]) }}">メモ選択画面に戻る</a>
        </div>
    </body>
</html>

