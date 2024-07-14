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
      /* auto is the initial value */
      margin: 0mm;
      /* this affects the margin in the printer settings */
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
      text-align: center;
      margin-top: 60px;
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
    <div class="header">
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
      <br>
      <hr style="border-top: 3px solid black; margin-top: 10px; margin-bottom: 10px;">
    </div>

    <h1 style="text-align: center;">{{ $judul }}</h1>
    @foreach ($laporanPelanggarans as $data)
      <table class="table">
        <tr>
          <th class="text-center align-middle">Nama Peserta Pemilu</th>
          <td class="text-center align-middle">{{ $data->pelanggaran->nama_bacaleg }}</td>
        </tr>
        <tr>
          <th class="text-center align-middle">Jenis Pelanggaran</th>
          <td class="text-center align-middle">{{ $data->pelanggaran->jenisPelanggaran->jenis_pelanggaran }}</td>
        </tr>
        <tr>
          <th class="text-center align-middle">Nama Partai</th>
          <td class="text-center align-middle">{{ $data->pelanggaran->parpol->parpol_name }}</td>
        </tr>
        <tr>
          <th class="text-center align-middle">Status Peserta Pemilu</th>
          <td class="text-center align-middle">{{ $data->pelanggaran->status_peserta_pemilu }}</td>
        </tr>
        <tr>
          <th class="text-center align-middle">Dapil</th>
          <td class="text-center align-middle">{{ $data->pelanggaran->dapil }}</td>
        </tr>
        <tr>
          <th class="text-center align-middle">Tempat</th>
          <td class="text-center align-middle">
            {{ $data->province->name }}, {{ $data->regency->name }}, {{ $data->district->name }},
            {{ $data->village->name }}
          </td>
        </tr>
        <tr>
          <th class="text-center align-middle">Tanggal</th>
          <td class="text-center align-middle">{{ $data->pelanggaran->tanggal_input }}</td>
        </tr>
        <tr>
          <th class="text-center align-middle">Keterangan</th>
          <td class="text-center align-middle">{{ $data->pelanggaran->keterangan }}</td>
        </tr>
        <tr>
          <th class="text-center align-middle">Status Verifikasi</th>
          <td class="text-center align-middle">
            @if ($data->status === 'pending')
              <span style="color: orange;">Belum Verif</span>
            @elseif ($data->status === 'approved')
              <span style="color: green;">Verif</span>
            @elseif ($data->status === 'rejected')
              <span style="color: red;">Reject</span>
            @endif
          </td>
        </tr>
        <tr>
          <th>Bukti Pendukung</th>
          <td>
            <div class="image-container">
              @foreach ($data->pelanggaran->pelanggaranImages as $item)
                <img src="{{ public_path('storage/pelanggarans/' . $item->image) }}" alt="Bukti Pendukung">
              @endforeach
            </div>
          </td>
        </tr>
      </table>
    @endforeach
    <div class="signature">
      <p>
        Banjarmasin,
        <?php
        // Array mapping English day names to Indonesian
        $dayNames = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];
        // Array mapping English month names to Indonesian
        $monthNames = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
        // Get current date and time
        $currentDate = date('l, d F Y');
        // Translate day and month names to Indonesian
        foreach ($dayNames as $english => $indonesian) {
            $currentDate = str_replace($english, $indonesian, $currentDate);
        }
        foreach ($monthNames as $english => $indonesian) {
            $currentDate = str_replace($english, $indonesian, $currentDate);
        }
        echo $currentDate;
        ?>
        <br>Mengetahui
      </p>
      <br>
      <br>
      <p>
        <b><u>Aries Mardiono, M.Sos</u></b>
      </p>
    </div>
  </section>

</body>

</html>
