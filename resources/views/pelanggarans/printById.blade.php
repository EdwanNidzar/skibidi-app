<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>{{ $judul }}</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style type="text/css" media="print">
    @page {
      size: auto;
      margin: 0mm;
    }
  </style>
  <style>
    body {
      font-family: 'Calibri', sans-serif;
      padding: 15mm;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 24px;
      margin-top: 20px;
      text-align: center;
      text-transform: uppercase;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .table th,
    .table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    .table th {
      background-color: #f2f2f2;
      color: #333;
      text-align: center;
    }

    .table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .left-align {
      text-align: left;
    }

    .right-align {
      text-align: right;
    }

    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }

    .signature {
      float: right;
      width: 45%;
      text-align: center;
    }

    .signature p {
      margin: 0;
    }

    .signature p.name {
      margin-top: 60px;
      text-decoration: underline;
      font-weight: bold;
    }

    .image-container {
      display: block;
      margin-top: 10px;
    }

    .image-container img {
      display: inline-block;
      width: 48%;
      margin-right: 2%;
      margin-bottom: 10px;
      max-height: 150px;
      object-fit: cover;
    }

    .image-container img:nth-child(2n) {
      margin-right: 0;
    }
  </style>
</head>

<body>
  <section class="sheet">
    <!-- Header/Kop Surat -->
    <div class="header clearfix">

      <!-- Logo -->
      <img src="{{ public_path('images/logo-bawaslu.png') }}" alt="LOGO BAWASLU"
        style="width: 120px; height: auto; float: left; margin-right: 30px;">

      <!-- Informasi Organisasi -->
      <div class="left-align">
        <h2 style="margin: 0; font-size: 18px;"><b>Badan Pengawas Pemilihan Umum Provinsi Kalimantan Selatan</b></h2>
        <p style="margin: 5px 0;">Jl. RE Martadinata No.3, Kertak Baru Ilir, Kec. Banjarmasin Tengah,</p>
        <p style="margin: 5px 0;">Kota Banjarmasin, Kalimantan Selatan 70231</p>
        <p style="margin: 5px 0;">Telepon: (0511) 6726 437 | Email: set.kalsel@gmail.go.id</p>
      </div>
      <!-- Clearfix untuk mengatasi float -->
      <div style="clear: both;"></div>
      <hr style="border-top: 3px solid black; margin-top: 10px; margin-bottom: 10px;">
    </div>

    <h1>{{ $judul }}</h1>
    @foreach ($pelanggaran as $data)
      <table class="table">
        <tbody>
          <tr>
            <th>Nomor Surat Kerja</th>
            <td>{{ $data->suratKerja->nomor_surat_kerja }}</td>
          </tr>
          <tr>
            <th>Nama Partai</th>
            <td>{{ $data->parpol->parpol_name }}</td>
          </tr>
          <tr>
            <th>Jenis Pelanggaran</th>
            <td>{{ $data->jenisPelanggaran->jenis_pelanggaran }}</td>
          </tr>
          <tr>
            <th>Status Peserta Pemilu</th>
            <td>{{ $data->status_peserta_pemilu }}</td>
          </tr>
          <tr>
            <th>Nama Peserta Pemilu</th>
            <td>{{ $data->nama_bacaleg }}</td>
          </tr>
          <tr>
            <th>Daerah Pemilihan</th>
            <td>{{ $data->dapil }}</td>
          </tr>
          <tr>
            <th>Tanggal Input</th>
            <td>{{ $data->tanggal_input }}</td>
          </tr>
          <tr>
            <th>Keterangan</th>
            <td>{{ $data->keterangan }}</td>
          </tr>
          <tr>
            <th>Bukti Pendukung</th>
            <td>
              <div class="image-container">
                @foreach ($data->pelanggaranImages as $item)
                  <img src="{{ public_path('storage/pelanggarans/' . $item->image) }}" alt="Bukti Pendukung">
                @endforeach
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    @endforeach

    <div style="margin-top: 40px;" class="signature">
      <p>Banjarmasin, {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
      <p>Mengetahui</p>
      <p class="name">Aries Mardiono, M.Sos</p>
    </div>
  </section>
</body>

</html>
