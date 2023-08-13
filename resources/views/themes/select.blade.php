<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Theme</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
	<x-slot name="header">
            テーマ選択
        </x-slot>
        <body>
        <h1>テーマを選択してださい</h1>
	<div class='themes'>
            <form action="{{ route('theme.access') }}" method="post">
	    @csrf
    	        <select name="theme">
                @foreach ($themes as $theme)
                    <option value="{{ $theme->id }}">{{ $theme->name }}</option>
		@endforeach
		</select>
                <button class="bg-gray-500 font-semibold text-white py-2 px-4 rounded">決定</button>
	    </form>
	</div>
	<div class='create'>
            <a href="{{ route('format.createFirst') }}" class="text-blue-500 underline hover:text-blue-700">新規テーマを作成する</a>
	</div>
        </body>
    </x-app-layout>
</html>

