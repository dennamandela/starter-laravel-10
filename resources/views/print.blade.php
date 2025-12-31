<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Bukti Pengeluaran</title>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        margin: 0;
        padding: 0;
    }

    @page {
        size: A4 portrait;
        margin: 7mm;
    }

    /* ===== CONTAINER SETENGAH A4 ===== */
    .container {
        width: 100%;
        height: 14.2cm;
        border: 1px solid #000;
        padding: 10px;
        box-sizing: border-box;
        page-break-inside: avoid;
    }

    .container:nth-child(2n) {
        page-break-after: always;
    }

    /* ===== HEADER ===== */
    .header {
        display: table;
        width: 100%;
        border-bottom: 2px solid #000;
        margin-bottom: 8px;
    }

    .header-left {
        display: table-cell;
        width: 70px;
        vertical-align: middle;
    }

    .logo {
        width: 80px;      /* sesuaikan */
        height: auto;
    }

    .header-right {
        display: table-cell;
        vertical-align: middle;
        font-size: 13px;
        line-height: 1.4;
    }

    /* ===== TITLE ===== */
    .bukti-wrapper {
        text-align: center;
        margin: 8px 0;
    }

    .bukti-title {
        display: inline-block;
        border: 2px solid #000;
        padding: 5px 25px;
        font-size: 18px;
        font-weight: bold;
    }

    .kas-bank {
        margin-top: 5px;
    }

    /* ===== INFO ===== */
    .info {
        display: table;
        width: 100%;
        margin-bottom: 6px;
    }

    .info-col {
        display: table-cell;
        width: 50%;
        vertical-align: top;
    }

    .row {
        margin-bottom: 5px;
    }

    .label {
        display: inline-block;
        width: 90px;
    }

    /* ===== TABLE ===== */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    th, td {
        border: 1px solid #000;
        padding: 4px 6px;
        font-size: 12.5px;
    }

    th {
        text-align: center;
    }

    .jumlah {
        text-align: center;
        vertical-align: middle;
    }

    .keterangan {
        text-align: center;
        vertical-align: middle;
        word-wrap: break-word;
    }

    /* ===== TERBILANG ===== */
    .terbilang {
        margin-top: 6px;
        font-size: 12.5px;
    }

    /* ===== FOOTER ===== */
    .footer {
        margin-top: 12px;
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .footer-row {
        display: table-row;
    }

    .sign, .keuangan {
        display: table-cell;
        border: 1px solid #000;
        font-size: 12px;
        padding: 5px;
        vertical-align: top;
    }

    .sign {
        width: 18%;
        height: 75px;
        text-align: center;
    }

    .keuangan {
        width: 28%;
    }
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="header-left">
            <img src="file://{{ public_path('images/images-removebg-preview.png') }}"
                class="logo"
                alt="Logo">
        </div>
        <div class="header-right">
            <strong>DPD PDI PERJUANGAN JAWA BARAT</strong><br>
            Sekretariat : Jl. Pelajar Pejuang 45 No. 1<br>
            Telp. 022-7300428 | Bandung
        </div>
    </div>

    <!-- TITLE -->
    <div class="bukti-wrapper">
        <div class="bukti-title">BUKTI PENGELUARAN</div>
        <div class="kas-bank">
            <input type="checkbox" {{ $voucher->payment_method === 'KAS' ? 'checked' : '' }}> KAS
            &nbsp;&nbsp;
            <input type="checkbox" {{ $voucher->payment_method === 'BANK' ? 'checked' : '' }}> BANK
        </div>
    </div>

    <!-- INFO -->
    <div class="info">
        <div class="info-col">
            <div class="row">
                <span class="label">Dibayarkan</span>:
                {{ $voucher->paid_to }}
            </div>
        </div>
        <div class="info-col">
            <div class="row">
                <span class="label">Nomor</span>:
                {{ $voucher->number }}
            </div>
            <div class="row">
                <span class="label">Tanggal</span>:
                {{ \Carbon\Carbon::parse($voucher->date)->format('d-m-Y') }}
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>KETERANGAN</th>
                <th>JUMLAH</th>
                <th>CATATAN</th>
            </tr>
        </thead>
        <tbody>
        @foreach($voucher->details as $detail)
        <tr style="height:36px">
            <td class="keterangan">{{ $detail->description }}</td>
            <td class="jumlah">
                Rp {{ number_format($detail->amount, 0, ',', '.') }}
            </td>
            <td>{{ $voucher->notes }}</td>
        </tr>
        @endforeach

        <tr>
            <td style="text-align:center;"><strong>Jumlah</strong></td>
            <td class="jumlah">
                <strong>Rp {{ number_format($voucher->total, 0, ',', '.') }}</strong>
            </td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <!-- TERBILANG (PINDAH KE SINI) -->
    <div class="terbilang">
        <strong>Terbilang :</strong>
        {{ terbilang($voucher->total) }} rupiah
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-row">
            <div class="sign">Diminta</div>
            <div class="sign">Diperiksa</div>
            <div class="sign">Disetujui</div>
            <div class="sign">Diterima</div>
            <div class="keuangan">
                <strong>Data Keuangan</strong><br>
                Bank : <br>
                A/C No : <br>
                No. Cek / BG : <br>
                Tgl JT : <br>
                Kasir :
            </div>
        </div>
    </div>

</div>

</body>
</html>
