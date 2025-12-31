@extends('layouts.edit')
@section('content')
<div class="app-content">
  <div class="container-fluid">
    <div class="row g-4">

      <form action="{{ route('expense-voucher.update', $voucher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ================= HEADER ================= -->
        <div class="col-md-12">
          <div class="card card-primary card-outline mb-4">
            <div class="card-header">
              <div class="card-title">Edit Bon Pengeluaran</div>
            </div>

            <div class="card-body">

              <div class="mb-3">
                <label class="form-label">Nomor Bon</label>
                <input type="text"
                      name="number"
                       class="form-control"
                       value="{{ $voucher->number }}"
                       readonly>
              </div>

              <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date"
                       name="date"
                       class="form-control"
                       value="{{ $voucher->date }}"
                       required>
              </div>

              <div class="mb-3">
                <label class="form-label">Dibayarkan Kepada</label>
                <input type="text"
                       name="paid_to"
                       class="form-control"
                       value="{{ $voucher->paid_to }}"
                       required>
              </div>

              <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-control">
                    <option value="KAS" {{ $voucher->payment_method=='KAS'?'selected':'' }}>Kas</option>
                    <option value="BANK" {{ $voucher->payment_method=='BANK'?'selected':'' }}>Bank</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="notes"
                          class="form-control"
                          rows="3">{{ $voucher->notes }}</textarea>
              </div>

            </div>
          </div>
        </div>

        <!-- ================= DETAIL ================= -->
        <div class="col-12">
          <div class="card card-success card-outline mb-4">
            <div class="card-header">
              <div class="card-title">Detail Pengeluaran</div>
            </div>

            <div class="card-body">
              <table class="table table-bordered" id="expenseTable">
                <thead>
                  <tr>
                    <th>Keterangan</th>
                    <th width="200">Jumlah (Rp)</th>
                    <th width="80">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($voucher->details as $i => $detail)
                <tr>
                <td>
                    <input type="text"
                        name="details[{{ $i }}][description]"
                        class="form-control"
                        value="{{ $detail->description }}"
                        required>
                </td>
                <td>
                    <input type="number"
                        name="details[{{ $i }}][amount]"
                        class="form-control amount"
                        value="{{ $detail->amount }}"
                        required>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm removeRow">❌</button>
                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
              <input type="hidden" name="total" id="totalInput">
              <br>
              <button type="button"
                      class="btn btn-outline-primary btn-sm"
                      id="addRow">
                + Tambah Baris
              </button>
            </div>

            <div class="card-footer text-end">
              <h5>Total: Rp <span id="totalText">0</span></h5>
            </div>
          </div>
        </div>

        <!-- ================= SUBMIT ================= -->
        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">
            Simpan Bon
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection