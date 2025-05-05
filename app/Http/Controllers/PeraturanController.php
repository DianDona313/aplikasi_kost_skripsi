<?php

namespace App\Http\Controllers;

use App\Models\Peraturans;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeraturanController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:peraturan-list|peraturan-create|peraturan-edit|peraturan-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:peraturan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:peraturan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:peraturan-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Peraturans::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';

                if (auth()->user()->can('peraturan-edit')) {
                    $btn .= '<a href="' . route('peraturans.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                }

                if (auth()->user()->can('peraturan-delete')) {
                    $btn .= '<form action="' . route('peraturans.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus?\')">';
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

    return view('peraturans.index');
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
