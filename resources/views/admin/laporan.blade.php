@extends('layoutadmin.app')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Laporan</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Laporan</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-1" id="navbar">
                <div class="ms-md-auto pe-md-5 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Type here...</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <ul class="navbar-nav pe-md-3">
                    <!-- Profile Icon -->
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('profile') }}" class="nav-link text-body font-weight-bold px-2">
                            <i class="fas fa-user-circle me-sm-1"></i>
                            <span class="d-sm-inline d-none">Profile</span>
                        </a>
                    </li>
                    <!-- Logout Icon -->
                    <li class="nav-item d-flex align-items-center">
                        <a href="javascript:void(0);" class="nav-link text-body font-weight-bold px-2" id="logout-link">
                            <i class="fa fa-sign-out me-sm-1"></i>
                            <span class="d-sm-inline d-none">Logout</span>
                        </a>
                    </li>

                    <!-- SweetAlert Logout Script -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.getElementById('logout-link').addEventListener('click', function(event) {
                            event.preventDefault(); // Prevent default link behavior

                            // Show confirmation with SweetAlert
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
                                        '{{ route('home') }}'; // Redirect to logout route if confirmed
                                }
                            });
                        });
                    </script>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-1">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Laporan Pendapatan</h6>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-0 ">
                        <!-- Form Filter Laporan -->
                        <form action="{{ route('cetakpendapatan') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3 text-capitalize ps-10">
                                    <label for="tglawal" class="form-label">Tanggal Awal</label>
                                    <input type="date" name="tglawal" id="tglawal" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3 ps-10">
                                    <label for="tglakhir" class="form-label">Tanggal Akhir</label>
                                    <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- resources/views/admin/laporan.blade.php -->
    <div class="container-fluid py-1">
        <div class="row">
            <div class="col-12">
                <div class="card my-1">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Laporan Pengeluaran</h6>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <!-- Form Filter Laporan -->
                        <form action="{{ route('laporan.cetak') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3 text-capitalize ps-10">
                                    <label for="tglawal" class="form-label">Tanggal Awal</label>
                                    <input type="date" name="tglawal" id="tglawal" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3 ps-10">
                                    <label for="tglakhir" class="form-label">Tanggal Akhir</label>
                                    <input type="date" name="tglakhir" id="tglakhir" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
