@extends('templates.layout1')
@push('style')
@endpush
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="margin: 10px;">jenis</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('success') }}
                </div>
            @endif
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#formJenisModal">
                <i class="fas fa-plus"></i>
            </button>
            <a href="{{ route('jenis.export_pdf') }}" class="btn btn-danger">Export to PDF</a>

            <a href="{{ route('export-jenis') }}" class='btn btn-success'><i class="fa-file-excel-o">Export
                    Excel</a>


            <button type="button" class='btn btn-warning' data-bs-toggle="modal" data-bs-target="#formImportJenisModal"><i
                    class="fa-file-excel-o">
                    Import Excel</button>

        </div>
        <div class="card-body">

            <table class=" table table-bordered table-hover table-stripped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($jenis as $p)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : 1 }}</td>
                            <td>{{ $p->jenis }}</td>
                            <td>
                                <form action="jenis/{{ $p->id }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>

                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#formJenisModal"
                                    data-mode="edit" data-id="{{ $p->id }}" data-jenis="{{ $p->jenis }}"><i
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

    @include('jenis.import')
    @include('jenis.form')
@endsection

@push('script')
    <script>
        console.log('jenis')
        $('.alert-success').fadeTo(5000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(10000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        console.log('jenis')
        // $('#tbl_jenis').DataTable()
        // dialog hapus
        $('.btn-delete').on('click', function(e) {
            console.log('delete')
            let jenis = $(this).closest('tr').find('td:eq(1)').text();
            Swal.fire({
                icon: 'error',
                title: 'hapus data',
                html: `Hapus <b>${jenis}</b> engga?`,
                confirmButtonText: 'Iyah',
                denyButtonText: 'engga',
                showDenyButton: true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
        $('#formJenisModal').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const id = btn.data('id')
            const jenis = btn.data('jenis')
            const modal = $(this)
            console.log(mode)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data jenis')
                modal.find('#jenis').val(jenis)
                modal.find('.modal-body form').attr('action', '{{ url('jenis') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data jenis')
                modal.find('#jenis').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('jenis') }}')
            }
        })
    </script>
@endpush
