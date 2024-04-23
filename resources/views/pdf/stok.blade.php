<!DOCTYPE html>
<html>

<head>
    <title>PDF Export Stok</title>
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
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stok as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
