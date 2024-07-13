@extends('layouts.dashboard.dashboard')
@section('title', 'Member')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="w-100">
            <a href="{{ route('dashboard.member.index') }}" class="btn btn-outline-primary mb-3">
                <i class="ti ti-arrow-left"></i>
                Kembali
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Tambah Member</h4>

                <form action="{{ route('dashboard.member.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Username</label>
                                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Masukkan Kategori" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Email</label>
                                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Masukkan Kategori" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}"  />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <!-- Username -->
                        <div class="col-md-6 mb-4">
                            <input type="text" class="form-control" name="name"
                                 placeholder="name" value="{{ old('name') }}"  />
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-2">
                            <input type="password" class="form-control" name="password" placeholder="Password"  />
                        </div>

                        <!-- Password (Again) -->
                        <div class="col-md-6 mb-5">
                            <input type="password" class="form-control" name="password_confirmation"
                              placeholder="Password (again)"  />
                        </div>

                        <!-- Additional Fields for Member Data -->
                        <hr>
                        <p>Member Data</p>
                        <hr>
                        <div class="col-md-6 mb-2">
                            <input type="tel" class="form-control" name="phone" placeholder="phone"
                                value="{{ old('phone') }}"  />
                        </div>

                        <div class="col-md-6 mb-2">
                            <textarea class="form-control" name="address" placeholder="address">{{ old('address') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-2">
                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}"/>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="male" name="gender"/>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="female" name="gender"/>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <button class="btn btn-primary float-end">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
