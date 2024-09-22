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
        <h1>予約ページ</h1>
        <form method="POST" action="{{route('reservation.store')}}">
            @csrf

            {{-- <input type="hidden" name="movie_id" value="{{$movie_id}}"> --}}
            <input type="hidden" name="schedule_id" class="form-control" value="{{$schedule_id}}">
            <input type="hidden" name="sheet_id" class="form-control" value="{{$sheet_id}}">
            <input type="hidden" name="screen_id" class="form-control" value="{{$screen_id}}">
            <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
            <input type="hidden" name="date" class="form-control" value="{{$date}}">


            <label for="email" class="form-label">メールアドレス</label>
            <input class="form-control col-4" value="{{Auth::user()->email}}" readonly>
            <label for="name" class="form-label">名前</label>
            <input class="form-control col-3" value="{{Auth::user()->name}}" readonly >

            <button type="submit" class="btn btn-primary mt-3">予約する</button>
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
        </form>
    </div>
</body>
</html>
