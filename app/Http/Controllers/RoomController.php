<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Properties;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Property;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{



    public function __construct()
    {
        $this->middleware('permission:room-list|room-create|room-edit|room-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:room-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:room-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:room-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        // dd($data);
        if ($request->ajax()) {
            $subQuery = Room::selectRaw('MIN(id) as id')
                ->groupBy('room_name');

            $data = Room::with('properti')->whereIn('id', $subQuery)->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    return $row->foto ?? '-';
                })
                ->addColumn('properti', function ($row) {
                    return $row->properti->nama ?? '-';
                })
                ->addColumn('is_available', function ($row) {
                    return $row->is_available
                        ? '<span class="badge bg-success">Tersedia</span>'
                        : '<span class="badge bg-danger">Tidak Tersedia</span>';
                })
                ->addColumn('harga', function ($row) {
                    // Periksa apakah harga tidak null dan merupakan angka
                    $harga = is_numeric($row->harga) ? $row->harga : 0; // Default ke 0 jika tidak valid
                    return 'Rp ' . number_format($harga, 0, ',', '.');
                    // return $row->harga;
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('/rooms/' . urlencode($row->id)) . '" class="btn btn-info btn-sm">Detail</a>';

                    if (auth()->user()->can('room-edit')) {
                        $btn .= ' <a href="' . route('rooms.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                    }

                    if (auth()->user()->can('room-delete')) {
                        $btn .= ' <form action="' . route('rooms.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus kamar ini?\')">';
                        $btn .= csrf_field();
                        $btn .= method_field('DELETE');
                        $btn .= '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
                        $btn .= '</form>';
                    }

                    return $btn;
                })
                ->rawColumns(['action', 'is_available', 'foto'])
                ->make(true);
        }

        return view('rooms.index');
    }

    /**
     * Menampilkan form untuk membuat kamar baru.
     */
    public function create()
    {
        $fasilitas = Fasilitas::all();
        $propertis = Properties::all();
        return view('rooms.create', compact('fasilitas', 'propertis'));
    }

    /**
     * Menyimpan data kamar baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'properti_id' => 'required|exists:properties,id',
            'room_name' => 'required|string|max:255',
            'room_deskription' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'is_available' => 'required|in:Ya,Tidak',
            'fasilitas' => 'required|array',
            'fasilitas.*' => 'exists:fasilitas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi foto
        ]);

        $data = $request->only(['properti_id', 'room_name', 'room_deskription', 'harga', 'is_available']);
        $data['created_by'] = 1;
        $data['updated_by'] = 1;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('rooms', 'public'); // simpan ke storage/app/public/rooms
            $data['foto'] = $path;
        } else {
            $data['foto'] = null; // atau bisa default foto
        }
        // dd($data);

        // Simpan untuk setiap fasilitas (jika fasilitas dipecah jadi satu record per baris)
        foreach ($request->fasilitas as $f) {
            Room::create([
                'properti_id' => $data['properti_id'],
                'room_name' => $data['room_name'],
                'room_deskription' => $data['room_deskription'],
                'harga' => $data['harga'],
                'is_available' => $data['is_available'],
                'fasilitas' => $f,
                'foto' => $data['foto'],
                'created_by' => $data['created_by'],
                'updated_by' => $data['updated_by'],
            ]);
        }

        return redirect()->route('rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan.');
    }



    /**
     * Menampilkan detail kamar tertentu.
     */
    public function show($id)
    {
        // Ambil ruangan berdasarkan ID (return 404 jika tidak ditemukan)
        $room = Room::findOrFail($id);

        // Ambil semua ruangan dengan nama yang sama (termasuk ruangan saat ini)
        $roomsWithSameName = Room::where('room_name', $room->room_name)->get();

        return view('rooms.show', [
            'room' => $room,
            'roomsWithSameName' => $roomsWithSameName
        ]);
    }

    /**
     * Menampilkan form edit kamar.
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Memperbarui data kamar.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'properti_id' => 'required|exists:propertis,id',
            'room_name' => 'required|string|max:255',
            'room_deskription' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'is_available' => 'required|in:yes,no',
            'fasilitas' => 'required|string',
        ]);

        $data = $request->all();
        $data['updated_by'] = Auth::id();

        $room->update($data);

        return redirect()->route('rooms.index')
            ->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) kamar.
     */
    public function destroy(Room $room)
    {
        $room->update(['deleted_by' => Auth::id()]);
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }

    /**
     * Mengembalikan data yang telah dihapus (restore).
     */
    public function restore($id)
    {
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->restore();

        return redirect()->route('rooms.index')
            ->with('success', 'Kamar berhasil dikembalikan.');
    }

    /**
     * Menghapus data secara permanen.
     */
    public function forceDelete($id)
    {
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->forceDelete();

        return redirect()->route('rooms.index')
            ->with('success', 'Kamar berhasil dihapus permanen.');
    }
    public function daftarKamar()
    {
        $rooms = Room::with('properti')->get();
        return view('daftarkamar', compact('rooms'));
    }

}
