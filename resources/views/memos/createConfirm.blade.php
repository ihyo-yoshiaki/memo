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
    新規メモ内容確認
    </x-slot>
    <body>
        <form action="{{ route('memo.createSecond', ['theme' => $theme_id]) }}" method="post">
	@csrf
	<input type="hidden" name="memo[title]" value="{{ $memo['title'] }}">
	<h2>{{ $memo['title'] }}</h2>
    	   @foreach ($formats as $format)
	       <?php $idx=$format->order; ?>
	       <h4>{{ $format->name }}({{ $format->item->name }})</h4>
		       @if ($format->item->id === 1)
                  <input type="hidden" name="action[{{ $idx }}]" value="None" /> 　
		       <input type="hidden" name="memo[newTags][{{ $idx }}]" />
		       @if (! is_null($memo['newTags'][$idx]))
		       @foreach ($memo['newTags'][$idx] as $newTag)
			  <input type="hidden" name="memo[newTags][{{ $idx }}][]" value="{{ $newTag }}" />
                          <button type="button" class="bg-gray-500 text-sm text-white py-1 px-2 rounded">{{ $newTag }}</button>
			  @endforeach
		       @endif
		       <input type="hidden" name="memo[oldTags][{{ $idx }}]" />
                       @if (! is_null($memo['oldTags'][$idx]))
                       @foreach ($memo['oldTags'][$idx] as $oldTagId => $oldTagName)
			  <input type="hidden" name="memo[oldTags][{{ $idx }}][{{ $oldTagId}}]" value="{{ $oldTagName }}" />
                          <button type="button" class="bg-gray-500 text-sm text-white py-1 px-2 rounded">{{ $oldTagName }}</button>
			  @endforeach
		       @endif
		  
		  @else
		     <input type="hidden" name="memo[text][{{ $idx }}]" value="{{ $memo['text'][$idx] }}" /> 
		     <p>{{ $memo['text'][$idx] }}</p>
               @endif
           @endforeach
	<div class=submit-button>
            <button type="submit" name="action" value="store" class="bg-gray-500 font-semibold text-white py-1 px-4 rounded">新規メモを作成する</button>
	</div>
	<div class=back-button>
            <button type="submit" value="back" class="bg-gray-500 font-semibold text-white py-1 px-4 rounded">メモ作成画面に戻る</button>
        </div>
        </form>
	<div class='footer'>
            <a href="{{ route('theme.index', ['theme' => $theme_id]) }}" class="bg-gray-500 font-semibold text-white py-1 px-4 rounded">メモ選択画面に戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>

