@extends('layouts.dashboard.dashboard')
@section('title', 'Kategori')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="w-100">
            <a href="{{ route('dashboard.kategori.index') }}" class="btn btn-outline-primary mb-3">
                <i class="ti ti-arrow-left"></i>
                Kembali
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Tambah Kategori</h4>

                <form action="{{ route('dashboard.kategori.store') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Masukkan Kategori" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
