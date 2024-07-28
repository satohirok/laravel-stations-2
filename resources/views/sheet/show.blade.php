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
        <h1>{{ $schedule->movie->title}}:座席予約ページ</h1>
        <h2>{{$schedule->end_time}}</h2>
        <table class="table" border="2">
            <tbody>
                @foreach ($sheets as $row => $rowSheets)
                <tr>
                    @foreach ($rowSheets as $sheet)
                        <td>
                            <form action="{{route('reservation.create',['movie_id' => $movie->id,'schedule_id' => $schedule->id])}}" method="GET">
                                <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                <input type="hidden" name="sheetId" value="{{$sheet->id}}">
                                <input type="submit" class="btn btn-outline-primary" value="{{$sheet->row}}-{{$sheet->column}}">
                            </form>
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
