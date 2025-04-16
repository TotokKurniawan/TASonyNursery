@extends('layoutadmin.app')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Profile</h6>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto"
                                form="edit-profile-form">Update</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="edit-profile-form" action="{{ route('update.profile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf <!-- Laravel CSRF token -->

                            <div class="form-group">
                                <label for="name" class="form-control-label">Nama Lengkap</label>
                                <input id="name" name="name" class="form-control" type="text">
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input id="password" name="password" class="form-control" type="password">
                            </div>

                            <div class="form-group">
                                <label for="profile-photo" class="form-control-label">Upload Foto Profil</label>
                                <input id="profile-photo" name="profile_photo" class="form-control" type="file">
                            </div>

                            <hr class="horizontal dark">

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="{{ asset('assetsadmin/img/bg-profile.jpg') }}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assetsadmin/img/team-2.jpg') }}"
                                        style="width: 100px; height: 100px; object-fit: cover;"
                                        class="rounded-circle img-fluid border border-2 border-white" alt="Foto Profil">
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="text-center mt-4">
                            <h5>{{ $user->name }} <span class="font-weight-light">,
                                    <br> {{ $user->email ?? 'N/A' }} <br>{{ $user->password }} </span></h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
