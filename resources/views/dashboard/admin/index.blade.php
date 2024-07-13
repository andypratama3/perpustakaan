@extends('layouts.dashboard.dashboard')
@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="pb-2">
            @include('layouts.dashboard.flashmessage')
          </div>
        <div class="card">
            <div class="card-body">
                <h4>Data Users </h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td><span class="{{ $user->role == 'admin' ? 'badge bg-primary' : 'badge badge-secondary' }}"></span>{{ $user->role == 'admin' ? 'Admin' : 'Member' }}</td>
                                <td>
                                    <a href="{{ route('dashboard.admin.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">
                                        <form action="{{ route('dashboard.admin.destroy', $user->id) }}" method="post" id="delete-{{ $user->id }}" method="POST" class="d-inline">
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
                            {{ $users->onEachSide(1)->links() }}
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
