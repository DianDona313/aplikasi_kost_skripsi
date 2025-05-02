<?php

namespace App\Http\Controllers;

use App\Models\Peraturans;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    public function index()
    {
        $peraturans = Peraturans::latest()->paginate(10);
        return view('peraturans.index', compact('peraturans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('peraturans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'created_by' => 'nullable|integer',
        ]);

        Peraturans::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            // 'created_by' => $request->created_by,
        ]);

        return redirect()->route('peraturans.index')
            ->with('success', 'Peraturan berhasil ditambahkan.');
    }

    public function show(Peraturans $peraturan)
    {
        return view('peraturans.show', compact('peraturan'));
    }

    public function edit(Peraturans $peraturan)
    {
        return view('peraturans.edit', compact('peraturan'));
    }

    public function update(Request $request, Peraturans $peraturan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            // 'updated_by' => 'nullable|integer',
        ]);

        $peraturan->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()->route('peraturans.index')
            ->with('success', 'Peraturan berhasil diperbarui.');
    }

    public function destroy(Peraturans $peraturan)
    {
        $peraturan->delete();

        return redirect()->route('peraturans.index')
            ->with('success', 'Peraturan berhasil dihapus.');
    }
}
