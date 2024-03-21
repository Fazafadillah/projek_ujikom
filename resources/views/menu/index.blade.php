@extends('templates.layout')
@push('style')
@endpush
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="margin: 10px;">menu</h1>
            <br>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('success') }}
                </div>
            @endif
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#formMenuModal">
                <i class="fas fa-plus"></i>
            </button>

            <a href="{{ route('menu.export_pdf') }}" class="btn btn-danger">Export to PDF</a>

            <div class="card-tools">

            </div>
        </div>
        <div class="card-body">

            <table class=" table table-bordered table-hover table-stripped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>stok</th>
                        <th>Jenis</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @foreach ($menu as $p)
                        <tr>
                            <td>{{ $i = isset($i) ? ++$i : 1 }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->harga }}</td>
                            <td>{{ $p->stok }}</td>
                            <td>{{ $p->jenis->jenis }}</td>
                            <td><img src="{{ asset('storage/menu-image/' . $p->image) }}" width="100" height="100">
                            </td>
                            <td>{{ $p->deskripsi }}</td>
                            <td>
                                <form action="menu/{{ $p->id }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>

                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#formMenuModal"
                                    data-mode="edit" data-id="{{ $p->id }}" data-name="{{ $p->name }}"
                                    data-harga="{{ $p->harga }}" data-stok="{{ $p->stok }}"
                                    data-jenis_id="{{ $p->jenis_id }}" data-image="{{ $p->image }}"
                                    data-deskripsi="{{ $p->deskripsi }}"><i class="fas fa-edit"></i></button>
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

    @include('menu.form')
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        console.log('menu')
        $('.alert-success').fadeTo(5000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(10000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        console.log('menu')
        // $('#tbl_menu').DataTable()
        // dialog hapus
        $('.btn-delete').on('click', function(e) {
            console.log('delete')
            let menu = $(this).closest('tr').find('td:eq(1)').text();
            Swal.fire({
                icon: 'error',
                title: 'hapus data',
                html: `Hapus <b>${menu}</b> engga?`,
                confirmButtonText: 'Iyah',
                denyButtonText: 'engga',
                showDenyButton: true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
        $('#formMenuModal').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const id = btn.data('id')
            const name = btn.data('name')
            const harga = btn.data('harga')
            const stok = btn.data('stok')
            const jenis_id = btn.data('jenis_id')
            const image = btn.data('image')
            const deskripsi = btn.data('deskripsi')
            const modal = $(this)
            console.log(mode)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data menu')
                modal.find('#name').val(name)
                modal.find('#harga').val(harga)
                modal.find('#stok').val(stok)
                modal.find('#jenis_id').val(jenis_id)
                modal.find('#old_image').val(image)
                modal.find('#deskripsi').val(deskripsi)
                modal.find('.img-preview').attr('src', '{{ asset('storage/menu-image') }}/' + image)
                modal.find('.modal-body form').attr('action', '{{ url('menu') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data menu')
                modal.find('#name').val('')
                modal.find('#harga').val('')
                modal.find('#stok').val('')
                modal.find('#jenis_id').val('')
                modal.find('#old_image').val('')
                modal.find('#deskripsi').val('')
                modal.find('.img-preview').attr('src', '')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('menu') }}')
            }
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
