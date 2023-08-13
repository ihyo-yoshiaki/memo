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
        メモ閲覧
    </x-slot>
    <body>
        <h4>メモタイトル</h4>
	<h1 class="text-lg">{{ $memo->title }}</h1>
	   @foreach ($formats as $format)
	       <h5>{{ $format->name }}({{ $format->item->name }})</h5>
               @if ($format->item->id == 1)
	           @foreach ($format->tag_rels as $tag_rel )
	               @if ($tag_rel->memo_id == $memo->id)
			   <button type="button" class="bg-gray-500 text-white text-sm px-2 py-1 rounded">{{ $tag_rel->tag->name }}</button>
                       @endif
                   @endforeach
	       @else
		   @foreach ($format->texts as $text)		   
		       @if ($text->memo_id == $memo->id)    
                           <p>{{ $text->content }}</p>
                       @endif
                   @endforeach
               @endif
	       @endforeach
	<div class="return">
	<a href="{{ route('theme.index', ['theme' => $memo->theme->id]) }}"  class="text-blue-500 underline hover:text-blue-700">戻る</a>
	</div>
    </body>
    </x-app-layout>
</html>

