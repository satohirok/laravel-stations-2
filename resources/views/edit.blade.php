@include('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie List</title>
</head>
<body>
    <div class="container mt-3">
        <h1>編集画面</h1>
        <form method="PATCH" action="{{route('admin.update',['id' => $movie->id])}}">
            @csrf

            <label for="title" class="form-label">映画タイトル</label>
            <input type="text" name="title" class="form-control" value="{{$movie->title}}">
            @error('title')
                <p>{{ $message }}</p>
            @enderror

            <label for="url" class="form-label">画像URL</label>
            <input type="text" name="image_url" class="form-control" value="{{$movie->image_url}}">
            @error('image_url')
                <p>{{ $message }}</p>
            @enderror

            <label for="published_year" class="form-label">公開年</label>
            <input type="text" name="published_year" class="form-control" value="{{$movie->published_year}}">
            @error('published_year')
                <p>{{ $message }}</p>
            @enderror

            <div class="form-check mt-2">
                <input type="hidden" name="is_showing" value="0">
                <input class="form-check-input" type="checkbox" name="is_showing" value="1" @if($movie->is_showing === 1) checked @endif>
                <label class="form-check-label">
                  公開中かどうか
                </label>
            </div>
            @error('is_showing')
                <p>{{ $message }}</p>
            @enderror

            <label for="genre mt-3">ジャンル</label>
            <input type="text" name="name" class="form-control" value="{{ $movie->genre->name }}">
            @error('name')
                <p>{{ $message }}</p>
            @enderror


            <label for="description" class="form-label">概要</label>
            <textarea name="description" class="form-control">{{$movie->description}}</textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">登録</button>
        </form>

    </div>
</body>
</html>
