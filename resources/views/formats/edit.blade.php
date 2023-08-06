<!DOQTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Theme</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
        <body>
	<h1>{{ $theme->name }}のフォーマットの編集</h1>
	<div class='items'>
            <form action="{{ route('format.editSecond', ['theme' => $theme->id]) }}" method="post">
	    @csrf 
		<h3>テーマの項目を設定してください</h3>
		@if (! is_null($newFormats))
		<?php $n = count($newFormats)?>
		@for ($order=1; $order <= $n ; $order++)
		<?php $newFormat = $newFormats[$order] ?>
		<button type="submit" name="action[{{ $order }}]" value="new">項目を追加する</button>
		    <h4>項目名</h4>
		    @if ($newFormat['label'] === 'new' or $newFormat['label'] === 'old')
		    <input type="text" name="newFormats[{{ $order }}][name]" placeholder="項目名を入力してください" value="{{ $newFormat["name"] }}"/>
		    <button type="submit" name="action[{{ $order }}]" value="del">削除</button>
		    @else
		    <h5 style="color:gray">{{ $newFormat['name'] }}（削除）</h5>
                    <input type="hidden" name="newFormats[{{ $order }}][name]" value="{{ $newFormat['name'] }}" />
		    <button type="submit" name="action[{{ $order }}]" value="rec"> 復元</button>
		    @endif
		    @if ($newFormat['label'] === 'new' or $newFormat['label'] === 'old')
		    <h4>項目属性</h4>
		    @endif
                        @if ($newFormat['label'] === 'old')
                        <h5>{{ $items->find($newFormat['item_id'])->name }}</h5>
                        <input type="hidden" name="newFormats[{{ $order }}][format_id]" value="{{ $newFormat['format_id'] }}" />
                        <input type="hidden" name="newFormats[{{ $order }}][item_id]" value="{{ $newFormat['item_id'] }}" />
                        <input type="hidden" name="newFormats[{{ $order }}][label]" value="old" />
                        @elseif ($newFormat['label'] === 'new')
                        <p>新規項目</p>
                        <select name="newFormats[{{ $order }}][item_id]">
                        @foreach ($items as $item)
                             @if ($item->id == $newFormat['item_id'])
                                     <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                             @else
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                             @endif
                             @endforeach
                        <input type="hidden" name="newFormats[{{ $order }}][format_id]" value="{{ $newFormat['format_id'] }}" />
                        <input type="hidden" name="newFormats[{{ $order }}][label]" value="new" />
                        @else
                        <div class="deleted">
                            <input type="hidden" name="newFormats[{{ $order }}][format_id]" value="{{ $newFormat['format_id'] }}" />
                            <input type="hidden" name="newFormats[{{ $order }}][item_id]" value="{{ $newFormat['item_id'] }}" />
                            <input type="hidden" name="newFormats[{{ $order }}][label]" value="del" />
                        </div>
                        @endif
		    @endfor
		<?php $nl = count($newFormats) + 1 ?>
		<button type="submit" name="action[{{ $nl }}]" value="new">項目を追加する</button>
                @endif
		<div class="store">
                    <button type="submit" name="action" value="store">フォーマットを保存する</button>
                </div>
	    </form>
        </div>
	</body>
        <div class="footer">
            <a href="{{ route('theme.select') }}">戻る</a>
        </div>
</html>

