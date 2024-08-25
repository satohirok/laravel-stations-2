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
                @foreach ($sheets as $row => $rowSheets)
                <tr>
                    @foreach ($rowSheets as $sheet)
                        <td>
                          <input type="submit" class="btn btn-outline-primary" value="{{$sheet->row}}-{{$sheet->column}}">
                        </td>
                    @endforeach
                </tr>
                @endforeach
        </table>
    </div>
</body>
</html>
