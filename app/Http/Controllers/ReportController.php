<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Parpol;
use App\Models\JenisPelanggaran;

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
}
