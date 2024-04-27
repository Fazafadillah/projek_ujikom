<!-- Modal -->
<div class="modal fade" id="formImportMejaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="post" action="{{ route('import-meja') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Form fields -->
                    <div class="input-group input-group-static mb-4">
                        <label for="import">File</label>
                        <input type="file" class="form-control" id="import" name="import" placeholder="import">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
