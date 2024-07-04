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
        <table class="table">
            <thead>
                <th>映画タイトル</th>
                <th>画像URL</th>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                <tr>
                    <td> {{ $movie->title }}</td>
                    <td>{{ $movie->image_url }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
