<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Parpol;
use App\Models\JenisPelanggaran;
use App\Models\Pelanggaran;
use App\Models\SuratKerja;
use App\Models\LaporanPelanggaran;
use Illuminate\Support\Facades\DB;

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
        $parpol = Parpol::withCount('pelanggaran')->where('id', $id)->first();
        
        $pelanggaran = DB::select(
            'SELECT 
                pelanggarans.nama_bacaleg,
                jenis_pelanggarans.jenis_pelanggaran AS "jenis_pelanggaran",
                parpols.parpol_name AS "parpol_name"
            FROM 
                pelanggarans
            JOIN 
                jenis_pelanggarans ON pelanggarans.jenis_pelanggaran_id = jenis_pelanggarans.id
            JOIN 
                parpols ON pelanggarans.parpol_id = parpols.id
            WHERE 
                pelanggarans.parpol_id = :id',
            ['id' => $id]
        );
        
        $data = [
            'parpol' => $parpol,
            'pelanggaran' => $pelanggaran,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Partai Politik'
        ];

        // $report = PDF::loadView('parpols.printById', $data)->setPaper('A4', 'potrait');
        $report = PDF::loadView('parpols.coba', $data)->setPaper('A4', 'potrait');

        $nama_tgl = date('dmY');
        $nama_jam = date('His');

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
        $surat = SuratKerja::with('assignTo')->withCount('pelanggaran')->where('id', $id)->first();

        $pelanggaran = DB::select(
            'SELECT 
                pelanggarans.nama_bacaleg,
                jenis_pelanggarans.jenis_pelanggaran,
                parpols.parpol_name,
                pelanggarans.status_peserta_pemilu
            FROM 
                pelanggarans
            JOIN 
                jenis_pelanggarans ON pelanggarans.jenis_pelanggaran_id = jenis_pelanggarans.id
            JOIN 
                parpols ON pelanggarans.parpol_id = parpols.id
            WHERE 
                pelanggarans.surat_kerja_id = :id',
            ['id' => $id]
        );
        
        $data = [
            'surat' => $surat,
            'pelanggaran' => $pelanggaran,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Surat Kerja'
        ];

        $report = PDF::loadView('suratkerja.coba', $data)->setPaper('A4', 'potrait');
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
        $pelapor = DB::select('SELECT surat_kerjas.nomor_surat_kerja, users.name
            FROM pelanggarans
            JOIN surat_kerjas ON pelanggarans.surat_kerja_id = surat_kerjas.id
            JOIN users ON pelanggarans.pelapor_id = users.id
            WHERE pelanggarans.id = :id', ['id' => $id]); 
            
        $pelapor = !empty($pelapor) ? $pelapor[0] : null;

        $data = [
            'pelanggaran' => $pelanggaran,
            'pelapor' => $pelapor,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Per Pelanggaran'
        ];

        $report = PDF::loadView('pelanggarans.printById', $data)->setPaper('A4', 'potrait');
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
