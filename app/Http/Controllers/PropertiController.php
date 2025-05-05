<?php

namespace App\Http\Controllers;

use App\Models\JenisKost;
use App\Models\Properties;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PropertiController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:properti-list|properti-create|properti-edit|properti-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:properti-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:properti-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:properti-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Properties::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('properties.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <form action="' . route('properties.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                          </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('properties.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisKosts = JenisKost::all();
        return view('properties.create', compact('jenisKosts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'jeniskost_id' => 'required|exists:jeniskosts,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            // 'created_by' => 'required|integer',
        ]);

        // Upload Foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads', 'public');
        }

        Properties::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'jeniskost_id' => $request->jeniskost_id,
            'foto' => $fotoPath ?? "image",
            'deskripsi' => $request->deskripsi,
            'created_by' => $request->created_by,
            'updated_by' => 1,
            'deleted_by' => 1,
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
        return view('properties.show', compact('property', 'jenisKosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Properties $property)
    {
        $jenisKosts = JenisKost::all();
        return view('properties.edit', compact('property', 'jenisKosts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Properties $property)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'jeniskost_id' => 'required|exists:jeniskosts,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            // 'updated_by' => 'required|integer',
        ]);

        // Jika ada file baru, simpan
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads', 'public');
            $property->foto = $fotoPath;
        }

        $property->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'jeniskost_id' => $request->jeniskost_id,
            'deskripsi' => $request->deskripsi,
            'updated_by' => $request->updated_by,
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
