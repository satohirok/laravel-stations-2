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
        <h2>スケジュール作成</h2>
        <form method="POST" action="{{route('schedule.store',['id' => $movie->id])}}" class="mb-3">
            @csrf
            <input name="movie_id" type="hidden" value="{{ $movie->id }}">
            <div class="d-flex">
                <div class="me-3">
                    <label for="start_time">開始時間</label>
                    <input name="start_time_date" type="date" class="form-control">
                    <input name="start_time_time" type="time" class="form-control">
                </div>
                <div>
                    <label for="start_time">終了時間</label>
                    <input name="end_time_date" type="date" class="form-control">
                    <input name="end_time_time" type="time" class="form-control">
                </div>
            </div>
            <div class="mt-2">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
