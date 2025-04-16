@extends('layoutuser.app')
@section('content')
    @php
        $adaNegosiasi = $pesanans->contains('status', 'negosiasi');
    @endphp

    <main id="main">
        <!-- ======= Features Section ======= -->
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
                                    Pesanan Saya
                                </h1>
                                <p class="mb-5" data-aos="fade-up" data-aos-delay="100">
                                    Kami Melayani Dengan Sepenuh Hati.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section pb-0" style="background:white ">
            <div class="container">
                <h2 class="mb-10 text-center">Informasi Pesanan Saya</h2>
                <br>
                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-end">
                        <!-- Filter Dropdown -->
                        <select id="statusFilter" class="form-select w-auto" onchange="filterTable()">
                            <option value="all">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="in progress">Proses</option>
                            <option value="completed">Selesai</option>
                            <option value="canceled">Dibatalkan</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="background: #f8f9fa">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped table-hover align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Budget</th>
                                    <th class="text-center">Bunga</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Metode Pembayaran</th>
                                    <th class="text-center">status Pembayaran</th>
                                    <th class="text-center">Nominal DP</th>

                                    @if ($adaNegosiasi)
                                        <th class="text-center">Negosiasi</th>
                                    @endif

                                    <th class="text-center">Foto Lokasi</th>
                                    <th class="text-center">Foto Desain</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody id="orderTableBody" class="align-middle text-center">
                                @foreach ($pesanans as $pesanan)
                                    <tr data-status="{{ $pesanan->status }}">
                                        <!-- Nama -->
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0">{{ $pesanan->pelanggan->nama }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $pesanan->pelanggan->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Budget -->
                                        <td>{{ 'Rp ' . number_format($pesanan->budget, 0, ',', '.') }}</td>

                                        <!-- Bunga -->
                                        <td class="align-middle text-center">{{ $pesanan->request_bunga }}</td>

                                        <!-- Status -->
                                        <td class="align-middle text-center">
                                            <span
                                                class="badge
                                                @if ($pesanan->status == 'proses') bg-warning
                                                @elseif($pesanan->status == 'pending') bg-primary
                                                @elseif($pesanan->status == 'completed') bg-success
                                                @elseif($pesanan->status == 'canceled') bg-danger
                                                @else bg-secondary @endif">
                                                {{ ucfirst($pesanan->status) }}
                                            </span>
                                        </td>

                                        <td class="align-middle text-center">{{ $pesanan->pelanggan->alamat }}</td>
                                        <td class="align-middle text-center">{{ $pesanan->metode_pembayaran }}</td>
                                        <td class="align-middle text-center">{{ $pesanan->status_pembayaran }}</td>
                                        <td class="align-middle text-center">{{ $pesanan->nominal_dp }}</td>
                                        @if ($adaNegosiasi)
                                            <td class="align-middle text-center">
                                                @if ($pesanan->status == 'negosiasi')
                                                    {{ $pesanan->keterangan_banding }}
                                                @else
                                                    {{-- Biar cell-nya tetap rapi --}}
                                                    &nbsp;
                                                @endif
                                            </td>
                                        @endif

                                        <!-- Foto Lokasi -->
                                        <td class="align-middle text-center">
                                            @if ($pesanan->foto_lokasi)
                                                <!-- Menampilkan Foto Lokasi jika ada -->
                                                <img src="{{ asset('storage/' . $pesanan->foto_lokasi) }}"
                                                    alt="Foto Lokasi" class="img-fluid" style="max-height: 100px;">
                                            @else
                                                <span class="text-secondary">Tidak Ada</span>
                                            @endif
                                        </td>

                                        <!-- Foto Desain -->
                                        <td class="align-middle text-center">
                                            @if ($pesanan->desain && $pesanan->desain->foto)
                                                <!-- Jika desain dipilih dari tabel desain -->
                                                <img src="{{ asset('storage/' . $pesanan->desain->foto) }}"
                                                    alt="Foto Desain" class="img-fluid" style="max-height: 100px;">
                                            @elseif ($pesanan->foto_desain)
                                                <!-- Jika foto desain diunggah langsung -->
                                                <img src="{{ asset('storage/' . $pesanan->foto_desain) }}"
                                                    alt="Foto Desain" class="img-fluid" style="max-height: 100px;">
                                            @else
                                                <span class="text-secondary">Tidak Ada</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center">
                                            @if ($pesanan->status == 'canceled' || $pesanan->status == 'completed')
                                                <span class="text-success">Pesanan Selesai</span>
                                            @elseif ($pesanan->status == 'in progress')
                                                @if ($pesanan->metode_pembayaran == 'bank_transfer')
                                                    <button class="btn btn-sm btn-warning mt-2 initiate-payment"
                                                        data-id="{{ $pesanan->id }}">
                                                        <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                                                    </button>
                                                    <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#detailPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                @elseif ($pesanan->metode_pembayaran == 'cash')
                                                @else
                                                    <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#metodePembayaranModal{{ $pesanan->id }}">
                                                        <i class="fas fa-credit-card"></i> Pilih Metode Pembayaran
                                                    </button>
                                                    <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#detailPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                @endif
                                            @elseif ($pesanan->status == 'negosiasi')
                                                {{-- Tombol Bayar DP jika status pembayaran adalah DP --}}
                                                @if ($pesanan->status_pembayaran == 'dp')
                                                    <form action="{{ route('terimaadmin', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-check-circle"></i> Terima
                                                        </button>
                                                    </form>
                                                @elseif ($pesanan->status_pembayaran == 'belum lunas')
                                                    {{-- Tombol Terima jika status pembayaran belum lunas --}}
                                                    <form action="{{ route('terimaadmin', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-check-circle"></i> Terima
                                                        </button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('pesanan.tolak', $pesanan->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-sm btn-danger mt-2" type="submit">
                                                        <i class="fas fa-trash-alt"></i> Tolak
                                                    </button>
                                                </form>
                                                <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                    data-bs-target="#detailPesananModal{{ $pesanan->id }}">
                                                    <i class="fas fa-info-circle"></i> Detail
                                                </button>

                                                {{-- AAA --}}
                                            @elseif ($pesanan->status == 'pending')
                                                <form action="{{ route('tolakadmin', $pesanan->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-sm btn-danger mt-2" type="submit">
                                                        <i class="fas fa-trash-alt"></i> Tolak
                                                    </button>
                                                </form>
                                                <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                    data-bs-target="#detailPesananModal{{ $pesanan->id }}">
                                                    <i class="fas fa-info-circle"></i> Detail
                                                </button>
                                                {{-- AAA --}}
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </section>

        @foreach ($pesanans as $pesanan)
            <div class="modal fade" id="metodePembayaranModal{{ $pesanan->id }}" tabindex="-1"
                aria-labelledby="metodePembayaranModalLabel{{ $pesanan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="metodePembayaranModalLabel{{ $pesanan->id }}">Pilih Metode
                                Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('updateMetodePembayaran', $pesanan->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="metode_pembayaran_{{ $pesanan->id }}" class="form-label">Metode
                                        Pembayaran</label>
                                    <select class="form-select" name="metode_pembayaran"
                                        id="metode_pembayaran_{{ $pesanan->id }}">
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="detailPesananModal{{ $pesanan->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailPesananLabel{{ $pesanan->id }}">Detail Pesanan
                                #{{ $pesanan->id }} {{ $pesanan->pelanggan->nama }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $pesanan->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <td>{{ $pesanan->pelanggan->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $pesanan->status }}</td>
                                </tr>
                                <tr>
                                    <th>Budget</th>
                                    <td>Rp.{{ number_format($pesanan->budget, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tgl Pengerjaan</th>
                                    <td>{{ $pesanan->tanggal_pengerjaan }}</td>
                                </tr>
                                <tr>
                                    <th>Estimasi Pengerjaan</th>
                                    <td>{{ $pesanan->waktu_pengerjaan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @include('layoutLanding.cta')
    </main>
    <script>
        function filterTable() {
            const filterValue = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#orderTableBody tr');

            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                if (filterValue === 'all' || status === filterValue) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.initiate-payment').forEach(button => {
                button.addEventListener('click', function() {
                    let orderId = this.getAttribute('data-id');

                    fetch(`/payment/initiate/${orderId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.token) {
                                snap.pay(data.token, {
                                    onSuccess: function(result) {
                                        console.log(
                                            "Pembayaran sukses, mengupdate status..."
                                        );

                                        fetch(`/payment/update-status/${orderId}`, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    status: 'completed',
                                                    status_pembayaran: 'lunas',
                                                    transaction_id: result
                                                        .transaction_id
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                console.log(
                                                    "Respon dari server:",
                                                    data);
                                                alert(
                                                    'Pembayaran berhasil! Status pesanan diperbarui.'
                                                );
                                                location.reload();
                                            })
                                            .catch(error => console.error(
                                                'Error saat update status:',
                                                error));
                                    },
                                    onPending: function(result) {
                                        console.log("Pembayaran pending:", result);
                                        alert(
                                            'Pembayaran masih dalam status pending.'
                                        );
                                    },
                                    onError: function(result) {
                                        console.log("Pembayaran gagal:", result);
                                        alert(
                                            'Pembayaran gagal! Silakan coba lagi.'
                                        );
                                    }
                                });
                            } else {
                                alert('Terjadi kesalahan dalam memproses pembayaran.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>


    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>

    @include('user.chat')
@endsection
