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
    <div class="container mt-2">
        <h1>詳細画面</h1>
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

        <table class="table mt-2">
            <h2>上映スケジュール</h2>
            <thead>
                <tr>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                    <th>座席を予約する</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($movie->schedules as $schedule)
                @if($schedule)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i') }}
                    </td>
                    <td>
                        <form action="{{ route('sheet.show',['movie_id' => $movie->id,'schedule_id' => $schedule->id,'screen_id' => $schedule->screen_id])}}">
                            <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            <input type="submit" value="座席を予約する" class="btn btn-primary">

                        </form>
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
