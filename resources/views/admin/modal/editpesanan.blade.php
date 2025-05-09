  <!-- Modal Edit Pesanan -->
  <div class="modal fade" id="editPesananModal{{ $pesanan->id }}" tabindex="-1"
      aria-labelledby="editPesananLabel{{ $pesanan->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                  @csrf
                  @method('patch')

                  <div class="modal-header">
                      <h5 class="modal-title" id="editPesananLabel{{ $pesanan->id }}">Edit
                          Pesanan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                  </div>

                  <div class="modal-body">
                      <div class="mb-3">
                          <label for="budget{{ $pesanan->id }}" class="form-label">Budget</label>
                          <input type="text" name="budget" class="form-control" id="budget{{ $pesanan->id }}"
                              value="{{ $pesanan->budget }}" required>
                      </div>


                      <div class="mb-3">
                          <label for="tanggal_survei{{ $pesanan->id }}" class="form-label">Tanggal
                              Pengerjaan</label>
                          <input type="date" name="tanggal_survei" class="form-control"
                              id="tanggal_survei{{ $pesanan->id }}" value="{{ $pesanan->tanggal_survei }}" required>
                      </div>

                      <div class="mb-3">
                          <label for="tenggatSelesai{{ $pesanan->id }}" class="form-label">Tenggat
                              Pengerjaan</label>
                          <input type="date" name="tanggal_selesai" class="form-control"
                              id="tanggal_selesai{{ $pesanan->id }}" value="{{ $pesanan->tanggal_selesai }}"
                              required>
                      </div>


                      <div class="mb-3">
                          <label for="statusPembayaran{{ $pesanan->id }}" class="form-label">Status
                              Pembayaran</label>
                          <select name="status_pembayaran" id="statusPembayaran{{ $pesanan->id }}" class="form-select"
                              required>
                              <option value="belum"
                                  {{ $pesanan->status_pembayaran == 'belum lunas' ? 'selected' : '' }}>
                                  Belum lunas</option>
                              <option value="dp" {{ $pesanan->status_pembayaran == 'dp' ? 'selected' : '' }}>
                                  DP</option>
                              <option value="lunas" {{ $pesanan->status_pembayaran == 'lunas' ? 'selected' : '' }}>
                                  Lunas</option>
                              <option value="dp lunas"
                                  {{ $pesanan->status_pembayaran == 'dp lunas' ? 'selected' : '' }}>
                                  dp Lunas</option>
                          </select>
                      </div>
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan
                          Perubahan</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
