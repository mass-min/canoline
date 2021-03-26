<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<form action="{{ route('bot.store') }}" method="POST" class="p-2">
    @csrf
    <div class="mb-3">
        <label for="basic_id" class="form-label">内部ID</label>
        <input type="text" name="basic_id" class="form-control">
    </div>
    <div class="mb-3">
        <label for="alias" class="form-label">ボット名</label>
        <input type="text" name="display_name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="alias" class="form-label">チャネルシークレット</label>
        <input type="text" name="channel_secret" class="form-control">
    </div>
    <div class="mb-3">
        <label for="alias" class="form-label">アクセストークン</label>
        <input type="text" name="channel_access_token" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">作成</button>
</form>