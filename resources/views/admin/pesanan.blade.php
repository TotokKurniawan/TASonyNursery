@extends('layoutadmin.app')
@section('content')
    @php
        $adaNegosiasi = $pesanans->contains('status', 'negosiasi');
    @endphp
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
                                    <optgroup label="In Progress">
                                        <option value="in progress (bayar dp)">In Progress (Bayar DP)</option>
                                        <option value="in progress (pembuatan taman)">In Progress (Pembuatan Taman)</option>
                                        <option value="in progress (penyelesaian akhir)">In Progress (Penyelesaian Akhir)
                                        </option>
                                    </optgroup>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                            <table class="table align-items-center mb-0" id="statusTable">
                                <thead>
                                    <tr>
                                        <th class="text-center w-12">No</th>
                                        <th class="text-center w-30">Nama</th>
                                        <th class="text-center w-30">Budget / Sisa Bayar</th>
                                        <th class="text-center w-15">Status Pesanan</th>
                                        <th class="text-center w-20">Status Dp</th>
                                        <th class="text-center w-30">Nominal DP</th>
                                        @if ($adaNegosiasi)
                                            <th class="text-center">Negosiasi</th>
                                        @endif
                                        <th class="text-center w-40">Foto Lokasi</th>
                                        <th class="text-center w-40">Foto Desain</th>
                                        <th class="text-center w-15">Action</th>
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
                                            <td class="align-middle text-center">{{ $pesanan->status_pembayaran }}</td>
                                            <td class="align-middle text-center">
                                                {{ 'Rp ' . number_format($pesanan->nominal_dp, 0, ',', '.') }}</td>
                                            @if ($adaNegosiasi)
                                                <td class="align-middle text-center">
                                                    @if ($pesanan->status == 'negosiasi' && $pesanan->negosiasi->isNotEmpty())
                                                        {{ $pesanan->negosiasi->last()->pesan }}
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </td>
                                            @endif

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
                                                @if ($pesanan->status == 'canceled')
                                                    <span class="text-danger">{{ $pesanan->keterangan_tolak }} </span>
                                                @elseif ($pesanan->status == 'completed')
                                                    <span class="text-success">Pesanan Selesai</span>
                                                @elseif ($pesanan->status == 'pending')
                                                    <form action="{{ route('terimalunas', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-trash-alt"></i> Terima
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#negosiasiModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Negosiasi
                                                    </button>
                                                    <button class="btn btn-sm btn-danger mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#tolakModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Tolak
                                                    </button>
                                                    <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#cetakPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                @elseif ($pesanan->status == 'in progress (survei)')
                                                    <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#cetakPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                    <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#editPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Edit
                                                    </button>
                                                    @if ($pesanan->status_pembayaran == 'belum lunas')
                                                        <form action="{{ route('lanjutadmin', $pesanan->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                                <i class="fas fa-trash-alt"></i> Lanjut
                                                            </button>
                                                        </form>
                                                    @elseif ($pesanan->status_pembayaran == 'dp')
                                                        <form action="{{ route('terimaadmin', $pesanan->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                                <i class="fas fa-trash-alt"></i> Lanjut
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-sm btn-danger mt-2" data-bs-toggle="modal"
                                                            data-bs-target="#editPesananModal{{ $pesanan->id }}">
                                                            <i class="fas fa-info-circle"></i> Tolak
                                                        </button>
                                                    @endif
                                                @elseif ($pesanan->status == 'in progress (bayar dp)')
                                                    <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#cetakPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                    <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#lihatbukti{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Bukti dp
                                                    </button>
                                                    <form action="{{ route('lanjutadmin', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-trash-alt"></i> Lanjut
                                                        </button>
                                                    </form>
                                                @elseif ($pesanan->status == 'in progress (pembuatan taman)')
                                                    <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#cetakPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                    <form action="{{ route('selesaiadmin', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-success mt-2" type="submit">
                                                            <i class="fas fa-trash-alt"></i> Selesai
                                                        </button>
                                                    </form>
                                                @elseif ($pesanan->status == 'negosiasi')
                                                    <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#negosiasiModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Negosiasi
                                                    </button>

                                                    <button class="btn btn-sm btn-info mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#cetakPesananModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Detail
                                                    </button>
                                                    <form action="{{ route('terimalunas', $pesanan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                            <i class="fas fa-trash-alt"></i> Terima
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-sm btn-danger mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#tolakModal{{ $pesanan->id }}">
                                                        <i class="fas fa-info-circle"></i> Tolak
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex  mt-4 text-black justify-content-center">
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
@foreach ($pesanans as $pesanan)
    @include('admin.modal.editcetakpesanan')
    @include('admin.modal.editpesanan')
    @include('admin.modal.editpembayaran')
    @include('admin.modal.modaltolak')
    @include('admin.modal.negosiasi')
    @include('admin.modal.dpmodal')
@endforeach

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
