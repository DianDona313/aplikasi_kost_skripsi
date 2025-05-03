<?php

namespace App\Http\Controllers;

use App\Models\JenisKost;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:penyewa-list|penyewa-create|penyewa-edit|penyewa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:penyewa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:penyewa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:penyewa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $penyewas = Penyewa::latest()->paginate(5);
        return view('penyewas.index', compact('penyewas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisKosts = JenisKost::all();
        return view('penyewas.create', compact('jenisKosts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:penyewas,email',
            'nohp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            // 'created_by'    => 'required|integer',
        ]);

        Penyewa::create($request->all());

        return redirect()->route('penyewas.index')
            ->with('success', 'Penyewa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd($id);
        $penyewa = Penyewa::findOrFail($id);
        // dd($penyewa);
        return view('penyewas.show', compact('penyewa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewa $penyewa)
    {
        // $penyewas = Penyewa::all(); 
        return view('penyewas.edit', compact('penyewa'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewa $penyewa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:penyewas,email,' . $penyewa->id,
            'nohp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            // 'updated_by'    => 'required|integer',
        ]);

        $penyewa->update($request->all());

        return redirect()->route('penyewas.index')
            ->with('success', 'Penyewa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewa $penyewa)
    {
        $penyewa->delete(); // SoftDeletes: tidak langsung menghapus dari database

        return redirect()->route('penyewas.index')
            ->with('success', 'Penyewa berhasil dihapus.');
    }

    /**
     * Restore a deleted penyewa.
     */
    public function restore($id)
    {
        Penyewa::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('penyewas.index')
            ->with('success', 'Penyewa berhasil dikembalikan.');
    }

    /**
     * Permanently delete the specified penyewa from database.
     */
    public function forceDelete($id)
    {
        Penyewa::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('penyewas.index')
            ->with('success', 'Penyewa dihapus secara permanen.');
    }
}
