@extends('layoutuser.app')

@section('content')
    <main id="main">
        <style>
            .hero-section {
                background-color: #e0f7fa;
                /* Latar belakang biru muda */
            }
        </style>
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
                                <h1 data-aos="fade-up" data-aos-delay="">PROFILE</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container-fluid py-5 d-flex justify-content-center" style="background: whiteo">
            <div class="row w-75 justify-content-center">
                <!-- Edit Profile Form -->
                <div class="col-md-7">
                    <div class="card shadow-sm rounded">
                        <div class="card-header pb-3">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0">Edit Profile</h5>
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
                        <img src="{{ asset('assetsadmin/img/bg-profile.jpg') }}" alt="Image placeholder"
                            class="card-img-top">
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
                                        <br> {{ $user->email ?? 'N/A' }}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CTA Section -->
        <section class="section cta-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-5 mb-md-0">
                        <h2>Consult your Garden Design Here</h2>
                    </div>
                    <div class="col-md-5 text-center text-md-end">
                        <a href="#" class="btn btn-primary"><i class="bx bxl-whatsapp"></i> WhatsApp</a>
                        <a href="#" class="btn btn-secondary"><i class="bx bx-envelope"></i> Email Us</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
