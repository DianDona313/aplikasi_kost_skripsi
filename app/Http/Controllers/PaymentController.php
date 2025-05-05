<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:payment-list|payment-create|payment-edit|payment-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:payment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:payment-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:payment-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
{
    if ($request->ajax()) {
        $payments = Payment::with('user')->latest();

        return DataTables::of($payments)
            ->addIndexColumn()
            ->addColumn('user', fn($row) => $row->user->name ?? 'Tidak Diketahui')
            ->addColumn('jumlah', fn($row) => 'Rp ' . number_format($row->jumlah, 0, ',', '.'))
            ->addColumn('sisa', fn($row) => 'Rp ' . number_format($row->sisa_pembayaran, 0, ',', '.'))
            ->addColumn('metode', fn($row) => ucfirst($row->payment_method))
            ->addColumn('status', function ($row) {
                return match ($row->payment_status) {
                    'paid' => '<span class="badge bg-success">Lunas</span>',
                    'pending' => '<span class="badge bg-warning">Menunggu</span>',
                    default => '<span class="badge bg-danger">Gagal</span>',
                };
            })
            ->addColumn('bukti', fn($row) => '<img src="' . asset('storage/' . $row->foto) . '" width="50">')
            ->addColumn('action', function ($row) {
                $detail = '<a href="' . route('payments.show', $row->id) . '" class="btn btn-info btn-sm">Detail</a>';
                $edit = '<a href="' . route('payments.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                $delete = '<form action="' . route('payments.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Yakin ingin menghapus pembayaran ini?\')">'
                        . csrf_field() . method_field('DELETE')
                        . '<button type="submit" class="btn btn-danger btn-sm">Hapus</button></form>';
                return $detail . ' ' . $edit . ' ' . $delete;
            })
            ->rawColumns(['status', 'bukti', 'action'])
            ->make(true);
    }

    return view('payments.index');
}

    public function create()
    {
        $bookings = Booking::all();
        $penyewas = Penyewa::all();
        return view('payments.create', compact('bookings', 'penyewas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required',
            'user_id' => 'required',
            'jumlah' => 'required|numeric|min:0',
            'sisa_pembayaran' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'payment_status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Tambahkan field foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_pembayaran', 'public');
        }

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }


    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'booking_id' => 'required',
            'user_id' => 'required',
            'jumlah' => 'required|integer',
            'sisa_pembayaran' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'foto' => 'nullable|string',
            // 'updated_by' => 'required|integer',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
