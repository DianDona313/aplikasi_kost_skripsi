<?php

namespace App\Http\Controllers;

use App\Models\JenisKost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class JenisKostController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:jeniskost-list|jeniskost-create|jeniskost-edit|jeniskost-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:jeniskost-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:jeniskost-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:jeniskost-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisKost::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('jeniskosts.show', $row->id) . '" class="edit btn btn-info btn-sm">Show</a> ';
                
                    if (Auth::user()->can('jeniskost-edit')) {
                        $btn .= '<a href="' . route('jeniskosts.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a> ';
                    }
                
                    if (Auth::user()->can('jeniskost-destroy')) {
                        $btn .= '<form action="' . route('jeniskosts.destroy', $row->id) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . method_field("DELETE") . '
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                 </form>';
                    }
                
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('jeniskosts.index');
    }

    public function create()
    {
        return view('jeniskosts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // 'deskripsi' => 'nullable|string',
        ]);

        JenisKost::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('jeniskosts.index')
            ->with('success', 'Jenis Kost berhasil ditambahkan.');
    }

    public function show(JenisKost $jeniskost)
    {
        return view('jeniskosts.show', compact('jeniskost'));
    }

    public function edit(JenisKost $jeniskost)
    {
        return view('jeniskosts.edit', compact('jeniskost'));
    }

    public function update(Request $request, JenisKost $jeniskost)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // 'deskripsi' => 'nullable|string',
            // 'updated_by' => 'required|integer',
        ]);

        $jeniskost->update($request->all());

        return redirect()->route('jeniskosts.index')
            ->with('success', 'Jenis Kost berhasil diperbarui.');
    }

    public function destroy(JenisKost $jeniskost)
    {
        $jeniskost->delete();
        return redirect()->route('jeniskosts.index')
            ->with('success', 'Jenis Kost berhasil dihapus.');
    }
}
