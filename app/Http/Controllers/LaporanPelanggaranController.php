<?php

namespace App\Http\Controllers;

use App\Models\LaporanPelanggaran;
use App\Models\Pelanggaran;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Notifications\LaporanPelanggaranCreated;
use App\Notifications\LaporanPelanggaranUpdated;
use App\Notifications\LaporanPelanggaranVerified;
use App\Notifications\LaporanPelanggaranRejected;

class LaporanPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('bawaslu-provinsi') || Auth::user()->hasRole('bawaslu-kabupaten-kota')) {
            $laporanPelanggarans = LaporanPelanggaran::with('pelanggaran.jenisPelanggaran', 'pelanggaran.parpol')->orderByDesc('id')->paginate(10);

            return view('laporanpelanggaran.index', compact('laporanPelanggarans'));
        } else {
            $laporanPelanggarans = LaporanPelanggaran::with('pelanggaran.jenisPelanggaran', 'pelanggaran.parpol')
                ->where('assign_by', Auth::user()->id)
                ->orderByDesc('id')
                ->paginate(10);

            return view('laporanpelanggaran.index', compact('laporanPelanggarans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mendapatkan ID dari pengguna yang sedang terautentikasi
        $id = auth()->id();

        $pelanggarans = Pelanggaran::with(['parpol', 'jenisPelanggaran', 'pelanggaranImages'])
            ->where('pelapor_id', $id)
            ->get();
        $provinces = Province::all();
        return view('laporanpelanggaran.create', compact(['pelanggarans', 'provinces']));
    }

    public function getRegency($province_id)
    {
        $regencies = Regency::where('province_id', $province_id)->get();
        return response()->json($regencies);
    }

    public function getDistricts($regency_id)
    {
        $districts = District::where('regency_id', $regency_id)->get();
        return response()->json($districts);
    }

    public function getVillages($district_id)
    {
        $villages = Village::where('district_id', $district_id)->get();
        return response()->json($villages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggaran_id' => 'required',
            'alamat' => 'required',
            'provinsi_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $laporan = new LaporanPelanggaran();
            $laporan->pelanggaran_id = $request->pelanggaran_id;
            $laporan->address = $request->alamat;
            $laporan->province_id = $request->provinsi_id;
            $laporan->regency_id = $request->regency_id;
            $laporan->district_id = $request->district_id;
            $laporan->village_id = $request->village_id;
            $laporan->latitude = $request->latitude;
            $laporan->longitude = $request->longitude;
            $laporan->assign_by = Auth::user()->id;

            if ($laporan->save()) {
                // Temukan semua pengguna dengan peran 'bawaslu-kabupaten-kota'
                $users = User::whereHas('roles', function ($query) {
                    $query->where('name', 'bawaslu-kabupaten-kota');
                })->get();

                // Kirim notifikasi ke setiap pengguna
                foreach ($users as $user) {
                    $user->notify(new LaporanPelanggaranCreated($laporan));
                }

                DB::commit();

                return redirect()->route('laporanpelanggarans.index')->with('success', 'Laporan berhasil disimpan');
            } else {
                DB::rollBack();
                return redirect()->route('laporanpelanggarans.index')->with('error', 'Laporan gagal disimpan');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('laporanpelanggarans.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporanPelanggaran = LaporanPelanggaran::with(['pelanggaran', 'province', 'regency', 'district', 'village'])
            ->where('id', $id)
            ->first();
        return view('laporanpelanggaran.show', compact('laporanPelanggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mendapatkan ID dari pengguna yang sedang terautentikasi
        $pelapor_id = auth()->id();

        $laporanPelanggaran = LaporanPelanggaran::with(['pelanggaran', 'province', 'regency', 'district', 'village'])
            ->where('id', $id)
            ->first();

        $pelanggarans = $pelanggarans = Pelanggaran::with(['parpol', 'jenisPelanggaran', 'pelanggaranImages'])
            ->where('pelapor_id', $pelapor_id)
            ->get();

        $provinces = Province::all();
        $regencies = Regency::where('province_id', $laporanPelanggaran->province_id)->get();
        $districts = District::where('regency_id', $laporanPelanggaran->regency_id)->get();
        $villages = Village::where('district_id', $laporanPelanggaran->district_id)->get();

        return view('laporanpelanggaran.edit', compact('laporanPelanggaran', 'pelanggarans', 'provinces', 'regencies', 'districts', 'villages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pelanggaran_id' => 'required',
            'alamat' => 'required',
            'provinsi_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Create a new instance of LaporanPelanggaran
            $laporan = LaporanPelanggaran::find($id);

            // Assign validated data to the model
            $laporan->pelanggaran_id = $request->pelanggaran_id;
            $laporan->address = $request->alamat;
            $laporan->province_id = $request->provinsi_id;
            $laporan->regency_id = $request->regency_id;
            $laporan->district_id = $request->district_id;
            $laporan->village_id = $request->village_id;
            $laporan->latitude = $request->latitude;
            $laporan->longitude = $request->longitude;
            $laporan->status = 'pending';
            $laporan->assign_by = Auth::user()->id;

            if ($laporan->save()) {
                // Find all users with the role 'bawaslu-kabupaten-kota'
                $users = User::whereHas('roles', function ($query) {
                    $query->where('name', 'bawaslu-kabupaten-kota');
                })->get();

                // Notify each user
                foreach ($users as $user) {
                    $user->notify(new LaporanPelanggaranUpdated($laporan));
                }

                DB::commit();

                return redirect()->route('laporanpelanggarans.index')->with('success', 'Laporan berhasil diperbarui');
            } else {
                DB::rollBack();
                return redirect()->route('laporanpelanggarans.index')->with('error', 'Laporan gagal diperbarui');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('laporanpelanggarans.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporanPelanggaran = LaporanPelanggaran::find($id);

        if ($laporanPelanggaran->delete()) {
            return redirect()->route('laporanpelanggarans.index')->with('success', 'Laporan berhasil dihapus');
        } else {
            return redirect()->route('laporanpelanggarans.index')->with('error', 'Laporan gagal dihapus');
        }
    }

    /**
     * Verify the specified resource.
     */
    public function verify(string $id)
    {
        DB::beginTransaction();

        try {
            // Find the report by ID
            $verif = LaporanPelanggaran::findOrFail($id);

            // Update the status and verifier
            $verif->status = 'approved';
            $verif->verif_by = Auth::user()->id;

            if ($verif->save()) {
                // Notify the user who assigned the report
                $user = $verif->assignedBy;
                if ($user) {
                    $user->notify(new LaporanPelanggaranVerified($verif));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('laporanpelanggarans.index')->with('success', 'Laporan berhasil diverifikasi');
            } else {
                // Rollback if saving the report failed
                DB::rollBack();
                return redirect()->route('laporanpelanggarans.index')->with('error', 'Laporan gagal diverifikasi');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('laporanpelanggarans.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Reject the specified resource.
     */
    public function reject(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Find the report by ID
            $verif = LaporanPelanggaran::findOrFail($id);

            // Update the status, note, and verifier
            $verif->status = 'rejected';
            $verif->note = $request->note;
            $verif->verif_by = Auth::user()->id;

            if ($verif->save()) {
                // Notify the user who assigned the report
                $user = $verif->assignedBy;
                if ($user) {
                    $user->notify(new LaporanPelanggaranRejected($verif));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('laporanpelanggarans.index')->with('success', 'Laporan berhasil direject');
            } else {
                // Rollback if saving the report failed
                DB::rollBack();
                return redirect()->route('laporanpelanggarans.index')->with('error', 'Laporan gagal direject');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('laporanpelanggarans.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
