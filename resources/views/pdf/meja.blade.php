<!DOCTYPE html>
<html>

<head>
    <title>PDF Export Meja</title>
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
                <th>Nomor Meja</th>
                <th>Status</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($meja as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nomor_meja }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
