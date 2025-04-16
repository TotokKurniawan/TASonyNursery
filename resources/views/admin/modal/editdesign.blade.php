<!-- Modal Edit Design -->
<div class="modal fade" id="editdesignmodal-{{ $design->id }}" tabindex="-1"
    aria-labelledby="editDesignModalLabel-{{ $design->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDesignModalLabel-{{ $design->id }}">Edit Design</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Update the form action to point to the correct update route -->
            <form method="POST" action="{{ route('updatedesign', $design->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $design->id }}">

                    <div class="mb-3">
                        <label for="editKonsep-{{ $design->id }}" class="form-label">Konsep</label>
                        <input type="text" class="form-control" value="{{ $design->konsep }}"
                            id="editKonsep-{{ $design->id }}" name="konsep" required>
                    </div>
                    <div class="mb-3">
                        <label for="editKonsep-{{ $design->id }}" class="form-label">Lahan</label>
                        <input type="text" class="form-control" value="{{ $design->lahan }}"
                            id="editKonsep-{{ $design->id }}" name="lahan" required>
                    </div>
                    <div class="mb-3">
                        <label for="editKonsep-{{ $design->id }}" class="form-label">Harga</label>
                        <input type="text" class="form-control" value="{{ $design->harga }}"
                            id="editKonsep-{{ $design->id }}" name="harga" required>
                    </div>

                    <div class="mb-3">
                        <label for="editFoto-{{ $design->id }}" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="editFoto-{{ $design->id }}" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
