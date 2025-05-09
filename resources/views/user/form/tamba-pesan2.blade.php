@extends('layoutuser.app')
@section('content')
    <main class="main " id="main">
        <section class="hero-section inner-page">
            <div class="wave">
                <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                            <path
                                d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z"
                                id="Path"></path>
                        </g>
                    </g>
                </svg>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <div class="col-md-7 text-center hero-text">
                                <h1 data-aos="fade-up" data-aos-delay="">
                                    Tambah Pesanan
                                </h1>
                                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">
                                    Isi Pesanan Sesuai dengan desain anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section pb-9">
            <div class="container">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-black text-capitalize ps-3">Atur Request desain anda</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <form action="{{ route('pesanan.store2', ['id_pelanggan' => $pelanggan->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Input Spesifikasi Lahan -->
                            <div class="mb-3">
                                <label for="spesifikasi_lahan" class="form-label">Spesifikasi Lahan</label>
                                <input type="text" class="form-control" id="spesifikasi_lahan" name="spesifikasi_lahan"
                                    placeholder="Masukkan panjang dan lebar lahan" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pengerjaan" class="form-label">Dikerjakan tanggal / Tanggal Untuk
                                    Survei</label>
                                <input type="date" class="form-control" id="tanggal_survei" name="tanggal_survei"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_pengerjaan" class="form-label">Harus selesai Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    placeholder="Masukkan waktu selesai" required>
                            </div>
                            <div class="mb-3">
                                <label for="pembayaran" class="form-label">Pembayaran</label>
                                <select class="form-select" id="pembayaran" name="pembayaran" required
                                    onchange="toggleNominalDP(this)">
                                    <option value="">-- Pilih Jenis Pembayaran --</option>
                                    <option value="dp">DP</option>
                                    <option value="belum lunas">Tidak</option>
                                </select>
                            </div>

                            <!-- Input Nominal DP (disembunyikan secara default) -->
                            <div class="mb-3" id="nominalDPField" style="display: none;">
                                <label for="nominal_dp_display" class="form-label">Nominal DP</label>

                                <!-- Input untuk tampilan (diformat sebagai rupiah) -->
                                <input type="text" class="form-control" id="nominal_dp_display"
                                    placeholder="Masukkan nominal DP">

                                <!-- Input tersembunyi untuk dikirim ke backend -->
                                <input type="hidden" id="nominal_dp" name="nominal_dp">
                            </div>



                            <!-- Input Request Bunga -->
                            <div class="mb-3">
                                <label for="request_bunga" class="form-label">Request Bunga (Bunga yang Digunakan)</label>
                                <textarea class="form-control" id="request_bunga" name="request_bunga" rows="10"
                                    placeholder="Masukkan request bunga" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan_tambahan" class="form-label">Keterangan tambahan</label>
                                <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="10"
                                    placeholder="Masukkan keterangan tambahan yang digunakan untuk taman anda" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto_lokasi" class="form-label">Foto Lokasi/Tempat</label>
                                <input type="file" class="form-control" id="foto_lokasi" name="foto_lokasi"
                                    accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="foto_design" class="form-label">Foto Design (Jika Ada)</label>
                                <input type="file" class="form-control" id="foto_design" name="foto_design"
                                    accept="image/*">
                            </div>

                            <!-- Input Budget -->
                            <div class="mb-3">
                                <label for="Budget" class="form-label">Budget</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control" id="Budget" name="Budget"
                                        placeholder="Masukkan Budget yang sama dengan konsep bila sesuai dengan keinginan anda"
                                        required>
                                </div>
                            </div>


                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>

                </div>
            </div>
        </section>

    </main>
    <script>
        const displayInput = document.getElementById('nominal_dp_display');
        const hiddenInput = document.getElementById('nominal_dp');

        // Format angka jadi rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        displayInput.addEventListener('input', function() {
            let rawValue = this.value.replace(/\D/g, ''); // Hapus semua karakter selain angka

            // Update hidden input (untuk disimpan)
            hiddenInput.value = rawValue;

            // Tampilkan kembali dalam format Rupiah
            if (rawValue) {
                this.value = formatRupiah(rawValue);
            } else {
                this.value = '';
            }
        });

        function toggleNominalDP(select) {
            const nominalField = document.getElementById('nominalDPField');
            if (select.value === 'dp') {
                nominalField.style.display = 'block';
            } else {
                nominalField.style.display = 'none';
            }
        }

        const budgetInput = document.getElementById('Budget');

        // Format Rupiah saat diketik
        budgetInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Hapus semua non-digit
            this.value = formatRupiah(value);
        });

        // Format fungsi
        function formatRupiah(angka) {
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Sebelum form disubmit, hapus format dan kirim angka saja
        const form = budgetInput.closest('form');
        form.addEventListener('submit', function() {
            const cleanValue = budgetInput.value.replace(/\./g, ''); // Hapus titik
            budgetInput.value = cleanValue; // Simpan hanya angka ke database
        });
    </script>
@endsection
