<?php

namespace App\Http\Controllers;

use App\Models\JenisKost;
use App\Models\Properties;
use Illuminate\Http\Request;

class PropertiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Properties::latest()->paginate(5);
        return view('properties.index', compact('properties'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisKosts = JenisKost::all();
        return view('properties.create',compact('jenisKosts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required',
            'alamat'     => 'required',
            'kota'       => 'required',
            'jeniskost_id' => 'required|exists:jeniskosts,id',
            'foto'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'  => 'nullable|string',
            // 'created_by' => 'required|integer',
        ]);

        // Upload Foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads', 'public');
        }

        Properties::create([
            'nama'        => $request->nama,
            'alamat'      => $request->alamat,
            'kota'        => $request->kota,
            'jeniskost_id'=> $request->jeniskost_id,
            'foto'        => $fotoPath ?? "image",
            'deskripsi'   => $request->deskripsi,
            'created_by'  => $request->created_by,
            'updated_by'  => 1,
            'deleted_by'  => 1,
        ]);

        return redirect()
            ->route('properties.index')
            ->with('success', 'Properti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Properties $property)
    {
        $jenisKosts = JenisKost::all();
        return view('properties.show', compact('property','jenisKosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Properties $property)
    {
        $jenisKosts = JenisKost::all();
        return view('properties.edit',compact('property','jenisKosts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Properties $property)
    {
        $request->validate([
            'nama'       => 'required',
            'alamat'     => 'required',
            'kota'       => 'required',
            'jeniskost_id' => 'required|exists:jeniskosts,id',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'  => 'nullable|string',
            // 'updated_by' => 'required|integer',
        ]);

        // Jika ada file baru, simpan
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads', 'public');
            $property->foto = $fotoPath;
        }

        $property->update([
            'nama'        => $request->nama,
            'alamat'      => $request->alamat,
            'kota'        => $request->kota,
            'jeniskost_id'=> $request->jeniskost_id,
            'deskripsi'   => $request->deskripsi,
            'updated_by'  => $request->updated_by,
        ]);

        return redirect()->route('properties.index')
            ->with('success', 'Properti berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Properties $property)
    {
        $property->delete();
        return redirect()->route('properties.index')
            ->with('success', 'Properti berhasil dihapus.');
    }
}
