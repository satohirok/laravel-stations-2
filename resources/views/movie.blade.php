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
    <div class="container mt-2">
        <h1>映画一覧</h1>
        <form action="{{ route('index') }}" method="GET">
            <fieldset>
                <input type="radio" name="is_showing" value="all" {{ $is_showing === 'all' ? 'checked' : '' }}>
                <label for="">全て</label>
                <input type="radio" name="is_showing" value="0" {{ $is_showing === '0' ? 'checked' : '' }}>
                <label for="">公開予定</label>
                <input type="radio" name="is_showing" value="1" {{ $is_showing === '1' ? 'checked' : '' }}>
                <label for="">公開中</label>
            </fieldset>
            <input type="text" name="keyword" value="{{ $keyword }}" >
            <input type="submit" class="btn btn-primary" value="検索">
        </form>
        <table class="table">
            <thead>
                <th>映画タイトル</th>
                <th>画像URL</th>
                <th>概要</th>
                <th>上映中かどうか</th>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                <tr>
                    <td> {{ $movie->title }}</td>
                    <td>{{ $movie->image_url }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>
                        @if($movie->is_showing === 1)
                            上映中
                        @else
                            上映予定
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $movies->appends(request()->input())->links() }}
        </div>
    </div>
</body>
</html>
