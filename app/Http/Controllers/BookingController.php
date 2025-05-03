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

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:booking-list|booking-create|booking-edit|booking-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:booking-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:booking-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:booking-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $bookings = Booking::latest()->paginate(5);
        return view('bookings.index', compact('bookings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $request->validate([
            'property_id' => 'required',
            'penyewa_id' => 'required',
            'room_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();

        Booking::create($data);

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
}
