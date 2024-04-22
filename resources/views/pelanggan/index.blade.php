@extends('templates.layout')
@push('style')
@endpush
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="margin: 10px;">pelanggan</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                        Launch Primary Modal --}}
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formPelangganModal"
                style="margin: 10px;">
                <i class="fas fa-plus"></i>
            </button>
            <a href="{{ route('pelanggan.export_pdf') }}" class="btn btn-danger">Export to PDF</a>
            <a href="{{ route('export-paket-pelanggan') }}" class='btn btn-success'><i class="fa-file-excel-o">Export
                    Excel</a>

            <div class="card-tools">

            </div>
        </div>
        <div class="card-body">

            <table class=" table table-bordered table-hover table-stripped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($pelanggan as $p)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : 1 }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->no_telp }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>
                                <form action="pelanggan/{{ $p->id }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>

                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#formPelangganModal"
                                    data-mode="edit" data-id="{{ $p->id }}" data-nama="{{ $p->nama }}"
                                    data-email="{{ $p->email }}" data-no_telp="{{ $p->no_telp }}"
                                    data-alamat="{{ $p->alamat }}"><i class="fas fa-edit"></i></button>
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
    @include('pelanggan.form')
@endsection

@push('script')
    <script>
        console.log('pelanggan')
        $('.alert-success').fadeTo(5000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(10000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        console.log('pelanggan')
        // $('#tbl_pelanggan').DataTable()
        // dialog hapus
        $('.btn-delete').on('click', function(e) {
            console.log('delete')
            let pelanggan = $(this).closest('tr').find('td:eq(1)').text();
            Swal.fire({
                icon: 'error',
                title: 'hapus data',
                html: `Hapus <b>${pelanggan}</b> engga?`,
                confirmButtonText: 'Iyah',
                denyButtonText: 'engga',
                showDenyButton: true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
        $('#formPelangganModal').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama = btn.data('nama')
            const email = btn.data('email')
            const no_telp = btn.data('no_telp')
            const alamat = btn.data('alamat')
            const modal = $(this)
            console.log(mode)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data pelanggan')
                modal.find('#nama').val(nama)
                modal.find('#email').val(email)
                modal.find('#no_telp').val(no_telp)
                modal.find('#alamat').val(alamat)
                modal.find('.modal-body form').attr('action', '{{ url('pelanggan') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data pelanggan')
                modal.find('#nama').val('')
                modal.find('#email').val('')
                modal.find('#no_telp').val('')
                modal.find('#alamat').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('pelanggan') }}')
            }
        })
    </script>
@endpush
