<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-1" id="navbar">
            <div class="ms-md-auto pe-md-5 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <label class="form-label">Type here...</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <ul class="navbar-nav pe-md-3">
                {{-- <li class="nav-item d-flex align-items-center">
                    <a href="javascript:void(0);" class="nav-link text-body font-weight-bold px-2"
                        id="notification-icon">
                        <i class="fas fa-bell me-sm-1"></i>
                    </a>
                </li>

                <!-- Modal untuk menampilkan notifikasi -->
                <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="notification-list">
                                <!-- Daftar notifikasi akan dimasukkan di sini dengan JavaScript -->
                            </div>
                        </div>
                    </div>
                </div> --}}


                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('profile') }}" class="nav-link text-body font-weight-bold px-2">
                        <i class="fas fa-user-circle me-sm-1"></i>
                        <span class="d-sm-inline d-none">Profile</span>
                    </a>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:void(0);" class="nav-link text-body font-weight-bold px-2" id="logout-link">
                        <i class="fa fa-sign-out me-sm-1"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a>
                </li>

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
