<!-- Modal -->
<div class="modal fade" id="dpModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="dpModalLabel{{ $pesanan->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white rounded-xl shadow-2xl transform transition-all duration-300 ease-in-out">

            <!-- Header -->
            <div class="modal-header bg-gradient-to-r from-blue-500 to-teal-500 text-white rounded-t-xl p-6">
                <h5 class="modal-title text-2xl font-semibold" id="dpModalLabel{{ $pesanan->id }}">
                    Informasi Bank & Bukti Pembayaran</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-6 space-y-6">
                <!-- Informasi Bank -->
                <div class="alert alert-info bg-blue-100 border border-blue-300 text-blue-800 p-4 rounded-lg">
                    <p class="text-lg">Silahkan transfer DP ke nomor rekening berikut:</p>
                    <strong class="font-semibold">Bank BCA</strong><br>
                    No. Rekening: <strong>0390769393</strong><br>
                    Atas Nama: <strong>LILIK HARTINI</strong>
                </div>

                <!-- Divider -->
                <hr class="border-gray-300">

                <!-- Form Upload Bukti -->
                <form action="{{ route('upload.bukti', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="buktiBayar" class="block text-sm font-medium text-gray-700">Upload Bukti
                            Pembayaran</label>
                        <input type="file"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-md hover:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="buktiBayar" name="bukti_pembayaran" required>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-between items-center">
                        <button type="button"
                            class="btn btn-outline-secondary text-gray-600 hover:bg-gray-200 px-6 py-2 rounded-md"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary bg-gradient-to-r from-blue-600 to-teal-500 text-white hover:bg-gradient-to-l hover:from-teal-500 hover:to-blue-600 px-6 py-2 rounded-md">Kirim
                            Bukti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
