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
                                    Pilih desain yang menurut anda menarik.
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
                            <h6 class="text-black text-capitalize ps-3">Pilihlah Salah Satu Dari Desain Dari Kami</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <form action="{{ route('pesanan.store', ['id_pelanggan' => $pelanggan->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Pilihan Konsep Design -->
                            <div class="mb-3">
                                <label for="design_id" class="form-label">Pilih Konsep Design</label>

                                <div id="designCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($designs as $index => $design)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <div class="card mx-auto" style="max-width: 600px;">
                                                    <img src="{{ asset('storage/' . $design->foto) }}"
                                                        class="card-img-top design-img" alt="{{ $design->konsep }}">
                                                    <div class="card-body text-center">
                                                        <p class="card-text"><strong>Nama Konsep :</strong>
                                                            {{ $design->konsep }}</p>
                                                        <p class="card-text"><strong>Lahan yang dibutuhkan:</strong>
                                                            {{ $design->lahan }}</p>
                                                        <p class="card-text"><strong>Harga: </strong>
                                                            Rp.{{ $design->harga }}
                                                        </p>

                                                        <!-- Radio Button dengan data-harga dan data-lahan -->
                                                        <input type="radio" name="design_id" value="{{ $design->id }}"
                                                            data-harga="{{ $design->harga }}"
                                                            data-lahan="{{ $design->lahan }}"
                                                            onchange="updateFormFields(this)" required>
                                                        <label class="form-label">Pilih {{ $design->konsep }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Carousel Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#designCarousel"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-dark rounded-circle"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Sebelumnya</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#designCarousel"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-dark rounded-circle"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Selanjutnya</span>
                                    </button>
                                </div>
                            </div>

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
                                <label for="waktu_pengerjaan" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    placeholder="Masukkan waktu pengerjaan" required>
                            </div>

                            <div class="mb-3">
                                <label for="pembayaran" class="form-label">Pembayaran</label>
                                <select class="form-select" id="status_pembayaran" name="status_pembayaran" required
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
                                <label for="request_bunga" class="form-label">Request Bunga</label>
                                <textarea class="form-control" id="request_bunga" name="request_bunga" rows="10"
                                    placeholder="Masukkan request bunga" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan_tambahan" class="form-label">Keterangan tambahan</label>
                                <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="10"
                                    placeholder="Masukkan keterangan tambahan untuk taman Anda" required></textarea>
                            </div>

                            <!-- Input Foto Lokasi -->
                            <div class="mb-3">
                                <label for="foto_lokasi" class="form-label">Foto Lokasi/Tempat</label>
                                <input type="file" class="form-control" id="foto_lokasi" name="foto_lokasi"
                                    accept="image/*" required>
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

                        <!-- Script Bagian Bawah -->
                        <script>
                            function toggleNominalDP(select) {
                                const nominalField = document.getElementById('nominalDPField');
                                nominalField.style.display = (select.value === 'dp') ? 'block' : 'none';
                            }

                            // Update spesifikasi lahan dan budget berdasarkan Harga dan Lahan yang dipilih
                            function updateFormFields(radio) {
                                const harga = radio.getAttribute('data-harga');
                                const lahan = radio.getAttribute('data-lahan');

                                // Update Budget dan Spesifikasi Lahan
                                document.getElementById('Budget').value = harga;
                                document.getElementById('spesifikasi_lahan').value = lahan;
                            }
                        </script>
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

<style>
    .card-text {
        font-size: 16px;
        /* Ukuran font lebih nyaman */
        font-weight: 500;
        /* Medium untuk tampilan lebih halus */
        color: #333;
        /* Warna yang lebih soft */
        margin-bottom: 5px;
        /* Jarak antar teks */
        text-align: left;
        /* Rata kiri agar lebih rapi */
    }

    .card-body {
        text-align: left;
        /* Menyesuaikan teks di dalam card */
        padding: 15px;
    }

    .design-img {
        width: 100%;
        height: 500px;
        object-fit: contain;
        border-radius: 5px;
        background-color: #f0f0f0;
    }
</style>
