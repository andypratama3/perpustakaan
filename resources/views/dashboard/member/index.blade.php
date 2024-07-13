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
                <h4>Data Member <a href="{{ route('dashboard.member.create') }}" class="btn btn-primary btn-sm float-end"><i class="ti ti-plus"></i>Tambah Data</a></h4>

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
