<!-- Modal Edit Pengeluaran -->
<div class="modal fade" id="editPengeluaranModal-{{ $pengeluaran->id }}" tabindex="-1"
    aria-labelledby="editPengeluaranModalLabel-{{ $pengeluaran->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPengeluaranModalLabel-{{ $pengeluaran->id }}">Edit Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- The form action should point to the update route with the pengeluaran id -->
                <form id="editPengeluaranForm-{{ $pengeluaran->id }}" method="POST"
                    action="{{ route('pengeluaran.update', $pengeluaran->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="tanggal-{{ $pengeluaran->id }}" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" value="{{ $pengeluaran->tanggal }}"
                            id="tanggal-{{ $pengeluaran->id }}" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-{{ $pengeluaran->id }}" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" value="{{ $pengeluaran->jumlah }}" name="jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan-{{ $pengeluaran->id }}" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan-{{ $pengeluaran->id }}" name="keterangan" rows="3" required>{{ $pengeluaran->keterangan }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
