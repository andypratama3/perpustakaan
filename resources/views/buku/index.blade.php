<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buku</title>
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
            <a href="/" class="btn btn-outline-primary m-3 position-absolute">
                <i class="ti ti-home"></i>
                Kembali
            </a>
            <div class="container col-xxl-8 px-4 py-5" style="min-height: 100vh;">
                <!-- Main content -->
                <div class="w-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 col-lg-5">
                                    <h5 class="card-title fw-semibold">Daftar Buku</h5>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <div>
                                            <form action="" method="get">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="search" value=""
                                                        placeholder="Cari buku" aria-label="Cari buku"
                                                        aria-describedby="searchButton">
                                                    <button class="btn btn-outline-secondary" type="submit"
                                                        id="searchButton">Cari</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($bukus as $buku)
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card overflow-hidden rounded-2" style="height: auto;">
                                        <div class="position-relative">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#bookDetailModal"
                                                data-title="{{ $buku->name }}" data-year="{{ $buku->year }}" data-author="{{ $buku->pengarang }}"
                                                data-publisher="{{ $buku->penerbit }}" data-category="{{ $buku->kategori->name }}" data-rack="{{ $buku->rak }}"
                                                data-quantity="{{ $buku->stok }}"
                                                data-cover="{{ asset('image/buku/'. $buku->image) }}">
                                                <div class="card-img-top rounded-0" id="coverBook1" ><img src="{{ asset("storage/image/buku/". $buku->image) }}" class="img-fluid" alt="" srcset="">
                                            </a>
                                        </div>
                                        <div class="card-body pt-3 p-4">
                                            <h6 class="fw-semibold fs-4">
                                                {{ $buku->name }} </h6>
                                            <div class="card-body pt-3 p-0">
                                                <a href="#" class="btn btn-primary mt-3" data-bs-toggle="modal"
                                                    data-bs-target="#bookDetailModal"
                                                    data-cover="{{ asset('image/buku/'. $buku->image) }}"
                                                    data-title="{{ $buku->name }}" data-year="{{ $buku->tahun_terbit }}" data-author="{{ $buku->pengarang }}"
                                                    data-publisher="{{ $buku->penerbit }}" data-category="{{ $buku->kategori->name }}" data-rack="{{ $buku->rak }}"
                                                    data-quantity="{{ $buku->stok }}">
                                                    Detail Buku
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <!-- DEBUG-VIEW START 1 APPPATH/Views/layouts/pager.php -->

                                <nav aria-label="Page navigation" class="d-flex">
                                    <ul class="pagination m-auto">

                                        {{-- <li class="page-item active">
                                            <a class="page-link"
                                                href="{{ url()->current() }}?page={{ $bukus->currentPage() }}">
                                                {{ $bukus->currentPage() }} </a>
                                        </li> --}}
                                        {{-- @for ($i = 1; $i <= $bukus->lastPage(); $i++)
                                            <li class="page-item {{ $bukus->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() }}?page={{ $i }}">{{ $i }}</a>
                                            </li>
                                        @endfor --}}

                                    </ul>
                                </nav>
                                <!-- DEBUG-VIEW ENDED 1 APPPATH/Views/layouts/pager.php -->
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="bookDetailModal" tabindex="-1" aria-labelledby="bookDetailModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bookDetailModalLabel">Detail Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex">
                                    <div class="w-50">
                                        <h6 id="bookTitle"></h6>
                                        <p><strong>Tahun:</strong> <span id="bookYear"></span></p>
                                        <p><strong>Pengarang:</strong> <span id="bookAuthor"></span></p>
                                        <p><strong>Penerbit:</strong> <span id="bookPublisher"></span></p>
                                        <p><strong>Kategori:</strong> <span id="bookCategory"></span></p>
                                        <p><strong>Rak:</strong> <span id="bookRack"></span></p>
                                        <p><strong>Stok:</strong> <span id="bookQuantity"></span></p>
                                    </div>
                                    <div class="w-50 text-center">
                                        <img id="bookCover" src="" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    {{-- add bootstrap  --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var bookDetailModal = document.getElementById('bookDetailModal');
        bookDetailModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var title = button.getAttribute('data-title');
            var year = button.getAttribute('data-year');
            var author = button.getAttribute('data-author');
            var publisher = button.getAttribute('data-publisher');
            var category = button.getAttribute('data-category');
            var rack = button.getAttribute('data-rack');
            var quantity = button.getAttribute('data-quantity');
            var cover = button.getAttribute('data-cover');

            var modalTitle = bookDetailModal.querySelector('.modal-title');
            var modalBodyTitle = bookDetailModal.querySelector('#bookTitle');
            var modalBodyYear = bookDetailModal.querySelector('#bookYear');
            var modalBodyAuthor = bookDetailModal.querySelector('#bookAuthor');
            var modalBodyPublisher = bookDetailModal.querySelector(
            '#bookPublisher');
            var modalBodyCategory = bookDetailModal.querySelector('#bookCategory');
            var modalBodyRack = bookDetailModal.querySelector('#bookRack');
            var modalBodyQuantity = bookDetailModal.querySelector('#bookQuantity');
            var modalBodyCover = bookDetailModal.querySelector('#bookCover');

            modalTitle.textContent = title;
            modalBodyTitle.textContent = title;
            modalBodyYear.textContent = year;
            modalBodyAuthor.textContent = author;
            modalBodyPublisher.textContent = publisher;
            modalBodyCategory.textContent = category;
            modalBodyRack.textContent = rack;
            modalBodyQuantity.textContent = quantity;
            modalBodyCover.src = cover;
        });
    });
</script>

</body>
</html>
