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
                <th>上映中かどうか</th>
                <th>スケジュール作成</th>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $movie->title }}</td>
                    <td><img src="{{ $movie->image_url }}"/></td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>
                        @if($movie->is_showing === 1)
                        上映中
                        @else
                        上映予定
                        @endif
                    </td>
                    <td><a href="{{ route('schedule.create',['id' => $movie->id] )}}">作成</a></td>
                </tr>
            </tbody>
        </table>



        <table class="table mt-2">
            <h2>上映スケジュール</h2>
            <thead>
                <tr>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($movie->schedules as $schedule)
                @if($schedule)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i:s') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i:s') }}
                    </td>
                    <td>
                        <a href="{{ route('schedule.show', ['id' => $schedule->id])}}">詳細</a>
                    </td>
                </tr>
                @else
                <tr>
                    <td colspan="2">スケジュールがありません</td>
                </tr>
                @endif
              @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
