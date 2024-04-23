<!-- Modal -->
<div class="modal fade" id="formAbsensiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="post" action="absensi">
                    @csrf
                    <div id="method"></div>
                    <div class="method"></div>
                    <div class="card-body">
                        <div class="input-group input-group-static mb-4">
                            <label for="namaKaryawan">nama Karyawan</label>
                            <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan"
                                placeholder="namaKaryawan">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="tanggalMasuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggalMasuk" name="tanggalMasuk"
                                placeholder="tanggalMasuk">
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label for="waktuMasuk">Waktu Masuk</label>
                            <input type="time" class="form-control" id="waktuMasuk" name="waktuMasuk"
                                placeholder="waktuMasuk">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Cuti">Cuti</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="waktuKeluar" class="form-label">Waktu Keluar</label>
                            <input type="time" class="form-control" id="waktuKeluar" name="waktuKeluar">
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
