@extends('templates.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="margin: 10px;">Absensi</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAbsensiModal"
                style="margin: 10px;">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Masuk</th>
                        <th>Waktu Masuk</th>
                        <th>Status</th>
                        <th>Waktu Keluar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach ($absensi as $p)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $p->namaKaryawan }}</td>
                            <td>{{ $p->tanggalMasuk }}</td>
                            <td>{{ $p->waktuMasuk }}</td>
                            <td>{{ $p->status }}</td>
                            <td>{{ $p->waktuKeluar }}</td>
                            <td>
                                <form action="{{ url('absensi/' . $p->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#formAbsensiModal"
                                    data-mode="edit" data-id="{{ $p->id }}"
                                    data-namaKaryawan="{{ $p->namaKaryawan }}" data-tanggalMasuk="{{ $p->tanggalMasuk }}"
                                    data-waktuMasuk="{{ $p->waktuMasuk }}" data-status="{{ $p->status }}"
                                    data-waktuKeluar="{{ $p->waktuKeluar }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('absensi.form')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Handling delete button click
            $('.btn-delete').on('click', function(e) {
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
                    if (result.isConfirmed) {
                        $(e.target).closest('form').submit();
                    } else {
                        Swal.close(); // Corrected from swal.close() to Swal.close()
                    }
                });
            });

            // Handling modal show event
            $('#formAbsensiModal').on('show.bs.modal', function(e) {
                const btn = $(e.relatedTarget);
                const mode = btn.data('mode');
                const id = btn.data('id');
                const namaKaryawan = btn.data('namaKaryawan');
                const tanggalMasuk = btn.data('tanggalMasuk');
                const waktuMasuk = btn.data('waktuMasuk');
                const status = btn.data('status');
                const waktuKeluar = btn.data('waktuKeluar');
                const modal = $(this); // Define modal here
                if (mode === 'edit') {
                    modal.find('.modal-title').text('Edit Data absensi');
                    modal.find('#namaKaryawan').val(namaKaryawan);
                    modal.find('#tanggalMasuk').val(tanggalMasuk);
                    modal.find('#waktuMasuk').val(waktuMasuk);
                    modal.find('#status').val(status);
                    modal.find('#waktuKeluar').val(waktuKeluar);
                    modal.find('.modal-body form').attr('action', `{{ url('absensi') }}/${id}`);
                    modal.find('#method').html('@method('PATCH')');
                } else {
                    modal.find('.modal-title').text('Input Data absensi');
                    modal.find('#namaKaryawan').val('');
                    modal.find('#tanggalMasuk').val('');
                    modal.find('#waktuMasuk').val('');
                    modal.find('#status').val('');
                    modal.find('#waktuKeluar').val('');
                    modal.find('#method').html('');
                    modal.find('.modal-body form').attr('action', `{{ url('absensi') }}`);
                }
            });
        });
    </script>
@endpush
