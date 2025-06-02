<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Penyewa;
use App\Models\Properti;
use App\Models\Properties;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:booking-list|booking-create|booking-edit|booking-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:booking-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:booking-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:booking-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::latest()->get(); // Ambil data booking

            return DataTables::of($data)
                ->addIndexColumn() // Menambahkan kolom index
                ->addColumn('properti', function ($row) {
                    return $row->property->nama ?? 'Tidak Diketahui';
                })
                ->addColumn('penyewa', function ($row) {
                    return $row->penyewa->nama ?? 'Tidak Diketahui';
                })
                ->addColumn('kamar', function ($row) {
                    return $row->room->room_name ?? 'Tidak Diketahui';
                })
                ->addColumn('periode', function ($row) {
                    return $row->start_date . ' - ' . $row->end_date;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'confirmed') {
                        return '<span class="badge bg-success">Terkonfirmasi</span>';
                    } elseif ($row->status == 'pending') {
                        return '<span class="badge bg-warning">Menunggu</span>';
                    } else {
                        return '<span class="badge bg-danger">Dibatalkan</span>';
                    }
                })
                ->addColumn('aksi', function ($row) {
                    $edit = '';
                    $delete = '';

                    if (auth()->user()->can('booking-edit')) {
                        $edit = '<a href="' . route('bookings.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                    }

                    if (auth()->user()->can('booking-delete')) {
                        $delete = '
                        <form action="' . route('bookings.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus booking ini?\');">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>';
                    }

                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['status', 'aksi']) // Menandakan kolom yang berisi HTML raw
                ->make(true);
        }

        return view('bookings.index');
    }

    /**
     * Menampilkan form untuk membuat pemesanan baru.
     */
    public function create()
    {
        $properties = Properties::all();
        $rooms = Room::get()
            ->unique('room_name')
            ->values();
        // dd($rooms);
        $penyewas = Penyewa::all();

        return view('bookings.create', compact('properties', 'rooms', 'penyewas'));
    }

    /**
     * Menyimpan data pemesanan baru ke database.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'property_id' => 'required',
            'penyewa_id' => 'required',
            'room_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            // 'status' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'pending';
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();

        $data2 = Booking::create($data);
        return redirect()->route('bookings.index')
            ->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pemesanan tertentu.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Menampilkan form edit pemesanan.
     */
    public function edit(Booking $booking)
    {
        $properties = Properties::all();
        $rooms = Room::get()
            ->unique('room_name')
            ->values();
        // dd($rooms);
        $penyewas = Penyewa::all();

        return view('bookings.edit', compact('booking', 'properties', 'rooms', 'penyewas'));
    }

    /**
     * Memperbarui data pemesanan.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'property_id' => 'required',
            'penyewa_id' => 'required',
            'room_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['updated_by'] = Auth::id();

        $booking->update($data);

        return redirect()->route('bookings.index')
            ->with('success', 'Pemesanan berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) pemesanan.
     */
    public function destroy(Booking $booking)
    {
        $booking->update(['deleted_by' => Auth::id()]);
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }

    /**
     * Mengembalikan data yang telah dihapus (restore).
     */
    public function restore($id)
    {
        $booking = Booking::onlyTrashed()->findOrFail($id);
        $booking->restore();

        return redirect()->route('bookings.index')
            ->with('success', 'Pemesanan berhasil dikembalikan.');
    }

    /**
     * Menghapus data secara permanen.
     */
    public function forceDelete($id)
    {
        $booking = Booking::onlyTrashed()->findOrFail($id);
        $booking->forceDelete();

        return redirect()->route('bookings.index')
            ->with('success', 'Pemesanan berhasil dihapus permanen.');
    }
    public function kamar_by_id_kost($id)
    {
        // Ambil kamar berdasarkan ID properti
        $kamar = Room::where('properti_id', $id)->get(['id', 'room_name', 'harga']);
        return response()->json($kamar);
    }
    public function pemesanan($id)
    {
        
    }
    public function historybooking($id)
    {
        
    }
    
}
