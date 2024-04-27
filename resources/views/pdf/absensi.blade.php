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
                <th>Nama Karyawan</th>
                <th>Tanggal Masuk</th>
                <th>Waktu Masuk</th>
                <th>Status</th>
                <th>Waktu Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->namaKaryawan }}</td>
                    <td>{{ $item->tanggalMasuk }}</td>
                    <td>{{ $item->waktuMasuk }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->waktuKeluar }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
