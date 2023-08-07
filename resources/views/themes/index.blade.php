<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Theme</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
	<div class="memo menu">
	    <h2>メモメニュー</h2>
            <div class="create_memo">
	        <a href="{{ route('memo.createFirst', ['theme' => $main_theme->id]) }}">新規メモを作成</a>
	    </div>
	</div>
	<div class="theme menu">
            <h2>テーマメニュー</h2>
	    <h4>現在のテーマ</h4>
		<h3> {{ $main_theme->name }}</h3>
                <a href="{{ route('format.editFirst', ['theme' => $main_theme->id]) }}">フォーマットを編集する</a>
            <h4>他テーマを選択</h4>
	    @foreach ($other_themes as $other_theme)
	       <div class="theme">
	           <a href="{{ route('theme.index', ['theme' => $other_theme->id]) }}">{{ $other_theme->name }}</a>
	       </div>
	    @endforeach 
            <a href="{{ route('format.createFirst') }}">新規テーマを作成</a>
        </div>
        <h1>メモ</h1>
	<div class='memos'>
	@foreach ($memos as $memo)
	    <div class="memo">
                <a href="{{ route('memo.show', ['theme' => $main_theme->id, 'memo' => $memo->id]) }}">{{ $memo->title }}</a>
	    </div>	
	@endforeach
        </div>
    </body>
</html>

