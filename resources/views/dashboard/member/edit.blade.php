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
                <h4>Edit Member</h4>

                <form action="{{ route('dashboard.member.update', $member->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Username</label>
                                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Masukkan Username" value="{{ old('name', $member->name) }}">
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
                                <input type="email" name="email" id="email" class="form-control mt-2 @error('email') is-invalid @enderror" placeholder="Masukkan Email" value="{{ old('email', $member->user->email) }}">
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
                                <input type="password" name="password" id="password" class="form-control mt-2 @error('password') is-invalid @enderror" placeholder="Masukkan Password" value="{{ old('password') }}">
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
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mt-2 @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan Password (again)" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <p>Member Data</p>
                        <hr>
                        <div class="col-md-6 mb-2">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" name="phone" placeholder="phone"
                                value="{{ old('phone', $member->phone) }}"  />
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="phone">Address</label>
                            <textarea class="form-control" name="address" placeholder="address">{{ old('address', $member->address) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="phone">Date Of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth) }}"/>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="row"></div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="male" name="gender" {{ $member->gender == 'male' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="female" name="gender" {{ $member->gender == 'female' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

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

