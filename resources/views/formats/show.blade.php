<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Theme</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
        <body>
	<h1>フォーマットの作成</h1>
	<div class='items'>
            <form action="{{ route('format.show')}}" method="post">
	        @csrf
		@foreach ($tmp_items as $tmp_item)
		    <p>{{ $loop->index }}</p>
		    <p>{{ $tmp_item[name] }}</p>
		    <p>{{ $tmp_item[item] }}</p>
                    <p>{{ $tmp_item[content] }}</p>
		    <button type="submit" name="delete_item" value="{{ $loop->index }}">削除</button>
		@endforeach
            </form>
        </div>
	<div class='add'>
            <form action="{{ route('format.add_item') }}" method="post">
                @csrf
                <button type="submit" value="send">項目を追加</button>
	    </form>
	</div>
        </body>
</html>

