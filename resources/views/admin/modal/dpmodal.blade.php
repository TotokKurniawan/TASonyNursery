<!-- Modal untuk melihat bukti pembayaran -->
<div class="modal fade" id="lihatbukti{{ $pesanan->id }}" tabindex="-1"
    aria-labelledby="lihatBuktiLabel{{ $pesanan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white rounded-xl shadow-2xl">

            <!-- Modal Header -->
            <div class="modal-header bg-gradient-to-r from-blue-500 to-teal-500 text-white rounded-t-xl p-6">
                <h5 class="modal-title text-2xl font-semibold" id="lihatBuktiLabel{{ $pesanan->id }}">Bukti Pembayaran
                </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-6">
                <!-- Menampilkan gambar bukti pembayaran -->
                @if ($pesanan->bukti_dp)
                    <img src="{{ asset('storage/' . $pesanan->bukti_dp) }}" alt="Bukti Pembayaran"
                        class="max-w-30 max-h-96 object-contain mx-auto rounded-lg" style="width: 100%">
                @else
                    <p class="text-center text-gray-600">Bukti pembayaran belum diunggah.</p>
                @endif
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
