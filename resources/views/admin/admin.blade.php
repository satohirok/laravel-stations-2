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
        <h1>管理者画面</h1>
        <table class="table">
            <thead>
                <th>映画タイトル</th>
                <th>画像URL</th>
                <th>公開年</th>
                <th>上映中かどうか</th>
                <th>概要</th>
                <th>ジャンル</th>

            </thead>
            <tbody>
                @foreach ($movies as $movie)
                <tr>
                    <td> {{ $movie->title }}</td>
                    <td>{{ $movie->image_url }}</td>
                    <td>{{$movie->published_year}}</td>
                    <td>
                        @if($movie->is_showing === 1)
                            上映中
                        @else
                            上映予定
                        @endif
                    </td>
                    <td>{{$movie->description}}</td>
                    <td>{{$movie->genre_id}}</td>
                    <td><a href="{{ route('admin.edit',['id' => $movie->id]) }}" >編集</a></td>
                    <td><a href="{{ route('admin.destroy',['id' => $movie->id] )}}" onclick="return confirm('削除してよろしいですか?')">削除</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.create') }}">登録画面</a>
        <a href="{{ route('index') }}">一覧</a>
    </div>
</body>
</html>
