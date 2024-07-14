<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Parpol;
use App\Models\JenisPelanggaran;
use App\Models\Pelanggaran;
use App\Models\SuratKerja;
use App\Models\LaporanPelanggaran;

class ReportController extends Controller
{
    public function printAllParpols()
    {
        $parpol = Parpol::withCount('pelanggaran')->get();
        
        $data = [
            'parpol' => $parpol,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Partai Politik'
        ];

        $report = PDF::loadView('parpols.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('Laporan Data Partai Politik '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllParpolsById($id)
    {
        $parpol = Parpol::withCount('pelanggaran')->where('id', $id)->get();
        
        $data = [
            'parpol' => $parpol,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Partai Politik'
        ];

        $report = PDF::loadView('parpols.printById', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('Laporan Data Per Partai Politik '.$nama_tgl.'_'.$nama_jam.'.pdf');        
    }

    public function printAllJenisPelanggarans()
    {
        $jenis = JenisPelanggaran::withCount('pelanggaran')->get();
        
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Jenis Pelanggaran'
        ];

        $report = PDF::loadView('jenispelanggarans.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('Laporan Data Jenis Pelanggaran '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllJenisPelanggaransById($id)
    {
        $jenis = JenisPelanggaran::withCount('pelanggaran')->where('id', $id)->get();
        
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Jenis Pelanggaran'
        ];

        $report = PDF::loadView('jenispelanggarans.printById', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('Laporan Data Per Jenis Pelanggaran '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllSuratKerjas()
    {
        $surat = SuratKerja::withCount('pelanggaran')->get();
        
        $data = [
            'surat' => $surat,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Surat Kerja'
        ];

        $report = PDF::loadView('suratkerja.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('Laporan Data Surat Kerja '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllSuratKerjasById($id)
    {
        $surat = SuratKerja::withCount('pelanggaran')->where('id', $id)->get();
        
        $data = [
            'surat' => $surat,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Surat Kerja'
        ];

        $report = PDF::loadView('suratkerja.printById', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('Laporan Data Surat Kerja '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllPelanggarans()
    {
        $pelanggaran = Pelanggaran::with(['parpol', 'jenisPelanggaran', 'suratKerja'])->get();
        
        $data = [
            'pelanggaran' => $pelanggaran,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Pelanggaran'
        ];

        $report = PDF::loadView('pelanggarans.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = date('dmY');
        $nama_jam = date('His');

        return $report->stream('Laporan Data Pelanggaran '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllPelanggaransById($id)
    {
        $pelanggaran = Pelanggaran::with(['parpol', 'jenisPelanggaran', 'pelanggaranImages', 'suratKerja'])->where('id', $id)->get();
       
        $data = [
            'pelanggaran' => $pelanggaran,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Pelanggaran'
        ];

        $report = PDF::loadView('pelanggarans.printById', $data)->setPaper('A4', 'landscape');
        $nama_tgl = date('dmY');
        $nama_jam = date('His');

        return $report->stream('Laporan Data Per Pelanggaran '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllLaporanPelanggaran()
    {
        $laporanPelanggarans = LaporanPelanggaran::with('pelanggaran.jenisPelanggaran', 'pelanggaran.parpol')->get();

        $data = [
            'laporanPelanggarans' => $laporanPelanggarans,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Laporan Pelanggaran'
        ];

        $report = PDF::loadView('laporanpelanggaran.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = date('dmY');
        $nama_jam = date('His');

        return $report->stream('Laporan Data Laporan Pelanggaran '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }

    public function printAllLaporanPelanggaranById($id)
    {
        $laporanPelanggarans = LaporanPelanggaran::with(['pelanggaran', 'province', 'regency', 'district', 'village'])
        ->where('id', $id)
        ->get();

        $data = [
            'laporanPelanggarans' => $laporanPelanggarans,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Laporan Pelanggaran'
        ];

        $report = PDF::loadView('laporanpelanggaran.printById', $data)->setPaper('A4', 'potrait');
        $nama_tgl = date('dmY');
        $nama_jam = date('His');

        return $report->stream('Laporan Data Per Laporan Pelanggaran '.$nama_tgl.'_'.$nama_jam.'.pdf');
    }
}
