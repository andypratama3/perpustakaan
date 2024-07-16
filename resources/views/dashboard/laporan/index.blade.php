@extends('layouts.dashboard.dashboard')
@section('title', 'Laporan')
@section('content')
    <!-- Row 1 -->
    <div class="row">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Unduh Laporan Peminjaman</h5>
              <form action="{{ route('dashboard.laporan.unduh') }}" method="post">
                @csrf
                <div class="mb-3">
                  <label for="month_start" class="form-label">Pilih Bulan Awal</label>
                  <input type="month" id="month_start" name="month_start" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="month_end" class="form-label">Pilih Bulan Akhir</label>
                  <input type="month" id="month_end" name="month_end" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">
                  <i class="ti ti-download"></i>
                  Unduh Laporan
                </button>
              </form>
            </div>
          </div>
    </div>
@endsection
