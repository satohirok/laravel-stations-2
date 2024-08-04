@include('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation List</title>
</head>
<body>
    <div class="container mt-3">
        <h1>予約管理 一覧画面</h1>
        <table class="table">
            <thead>
                <th>映画作品</th>
                <th>座席</th>
                <th>日時</th>
                <th>名前</th>
                <th>メールアドレス</th>

            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        @if ( \Carbon\Carbon::now()->format('Y-m-d') < $reservation->schedule->end_time)
                            <td>{{$reservation->schedule->movie->title}} </td>
                            <td>{{strtoupper($reservation->sheet->row.$reservation->sheet->column)}} </td>
                            <td>{{$reservation->date}}</td>
                            <td>{{$reservation->name}}</td>
                            <td>{{$reservation->email}}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-outline-danger">
            <a href="{{route('admin_reservation.create')}}">予約</a>
        </button>

    </div>
</body>
</html>
