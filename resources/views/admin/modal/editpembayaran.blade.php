<div class="modal fade" id="metodePembayaranModal{{ $pesanan->id }}" tabindex="-1"
    aria-labelledby="metodePembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="metodePembayaranModalLabel">Pilih Pembayaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateMetodePembayaran', $pesanan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode
                            Pembayaran</label>
                        <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                            <option value="bank_transfer"
                                {{ $pesanan->metode_pembayaran == 'bank_transfer' ? 'selected' : '' }}>
                                Transfer Bank</option>
                            <option value="cash" {{ $pesanan->metode_pembayaran == 'cash' ? 'selected' : '' }}>
                                Cash</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
