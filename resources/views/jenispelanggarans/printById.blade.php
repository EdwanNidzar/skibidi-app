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
      font-family: Calibri, sans-serif;
    }

    .sheet {
      padding: 15mm;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 18px;
      margin-top: 20px;
    }

    .table {
      background-color: transparent;
      /* Membuat latar belakang tabel menjadi transparan */
      font: normal 13px Arial, sans-serif;
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      /* Menghilangkan batas antar sel */
    }

    .table th,
    .table td {
      border: none;
      /* Menghilangkan batas pada sel */
      padding: 10px;
      text-align: center;
      text-shadow: 1px 1px 1px #fff;
    }

    .table thead th {
      background-color: #DDEFEF;
      color: #336B6B;
    }

    .table tbody tr:nth-child(even) {
      background-color: rgba(221, 238, 239, 0.5);
      /* Memberi warna latar belakang transparan untuk baris-genap */
    }

    .table tbody tr:nth-child(odd) {
      background-color: rgba(221, 238, 239, 0.3);
      /* Memberi warna latar belakang transparan untuk baris-ganjil */
    }

    .left-align {
      text-align: left;
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

    <h1 style="text-align: center;">LAPORAN DATA PARTAI POLITIK</h1>
    <?php foreach ($jenis as $data) : ?>
    <table class="table">
      <tr>
        <th class="text-center align-middle">Jenis Pelanggaran</th>
        <td class="text-center align-middle"><?php echo $data->jenis_pelanggaran; ?></td>
      </tr>
      <tr>
        <th class="text-center align-middle">Jumlah Pelanggaran</th>
        <td class="text-center align-middle"><?php echo $data->pelanggaran_count; ?></td>
      </tr>
    </table>
    <?php endforeach; ?>
    <div style="margin-top: 20px;">
      <div class="left-align" style="float: right; width: 45%;">
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
        <p class="left-align">
          <b><u>Aries Mardiono, M.Sos</u></b>
        </p>
      </div>
    </div>
  </section>

</body>

</html>
