@extends('layoutadmin.app')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah Pelanggan</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tambah Pelanggan</h6>
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
                            <h6 class="text-white text-capitalize ps-3">Form Tambah Design</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <form action="{{ route('design.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="konsep" class="form-label">Nama Konsep</label>
                                <input type="text" class="form-control" id="konsep" name="konsep"
                                    placeholder="Masukkan nama pelanggan" required>
                            </div>
                            <div class="mb-3">
                                <label for="lahan" class="form-label">Spesifikasi lahan</label>
                                <input type="text" class="form-control" id="lahan" name="lahan"
                                    placeholder="Masukkan spesifikasi lahan" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga"
                                    placeholder="Masukkan harga" required>
                            </div>

                            <script>
                                const hargaInput = document.getElementById('harga');

                                hargaInput.addEventListener('input', function(e) {
                                    // Hilangkan karakter selain angka
                                    let value = this.value.replace(/[^,\d]/g, '').toString();
                                    let split = value.split(',');
                                    let sisa = split[0].length % 3;
                                    let rupiah = split[0].substr(0, sisa);
                                    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                    if (ribuan) {
                                        let separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }

                                    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                                    this.value = 'Rp ' + rupiah;
                                });

                                document.querySelector('form').addEventListener('submit', function(e) {
                                    const input = document.getElementById('harga');
                                    const numericValue = input.value.replace(/[^0-9]/g, ''); // hanya ambil angka
                                    input.value = numericValue;
                                });
                            </script>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Desain</label>
                                <input type="file" class="form-control" id="foto" name="foto" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
