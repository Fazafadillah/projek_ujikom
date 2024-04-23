<!DOCTYPE html>
<html>

<head>
    <title>PDF Export Kategori</title>
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
                <th>name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
