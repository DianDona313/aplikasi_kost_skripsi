<?php

namespace App\Http\Controllers;

use App\Models\JenisKost;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PenyewaController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:penyewa-list|penyewa-create|penyewa-edit|penyewa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:penyewa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:penyewa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:penyewa-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Penyewa::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('penyewas.show', $row->id) . '" class="btn btn-info btn-sm">Lihat</a> ';

                    if (auth()->user()->can('penyewa-edit')) {
                        $btn .= '<a href="' . route('penyewas.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                    }

                    if (auth()->user()->can('penyewa-delete')) {
                        $btn .= '<form action="' . route('penyewas.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus?\')">';
                        $btn .= csrf_field();
                        $btn .= method_field('DELETE');
                        $btn .= '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
                        $btn .= '</form>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('penyewas.index');
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
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['nama', 'email', 'nohp', 'alamat', 'jenis_kelamin']);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $path = $file->store('penyewas', 'public'); // simpan di folder penyewas
        $data['foto'] = $path;
    }

    Penyewa::create($data);

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
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  // validasi foto
    ]);

    // Ambil data kecuali foto dulu
    $data = $request->only(['nama', 'email', 'nohp', 'alamat', 'jenis_kelamin']);

    // Jika ada file foto baru, simpan dan update path foto
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada (opsional)
        if ($penyewa->foto) {
            \Storage::disk('public')->delete($penyewa->foto);
        }

        $file = $request->file('foto');
        $path = $file->store('penyewas', 'public'); // simpan ke storage/app/public/penyewas
        $data['foto'] = $path;
    }

    $penyewa->update($data);

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
