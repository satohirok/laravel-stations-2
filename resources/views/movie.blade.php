<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie List</title>
</head>
<body>
    映画一覧
    <ul>
        @foreach ($movies as $movie)
            <li>映画タイトル: {{ $movie->title }}</li>
            <li>画像URL: {{ $movie->image_url }}</li>
            <img src="{{$movie->image_url}}" alt="">
        @endforeach
    </ul>
</body>
</html>
