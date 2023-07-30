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
            <form action="{{ route('format.createSecond')}}" method="post">
	        @csrf
		<input type="text"  name="themeName" placeholder="新規テーマのタイトルを入力してください" value="{{ $themeName  }}"></textarea>
		<h3>新規テーマの項目を設定してください</h3>
                @if (!is_null($tmpItems))
		@foreach ($tmpItems as $tmpItem)
		    <h4>項目属性</h4>
		    <select name="tmpItems[{{ $loop->index  }}][itemId]">
		        @foreach ($items as $item)
                            @if ($tmpItem["itemId"] == $item->id)
			        <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
			    @else
			         <option value="{{ $item->id }}">{{ $item->name }}</option>
	                    @endif
                        @endforeach
		    </select>
		    <h4>項目名</h4>
		    <input type="text" name="tmpItems[{{ $loop->index }}][name]" placeholder="項目名を入力してください" value="{{ $tmpItem["name"] }}">
		    <button type="submit" name="action" value="{{ $loop->index }}">削除</button>
		@endforeach
		@endif
		<div class="add_item">
                    <button type="submit" name="action" value="add">項目を追加する</button>
		</div>
		<div class="store">
                    <button type="submit" name="action" value="store">新規テーマを作成する</button>
                </div>
	    </form>
        </div>
	</body>
        <div class="footer">
            <a href="{{ route('theme.select') }}">戻る</a>
        </div>
</html>

