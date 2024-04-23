<!DOCTYPE html>
<html>

<head>
    <title>PDF Export Jenis</title>
    <style>
        /* Gaya CSS Anda di sini */
    </style>
</head>

<body>
    <h1>Data Export</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenis as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->jenis }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
