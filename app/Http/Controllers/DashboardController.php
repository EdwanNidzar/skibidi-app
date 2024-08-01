<?php

namespace App\Http\Controllers;

use App\Models\LaporanPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data grouped by status_peserta_pemilu and dapil
        $statusDapilData = Pelanggaran::select('status_peserta_pemilu', 'dapil')
            ->whereHas('laporanPelanggaran', function ($query) {
                $query->where('status', 'approved');
            })
            ->groupBy('status_peserta_pemilu', 'dapil')
            ->selectRaw('count(*) as total_pelanggaran')
            ->get();

        // Debugging: Log the retrieved data
        Log::info('Status Dapil Data:', $statusDapilData->toArray());

        // Organize data for chart
        $statusLabels = ['DPR RI', 'DPRD Provinsi', 'DPRD Kabupaten/Kota', 'DPD RI'];
        $dapilLabels = $statusDapilData->pluck('dapil')->unique();

        $chartData = [];
        foreach ($statusLabels as $status) {
            $chartData[$status] = $dapilLabels
                ->map(function ($dapil) use ($status, $statusDapilData) {
                    $data = $statusDapilData->where('status_peserta_pemilu', $status)->where('dapil', $dapil)->first();
                    return $data ? $data->total_pelanggaran : 0;
                })
                ->toArray();
        }

        // Debugging: Log the organized chart data
        Log::info('Chart Data:', $chartData);

        // Fetch other data for the dashboard as before
        $parpolData = Pelanggaran::select('parpol_id', 'jenis_pelanggaran_id')
            ->with(['parpol', 'jenisPelanggaran'])
            ->whereHas('laporanPelanggaran', function ($query) {
                $query->where('status', 'approved');
            })
            ->groupBy('parpol_id', 'jenis_pelanggaran_id')
            ->selectRaw('count(*) as total_pelanggaran')
            ->get();

        $jenisPelanggaranData = Pelanggaran::select('jenis_pelanggaran_id')
            ->with('jenisPelanggaran')
            ->whereHas('laporanPelanggaran', function ($query) {
                $query->where('status', 'approved');
            })
            ->groupBy('jenis_pelanggaran_id')
            ->selectRaw('count(*) as total_pelanggaran')
            ->get();

        $parpolLabels = $parpolData->map(function ($data) {
            preg_match('/\((.*?)\)/', $data->parpol->parpol_name, $matches);
            return $matches[1] ?? $data->parpol->parpol_name;
        });

        $parpolValues = $parpolData->map(function ($data) {
            return $data->total_pelanggaran;
        });

        $jenisPelanggaranLabels = $jenisPelanggaranData->map(function ($data) {
            return $data->jenisPelanggaran->jenis_pelanggaran;
        });

        $jenisPelanggaranValues = $jenisPelanggaranData->map(function ($data) {
            return $data->total_pelanggaran;
        });

        $locations = LaporanPelanggaran::with(['pelanggaran', 'pelanggaran.parpol', 'pelanggaran.jenisPelanggaran', 'pelanggaran.pelanggaranImages'])
            ->where('status', 'approved')
            ->get();

        return view('dashboard', compact('parpolLabels', 'parpolValues', 'jenisPelanggaranLabels', 'jenisPelanggaranValues', 'locations', 'statusLabels', 'dapilLabels', 'chartData'));
    }

    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
