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
                <h4>Data Kategori <a href="{{ route('dashboard.kategori.create') }}" class="btn btn-primary btn-sm float-end"><i class="ti ti-plus"></i>Tambah Kategori</a></h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $kategori)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $kategori->name }}</td>
                                <td>
                                    <a href="{{ route('dashboard.kategori.edit', $kategori->id) }}" class="btn btn-primary"><i class="ti ti-pencil"></i></a>
                                    <a href="#" class="btn btn-danger btn-delete" data-id="{{ $kategori->id }}">
                                        <form action="{{ route('dashboard.kategori.destroy', $kategori->id) }}" method="post" id="delete-{{ $kategori->id }}" method="POST" class="d-inline">
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
                            {{ $kategoris->onEachSide(1)->links() }}
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
