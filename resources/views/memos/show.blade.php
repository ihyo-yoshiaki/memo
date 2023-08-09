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
	<h1>{{ $memo->title }}</h1>
	   @foreach ($formats as $format)
	       <h5>{{ $format->name }}({{ $format->item->name }})</h5>
               @if ($format->item->id == 1)
	           @foreach ($format->tag_rels as $tag_rel )
	               @if ($tag_rel->memo_id == $memo->id)
                           <p>{{ $tag_rel->tag->name }}</p>
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
        </div>
	<div class='footer'>
            <a href="{{ route('theme.index', ['theme' => $memo->theme->id]) }}">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>

