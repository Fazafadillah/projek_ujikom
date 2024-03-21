<!-- Modal -->
<div class="modal fade" id="formStokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="post" action="stok">
                    @csrf
                    <div id="method"></div>
                    <div class="method"></div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="jumlah">jumlah</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah"
                                placeholder="jumlah">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="menu_id">Pilih Menu:</label>
                            <select class="form-control" name="menu_id" id="menu_id" required>
                                <option value="" disabled selected>Pilih Menu</option>
                                @foreach ($menu as $j)
                                    <option value="{{ $j->id }}">{{ $j->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Mohon pilih salah satu Menu</div>
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
        </div>
    </div>
</div>
