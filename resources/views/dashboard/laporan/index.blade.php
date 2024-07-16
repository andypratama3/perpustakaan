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
                <input type="hidden" name="csrf_test_name" value="cdf196f61e01725275b80bab0f5ac246">      <div class="mb-3">
                  <label for="month" class="form-label">Pilih Bulan</label>
                  <input type="month" id="month" name="month" class="form-control" required>
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
