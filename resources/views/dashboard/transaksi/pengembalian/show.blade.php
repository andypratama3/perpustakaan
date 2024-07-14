@extends('layouts.dashboard.dashboard')
@section('title', 'Peminjaman')
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
                <div class="d-flex justify-content-between mb-4">
                    <div class="d-flex gap-2 justify-content-end gap-2 float-end">
                        {{-- <form action="http://localhost:8080/admin/loans/436edd302d9b75bfe12ca672e08dd34e6dd2d927"
                            method="post">
                            <input type="hidden" name="csrf_test_name" value="546b4b97ff4b95147c129ca648a3a15e"> <input
                                type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger mb-2"
                                onclick="return confirm('Are you sure?');">
                                <i class="ti ti-x"></i>
                                Batalkan
                            </button>
                        </form> --}}
                        <div>
                            <a href=""
                                class="btn btn-primary w-100 ">
                                <i class="ti ti-check"></i>
                                Selesaikan pengembalian
                            </a>
                        </div>
                    </div>
                </div>
                <h5 class="card-title fw-semibold mb-4">Detail Peminjaman</h5>
                <div class="row mb-3">
                    <!-- member data -->
                    <div class="col-12 col-md-6 d-flex flex-wrap">
                        <div class="mb-4">
                            <table>
                                <tr>
                                    <td>
                                        <h5><b>Nama Lengkap</b></h5>
                                    </td>
                                    <td style="width:15px" class="text-center">
                                        <h5><b>:</b></h5>
                                    </td>
                                    <td>
                                        <h5><b>{{ $peminjaman->member->name }}</b></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Email</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $peminjaman->member->user->email }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Nomor telepon</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $peminjaman->member->phone }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Alamat</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $peminjaman->member->address }}</h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- book data -->
                    <div class="col-12 col-md-6 d-flex flex-wrap">
                        <div class="mb-4">
                            <table>
                                <tr>
                                    <td>
                                        <h5><b>Judul buku</b></h5>
                                    </td>
                                    <td style="width:15px" class="text-center">
                                        <h5><b>:</b></h5>
                                    </td>
                                    <td>
                                        <h5><b>{{ $peminjaman->buku->name }}</b></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Pengarang</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $peminjaman->buku->pengarang }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Penerbit</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $peminjaman->buku->penerbit }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Rak</h5>
                                    </td>
                                    <td class="text-center">
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $peminjaman->buku->rak }}</h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="row">
                    <!-- quantity -->
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card" style="height: 180px;">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-book"></i>
                                </h2>
                                <h5>Jumlah buku dipinjam: </h5>
                                <h4> {{ $peminjaman->jumlah }} </h4>
                            </div>
                        </div>
                    </div>
                    <!-- status -->
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card" style="height: 180px;">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-clock-exclamation"></i>
                                </h2>
                                <h5>Status: </h5>
                                @if($peminjaman->status == 'pending')
                                <span class="badge bg-warning rounded-3">
                                    <h5 class="fw-semibold mb-0">{{ $peminjaman->status ? 'Pending' : 'Pending' }}</h5>
                                </span>
                                @elseif($peminjaman->status == 'dikonfirmasi')
                                <span class="badge bg-primary rounded-3">
                                    <h5 class="fw-semibold mb-0">{{ $peminjaman->status ? 'Dikonfirmasi' : 'Dikonfirmasi' }}</h5>
                                </span>
                                @elseif($peminjaman->status == 'dipinjam')
                                <span class="badge bg-success rounded-3">
                                    <h5 class="fw-semibold mb-0">{{ $peminjaman->status ? 'Dipinjam' : 'Dipinjam' }}</h5>
                                </span>
                                @elseif($peminjaman->status == 'dikembalikan')
                                <span class="badge bg-info rounded-3"></span>
                                    <h5 class="fw-semibold mb-0">{{ $peminjaman->status ? 'Dikembalikan' : 'Dikembalikan' }}</h5>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- deadline -->
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card" style="height: 180px;">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-calendar-due"></i>
                                </h2>
                                <h5>Deadline: </h5>
                                <h4>
                                    {{ $count }} Hari lagi
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- loan date -->
                    <div class="col-12 col-sm-6">
                        <div class="card" style="height: 180px;">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-calendar-check"></i>
                                </h2>
                                <h5>Waktu pinjam: </h5>
                                <h4>
                                    <div>{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d-m-y') }}</div>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- due date -->
                    <div class="col-12 col-sm-6">
                        <div class="card" style="height: 180px;">
                            <div class="card-body">
                                <h2>
                                    <i class="ti ti-calendar-due"></i>
                                </h2>
                                <h5>Batas waktu pengembalian: </h5>
                                <h4>
                                    <div>{{ \Carbon\Carbon::parse($peminjaman->kembali)->format('d-m-y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script></script>

</script>
@endsection
