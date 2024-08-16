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
      text-decoration: underline;
      margin-top: 20px;
    }

    .table {
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      font: normal 13px Arial, sans-serif;
      width: 100%;
      margin-top: 20px;
    }

    .table thead th {
      background-color: #DDEFEF;
      border: solid 1px #DDEEEE;
      color: #336B6B;
      padding: 10px;
      text-align: left;
      text-shadow: 1px 1px 1px #fff;
    }

    .table tbody td {
      border: solid 1px #DDEEEE;
      color: #333;
      padding: 10px;
      text-shadow: 1px 1px 1px #fff;
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

    <h1 style="text-align: center;">{{ $judul }}</h1>

    <p>Berdasarkan Nomor Surat: <b><u>{{ $pelapor->nomor_surat_kerja }}</u></b>, saya
      <b><u>{{ $pelapor->name }}</u></b>, sebagai pelapor dari Panwascam, dengan ini melaporkan adanya dugaan
      pelanggaran kampanye yang terjadi pada:
    </p>

    @foreach ($pelanggaran as $data)
      <table class="table">
        <tbody>
          <tr>
            <th>Tanggal Pelanggaran</th>
            <td>:</td>
            <td>{{ $data->tanggal_input }}</td>
          </tr>
          <tr>
            <th>Nama Peserta Pemilu</th>
            <td>:</td>
            <td>{{ $data->nama_bacaleg }}</td>
          </tr>
          <tr>
            <th>Dari Partai</th>
            <td>:</td>
            <td>{{ $data->parpol->parpol_name }}</td>
          </tr>
          <tr>
            <th>Jenis Pelanggaran</th>
            <td>:</td>
            <td>{{ $data->jenisPelanggaran->jenis_pelanggaran }}</td>
          </tr>
          <tr>
            <th>Status Peserta Pemilu</th>
            <td>:</td>
            <td>{{ $data->status_peserta_pemilu }}</td>
          </tr>
          <tr>
            <th>Daerah Pemilihan</th>
            <td>:</td>
            <td>{{ $data->dapil }}</td>
          </tr>
          <tr>
            <th>Keterangan</th>
            <td>:</td>
            <td>{{ $data->keterangan }}</td>
          </tr>
          <tr>
            <th>Bukti Pendukung</th>
            <td>:</td>
            <td>
                @foreach ($data->pelanggaranImages as $item)
                  <img src="{{ public_path('storage/pelanggarans/' . $item->image) }}" alt="Bukti Pendukung" style="max-width: 50%; max-height: 50%;">
                @endforeach
            </td>
          </tr>
        </tbody>
      </table>
    @endforeach

    <p>Sebagai pelapor, kami menyerahkan bukti-bukti terlampir di atas dan meminta kepada pihak yang berwenang untuk melakukan investigasi lebih lanjut serta mengambil tindakan sesuai dengan peraturan yang berlaku.</p>

    <p>Demikian laporan ini dibuat dengan sebenar-benarnya dan dapat digunakan sebagaimana mestinya.</p>

    <div style="margin-top: 20px;">
      <div class="left-align" style="float: right; width: 45%;">
        <p>
          Banjarmasin,
          <?php
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
          $currentDate = date('d F Y');
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
