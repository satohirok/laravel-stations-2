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
    <div class="mt-5 container">
        <h2>スケジュール編集</h2>
        <form method="PATCH" action="{{route('schedule.update',['id' => $schedule->id])}}" class="mb-3">
            @csrf
            <input name="movie_id" type="hidden" value="{{ $schedule->movie_id }}">
            <div class="d-flex">
                <div class="me-3">
                    <label for="start_time">開始時間</label>
                    <input name="start_time_date" type="date" class="form-control" value="{{($schedule->start_time)->format('Y-m-d') }}">
                    <input name="start_time_time" type="time" class="form-control" value="{{($schedule->start_time)->format('H:i') }}">
                </div>
                <div>
                    <label for="start_time">終了時間</label>
                    <input name="end_time_date" type="date" class="form-control" value="{{($schedule->end_time)->format('Y-m-d') }}">
                    <input name="end_time_time" type="time" class="form-control" value="{{($schedule->end_time)->format('H:i') }}">
                </div>
            </div>
            <div class="mt-2">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
