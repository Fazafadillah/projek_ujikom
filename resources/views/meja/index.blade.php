@extends('templates.layout1')
@push('style')
@endpush
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="margin: 10px;">Meja</h1>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formMejaModal" s">
                    <i class="fas fa-plus"></i>
                </button>
                <a href="{{ route('meja.export_pdf') }}" class="btn btn-danger">Export to PDF</a>
                <a href="{{ route('export-meja') }}" class='btn btn-success'><i class="fa-file-excel-o">Export
                        Excel</a>
                <button type="button" class='btn btn-warning' data-bs-toggle="modal"
                    data-bs-target="#formImportMejaModal"><i class="fa-file-excel-o">
                        Import Excel</button>
            </div>
            <div class="card-tools">

                <div class="card-body">

                    <table class=" table table-bordered table-hover table-stripped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Meja</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @foreach ($meja as $p)
                                <tr>
                                    <td>{{ $i = isset($i) ? ++$i : 1 }}</td>
                                    <td>{{ $p->nomor_meja }}</td>
                                    <td>{{ $p->status }}</td>
                                    <td>
                                        <form action="meja/{{ $p->id }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>

                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#formMejaModal"
                                            data-mode="edit" data-id="{{ $p->id }}"
                                            data-nomor_meja="{{ $p->nomor_meja }}" data-status="{{ $p->status }}"><i
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
            @include('meja.import')
            @include('meja.form')
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
                $('#formMejaModal').on('show.bs.modal', function(e) {
                    const btn = $(e.relatedTarget)
                    console.log(btn.data('mode'))
                    const mode = btn.data('mode')
                    const id = btn.data('id')
                    const nomor_meja = btn.data('nomor_meja')
                    const status = btn.data('status')
                    const modal = $(this)
                    console.log(mode)
                    if (mode === 'edit') {
                        modal.find('.modal-title').text('Edit Data meja')
                        modal.find('#nomor_meja').val(nomor_meja)
                        modal.find('#status').val(status)
                        modal.find('.modal-body form').attr('action', '{{ url('meja') }}/' + id)
                        modal.find('#method').html('@method('PATCH')')
                    } else {
                        modal.find('.modal-title').text('Input Data meja')
                        modal.find('#nomor_meja').val('')
                        modal.find('#status').val('')
                        modal.find('#method').html('')
                        modal.find('.modal-body form').attr('action', '{{ url('meja') }}')
                    }
                })
            </script>
        @endpush
