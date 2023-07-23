<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Memo Name</h1>
	<div class='memos'>
                @foreach ($memos as $memo)
                    <p>{{ $memo->name }}</p>
		@endforeach
        </div>
    </body>
</html>

