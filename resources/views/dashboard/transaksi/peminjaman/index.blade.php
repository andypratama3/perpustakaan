@extends('layouts.dashboard.dashboard')

@section('title', 'Peminjaman')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pb-2">
            @include('layouts.dashboard.flashmessage')
        </div>
        <div class="card">
            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-12 col-lg-5">
                        <h5 class="card-title fw-semibold mb-4">Data Peminjaman</h5>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <div>
                                <form action="{{ route('dashboard.peminjaman.index') }}" method="get">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="search" value=""
                                            placeholder="Cari peminjaman" aria-label="Cari peminjaman"
                                            aria-describedby="searchButton">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="searchButton">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                @if (!$hasUnpaidDenda)
                                <a href="{{ route('dashboard.peminjaman.create') }}" class="btn btn-primary">Create Peminjaman</a>
                            @else
                                {{-- <button class="btn btn-primary" disabled>Create Peminjaman</button>
                                <p class="text-danger">You have unpaid denda associated with peminjaman. Resolve them before creating a new peminjaman.</p> --}}
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Jumlah</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tenggat</th>
                                <th>Jumlah Peminjaman</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                @if(Auth::user()->role == 'admin')
                                <th>Konfirmasi / Batalkan</th>
                                @else
                                <th>Pengembalian Buku</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $peminjaman->member->name }}</td>
                                <td>{{ $peminjaman->buku->name }}</td>
                                <td>{{ $peminjaman->jumlah }}</td>
                                <td>{{ $peminjaman->tgl_pinjam }}</td>
                                <td>{{ $peminjaman->tgl_kembali }}</td>
                                <td>{{ $peminjaman->jumlah }}</td>
                                <td>{{ $peminjaman->status }}</td>
                                <td>
                                    <a href="{{ route('dashboard.peminjaman.show', $peminjaman->id) }}"
                                        class="btn btn-sm btn-info"><i class="ti ti-eye"></i></a>
                                    <a href="{{ route('dashboard.peminjaman.edit', $peminjaman->id) }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger btn-delete"
                                        data-id="{{ $peminjaman->id }}">
                                        <form action="{{ route('dashboard.peminjaman.destroy', $peminjaman->id) }}"
                                            method="post" id="delete-{{ $peminjaman->id }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <i class="ti ti-trash"></i>
                                        </form>
                                    </a>
                                </td>

                                @if(Auth::user()->role == 'admin')
                                <td>
                                    {{-- make button confimation --}}
                                    @if ($peminjaman->status == 'pending')
                                    <a href="{{ route('dashboard.peminjaman.konfirmasi', $peminjaman->id) }}"
                                        class="btn btn-sm btn-success"><i class="ti ti-check"></i> Konfimasi</a>
                                    @else
                                    <a href="{{ route('dashboard.peminjaman.konfirmasi', $peminjaman->id) }}"
                                        class="btn btn-warning btn-sm"><i class="ti ti-check"></i>Batalkan Konfimasi</a>
                                    @endif
                                </td>
                                @else
                                <td>
                                    @if($peminjaman->status == 'konfirmasi')
                                        <a href="{{ route('dashboard.pengembalian.pengembalian', $peminjaman->id) }}"
                                            class="btn btn-primary w-100 btn-sm">
                                            <i class="ti ti-check"></i>
                                            Selesaikan pengembalian
                                        </a>
                                        @else

                                        @endif
                                </td>
                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-footer clearfix float-end">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{ $peminjamans->onEachSide(1)->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function () {

    });
</script>

@endpush
@endsection
