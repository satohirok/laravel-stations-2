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
        <h1>スケジュール詳細</h1>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                </tr>
            </thead>
            <tbody>
                @if($schedule)
                @csrf
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i:s') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i:s') }}
                        </td>
                        <td>
                            <a href="{{ route('schedule.edit', ['id' => $schedule->id])}}">編集</a>
                        </td>
                        <td>
                            <a href="{{ route('schedule.destroy', ['id' => $schedule->id])}}">削除</a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="2">スケジュールがありません</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
