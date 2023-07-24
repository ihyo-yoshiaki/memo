<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>{{ $memo->title }}</h1>
	<div class='texts'>
            @foreach ($texts as $text)
		<div class=='text'>
                    <p>{{ $text->content }}</p>
		</div>
            @endforeach
        </div>
	<div class='footer'>
            <a href="{{ route('theme.index', ['theme' => $theme->id]) }}">return</a>
        </div>
    </body>
</html>

