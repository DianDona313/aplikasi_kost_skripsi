<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Pengeluaran;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:kategori_pengeluarans-list|kategori_pengeluarans-create|kategori_pengeluarans-edit|kategori_pengeluarans-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kategori_pengeluarans-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kategori_pengeluarans-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kategori_pengeluarans-delete', ['only' => ['destroy']]);

    }
    public function index()
    {
        // Mengambil daftar kategori dengan pagination
        $kategoriPengeluarans = Kategori_Pengeluaran::latest()->paginate(10);

        // Kirim data ke view
        return view('kategori_pengeluarans.index', compact('kategoriPengeluarans'));
    }

    public function create()
    {
        return view('kategori_pengeluarans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            // 'created_by' => 'required|integer',
        ]);

        // Simpan data baru ke database
        Kategori_Pengeluaran::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'created_by' => $request->created_by,
            'updated_by' => $request->created_by, // Awalnya sama dengan created_by
        ]);

        return redirect()->route('kategori_pengeluarans.index')
            ->with('success', 'Kategori Pengeluaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Cari kategori berdasarkan ID
        $kategoriPengeluaran = Kategori_Pengeluaran::findOrFail($id);

        return view('kategori_pengeluarans.show', compact('kategoriPengeluaran'));
    }

    public function edit($id)
    {
        $kategoriPengeluaran = Kategori_Pengeluaran::findOrFail($id);
        $kategoripengeluaran = Kategori_Pengeluaran::all();
        return view('kategori_pengeluarans.edit', compact('kategoriPengeluaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            // 'updated_by' => 'required|integer',
        ]);

        // Ambil data kategori pengeluaran berdasarkan ID
        $kategoriPengeluaran = Kategori_Pengeluaran::findOrFail($id);

        // Update data kategori
        $kategoriPengeluaran->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()->route('kategori_pengeluarans.index')
            ->with('success', 'Kategori Pengeluaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriPengeluaran = Kategori_Pengeluaran::findOrFail($id);
        $kategoriPengeluaran->delete();

        return redirect()->route('kategori_pengeluarans.index')
            ->with('success', 'Kategori Pengeluaran berhasil dihapus.');
    }
}
