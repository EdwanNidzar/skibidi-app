<?php

namespace App\Http\Controllers;

use App\Models\Parpol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ParpolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parpols = Parpol::withCount('pelanggaran')->paginate(5);
        return view('parpols.index', compact('parpols'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('parpols.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'parpol_number' => 'required|numeric',
            'parpol_name' => 'required',
            'parpol_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload image
        $image = $request->file('parpol_picture');
        $image->storeAs('public/parpols', $image->hashName());

        // Create new Parpol instance
        $parpol = new Parpol();
        $parpol->parpol_number = $request->parpol_number;
        $parpol->parpol_name = $request->parpol_name;
        $parpol->parpol_picture = $image->hashName();

        // Save the Parpol instance
        if ($parpol->save()) {
            return redirect()->route('parpols.index')->with('success', 'Data parpol berhasil ditambahkan');
        } else {
            return redirect()->route('parpols.index')->with('error', 'Data parpol gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $parpol = Parpol::findOrFail($id);
        return view('parpols.show', compact('parpol'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $parpol = Parpol::findOrFail($id);
        return view('parpols.edit', compact('parpol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $parpol = Parpol::findOrFail($id);

        $request->validate([
            'parpol_number' => 'required|numeric',
            'parpol_name' => 'required',
            'parpol_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('parpol_picture')) {
            // Delete old image
            Storage::disk('public')->delete('parpols/' . $parpol->parpol_picture);

            // Upload new image
            $image = $request->file('parpol_picture');
            $image->storeAs('public/parpols', $image->hashName());
            $parpol->parpol_picture = $image->hashName();
        }

        $parpol->parpol_number = $request->parpol_number;
        $parpol->parpol_name = $request->parpol_name;

        // Save the updated Parpol instance
        if ($parpol->save()) {
            return redirect()->route('parpols.index')->with('success', 'Data parpol berhasil diubah');
        } else {
            return redirect()->route('parpols.index')->with('error', 'Data parpol gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $parpol = Parpol::findOrFail($id);

        // Delete image
        Storage::disk('public')->delete('parpols/' . $parpol->parpol_picture);

        // Delete the Parpol instance
        if ($parpol->delete()) {
            return redirect()->route('parpols.index')->with('success', 'Data parpol berhasil dihapus');
        } else {
            return redirect()->route('parpols.index')->with('error', 'Data parpol gagal dihapus');
        }
    }

    public function pelanggaran($id)
    {
        $parpol = Parpol::findOrFail($id);
        $pelanggarans = $parpol->pelanggaran()->paginate(5);

        return view('pelanggarans.index', compact('parpol', 'pelanggarans'));
    }

}
