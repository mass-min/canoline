<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<ul class="list-group">
    @foreach($bots as $bot)
        <li class="list-group-item"><a href="{{ route('bot.show', $bot->id) }}">{{ $bot->display_name }}</a></li>
    @endforeach
</ul>