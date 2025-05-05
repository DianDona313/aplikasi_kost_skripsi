<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PengelolaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:pengelola-list|pengelola-create|pengelola-edit|pengelola-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:pengelola-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengelola-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengelola-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Pengelola::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto', function ($row) {
                return '<img src="' . asset('storage/' . $row->foto) . '" width="50">';
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('pengelolas.show', $row->id) . '" class="btn btn-info btn-sm">Detail</a> ';
                
                if (auth()->user()->can('pengelola-edit')) {
                    $btn .= '<a href="' . route('pengelolas.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                }

                if (auth()->user()->can('pengelola-delete')) {
                    $btn .= '<form action="' . route('pengelolas.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Hapus pengelola ini?\')">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
                    $btn .= '</form>';
                }

                return $btn;
            })
            ->rawColumns(['foto', 'action'])
            ->make(true);
    }

    return view('pengelolas.index');
}

    /**
     * Menampilkan form untuk membuat pengelola baru.
     */
    public function create()
    {
        return view('pengelolas.create');
    }

    /**
     * Menyimpan data pengelola baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp_pengelola' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengelola_fotos', 'public');
        }

        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();

        Pengelola::create($data);

        return redirect()->route('pengelolas.index')
            ->with('success', 'Pengelola berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengelola tertentu.
     */
    public function show(Pengelola $pengelola)
    {
        return view('pengelolas.show', compact('pengelola'));
    }

    /**
     * Menampilkan form edit pengelola.
     */
    public function edit(Pengelola $pengelola)
    {
        return view('pengelolas.edit', compact('pengelola'));
    }

    /**
     * Memperbarui data pengelola.
     */
    public function update(Request $request, Pengelola $pengelola)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp_pengelola' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengelola_fotos', 'public');
        }

        $data['updated_by'] = Auth::id();
        $pengelola->update($data);

        return redirect()->route('pengelolas.index')
            ->with('success', 'Pengelola berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) pengelola.
     */
    public function destroy(Pengelola $pengelola)
    {
        $pengelola->update(['deleted_by' => Auth::id()]);
        $pengelola->delete();

        return redirect()->route('pengelolas.index')
            ->with('success', 'Pengelola berhasil dihapus.');
    }

    /**
     * Mengembalikan data yang telah dihapus (restore).
     */
    public function restore($id)
    {
        $pengelola = Pengelola::onlyTrashed()->findOrFail($id);
        $pengelola->restore();

        return redirect()->route('pengelolas.index')
            ->with('success', 'Pengelola berhasil dikembalikan.');
    }

    /**
     * Menghapus data secara permanen.
     */
    public function forceDelete($id)
    {
        $pengelola = Pengelola::onlyTrashed()->findOrFail($id);
        $pengelola->forceDelete();

        return redirect()->route('pengelolas.index')
            ->with('success', 'Pengelola berhasil dihapus permanen.');
    }
}
