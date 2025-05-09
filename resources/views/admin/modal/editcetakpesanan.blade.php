<!-- Modal Cetak Pesanan -->
<div class="modal fade" id="cetakPesananModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="cetakPesananModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg overflow-hidden">
            <div class="modal-header text-white bg-primary">
                <h5 class="modal-title" id="cetakPesananModalLabel"style="color: white">
                    <i class="fas fa-file-invoice"></i> Detail Pesanan -
                    {{ $pesanan->pelanggan->nama }}
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-0">
                <div class="card p-3 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <!-- Foto Desain -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted">Desain Taman</h6>
                                        <img src="{{ asset('storage/' . ($pesanan->desain->foto ?? 'default-design.jpg')) }}"
                                            alt="Foto Desain" class="img-fluid rounded shadow-sm"
                                            style="width: 100%; aspect-ratio: 4/3; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Lokasi -->
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted">Lokasi Pemasangan</h6>
                                        <img src="{{ asset('storage/' . $pesanan->foto_lokasi) }}" alt="Foto Lokasi"
                                            class="img-fluid rounded shadow-sm"
                                            style="width: 100%; aspect-ratio: 4/3; object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Detail Pesanan -->
                        <p><strong>Alamat:</strong> {{ $pesanan->pelanggan->alamat }}</p>
                        <p><strong>No Telepon:</strong> {{ $pesanan->pelanggan->telepon }}</p>
                        <p><strong>Tanggal Dikerjakan / survei:</strong> {{ $pesanan->tanggal_survei }}</p>
                        <p><strong>Tenggat Pengerjaan:</strong> {{ $pesanan->tanggal_selesai }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ $pesanan->metode_pembayaran }}</p>
                        <p><strong>Keterangan Tambahan:</strong> {{ $pesanan->keterangan_tambahan }}</p>
                        <p><strong>Request Bunga:</strong> {{ $pesanan->request_bunga }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
