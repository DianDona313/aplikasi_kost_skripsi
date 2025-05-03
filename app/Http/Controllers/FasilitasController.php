<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    
    public function __construct()
{
    $this->middleware('permission:fasilitas-list|fasilitas-create|fasilitas-edit|fasilitas-delete', ['only' => ['index','show']]);
    $this->middleware('permission:fasilitas-create', ['only' => ['create','store']]);
    $this->middleware('permission:fasilitas-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:fasilitas-delete', ['only' => ['destroy']]);
}
    
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(10);
        return view('fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            // 'created_by' => 'required|integer',
        ]);

        Fasilitas::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function show(Fasilitas $fasilita)
    {
        return view('fasilitas.show', compact('fasilita'));
    }

    public function edit(Fasilitas $fasilita)
    {
        return view('fasilitas.edit', compact('fasilita'));
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            // 'updated_by' => 'required|integer',
        ]);

        $fasilita->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $fasilita->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
