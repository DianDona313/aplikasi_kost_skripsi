<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('payments.index', compact('payments'));
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
