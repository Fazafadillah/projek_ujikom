<!DOCTYPE html>
<html>

<head>
    <title>PDF Export Menu</title>
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
                <th>Nama</th>
                <th>Harga</th>
                <th>stok</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->jenis->jenis }}</td>

                    <td>{{ $item->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
