<!-- Modal -->
<div class="modal fade" id="formProdukTitipanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="post" action="produk_titipan">
                    @csrf
                    <div id="method"></div>
                    <div class="method"></div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="nama_produk">nama produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                placeholder="nama produk">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="nama_supplier">nama supplier</label>
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                placeholder="nama supplier">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="harga_beli">harga beli</label>
                            <input type="text" class="form-control" id="harga_beli" name="harga_beli"
                                placeholder="harga beli">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="harga_jual">harga jual</label>
                            <input type="text" class="form-control" id="harga_jual" name="harga_jual"
                                placeholder="harga jual" readonly>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="stok">stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" placeholder="stok">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="keterangan">keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                placeholder="keterangan">
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
