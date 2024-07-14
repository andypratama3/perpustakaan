@extends('layouts.dashboard.dashboard')

@section('title', 'Profile')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="w-100">
                {{-- <a href="{{ route('profile.index') }}" class="btn btn-outline-primary mb-3">
                    <i class="ti ti-arrow-left"></i>
                    Kembali
                </a> --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>Edit Profile</h4>

                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Masukkan Name" value="{{ old('name') ?? $user->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control mt-2 @error('email') is-invalid @enderror" placeholder="Masukkan Email" value="{{ old('email') ?? $user->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- update password --}}
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control mt-2 @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="text" name="password_confirmation" id="password_confirmation" class="form-control mt-2">
                        </div>


                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endSection
