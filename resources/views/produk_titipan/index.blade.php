@extends('templates.layout')
@push('style')
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="margin: 10px;">Produk Titipan</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('success') }}
                </div>
            @endif
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formProdukTitipanModal"
                style="margin: 10px;">
                <i class="fas fa-plus"></i>
            </button>
            <a href="{{ route('produk_titipan.export_excel') }}" class="btn btn-success">Export to
                Excel</a>

            <a href="{{ route('produk_titipan.export_pdf') }}" class="btn btn-danger">Export to PDF</a>
            <form action="{{ route('produk_titipan.import_excel') }}" method="POST" enctype="multipart/form-data"
                class="p-4 border rounded-lg bg-light">
                @csrf
                <div class="mb-1">
                    <label for="file" class="form-label">Choose Excel File</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-success" style="margin: 5px">Import from Excel</button>
            </form>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <table id="produk_titipan_table" class="table table-bordered table-hover table-striped table-sm">
                <!-- Isi tabel disini -->
            </table>

            <table class=" table table-bordered table-hover table-stripped table-sm" id="Mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Nama Supplier</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>stok</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($produk_titipan as $p)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : 1 }}</td>
                            <td>{{ $p->nama_produk }}</td>
                            <td>{{ $p->nama_supplier }}</td>
                            <td>Rp. {{ $p->harga_beli }}</td>
                            <td>Rp. {{ $p->harga_jual }}</td>
                            <td class="stok">{{ $p->stok }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td>
                                <form action="produk_titipan/{{ $p->id }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>

                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#formProdukTitipanModal"
                                    data-mode="edit" data-id="{{ $p->id }}"
                                    data-nama_produk="{{ $p->nama_produk }}" data-nama_supplier="{{ $p->nama_supplier }}"
                                    data-harga_beli="{{ $p->harga_beli }}" data-harga_jual="{{ $p->harga_jual }}"
                                    data-stok="{{ $p->stok }}" data-keterangan="{{ $p->keterangan }}"><i
                                        class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    @include('produk_titipan.form')
@endsection
@push('script')
    <script>
        $('#Mytable').DataTable()
        console.log('jumlah')
        $('.alert-success').fadeTo(5000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(10000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        console.log('jumlah')
        // $('#tbl_jumlah').DataTable()
        // dialog hapus
        $('.btn-delete').on('click', function(e) {
            console.log('delete')
            let jumlah = $(this).closest('tr').find('td:eq(1)').text();
            Swal.fire({
                icon: 'error',
                title: 'hapus data',
                html: `Hapus <b>${jumlah}</b> engga?`,
                confirmButtonText: 'Iyah',
                denyButtonText: 'engga',
                showDenyButton: true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
        $('#formProdukTitipanModal').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama_produk = btn.data('nama_produk')
            const nama_supplier = btn.data('nama_supplier')
            const harga_beli = btn.data('harga_beli')
            const harga_jual = btn.data('harga_jual')
            const stok = btn.data('stok')
            const keterangan = btn.data('keterangan')
            const modal = $(this)
            console.log(mode)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data produk_titipan')
                modal.find('#nama_produk').val(nama_produk)
                modal.find('#nama_supplier').val(nama_supplier)
                modal.find('#harga_beli').val(harga_beli)
                modal.find('#harga_jual').val(harga_jual)
                modal.find('#stok').val(stok)
                modal.find('#keterangan').val(keterangan)
                modal.find('.modal-body form').attr('action', '{{ url('produk_titipan') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data produk_titipan')
                modal.find('#nama_produk').val('')
                modal.find('#nama_supplier').val('')
                modal.find('#harga_beli').val('')
                modal.find('#harga_jual').val('')
                modal.find('#stok').val('')
                modal.find('#keterangan').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('produk_titipan') }}')
            }
        })
        $(document).ready(function() {
            // Fungsi untuk menghitung harga jual otomatis
            $('#harga_beli').on('input', function() {
                // Ambil nilai harga beli
                var hargaBeli = $(this).val();
                // Hitung harga jual berdasarkan harga beli dengan keuntungan 70%
                var hargaJual = parseFloat(hargaBeli) * 1.7;
                // Bulatkan harga jual ke kelipatan 500 terdekat
                hargaJual = Math.ceil(hargaJual / 500) * 500;
                // Masukkan nilai harga jual ke dalam input harga jual
                $('#harga_jual').val(hargaJual);
            });

            // Menambahkan form readonly pada saat mengetik nilai harga beli
            $('#harga_beli').on('keypress', function(e) {
                // Dapatkan tombol yang ditekan
                var key = e.keyCode || e.which;
                // Jika tombol yang ditekan bukan angka atau backspace, maka kembalikan false
                if (!/[0-9]/.test(String.fromCharCode(key)) && key !== 8) {
                    e.preventDefault();
                }
            });
        });
        $(document).ready(function() {
            // Event listener untuk double klik pada sel stok
            $('td.stok').dblclick(function() {
                var stok = $(this).text().trim(); // Ambil nilai stok saat ini
                $(this).html('<input type="number" class="form-control edit-stok" value="' + stok +
                    '">'); // Ganti elemen td dengan input stok
                $('input', this).focus(); // Fokuskan ke input stok yang baru
            });

            // Event listener untuk menangkap perubahan nilai input field stok
            $(document).on('blur', 'td.stok input', function() {
                var newStok = $(this).val(); // Ambil nilai baru dari input stok
                var productId = $(this).closest('tr').data(
                'product-id'); // Ambil ID produk dari atribut data
                updateStok(productId, newStok); // Panggil fungsi untuk memperbarui stok
            });
        });


        // Fungsi untuk memperbarui stok menggunakan AJAX
        function updateStok(productId, newStok) {
            $.ajax({
                url: '/update-stok/' + productId,
                method: 'PUT',
                data: {
                    stok: newStok
                },
                success: function(response) {
                    // Tambahkan kode di sini untuk menangani respons dari server
                    console.log('Stok berhasil diperbarui');
                    // Jika Anda ingin menampilkan pesan sukses atau melakukan tindakan lain, Anda bisa tambahkan di sini
                },
                error: function(xhr, status, error) {
                    // Tambahkan kode di sini untuk menangani kesalahan
                    console.error('Terjadi kesalahan: ' + error);
                }
            });
        }
    </script>
@endpush
