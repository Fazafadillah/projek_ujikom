<!-- Modal -->
<div class="modal fade" id="formMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <input type="hidden" name="old_image" id="old_image">
                    <div class="method"></div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga"
                                placeholder="Harga">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="stok">stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" placeholder="stok">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="jenis_id" class="col-sm-2 col-form-label">Jenis</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jenis_id" id="jenis_id" required>
                                    <option value="" disabled selected>Pilih Jenis</option>
                                    @foreach ($jenis as $j)
                                        <option value="{{ $j->id }}">{{ $j->jenis }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Mohon pilih salah satu jenis.</div>
                            </div>
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <img class="img-preview img-fluid" style="max-height: 200px">
                            <div class="input-group input-group-outline my-3">
                                <input type="file" class="form-control" id="image" name="image"
                                    onchange="previewImage()">
                            </div>
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="deskripsi" class="input-label">Deskripsi</label>
                            <input type="text" class="form-control input-field" id="deskripsi" name="deskripsi"
                                placeholder="Deskripsi">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-gradient-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
