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
        メモ編集内容確認
    </x-slot>
    <body>
	<form action="{{ route("memo.editSecond", ['theme' => $theme_id, 'memo' => $memo['id']]) }}" method="post">
        @csrf
	<input type="hidden" name="memo[title]" value="{{ $memo['title'] }}" />
        <h4>メモタイトル</h4>
        <p class="text-black-500 text-lg">{{ $memo['title'] }}</p>
    	   @foreach ($formats as $format)
	       <?php $idx=$format->order; ?>
	       <h4>{{ $format->name }}({{ $format->item->name }})</h4>
		       @if ($format->item->id === 1)
		       <input type="hidden" name="memo[newTags][{{ $idx }}]" />
		       @if (! is_null($memo['newTags'][$idx]))
		           @foreach ($memo['newTags'][$idx] as $newTag)
			       <input type="hidden" name="memo[newTags][{{ $idx }}][]" value="{{ $newTag }}" />
			       <button type="button" class="bg-gray-500 text-white text-sm py-1 px-2 rounded">{{ $newTag }}</button>
			   @endforeach
		       @endif 		      
		       <input type="hidden" name="memo[oldTags][{{ $idx }}]" />
		       @if (! is_null($memo['oldTags'][$idx]))
		       @foreach ($memo['oldTags'][$idx] as $oldTagId => $oldTagArray)
			  <input type="hidden" name="memo[oldTags][{{ $idx }}][{{ $oldTagId }}][name]" value="{{ $oldTagArray['name'] }}" />
                          <input type="hidden" name="memo[oldTags][{{ $idx }}][{{ $oldTagId }}][label]" value="{{ $oldTagArray['label'] }}" />
			  @if ($oldTagArray['label'] != 'del')
			  <button type="button" class="bg-gray-500 text-white text-sm px-2 py-1 rounded">
			  {{ $oldTagArray['name'] }}
			  </button>
			  @endif
                       @endforeach
                       @endif
		  
		  @else
		       <input type="hidden" name="memo[text][{{ $idx }}]" value="{{ $memo['text'][$idx] }}" />
                       <p>{{ $memo['text'][$idx] }}<p>
                  @endif
		  @endforeach
        <div class="confirm-button">
	<button type="submit" name="action" value="confirm" class="bg-gray-500 font-semibold text-white py-1 px-4 rounded">メモを保存</button>
	</div>
        <div class="back-button">
	<button type="submit" name="action" value="back" class="bg-gray-500 font-semibold text-white py-1 px-4 rounded">メモ編集画面に戻る</button>
        </div>
        </form>
        <a href="{{ route('theme.index', ['theme' => $theme_id]) }}"  class="text-blue-500 underline hover:text-blue-700">メモ選択画面に戻る</a>
    </body>
    </x-app-layout>
</html>

