<!-- Modal -->
<div class="modal fade" id="formPelangganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="post" action="pelanggan">
                    @csrf
                    <div id="method"></div>
                    <div class="method"></div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="email">email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="email">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="no_telp">no telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                placeholder="no_telp">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="alamat">
                        </div>

                        {{-- <div class="input-group input-group-outline mb-4">
                            <label class="form-label">Label</label>
                            <input type="text" class="form-control">
                        </div> --}}
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">TUTUP</button>
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
