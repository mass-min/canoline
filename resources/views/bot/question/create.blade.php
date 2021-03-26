<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<form action="{{ route('bot.question.store', compact('bot')) }}" method="POST" class="p-2">
    @csrf
    <div class="mb-3">
        <label for="basic_id" class="form-label">質問テキスト</label>
        <input type="text" name="question_text" class="form-control">
    </div>
    <div class="mb-3">
        <label for="alias" class="form-label">回答テキスト</label>
        <input type="text" name="answer_text" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">作成</button>
</form>