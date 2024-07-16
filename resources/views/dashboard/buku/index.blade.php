@extends('layouts.dashboard.dashboard')
@section('title', 'Buku')
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
                        <h5 class="card-title fw-semibold mb-4">Data Buku</h5>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <div>
                                <form action="{{ route('dashboard.buku.index') }}" method="get">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="search" value=""
                                            placeholder="Cari buku" aria-label="Cari peminjaman"
                                            aria-describedby="searchButton">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="searchButton">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('dashboard.buku.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i>
                                    Tambah Buku
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered table-hover mt-4 text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sampul</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Rak</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukus as $buku)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td class="text-center"><a href="{{ asset('image/buku/'. $buku->image) }}" target="_blank"><img src="{{ asset('image/buku/'. $buku->image) }}" alt="" class="img-fluid" style="width: 120px;"></a></td>
                                <td>{{ $buku->name }}</td>
                                <td>{{ $buku->kategori->name }}</td>
                                <td>{{ $buku->rak }}</td>
                                <td>{{ $buku->stok }}</td>
                                <td>
                                    <a href="{{ route('dashboard.buku.edit', $buku->id) }}" class="btn btn-primary"><i class="ti ti-pencil"></i></a>
                                    <a href="#" class="btn btn-danger btn-delete" data-id="{{ $buku->id }}">
                                        <form action="{{ route('dashboard.buku.destroy', $buku->id) }}" method="post" id="delete-{{ $buku->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <i class="ti ti-trash"></i>
                                        </form>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-footer clearfix float-end">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{ $bukus->onEachSide(1)->links() }}
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
