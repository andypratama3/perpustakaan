
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .background {
            position: absolute;
            overflow: hidden;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            /* background: linear-gradient(to right, #fd81d6, #80dfff); */
            background: radial-gradient(#80dfff, #ffaee5);
            display: flex;
            flex-grow: 1;
            z-index: -1;
            opacity: 0.35;
        }
    </style>
</head>

<body class="position-relative">
    <!--  Body Wrapper -->
    <div class="background">
    </div>

    <div class="page-wrapper" id="main-wrapper">
        <!--  Main wrapper -->
        <a href="{{ route('landing.index') }}" class="btn btn-outline-primary m-3 position-absolute">
            <i class="ti ti-arrow-left"></i>
            Kembali
          </a>
        <div class="body-wrapper position-relative">
            <div class="container col-xxl-8 px-4 py-5">
                <!-- Main content -->
                <div class="w-100">
                    <div class="container d-flex justify-content-center p-3">
                        <div class="card col-12 col-md-5 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-5">Register</h5>
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <!-- Email -->
                                    <div class="mb-2">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}"  />

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Username -->
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="name"
                                             placeholder="name" value="{{ old('name') }}"  />
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-2">
                                        <input type="password" class="form-control" name="password" placeholder="Password"  />
                                    </div>

                                    <!-- Password (Again) -->
                                    <div class="mb-5">
                                        <input type="password" class="form-control" name="password_confirmation"
                                          placeholder="Password (again)"  />
                                    </div>

                                    <!-- Additional Fields for Member Data -->
                                    <hr>
                                    <p>Member Data</p>
                                    <hr>
                                    <div class="mb-2">
                                        <input type="tel" class="form-control" name="phone" placeholder="phone"
                                            value="{{ old('phone') }}"  />
                                    </div>

                                    <div class="mb-2">
                                        <textarea class="form-control" name="address" placeholder="address">{{ old('address') }}</textarea>
                                    </div>

                                    <div class="mb-2">
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}"/>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="male" name="gender"/>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="female" name="gender"/>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>

                                    <div class="d-grid col-12 mx-auto m-3">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        <a href="{{ route('login') }}" class="btn btn-danger mt-2">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

{{-- @endsection --}}
