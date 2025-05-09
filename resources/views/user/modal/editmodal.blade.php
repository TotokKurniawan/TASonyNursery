<!-- Modal Edit Pesanan -->
<div class="modal fade" id="editPesananModal{{ $pesanan->id }}" tabindex="-1"
    aria-labelledby="editPesananLabel{{ $pesanan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                @csrf
                @method('patch')

                <div class="modal-header">
                    <h5 class="modal-title" id="editPesananLabel{{ $pesanan->id }}">Edit Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alamat{{ $pesanan->id }}" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat{{ $pesanan->id }}"
                            value="{{ $pesanan->pelanggan->alamat ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="telepon{{ $pesanan->id }}" class="form-label">No. Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="telepon{{ $pesanan->id }}"
                            value="{{ $pesanan->pelanggan->telepon ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_survei{{ $pesanan->id }}" class="form-label">Tanggal Pengerjaan</label>
                        <input type="date" name="tanggal_survei" class="form-control"
                            id="tanggal_survei{{ $pesanan->id }}" value="{{ $pesanan->tanggal_survei }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_selesai{{ $pesanan->id }}" class="form-label">Tenggat Pengerjaan</label>
                        <input type="date" name="tanggal_selesai" class="form-control"
                            id="tanggal_selesai{{ $pesanan->id }}" value="{{ $pesanan->tanggal_selesai }}" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
