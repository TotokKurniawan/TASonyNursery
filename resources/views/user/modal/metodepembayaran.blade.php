<div class="modal fade" id="metodePembayaranModal{{ $pesanan->id }}" tabindex="-1"
    aria-labelledby="metodePembayaranModalLabel{{ $pesanan->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="metodePembayaranModalLabel{{ $pesanan->id }}">Pilih Metode
                    Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateMetodePembayaran', $pesanan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="metode_pembayaran_{{ $pesanan->id }}" class="form-label">Metode
                            Pembayaran</label>
                        <select class="form-select" name="metode_pembayaran" id="metode_pembayaran_{{ $pesanan->id }}">
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
