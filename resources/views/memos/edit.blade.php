<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Memo</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <form action="{{ route('memo.create') }}" method="post">
        @csrf
	<h1>{{ $memo->title }}</h1>
	   @foreach ($formats as $format)
	       <h5>{{ $format->name }}({{ $format->item->name }})</h5>
               @if ($format->item->id === 1)
	           @foreach ($format->tag_rels as $tag_rel )
	               @if ($tag_rel->memo_id === $memo->id)
                           <p>{{ $tag_rel->tag->name }}</p>
                       @endif
                   @endforeach
	       @else
		   @foreach ($format->texts as $text)		   
		       @if ($text->memo_id === $memo->id)    
                           <textarea name="memo[{{ $format->order }}]" value="{{ $text->content }}"></textarea>
                       @endif
                   @endforeach
               @endif
           @endforeach
	</div>
	<div class submit-button>
            <button type="submit" value="store">新規メモを作成</button>
        </div>
        </form>
	<div class='footer'>
            <a href="{{ route('theme.index', ['theme' => $memo->theme->id]) }}">戻る</a>
        </div>
    </body>
</html>

