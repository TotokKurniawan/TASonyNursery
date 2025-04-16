@extends('layoutadmin.app')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Pelanggan</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Pelanggan</h6>
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
                            <span class="d-sm-inline d-none ">Logout</span>
                        </a>
                    </li>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.getElementById('logout-link').addEventListener('click', function(event) {
                            event.preventDefault(); // Mencegah tindakan default link

                            // Menampilkan konfirmasi dengan SweetAlert
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
                            <!-- Judul -->
                            <h6 class="text-white text-capitalize ps-3">Tabel Pelanggan</h6>

                            <div class="input-group" style="width: 40%; max-width: 240px; margin-right: 10px">
                                <input type="text" class="form-control bg-white" id="searchInput"
                                    placeholder="Cari berdasarkan nama pelanggan" />
                                <span class="input-group-text text-secondary" style="margin-top: 4px"><i
                                        class="fas fa-search"></i></span>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Telepon
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Alamat
                                        </th>
                                        <th
                                            class="text-center text-xxs text-uppercase font-weight-bolder text-secondary opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelanggans as $pelanggan)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm ">
                                                            {{ $loop->iteration }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $pelanggan->nama }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $pelanggan->telepon }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">{{ $pelanggan->alamat }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="text-danger font-weight-bold text-xs"
                                                    onclick="confirmDelete('{{ $pelanggan->id }}')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>

                                                <form id="delete-form-{{ $pelanggan->id }}"
                                                    action="{{ route('deletepelanggan', $pelanggan->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tautan Pagination -->
                            <div class="d-flex justify-content-center mt-4 text-black">
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $pelanggans->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $pelanggans->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @foreach ($pelanggans->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $page == $pelanggans->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ $pelanggans->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $pelanggans->nextPageUrl() }}" aria-label="Next">
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
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.querySelector('tbody');

        // Event listener untuk pencarian
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase(); // Ambil input dan ubah ke huruf kecil
            const rows = tableBody.querySelectorAll('tr'); // Ambil semua baris di tabel

            rows.forEach(row => {
                const nama = row.cells[1]?.textContent.toLowerCase(); // Ambil teks dari kolom "Nama"
                if (nama && nama.includes(filter)) {
                    row.style.display = ''; // Tampilkan baris jika cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                }
            });
        });
    </script>
@endsection
