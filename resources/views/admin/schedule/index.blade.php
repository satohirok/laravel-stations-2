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
    <div class="container mt-3">
        <h1>スケジュール一覧</h1>
        @foreach ($movies as $movie)
            <h2>{{ $movie->id }}:{{ $movie->title }}</h2>
            <table class="table">
                <thead>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                    <th></th>
                </thead>
                @foreach ($movie->schedules as $schedule)
                    <tbody>
                        <tr>
                            <td>{{ $schedule->start_time}}</td>
                            <td>{{ $schedule->end_time}}</td>
                            <td><a href="{{ route('schedule.show',['id' => $schedule->id]) }}">詳細</a></td>
                        </tr>
                    </tbody>
                @endforeach
                </table>
        @endforeach
    </div>
</body>
</html>
