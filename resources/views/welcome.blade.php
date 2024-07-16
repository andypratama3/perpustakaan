<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <div class="body-wrapper position-relative">
            <div class="container col-xxl-8 px-4 py-5" style="min-height: 100vh;">
                <!-- Main content -->
                <div class="w-100">
                    <div class="px-4 pt-5 my-5 text-center border-bottom">
                        <h1 class="display-4 fw-bold text-body-emphasis">PERPUSTAKAAN</h1><span class="text-primary">SMP
                            Negeri 18 Samarinda</span></h1>
                        <div class="col-lg-8 mx-auto">
                            <p class="lead mb-4">Temukan buku-buku menarik untuk memperluas pengetahuan dan imajinasi
                                Anda. BukuHub adalah teman setia pencinta buku dan pembelajar di mana saja, kapan saja.
                            </p>
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary btn-lg px-4 me-sm-3">Login</a>
                                <a href="{{ route('register') }}"
                                    class="btn btn-primary btn-lg px-4 me-sm-3">Pendaftaran</a>
                                <a href="{{ route('buku.index') }}"
                                    class="btn btn-outline-secondary btn-lg px-4">Daftar buku</a>
                            </div>
                        </div>
                        <div class="overflow-hidden" style="max-height: 45vh;">
                            <div class="container px-5">
                                <img src="{{ asset('image/perpustakaan.jpg') }}"
                                    class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700"
                                    height="500" loading="lazy" style="border-radius: 10px;">
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-6 text-center">
                            <h2>Lokasi</h2>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.637647379033!2d117.10536667377016!3d-0.545267099449397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df68090aad4f429%3A0xa9cc23390d75faea!2sSMP%20Negeri%2018%20Samarinda!5e0!3m2!1sid!2sid!4v1721106706932!5m2!1sid!2sid" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="col-md-6">
                            <h2>Kontak</h2>
                            <p>Alamat SMP Negeri 18 Samarinda</p>
                            <p>Telepon: 085266810777</p>
                            <p>Email: 9YqQI@example.com</p>
                        </div>
                    </div>
                </div>



                <div class="align-self-end w-100">
                    <!-- DEBUG-VIEW START 3 APPPATH/Views/layouts/footer.php -->

                    <!-- DEBUG-VIEW ENDED 3 APPPATH/Views/layouts/footer.php -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>

{{-- @endsection --}}
