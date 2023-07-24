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
	    <h2>memo menu</h2>
            <div class="create_memo">
	        <a href="">create new memo</a>
	    </div>
            <div class="add_items">
	        <a href="">add items</a>
            </div>
	</div>
	<div class="theme menu">
            <h2>theme menu</h2>
	    <h4>current theme</h4>
                <h3> {{ $main_theme->name }}</h3>
            <h4>select other theme</h4>
	    @foreach ($other_themes as $other_theme)
	       <div class="theme">
	           <a href="{{ route('theme.index', ['theme' => $other_theme->id]) }}">{{ $other_theme->name }}</a>
	       </div>
	    @endforeach 
            <a href="">add new theme</a>
        </div>
        <h1>Memo Name</h1>
	<div class='memos'>
	@foreach ($memos as $memo)
	    <div class="memo">
                <a href="{{ route('memo.show', ['memo' => $memo->id]) }}">{{ $memo->title }}</a>
	    </div>	
	@endforeach
        </div>
    </body>
</html>

