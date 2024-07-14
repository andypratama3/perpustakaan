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
                                <a href="{{ route('dashboard.pengembalian.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i>
                                    Tambah Peminjaman
                                </a>
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
                                <th>Tanggal Peminjaman</th>
                                <th>Tenggat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                @if(Auth::user()->role == 'admin')
                                <th>Konfirmasi / Batalkan Pengembalian</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $peminjaman->peminjaman->member->name }}</td>
                                <td>{{ $peminjaman->peminjaman->buku->name }}</td>
                                <td>{{ $peminjaman->tgl_pinjam }}</td>
                                <td>{{ $peminjaman->tgl_kembali }}</td>
                                <td>{{ $peminjaman->status }}</td>
                                <td>
                                    <a href="{{ route('dashboard.pengembalian.show', $peminjaman->id) }}"
                                        class="btn btn-sm btn-info"><i class="ti ti-eye"></i></a>
                                    <a href="{{ route('dashboard.pengembalian.edit', $peminjaman->id) }}"
                                        class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger btn-delete"
                                        data-id="{{ $peminjaman->id }}">
                                        <form action="{{ route('dashboard.pengembalian.destroy', $peminjaman->id) }}"
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
                                    @if ($peminjaman->status == 'Dikembalikan')
                                    <a href="{{ route('dashboard.pengembalian.konfirmasi', $peminjaman->id) }}"
                                        class="btn btn-sm btn-success"><i class="ti ti-check"></i> Konfimasi</a>
                                    @else
                                    <a href="{{ route('dashboard.pengembalian.konfirmasi', $peminjaman->id) }}"
                                        class="btn btn-warning btn-sm"><i class="ti ti-check"></i>Batalkan Konfimasi</a>
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
