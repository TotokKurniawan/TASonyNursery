<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-3 font-weight-bold text-white">SONY NURSERY</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::is('dashboard') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::is('pelanggan') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('pelanggan') }}">
                    <div class="d-flex align-items-center justify-content-center me-2">
                        <i class="material-icons opacity-10">support_agent</i>
                    </div>
                    <span class="nav-link-text ms-1">Pelanggan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::is('design') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('design') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">layers</i>
                    </div>
                    <span class="nav-link-text ms-1">Design</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::is('pengeluaran') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('pengeluaran') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Pengeluaran</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ Route::is('pesanan') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('pesanan') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Pesanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::is('laporan') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('laporan') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">view_in_ar</i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ Route::is('pesan') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('pesan') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">chat</i> <!-- Mengganti ikon ke 'chat' -->
                    </div>
                    <span class="nav-link-text ms-1">Pesan</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="btn bg-gradient-primary w-100" href="javascript:void(0);" id="logout-button"
                type="button">Keluar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('logout-button').addEventListener('click', function(event) {
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
                    // Mengarahkan ke URL logout jika konfirmasi diterima
                    window.location.href = '{{ route('home') }}';
                }
            });
        });
    </script>
</aside>
