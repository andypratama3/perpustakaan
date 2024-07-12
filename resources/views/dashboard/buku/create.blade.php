@extends('layouts.dashboard.dashboard')
@section('title', 'Buku')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="w-100">
            <a href="{{ route('dashboard.buku.index') }}" class="btn btn-outline-primary mb-3">
                <i class="ti ti-arrow-left"></i>
                Kembali
            </a>
        </div>
        <div class="card">
            @include('layouts.dashboard.flashmessage')
            <div class="card-body">
                <h5 class="card-title fw-semibold">Form Tambah Buku</h5>
                <form action="{{ route('dashboard.buku.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3 p-3">
                            <label for="cover" class="d-block" style="cursor: pointer;">
                                <div
                                    class="d-flex justify-content-center bg-light overflow-hidden h-100 position-relative">
                                    <img id="bookCoverPreview" src="{{ asset('assets/images/placeholder.png') }}" alt=""
                                        height="300" class="z-1">
                                    <p class="position-absolute top-50 start-50 translate-middle z-0">Pilih sampul</p>
                                </div>
                            </label>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8 col-xl-9">
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar sampul buku</label>
                                <input class="form-control @error('image') is-invalid @enderror  " type="file" id="image" name="image"
                                    onchange="previewImage(this)">
                                <div class="invalid-feedback">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Judul buku</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pengarang" class="form-label">Pengarang</label>
                                <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang"
                                    value="{{ old('pengarang') }}">
                                <div class="invalid-feedback">
                                    @error('pengarang')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control @error('penerbit') is-invalid @enderror  " id="penerbit" name="penerbit"
                                    value="{{ old('penerbit') }}">
                                <div class="invalid-feedback">
                                    @error('penerbit')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="kode_buku" class="form-label">Kode Buku</label>
                            <input type="text" class="form-control @error('kode_buku') is-invalid @enderror  " id="kode_buku" name="kode_buku" minlength="1"
                                maxlength="6" aria-describedby="kode_buku" value="{{ old('kode_buku') }}">
                            <div id="kode_bukuHelp" class="form-text">
                                Kode Buku must be 1-6 characters long, contain only numbers.
                            </div>
                            <div class="invalid-feedback">
                                @error('kode_buku')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun terbit</label>
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror  " id="tahun_terbit" name="tahun_terbit" minlength="4" maxlength="4"
                                value="{{ old('tahun_terbit') }}">
                            <div class="invalid-feedback">
                                @error('tahun_terbit')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <label for="rak" class="form-label">Rak</label>
                            <select class="form-select " aria-label="Select rak" id="rak" name="rak" value="{{ old('rak') }}">
                                <option selected disabled>--Pilih rak--</option>
                                <option value="1A">1A</option>
                                <option value="2B">2B</option>
                                <option value="3C">3C</option>
                            </select>
                            </select>
                            <div class="invalid-feedback">
                                @error('rack')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select form-control @error('kategoris_id') is-invalid @enderror" aria-label="Select category" id="category" name="kategoris_id"
                                value="{{ old('kategoris_id') }}">
                                <option selected disabled>--Pilih category--</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                @error('kategoris_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-3">
                            <label for="stok" class="form-label">Jumlah stok buku</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror  " id="stok" name="stok" value="{{ old('stok') }}">
                            <div class="invalid-feedback">
                                @error('stok')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 mb-3">
                            <label for="deskripsi">Deskripis</label>
                            <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">

                            </textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    function previewImage(input) {
        const fileInput = input;
        const imagePreview = document.querySelector('#bookCoverPreview');

        const reader = new FileReader();
        reader.readAsDataURL(fileInput.files[0]);

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        };
    }
</script>
@endpush
@endsection

