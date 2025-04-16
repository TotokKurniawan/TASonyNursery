@extends('layoutadmin.app')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah Pengeluaran</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tambah Pengeluaran</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-5 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Type here...</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <ul class="navbar-nav pe-md-3">
                    <li class="nav-item d-flex align-items-left">
                        <a href="{{ route('home') }}" class="nav-link text-body font-weight-bold px-2">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Form Tambah Pengeluaran</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <form action="{{ route('storepengeluaran') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="text" class="form-control rupiah-input" id="jumlah" name="jumlah"
                                    placeholder="Masukkan jumlah pengeluaran" required>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const inputs = document.querySelectorAll('.rupiah-input');

                                    inputs.forEach(function(input) {
                                        input.addEventListener('input', function() {
                                            let angka = this.value.replace(/[^0-9]/g, '');
                                            this.value = formatRupiah(angka, 'Rp ');
                                        });
                                    });

                                    // Bersihkan sebelum dikirim ke backend
                                    document.querySelectorAll('form').forEach(function(form) {
                                        form.addEventListener('submit', function() {
                                            inputs.forEach(function(input) {
                                                input.value = input.value.replace(/[^0-9]/g, '');
                                            });
                                        });
                                    });

                                    function formatRupiah(angka, prefix) {
                                        let number_string = angka.replace(/[^,\d]/g, '').toString(),
                                            split = number_string.split(','),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                        if (ribuan) {
                                            let separator = sisa ? '.' : '';
                                            rupiah += separator + ribuan.join('.');
                                        }

                                        return prefix + rupiah;
                                    }
                                });
                            </script>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="keterangan"
                                    placeholder="Masukkan deskripsi pengeluaran" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
