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
        <h1>座席表</h1>
        <table class="table" border="2">
            <tbody>
                @foreach ($sheets as $sheet)
                <tr>
                    <td>{{$sheet->id}}</td>
                    <td>{{$sheet->row}}-{{$sheet->column}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
