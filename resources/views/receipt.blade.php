@extends('layouts.receipt')
@section('content')
<div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                      <div class="row w-100 align-items-center">
                          <div class="col-md-6">
                              <h3 class="card-title mb-0">Bon Pengeluaran</h3>
                          </div>
                          <div class="col-md-6 text-end">
                              <form action="{{ route('expense-voucher') }}" method="GET" class="d-inline-block">
                                  <div class="input-group input-group-sm" style="width: 280px;">
                                      <input type="text"
                                            name="search"
                                            class="form-control"
                                            placeholder="Cari nomor / nama / keterangan"
                                            value="{{ request('search') }}">
                                      <button class="btn btn-secondary" type="submit">
                                          <i class="bi bi-search"></i>
                                      </button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Nomor Bon</th>
                          <th>Tanggal</th>
                          <th>Dibayarkan Kepada</th>
                          <th>Metode (KAS / BANK)</th>
                          <th>Total</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($voucher as $row)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->number }}</td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->paid_to }}</td>
                            <td>{{ $row->payment_method }}</td>
                            <td>
                              Rp {{ number_format($row->total, 0, ',', '.') }}
                            </td>
                            <td class="text-nowrap">
    <!-- LIHAT / PREVIEW -->
    <a href="{{ route('expense-voucher.show', $row->id) }}"
       target="_blank"
       class="btn btn-sm btn-info"
       title="Lihat">
        <i class="bi bi-eye"></i>
    </a>

    <!-- UPDATE -->
    <a href="{{ route('expense-voucher.edit', $row->id) }}"
       class="btn btn-sm btn-warning"
       title="Ubah">
        <i class="bi bi-pencil-square"></i>
    </a>

    <!-- DELETE -->
    <form id="delete-form-{{ $row->id }}"
      action="{{ route('expense-voucher.destroy', $row->id) }}"
      method="POST"
      class="d-inline">
    @csrf
    @method('DELETE')

    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="confirmDelete({{ $row->id }})"
            title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</form>

    <!-- PRINT -->
    <a href="{{ route('expense-voucher.print', $row->id) }}"
       class="btn btn-sm btn-secondary"
       title="Print">
        <i class="bi bi-printer"></i>
    </a>
</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="7" class="text-center text-muted">
                              Belum ada data bon pengeluaran
                            </td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                      <div class="float-end">
                          {{ $voucher->appends(request()->query())->links('pagination::bootstrap-5') }}
                      </div>
                  </div>
                </div>
                <!-- /.card -->
                
                <!-- /.card -->
              </div>
            </div>
    </div>
</div>
@endsection