<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Theme</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <body>
        <h1>Select Theme</h1>
	<div class='themes'>
            <form action="{{ route('theme.access') }}" method="POST">
                @csrf
    	        <select name="theme">
                @foreach ($themes as $theme)
                    <option value="{{ $theme->id }}">{{ $theme->name }}</option>
		@endforeach
		</select>
                <button type="submit" value="send">決定</button>
	    </form>
	</div>
	<div class=='create'>
            <a href="">Create new theme?</a>
	</div>
        </body>
    </x-app-layout>
</html>

