<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\SuratKerjaAssigned;

class SuratKerjaContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratKerjas = SuratKerja::with('assignBy', 'assignTo')
        ->withCount('pelanggaran')
        ->orderBy('id', 'asc')->paginate(10);
        return view('suratkerja.index', compact('suratKerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nomorSuratKerja = SuratKerja::generateNomorSuratKerja();
        $userAssignTo = User::role('panwaslu-kecamatan')->get();
        return view('suratkerja.create', compact('nomorSuratKerja', 'userAssignTo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomorSuratKerja' => 'required',
            'assign_to_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $surat = new SuratKerja();
            $surat->nomor_surat_kerja = $request->nomorSuratKerja;
            $surat->assign_by = Auth::user()->id;
            $surat->assign_to = $request->assign_to_id;

            if ($surat->save()) {
                // Kirim notifikasi ke pengguna yang ditugaskan
                $userAssigned = User::find($request->assign_to_id);
                $userAssigned->notify(new SuratKerjaAssigned($surat));

                // Commit transaksi
                DB::commit();

                return redirect()->route('suratkerjas.index')->with('success', 'Surat Kerja berhasil dibuat');
            } else {
                // Rollback jika penyimpanan gagal
                DB::rollBack();
                return redirect()->route('suratkerjas.index')->with('error', 'Surat Kerja gagal dibuat');
            }
        } catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            return redirect()
                ->route('suratkerjas.index')
                ->with('error', 'Surat Kerja gagal dibuat: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suratKerjas = SuratKerja::with('assignBy', 'assignTo')->where('id', $id)->orderBy('id', 'asc')->first();
        return view('suratkerja.show', compact('suratKerjas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suratKerjas = SuratKerja::with('assignBy', 'assignTo')->where('id', $id)->orderBy('id', 'asc')->first();
        $userAssignTo = User::role('panwaslu-kecamatan')->get();
        return view('suratkerja.edit', compact('suratKerjas', 'userAssignTo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomorSuratKerja' => 'required',
            'assign_to_id' => 'required',
        ]);

        try {
            $surat = SuratKerja::find($id);
            $surat->nomor_surat_kerja = $request->nomorSuratKerja;
            $surat->assign_by = Auth::user()->id;
            $surat->assign_to = $request->assign_to_id;

            if ($surat->save()) {
                return redirect()->route('suratkerjas.index')->with('success', 'Surat Kerja berhasil diubah');
            } else {
                return redirect()->route('suratkerjas.index')->with('error', 'Surat Kerja gagal diubah');
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('suratkerjas.index')
                ->with('error', 'Surat Kerja gagal diubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $surat = SuratKerja::find($id);
            if ($surat->delete()) {
                return redirect()->route('suratkerjas.index')->with('success', 'Surat Kerja berhasil dihapus');
            } else {
                return redirect()->route('suratkerjas.index')->with('error', 'Surat Kerja gagal dihapus');
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('suratkerjas.index')
                ->with('error', 'Surat Kerja gagal dihapus: ' . $e->getMessage());
        }
    }

    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
