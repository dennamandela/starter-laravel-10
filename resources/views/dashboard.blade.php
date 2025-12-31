@extends('layouts.index')

@section('content')
<div class="app-content">
  <div class="container-fluid">

    <!-- ================= TITLE ================= -->
    <div class="mb-4">
      <h3 class="fw-bold mb-0">Dashboard Keuangan</h3>
      <small class="text-muted">
        Sistem Administrasi Keuangan – Bon Pengeluaran
      </small>
    </div>

    <!-- ================= SUMMARY ================= -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Total Bon Bulan Ini</small>
          <h5 class="mb-0 fw-bold">
            #
          </h5>
        </div>
      </div>

      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Jumlah Bon</small>
          <h5 class="mb-0 fw-bold">{{ $countMonth }} Bon</h5>
        </div>
      </div>

      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Pengeluaran KAS</small>
          <h5 class="mb-0 fw-bold">
            Rp {{ number_format($totalKas, 0, ',', '.') }}
          </h5>
        </div>
      </div>

      <div class="col-md-3">
        <div class="border rounded p-3 bg-light">
          <small class="text-muted">Pengeluaran BANK</small>
          <h5 class="mb-0 fw-bold">
            Rp {{ number_format($totalBank, 0, ',', '.') }}
          </h5>
        </div>
      </div>
    </div>

    <!-- ================= AKSI CEPAT ================= -->
    <div class="mb-4 d-flex gap-2">
      <a href="{{ route('expense-voucher.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Bon
      </a>

      <a href="{{ route('expense-voucher') }}" class="btn btn-outline-secondary">
        <i class="bi bi-list"></i> Daftar Bon
      </a>
    </div>

    <!-- ================= AKTIVITAS TERAKHIR ================= -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Bon Pengeluaran Terakhir</h3>
      </div>

      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Nomor Bon</th>
              <th>Dibayarkan Kepada</th>
              <th>Metode</th>
              <th class="text-end">Total</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($latestVoucher as $row)
            <tr>
              <td>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
              <td>{{ $row->number }}</td>
              <td>{{ $row->paid_to }}</td>
              <td>{{ $row->payment_method }}</td>
              <td class="text-end">
                Rp {{ number_format($row->total, 0, ',', '.') }}
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center text-muted">
                Belum ada data bon pengeluaran
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection
