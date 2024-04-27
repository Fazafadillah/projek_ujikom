@extends('templates.layout1')
@push('style')
@endpush
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="margin: 10px;">Stok</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                        Launch Primary Modal --}}
                    </button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formStokModal">
                    <i class="fas fa-plus"></i>
                </button>
                <a href="{{ route('stok.export_pdf') }}" class="btn btn-danger">Export to PDF</a>
                <a href="{{ route('export-stok') }}" class='btn btn-success'><i class="fa-file-excel-o">Export
                        Excel</a>
                <button type="button" class='btn btn-warning' data-bs-toggle="modal"
                    data-bs-target="#formImportStokModal"><i class="fa-file-excel-o">
                        Import Excel</button>
            </div>
            <div class="card-tools">

            </div>
        </div>
        <div class="card-body">

            <table class=" table table-bordered table-hover table-stripped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($stok as $p)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : 1 }}</td>
                            <td>{{ $p->menu->name }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>
                                <form action="stok/{{ $p->id }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>

                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#formStokModal"
                                    data-mode="edit" data-id="{{ $p->id }}" data-menu_id="{{ $p->menu_id }}"
                                    data-jumlah="{{ $p->jumlah }}"><i class="fas fa-edit"></i></button>
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
    @include('stok.form')
    @include('stok.import')
@endsection

@push('script')
    <script>
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
        $('#formStokModal').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const id = btn.data('id')
            const menu_id = btn.data('menu_id')
            const jumlah = btn.data('jumlah')
            const modal = $(this)
            console.log(mode)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data stok')
                modal.find('#menu_id').val(menu_id)
                modal.find('#jumlah').val(jumlah)
                modal.find('.modal-body form').attr('action', '{{ url('stok') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data stok')
                modal.find('#menu_id').val('')
                modal.find('#jumlah').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('stok') }}')
            }
        })
    </script>
@endpush
