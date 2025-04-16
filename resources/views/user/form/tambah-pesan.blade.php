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
                                    Isi Identitas dan pesanan Anda.
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
                            <h6 class="text-black text-capitalize ps-3">Pilih Data Pelanggan</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <!-- Pilih pelanggan yang sudah ada -->
                        <form action="{{ route('lanjut.pesan') }}" method="GET" class="mb-4">
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">Pilih Pelanggan</label>
                                <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                                    <option value="">-- Pilih pelanggan --</option>
                                    @foreach ($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }} -
                                            {{ $pelanggan->telepon }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Lanjutkan</button>
                        </form>

                        <hr>

                        <!-- Form pelanggan baru -->
                        <div class="card mt-4">
                            <div class="card-header bg-secondary text-white">
                                <h6 class="mb-0">Atau Buat Data Pelanggan Baru</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('storeuser') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Masukkan nama pelanggan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" id="telepon" name="telepon"
                                            placeholder="Masukkan nomor telepon pelanggan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Masukkan alamat pelanggan" required>
                                    </div>
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                    <button type="submit" id="submitBtn" class="btn btn-primary" disabled>Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <script>
            function showExistingForm() {
                document.getElementById('existingForm').style.display = 'block';
                document.getElementById('newForm').style.display = 'none';
            }

            function showNewForm() {
                document.getElementById('newForm').style.display = 'block';
                document.getElementById('existingForm').style.display = 'none';
            }

            function getUserLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;

                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;

                        // Aktifkan tombol submit setelah lokasi didapat
                        document.getElementById('submitBtn').disabled = false;

                        // (opsional) Inisialisasi peta
                        var map = L.map('map').setView([latitude, longitude], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 18,
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup("Lokasi Anda: " + latitude + ", " + longitude)
                            .openPopup();

                    }, function(error) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Akses Lokasi Diperlukan!',
                            text: 'Silakan aktifkan lokasi untuk melanjutkan.',
                            confirmButtonText: 'OK'
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Akses Lokasi Diperlukan!',
                        text: 'Browser tidak mendukung Geolocation.',
                        confirmButtonText: 'OK'
                    });
                }
            }

            window.onload = getUserLocation;

            document.getElementById('newForm').addEventListener('focus', getUserLocation);
        </script>



    </main>
@endsection
