@extends('layouts.dashboard.dashboard')
@section('title', 'Admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="w-100">
            <a href="{{ route('dashboard.admin.index') }}" class="btn btn-outline-primary mb-3">
                <i class="ti ti-arrow-left"></i>
                Kembali
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Edit Admin</h4>

                <form action="{{ route('dashboard.admin.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Username</label>
                                <input type="text" name="name" id="name"
                                    class="form-control mt-2 @error('name') is-invalid @enderror"
                                    placeholder="Masukkan Username" value="{{ old('name', $user->name) }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control mt-2 @error('email') is-invalid @enderror"
                                    placeholder="Masukkan Email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control mt-2 @error('password') is-invalid @enderror"
                                    placeholder="Masukkan Password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control mt-2 @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Masukkan Password (again)" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
