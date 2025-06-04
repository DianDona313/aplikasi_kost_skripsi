<?php

namespace App\Http\Controllers;

use App\Models\JenisKost;
use App\Models\Peraturans;
use App\Models\Properties;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use PhpParser\Builder\Property;
use Str;
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
        $userId = Auth::id(); // Ambil ID user yang sedang login

        $data = Properties::where('created_by', $userId)->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . url('/properties/' . urlencode($row->id)) . '" class="btn btn-info btn-sm">Detail</a>';
                $btn .= ' <a href="' . route('properties.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
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
        $peraturans = Peraturans::all();
        return view('properties.create', compact('jenisKosts', 'peraturans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'jeniskost_id' => 'required|exists:jeniskosts,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'peraturans' => 'nullable|array',
            'peraturans.*' => 'exists:peraturans,id',
        ]);

        // Upload foto ke storage
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads', 'public');
        }

        $peraturanIds = $request->peraturans; // array: ['1', '2']
        $peraturanString = implode(',', $peraturanIds); // hasil: "1,2"
        // Loop setiap peraturan dan buat entri properti
        Properties::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'jeniskost_id' => $request->jeniskost_id,
            'foto' => $fotoPath ?? 'default.jpg',
            'deskripsi' => $request->deskripsi,
            'peraturan_id' => $peraturanString,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
            'deleted_by' => null,
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
        $peraturan = Peraturans::all(); // Ambil semua peraturan

        // Ubah peraturan_id menjadi array
        $peraturanIds = explode(',', $property->peraturan_id);

        return view('properties.edit', compact('property', 'jenisKosts', 'peraturan', 'peraturanIds'));
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
    public function daftarkost()
    {
        // Ambil semua properti beserta rooms-nya
        $properties = Properties::with('rooms')->get();
        return view('daftarkost', compact('properties'));
    }

    // public function detailKost($id_properti)
    // {
    //     $properti = Properties::with('rooms')->where('id', $id_properti)->first();

    //     if (!$properti) {
    //         abort(404, 'Properti tidak ditemukan');
    //     }

    //     return view('detailkost', compact('properti'));
    // }

    public function detailKost($id_properti)
    {
        // Ambil properti lengkap dengan relasi: jenis kost dan kamar-kamarnya
        $properti = Properties::with(['jeniskost', 'rooms'])
            ->findOrFail($id_properti);

        $rooms = $properti->rooms;

        return view('detailkost', compact('properti', 'rooms'));
    }


}
