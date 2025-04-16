@extends('layoutadmin.app')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Pesanan</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Pesanan</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-5 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Type here...</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <ul class="navbar-nav pe-md-3">
                    <!-- Tambahkan Profile Icon di sini -->
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('profile') }}" class="nav-link text-body font-weight-bold px-2">
                            <i class="fas fa-user-circle me-sm-1"></i>
                            <span class="d-sm-inline d-none">Profile</span>
                        </a>
                    </li>
                    <!-- Ikon Logout -->
                    <li class="nav-item d-flex align-items-center">
                        <a href="javascript:void(0);" class="nav-link text-body font-weight-bold px-2" id="logout-link">
                            <i class="fa fa-sign-out me-sm-1"></i>
                            <span class="d-sm-inline d-none">Logout</span>
                        </a>
                    </li>
                    <script>
                        document.getElementById('logout-link').addEventListener('click', function(event) {
                            event.preventDefault(); // Mencegah tindakan default link

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You will be logged out.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, logout',
                                cancelButtonText: 'No, cancel',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        '{{ route('home') }}'; // Arahkan ke route logout jika konfirmasi diterima
                                }
                            });
                        });
                    </script>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Table Pesanan</h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                                <!-- Search Input -->
                                <div class="input-group" style="width: 40%; max-width: 240px; margin-left: 10px">
                                    <input type="text" class="form-control bg-white" id="searchInput"
                                        placeholder="Cari berdasarkan nama pelanggan" />
                                    <span class="input-group-text text-secondary" style="margin-top: 3px"><i
                                            class="fas fa-search"></i></span>
                                </div>

                                <!-- Status Filter -->
                                <select id="statusFilter" class="form-select w-auto" onchange="filterTable()"
                                    style="margin-right: 3px">
                                    <option value="">Semua Status</option>
                                    <option value="in progress">In Progress</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                            <table class="table align-items-center mb-0" id="statusTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Budget</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Bunga</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            alamat</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status Pesanan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Metode Pembayaran</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Foto Lokasi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Foto Desain</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody id="orderTableBody" class="align-middle text-xxs font-weight-bolder text-center">
                                    @foreach ($pesanans as $pesanan)
                                        <tr data-status="{{ $pesanan->status }}">
                                            <td>
                                                <div class="d-flex px-2 py-1 text-center">
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">{{ $pesanan->pelanggan->nama }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $pesanan->pelanggan->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp{{ number_format($pesanan->budget, 0, ',', '.') }}</td>
                                            <td class="align-middle text-center">{{ $pesanan->request_bunga }}</td>
                                            <td class="align-middle text-center">{{ $pesanan->pelanggan->alamat }}</td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="badge
                                                    @if ($pesanan->status == 'in progress') bg-warning
                                                    @elseif($pesanan->status == 'pending') bg-primary
                                                    @elseif($pesanan->status == 'completed') bg-success
                                                    @elseif($pesanan->status == 'canceled') bg-danger
                                                    @else bg-secondary @endif">
                                                    {{ ucfirst($pesanan->status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">{{ $pesanan->metode_pembayaran }}</td>
                                            <td class="align-middle text-center">
                                                @if ($pesanan->foto_lokasi)
                                                    <img src="{{ asset('storage/' . $pesanan->foto_lokasi) }}"
                                                        alt="Foto Lokasi" class="img-fluid" style="max-height: 100px;">
                                                @else
                                                    <span class="text-secondary">Tidak Ada</span>
                                                @endif
                                            </td>
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
                                                    @elseif ($pesanan->metode_pembayaran == 'cash')
                                                        <!-- Tidak ada tombol jika metode pembayaran adalah cash -->
                                                    @else
                                                        <!-- Tombol Pilih Metode Pembayaran jika belum memilih metode pembayaran -->
                                                        <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal"
                                                            data-bs-target="#metodePembayaranModal{{ $pesanan->id }}">
                                                            <i class="fas fa-credit-card"></i> Pilih Metode Pembayaran
                                                        </button>
                                                    @endif

                                                    <form action="{{ route('selesaiadmin', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-check-circle"></i> Selesai
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#editPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    <!-- Modal Edit Pesanan -->
                                                    <div class="modal fade" id="editPesananModal{{ $pesanan->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="editPesananLabel{{ $pesanan->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <form action="{{ route('pesanan.update', $pesanan->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('patch')

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editPesananLabel{{ $pesanan->id }}">Edit
                                                                            Pesanan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Tutup"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="budget{{ $pesanan->id }}"
                                                                                class="form-label">Budget</label>
                                                                            <input type="text" name="budget"
                                                                                class="form-control"
                                                                                id="budget{{ $pesanan->id }}"
                                                                                value="{{ $pesanan->budget }}" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label
                                                                                for="waktuPengerjaan{{ $pesanan->id }}"
                                                                                class="form-label">Waktu Pengerjaan
                                                                                (hari)
                                                                            </label>
                                                                            <input type="text" name="waktu_pengerjaan"
                                                                                class="form-control"
                                                                                id="waktuPengerjaan{{ $pesanan->id }}"
                                                                                value="{{ $pesanan->waktu_pengerjaan }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label
                                                                                for="tanggalPengerjaan{{ $pesanan->id }}"
                                                                                class="form-label">Tanggal
                                                                                Pengerjaan</label>
                                                                            <input type="date"
                                                                                name="tanggal_pengerjaan"
                                                                                class="form-control"
                                                                                id="tanggalPengerjaan{{ $pesanan->id }}"
                                                                                value="{{ $pesanan->tanggal_pengerjaan }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label
                                                                                for="statusPembayaran{{ $pesanan->id }}"
                                                                                class="form-label">Status
                                                                                Pembayaran</label>
                                                                            <select name="status_pembayaran"
                                                                                id="statusPembayaran{{ $pesanan->id }}"
                                                                                class="form-select" required>
                                                                                <option value="belum"
                                                                                    {{ $pesanan->status_pembayaran == 'belum lunas' ? 'selected' : '' }}>
                                                                                    Belum lunas</option>
                                                                                <option value="dp"
                                                                                    {{ $pesanan->status_pembayaran == 'dp' ? 'selected' : '' }}>
                                                                                    DP</option>
                                                                                <option value="lunas"
                                                                                    {{ $pesanan->status_pembayaran == 'lunas' ? 'selected' : '' }}>
                                                                                    Lunas</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan
                                                                            Perubahan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <button class="btn btn-sm btn-success mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#cetakPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-check-circle"></i> Detail
                                                    </button>

                                                    <div class="modal fade" id="metodePembayaranModal{{ $pesanan->id }}"
                                                        tabindex="-1" aria-labelledby="metodePembayaranModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="metodePembayaranModalLabel">Pilih Pembayaran
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('updateMetodePembayaran', $pesanan->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <div class="mb-3">
                                                                            <label for="metode_pembayaran"
                                                                                class="form-label">Metode
                                                                                Pembayaran</label>
                                                                            <select class="form-select"
                                                                                id="metode_pembayaran"
                                                                                name="metode_pembayaran" required>
                                                                                <option value="bank_transfer"
                                                                                    {{ $pesanan->metode_pembayaran == 'bank_transfer' ? 'selected' : '' }}>
                                                                                    Transfer Bank</option>
                                                                                <option value="cash"
                                                                                    {{ $pesanan->metode_pembayaran == 'cash' ? 'selected' : '' }}>
                                                                                    Cash</option>
                                                                            </select>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Cetak Pesanan -->
                                                    <div class="modal fade" id="cetakPesananModal{{ $pesanan->id }}"
                                                        tabindex="-1" aria-labelledby="cetakPesananModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content shadow-lg overflow-hidden">
                                                                <div class="modal-header text-white">
                                                                    <h5 class="modal-title" id="cetakPesananModalLabel">
                                                                        <i class="fas fa-file-invoice"></i> Detail Pesanan
                                                                        #
                                                                        {{ $pesanan->pelanggan->nama }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close text-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body mt-sm-0
                                                                                            <div class="card
                                                                    p-3 border-0 shadow-sm">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <!-- Foto Desain -->
                                                                            <div class="col-md-6">
                                                                                <div class="card shadow-sm border-0">
                                                                                    <div class="card-body text-center">
                                                                                        <h6 class="text-muted">Desain Taman
                                                                                        </h6>
                                                                                        <img src="{{ asset('storage/' . ($pesanan->desain->foto ?? 'default-design.jpg')) }}"
                                                                                            alt="Foto Desain"
                                                                                            class="img-fluid rounded shadow-sm"
                                                                                            style="width: 100%; aspect-ratio: 4/3; object-fit: cover;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Foto Lokasi -->
                                                                            <div class="col-md-6">
                                                                                <div class="card shadow-sm border-0">
                                                                                    <div class="card-body text-center">
                                                                                        <h6 class="text-muted">Lokasi
                                                                                            Pemasangan</h6>
                                                                                        <img src="{{ asset('storage/' . $pesanan->foto_lokasi) }}"
                                                                                            alt="Foto Lokasi"
                                                                                            class="img-fluid rounded shadow-sm"
                                                                                            style="width: 100%; aspect-ratio: 4/3; object-fit: cover;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <hr>

                                                                        <!-- Detail Pesanan -->
                                                                        <p><strong>Budget:</strong>
                                                                            Rp{{ number_format($pesanan->budget, 0, ',', '.') }}
                                                                        </p>
                                                                        <p><strong>no telepon:</strong>
                                                                            {{ $pesanan->pelanggan->telepon }}</p>
                                                                        <p><strong>waktu pengerjaan:</strong>
                                                                            {{ $pesanan->waktu_pengerjaan }}</p>
                                                                        <p><strong>tanggal pengerjaan:</strong>
                                                                            {{ $pesanan->tanggal_pengerjaan }}
                                                                        </p>
                                                                        <p><strong>Status Pembayaran</strong>:
                                                                            <span
                                                                                class="badge
                                                                                @if ($pesanan->status_pembayaran == 'dp') bg-warning
                                                                                @elseif($pesanan->status_pembayaran == 'belum lunas') bg-primary
                                                                                @elseif($pesanan->status_pembayaran == 'lunas') bg-success
                                                                                @else bg-secondary @endif">
                                                                                {{ ucfirst($pesanan->status_pembayaran) }}
                                                                            </span>
                                                                        </p>

                                                                        <p><strong>Nominal DP</strong>
                                                                            {{ $pesanan->nominal_dp }}</p>
                                                                        <p><strong>Keterangan tambahan:</strong>
                                                                            {{ $pesanan->keterangan_tambahan }}</p>
                                                                        <p><strong>Request Bunga:</strong>
                                                                            {{ $pesanan->request_bunga }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($pesanan->status == 'negosiasi')
                                                    <form action="{{ route('terimaadmin', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-check-circle"></i> Terima
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-danger mt-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#tolakModal{{ $pesanan->id }}">
                                                        <i class="fas fa-trash-alt"></i> Tolak
                                                    </button>
                                                @elseif ($pesanan->status == 'pending')
                                                    <!-- Tombol trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-danger mt-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#tolakModal{{ $pesanan->id }}">
                                                        <i class="fas fa-trash-alt"></i> Tolak
                                                    </button>
                                                    <button class="btn btn-sm btn-success mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#cetakPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-check-circle"></i> Detail
                                                    </button>

                                                    <form action="{{ route('terimaadmin', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-check-circle"></i> Terima
                                                        </button>
                                                    </form>
                                                    <!-- Tombol trigger modal negosiasi -->
                                                    <button type="button" class="btn btn-sm btn-warning mt-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#negosiasiModal{{ $pesanan->id }}">
                                                        <i class="fas fa-comments"></i> Negosiasi
                                                    </button>

                                                    <!-- Modal Negosiasi -->
                                                    <div class="modal fade" id="negosiasiModal{{ $pesanan->id }}"
                                                        tabindex="-1" aria-labelledby="negosiasiModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route('pesanan.negosiasi', $pesanan->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Keterangan Negosiasi</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="keterangan_banding"
                                                                                class="form-label">Masukkan keterangan
                                                                                negosiasi:</label>
                                                                            <textarea class="form-control" name="keterangan_banding" rows="3" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-warning">Kirim
                                                                            Negosiasi</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Cetak Pesanan -->
                                                    <div class="modal fade" id="cetakPesananModal{{ $pesanan->id }}"
                                                        tabindex="-1" aria-labelledby="cetakPesananModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content shadow-lg overflow-hidden">
                                                                <div class="modal-header text-white">
                                                                    <h5 class="modal-title" id="cetakPesananModalLabel">
                                                                        <i class="fas fa-file-invoice"></i> Detail Pesanan
                                                                        #{{ $pesanan->pelanggan->nama }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close text-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Tabel untuk Detail Pesanan -->
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="2" class="text-center">
                                                                                    Detail Pesanan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            {{-- <tr>
                                                                                <td><strong>Desain Taman:</strong></td>
                                                                                <td>
                                                                                    <img src="{{ asset('storage/' . ($pesanan->desain->foto ?? 'default-design.jpg')) }}"
                                                                                        alt="Foto Desain"
                                                                                        class="img-fluid rounded shadow-sm"
                                                                                        style="width: 100px; height: auto;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Lokasi Pemasangan:</strong></td>
                                                                                <td>
                                                                                    <img src="{{ asset('storage/' . $pesanan->foto_lokasi) }}"
                                                                                        alt="Foto Lokasi"
                                                                                        class="img-fluid rounded shadow-sm"
                                                                                        style="width: 100px; height: auto;">
                                                                                </td>
                                                                            </tr> --}}
                                                                            <tr>
                                                                                <td><strong>Budget:</strong></td>
                                                                                <td>Rp{{ number_format($pesanan->budget, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>No Telepon:</strong></td>
                                                                                <td>{{ $pesanan->pelanggan->telepon }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Waktu Pengerjaan:</strong></td>
                                                                                <td>{{ $pesanan->waktu_pengerjaan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Tanggal Pengerjaan:</strong>
                                                                                </td>
                                                                                <td>{{ $pesanan->tanggal_pengerjaan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Status Pembayaran:</strong></td>
                                                                                <td>
                                                                                    <span
                                                                                        class="badge @if ($pesanan->status_pembayaran == 'dp') bg-warning @elseif($pesanan->status_pembayaran == 'belum lunas') bg-primary @elseif($pesanan->status_pembayaran == 'lunas') bg-success @else bg-secondary @endif">
                                                                                        {{ ucfirst($pesanan->status_pembayaran) }}
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Nominal DP:</strong></td>
                                                                                <td>Rp{{ number_format($pesanan->nominal_dp, 0, ',', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Keterangan Tambahan:</strong>
                                                                                </td>
                                                                                <td>{{ $pesanan->keterangan_tambahan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Request Bunga:</strong></td>
                                                                                <td>{{ $pesanan->request_bunga }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Modal Tolak -->
                                                    <div class="modal fade" id="tolakModal{{ $pesanan->id }}"
                                                        tabindex="-1" aria-labelledby="tolakModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route('tolakadmin', $pesanan->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Alasan Penolakan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Tutup"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="keterangan_tolak"
                                                                                class="form-label">Masukkan alasan
                                                                                penolakan:</label>
                                                                            <textarea class="form-control" name="keterangan_tolak" rows="3" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Tolak Pesanan</button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-4 text-black">
                                <ul class="pagination">
                                    <li class="page-item {{ $pesanans->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $pesanans->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    @foreach ($pesanans->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $page == $pesanans->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item {{ $pesanans->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $pesanans->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('statusFilter').addEventListener('change', function() {
            const selectedStatus = this.value;
            const rows = document.querySelectorAll('#statusTable tbody tr');

            rows.forEach(row => {
                if (selectedStatus === '' || row.dataset.status === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        document.getElementById("searchInput").addEventListener("input", function() {
            const searchValue = this.value.toLowerCase(); // Nilai input pencarian dalam huruf kecil
            const tableRows = document.querySelectorAll("#orderTableBody tr"); // Semua baris di tabel

            tableRows.forEach(row => {
                const namaPelanggan = row.querySelector("td:nth-child(2) h6").textContent
                    .toLowerCase(); // Ambil nama pelanggan
                if (namaPelanggan.includes(searchValue)) {
                    row.style.display = ""; // Tampilkan baris jika cocok
                } else {
                    row.style.display = "none"; // Sembunyikan baris jika tidak cocok
                }
            });
        });
    </script>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formatRupiah = (angka, prefix = 'Rp.') => {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix + rupiah;
        }

        document.querySelectorAll('input[name="budget"]').forEach(function(el) {
            el.addEventListener('keyup', function(e) {
                // Remove prefix 'Rp.' and format again
                this.value = formatRupiah(this.value.replace(/^Rp\.\s?/, ''), 'Rp.');
            });
        });
    });
</script>
