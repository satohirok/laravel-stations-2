@include('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>管理者映画詳細</h1>
        <table class="table">
            <thead>
                <th>映画タイトル</th>
                <th>画像URL</th>
                <th>公開年</th>
                <th>概要</th>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $movie->title }}</td>
                    <td><img src="{{ $movie->image_url }}"/></td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->description }}</td>
                </tr>
            </tbody>
        </table>
        <h2>上映スケジュール</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                        - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
