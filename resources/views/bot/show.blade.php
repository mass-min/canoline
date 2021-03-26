<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<a href="{{ route('bot.questions.index', compact('bot')) }}">質問を見る</a>

<ul class="list-group">
    <li class="list-group-item">表示名: {{ $bot->display_name }}</li>
    <li class="list-group-item">ステータス: {{ $bot->status }}</li>
    <li class="list-group-item">チャンネルシークレット: {{ $bot->channel_secret }}</li>
    <li class="list-group-item">チャンネルアクセストークン: {{ $bot->channel_access_token }}</li>
</ul>