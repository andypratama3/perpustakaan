@extends('layouts.dashboard.dashboard')
@section('title', 'Edit Peminjaman')
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
            @include('layouts.dashboard.flashmessage')
            <div class="card-body">
                <h4>Edit Peminjaman</h4>
                <form action="{{ route('dashboard.peminjaman.update', $peminjaman->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="fw-bold">Pilih Buku</p>
                                            <input type="text" id="search" class="form-control m-2" placeholder="Cari buku" name="name">
                                        </div>
                                        <div class="row">
                                            <div id="searchResults">

                                                <!-- Search results will be dynamically populated here -->
                                            </div>

                                        </div>
                                        <div class="row" id="buku-each">
                                            @foreach ($bukus as $buku)
                                            <div class="col-md-3 mt-2">
                                                <div class="d-flex flex-column mx-3">
                                                    <img src="{{ asset('image/buku/'. $buku->image) }}" alt="" style="border-radius: 10px; width: 100%;" class="book-image" data-radio-id="buku-{{ $buku->id }}">
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="radio" name="bukus_id"
                                                            id="buku-{{ $buku->id }}" value="{{ $buku->id }}"
                                                            {{ $peminjaman->bukus_id == $buku->id ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="buku-{{ $buku->id }}">
                                                            {{ $buku->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @error('buku_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="row" id="detail" style="display: none" data-aos="fade-up">
                                            <hr>
                                            <div class="col-md-12">
                                                <h5 class="fw-bold">Detail Buku</h5>
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <p class="fw-bold">Judul : </p>
                                                        <p id="name"></p>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="fw-bold">Pengarang : </p>
                                                        <p id="pengarang"></p>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="fw-bold">Penerbit : </p>
                                                        <p id="penerbit"></p>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="fw-bold">Tahun :</p>
                                                        <p id="tahun"></p>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="fw-bold">Stok :</p>
                                                        <p id="stok"></p>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->role == 'admin')
                        <div class="col-md-6 mb-2">
                            <label for="members_id">Peminjam</label>
                            <select name="members_id" id="members_id" class="form-control @error('members_id') is-invalid @enderror">
                                <option value="">-- Pilih Peminjam --</option>
                                @foreach ($users as $member)
                                <option value="{{ $member->id }}" {{ $member->id == $peminjaman->members_id ? 'selected' : '' }}>{{ $member->name }}</option>
                                @endforeach
                            </select>
                            @error('members_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @else
                            <input type="hidden" name="members_id" id="members_id" value="{{ $peminjaman->members_id }}">
                        @endif
                        <div class="col-md-6 mb-2">
                            <label for="tgl_pinjam">Tanggal Peminjaman</label>
                            <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control mt-2 @error('tgl_pinjam') is-invalid @enderror" value="{{ old('tgl_pinjam', $peminjaman->tgl_pinjam) }}">
                            @error('tgl_pinjam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="tenggat">Tenggat / Lama Peminjaman</label>
                            <select name="tenggat" id="tenggat" class="form-select">
                                <option disabled>-- Pilih Tenggat --</option>
                                <option value="7" {{ $peminjaman->tenggat == 7 ? 'selected' : '' }}>7 Hari</option>
                                <option value="14" {{ $peminjaman->tenggat == 14 ? 'selected' : '' }}>14 Hari</option>
                                <option value="30" {{ $peminjaman->tenggat == 30 ? 'selected' : '' }}>30 Hari</option>
                            </select>
                            @error('tenggat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="tgl_kembali">Tanggal Pengembalian</label>
                            <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control mt-2 @error('tgl_kembali') is-invalid @enderror" value="{{ old('tgl_kembali', $peminjaman->tgl_kembali) }}">
                            @error('tgl_kembali')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control mt-2 @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $peminjaman->jumlah) }}">
                            @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Update Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search').on('input', function () {
            let query = $(this).val().trim(); // Trim whitespace from the input
            if (query === '') {
                // If search input is empty, show the static list of books
                $('#buku-each').show();
                $('#searchResults').hide().empty();
            } else {
                $.ajax({
                    url: '{{ route("dashboard.peminjaman.searchBuku") }}',
                    type: 'GET',
                    data: { search: query },
                    success: function (response) {
                        let results = $('#searchResults');
                        results.empty();

                        if (response.length > 0) {
                            response.forEach(function (buku) {
                                $('#buku-each').hide();

                                let card = $('<div class="col-md-3 mt-2"></div>');
                                let innerDiv = $('<div class="d-flex flex-column mx-3"></div>');

                                let image = $('<img>').attr({
                                    src: '{{ asset("image/buku") }}/' + buku.image,
                                    alt: buku.name,
                                    style: 'border-radius: 10px; width: 100%;',
                                    class: 'book-image',
                                    'data-radio-id': 'buku-' + buku.id
                                });

                                let formCheck = $('<div class="form-check mt-2"></div>');
                                let inputRadio = $('<input>').attr({
                                    type: 'radio',
                                    class: 'form-check-input',
                                    name: 'buku_id',
                                    id: 'buku-' + buku.id,
                                    value: buku.id,
                                    checked: buku.id == '{{ old("buku_id") }}'
                                });
                                let label = $('<label class="form-check-label"></label>').attr('for', 'buku-' + buku.id).text(buku.name);

                                formCheck.append(inputRadio);
                                formCheck.append(label);

                                innerDiv.append(image);
                                innerDiv.append(formCheck);

                                card.append(innerDiv);
                                results.append(card);
                            });
                        } else {
                            results.append('<p class="text-muted">No books found</p>');
                            $('#buku-each').hide();
                        }
                        results.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

        // Function to handle book image click
        $(document).on('click', '.book-image', function () {
            let radioId = $(this).attr('data-radio-id');
            $('#' + radioId).prop('checked', true);

            // Get book ID from radio button ID
            let bookId = radioId.replace('buku-', '');

            // Make AJAX request to fetch book details
            $.ajax({
                url: '{{ route("peminjaman.detailBuku") }}',
                type: 'GET',
                data: { id: bookId },
                success: function(response) {
                    $('#detail').css('display', 'block');
                    $('#name').text(response.name);
                    $('#pengarang').text(response.pengarang);
                    $('#penerbit').text(response.penerbit);
                    $('#tahun').text(response.tahun_terbit);
                    $('#stok').text(response.stok);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Disable tenggat and tgl_kembali initially
        $('#tenggat').prop('disabled', true);
        // $('#tgl_kembali').prop('disabled', true);

        // Function to handle changes in loan date (tgl_pinjam)
        $('#tgl_pinjam').on('change', function () {
            let tgl_pinjam = $(this).val();

            // Enable tenggat and set minimum date for tgl_kembali
            $('#tenggat').prop('disabled', false);
            $('#tgl_kembali').prop('disabled', false);
            $('#tgl_kembali').attr('min', tgl_pinjam);

            // Reset tgl_kembali value when tgl_pinjam changes
            $('#tgl_kembali').val('');

            // Handle default case for tenggat if needed
        });

        // Function to handle changes in loan period (tenggat)
        $('#tenggat').on('change', function () {
            let value = parseInt($(this).val());
            let tgl_pinjam = $('#tgl_pinjam').val();

            // Calculate the return date based on the selected loan period and loan date
            if (value === 7) {
                $('#tgl_kembali').val(moment(tgl_pinjam, 'YYYY-MM-DD').add(7, 'days').format('YYYY-MM-DD'));
            } else if (value === 14) {
                $('#tgl_kembali').val(moment(tgl_pinjam, 'YYYY-MM-DD').add(14, 'days').format('YYYY-MM-DD'));
            } else if (value === 30) {
                $('#tgl_kembali').val(moment(tgl_pinjam, 'YYYY-MM-DD').add(30, 'days').format('YYYY-MM-DD'));
            } else {
                // Handle default case if needed
            }
        });

        // Initial setup for tgl_kembali based on default loan period (optional)
        let defaultValue = parseInt($('#tenggat').val());
        if (defaultValue) {
            let tgl_pinjam = $('#tgl_pinjam').val();
            // Set initial return date based on default loan period and loan date
            if (defaultValue === 7) {
                $('#tgl_kembali').val(moment(tgl_pinjam, 'YYYY-MM-DD').add(7, 'days').format('YYYY-MM-DD'));
            } else if (defaultValue === 14) {
                $('#tgl_kembali').val(moment(tgl_pinjam, 'YYYY-MM-DD').add(14, 'days').format('YYYY-MM-DD'));
            } else if (defaultValue === 30) {
                $('#tgl_kembali').val(moment(tgl_pinjam, 'YYYY-MM-DD').add(30, 'days').format('YYYY-MM-DD'));
            }
        }
    });
</script>


@endpush
