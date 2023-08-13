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
            メモ一覧
        </x-slot>
    <body>
	<div class="memo menu">
	    <h2>メモメニュー</h2>
            <div class="create_memo">
	        <a href="{{ route('memo.createFirst', ['theme' => $main_theme->id]) }}" class="text-blue-500 underline hover:text-blue-700">新規メモを作成</a>
	    </div>
	</div>
	<div class="theme menu">
            <h2>テーマメニュー</h2>
	    <h4>現在のテーマ</h4>
		<h3> {{ $main_theme->name }}</h3>
                <a href="{{ route('format.editFirst', ['theme' => $main_theme->id]) }}" class="text-blue-500 underline hover:text-blue-700">フォーマットを編集する</a>
            <h4>他テーマを選択</h4>
	    @foreach ($other_themes as $other_theme)
	       <div class="theme">
	           <a href="{{ route('theme.index', ['theme' => $other_theme->id]) }}" class="text-blue-500 underline hover:text-blue-700">{{ $other_theme->name }}</a>
	       </div>
	    @endforeach 
            <a href="{{ route('format.createFirst') }}" class="text-blue-500 underline hover:text-blue-700">新規テーマを作成</a>
        </div>
        <h1>メモ</h1>
	<div class='memos'>
	@foreach ($memos as $memo)
	    <div class="edit-button">
            <a href="{{ route('memo.show', ['theme' => $main_theme->id, 'memo' => $memo->id]) }}" class="text-blue-500 underline hover:text-blue-700">{{ $memo->title }}</a>
	    <form action="{{ route('memo.delete', ['theme' => $main_theme->id, 'memo' => $memo->id]) }}" id="form_{{ $memo->id }}" method="post">
	    @csrf
	    @method('DELETE')
	    <button type="button" onclick="deleteMemo({{ $memo->id }})" class="bg-gray-500 text-white py-1 px-2 rounded" >削除</button>
	    </form>	
	    <a href="{{ route('memo.editFirst', ['theme' => $main_theme->id, 'memo' => $memo->id]) }}" class="bg-gray-500 text-white py-1 px-2 rounded" >編集</a>
            </div>
	@endforeach
        </div>
    </body>
     </x-app-layout>
    <script>
        function deleteMemo(id) {
                'use strict'
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
		}
	}
     </script>
</html>

