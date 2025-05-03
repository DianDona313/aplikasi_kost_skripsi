<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Properties;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Property;

class RoomController extends Controller
{



    public function __construct()
    {
        $this->middleware('permission:room-list|room-create|room-edit|room-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:room-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:room-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:room-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $rooms = Room::select('*')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('rooms')
                    ->groupBy('room_name');
            })
            ->latest()
            ->paginate(5);
        return view('rooms.index', compact('rooms'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        ]);

        $data = $request->only(['properti_id', 'room_name', 'room_deskription', 'harga', 'is_available']);
        $data['created_by'] = 1;
        $data['updated_by'] = 1;

        // dd($request->fasilitas);
        $fasilitas = $request->fasilitas;
        for ($i = 0; $i < count($fasilitas); $i++) {
            $f = $fasilitas[$i];
            Room::create([
                'properti_id' => $data['properti_id'],
                'room_name' => $data['room_name'],
                'room_deskription' => $data['room_deskription'],
                'harga' => $data['harga'],
                'is_available' => $data['is_available'],
                'fasilitas' => $f,
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
}
