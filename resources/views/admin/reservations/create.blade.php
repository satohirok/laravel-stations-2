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
    <div class="container mt-3">
        <h1>管理者予約ページ</h1>
        <form method="POST" action="{{route('admin_reservation.store')}}">
            @csrf
            <label for="">予約日</label>
            <input type="date" name="date" class="form-control mb-2 col-2" value="">
            <label for="">映画タイトル</label>
            <select name="movie_id" class="form-select col-1">
                @foreach ($movies as $movie)
                    <option value="{{$movie->id}}">{{$movie->title}}</option>
                @endforeach
            </select>

            <label for="">スケジュール</label>
            <select name="schedule_id" class="form-select">
                @foreach ( $schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{($schedule->start_time)->format('Y-m-d-H:i')}}</option>
                @endforeach
            </select>

            <label for="" class="mt-2">座席</label>
            <select name="sheet_id" class="form-select col-1">
                @foreach ($sheets as $sheet)
                    <option value="{{$sheet->id}}">{{$sheet->row}}{{$sheet->column}}</option>
                @endforeach
            </select>

            <label for="" class="mt-2">スクリーン</label>
            <select name="screen_id" class="form-select col-2">
                @foreach ($screens as $screen)
                    <option value="{{$screen->id}}">{{$screen->name}}</option>
                @endforeach
            </select>

            <label for="email" class="mt-2">メールアドレス</label>
            <input type="text" name="email" class="form-control col-4">
            <label for="name">名前</label>
            <input type="text" name="name" class="form-control col-3">
            <input type="submit" class="btn btn-primary mt-2" value="登録">
        </form>
        @error('schedule_id')
            <p>{{ $message }}</p>
        @enderror
        @error('sheet_id')
            <p>{{ $message }}</p>
        @enderror
        @error('date')
            <p>{{ $message }}</p>
        @enderror
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        @error('movie_id')
            <p>{{ $message }}</p>
        @enderror
    </div>
</body>
</html>
