    <!-- Modal Tolak -->
    <div class="modal fade" id="tolakModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="tolakModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('tolakadmin', $pesanan->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alasan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="keterangan_tolak" class="form-label">Masukkan alasan
                                penolakan:</label>
                            <textarea class="form-control" name="keterangan_tolak" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
