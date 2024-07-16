@extends('layouts.dashboard.dashboard')
@section('title', 'Kategori')
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
                        <h5 class="card-title fw-semibold mb-4">Data Member</h5>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <div>
                                <form action="{{ route('dashboard.member.index') }}" method="get">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="search" value=""
                                            placeholder="Cari Member" aria-label="Cari peminjaman"
                                            aria-describedby="searchButton">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="searchButton">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('dashboard.member.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i>
                                    Tambah Member
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->user->email }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->gender }}</td>
                                <td>
                                    <a href="{{ route('dashboard.member.edit', $member->id) }}" class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $member->id }}">
                                        <form action="{{ route('dashboard.member.destroy', $member->id) }}" method="post" id="delete-{{ $member->id }}" method="POST" class="d-inline">
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
                            {{ $members->onEachSide(1)->links() }}
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
