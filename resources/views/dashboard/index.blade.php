@extends('layouts.dashboard.dashboard')
@section('title', 'Dashboard')
@section('content')
    @if(Auth::user()->role == 'admin')
    <!-- Admin Dashboard -->
    <!-- Row 1 -->
    <div class="row">
        <!-- BUKU -->
        <div class="col-lg-3 col-sm-6">
            <a href="{{ route('dashboard.buku.index') }}">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="ti ti-book"></i></h2>
                        <h3>{{ $buku }} Buku</h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- KATEGORI -->
        <div class="col-lg-3 col-6">
            <a href="{{ route('dashboard.kategori.index') }}">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="ti ti-category-2"></i></h2>
                        <h3>{{ $kategori }} Kategori</h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- MEMBER -->
        <div class="col-sm-6">
            <a href="{{ route('dashboard.member.index') }}">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="ti ti-user"></i></h2>
                        <h3>{{ $members }} Anggota</h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- PEMINJAMAN -->
        <div class="col-sm-6">
            <a href="{{ route('dashboard.peminjaman.index') }}">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="ti ti-arrows-exchange"></i></h2>
                        <h3>{{ $peminjamans }} Transaksi Peminjaman</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Laporan Hari Ini -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h3 class="card-title"><b>Laporan Hari Ini</b></h3>
                    {{ \Carbon\Carbon::now()->format('d F Y') }}
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 col-md-3">
                            <h4 class="text-success"><b>Anggota Baru</b></h4>
                            <h3>{{ $newMembers }}</h3>
                        </div>
                        <div class="col-6 col-md-3">
                            <h4 class="text-info"><b>Peminjaman</b></h4>
                            <h3>{{ $peminjamanToday }}</h3>
                        </div>
                        <div class="col-6 col-md-3">
                            <h4 class="text-info"><b>Pengembalian</b></h4>
                            <h3>{{ $pengembalianToday }}</h3>
                        </div>
                        <div class="col-6 col-md-3">
                            <h4 class="text-danger"><b>Jatuh Tempo</b></h4>
                            <h3>{{ $jatuhTempoToday }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Chart -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Ikhtisar 7 hari terakhir</h5>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <!-- Fine Income -->
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <h5 class="card-title mb-9 fw-semibold">Total Pendapatan Denda</h5>
                            <div class="row align-items-start">
                                <div class="col-9">
                                    <h4 class="fw-semibold mb-3">{{ $totalDendaFormatted }}</h4>
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            <span class="fs-2">Juli 2024</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex align-items-center mt-3">
                                    <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">{{ $percentageChangeFormatted }}</p>
                                    <p class="fs-3 mb-0 text">dari bulan sebelumnya</p>
                                </div>
                            </div>
                        </div>
                        <div id="fine"></div>
                    </div>
                </div>
                <!-- Total Arrears -->
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row align-items-start">
                                <div class="col-9">
                                    <h5 class="card-title mb-9 fw-semibold">Total Tunggakan</h5>
                                    <h4 class="fw-semibold mb-3">{{ $totalTunggakanFormatted }}</h4>
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            <span class="fs-2">31 Mei 2024 - 16 Juli 2024</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3"></div>
                        </div>
                        <div id="arrears"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Non-admin Dashboard -->
    <div class="row">
        <div class="col-sm-6">
            <a href="{{ route('dashboard.peminjaman.index') }}">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="ti ti-arrows-exchange"></i></h2>
                        <h3>{{ $peminjamans }} Transaksi Peminjaman</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endif
@endsection
