<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<a href="{{ route('bot.question.create', compact('bot')) }}" class="btn btn-primary">質問を作成</a>

<ul class="list-group">
    @foreach($questions as $question)
        <li>
            <p class="list-group-item">{{ $question->question_text }}</p>
            <p class="list-group-item">{{ $question->answer_text }}</p>
        </li>
    @endforeach
</ul>