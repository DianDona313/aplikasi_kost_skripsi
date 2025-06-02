@extends('layouts.app') {{-- Jika kamu menggunakan layout --}}
@section('content')
    <div class="container mt-4">
        <h2>Daftar Okupansi Kamar</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Tipe dan No. Kamar</th>
                                <th>Status Kamar</th>
                                <th>Penyewa</th>
                                <th>Status Penyewa</th>
                                <th>Durasi Sewa</th>
                                <th>Tanggal Check-in</th>
                                <th>Tanggal Check-out</th>
                                <th>Deposit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->tipe_kamar }}</td>
                                    <td>
                                        @if ($row->status_kamar === 'Terisi')
                                            <span class="badge bg-success">Terisi</span>
                                        @elseif ($row->status_kamar === 'Kosong')
                                            <span class="badge bg-secondary">Kosong</span>
                                        @else
                                            <span class="badge bg-dark">Tidak tersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->penyewa_nama)
                                            {{ $row->penyewa_nama }}<br>
                                            {{ $row->penyewa_nohp }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $status = $row->status_penyewa;
                                        @endphp
                                        @if (Str::contains($status, 'Check-in'))
                                            <span class="badge bg-primary">{{ $status }}</span>
                                        @elseif (Str::contains($status, 'Check-out'))
                                            <span class="badge bg-danger">{{ $status }}</span>
                                        @elseif ($status === 'Sudah Check-in')
                                            <span class="badge bg-success">{{ $status }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $row->durasi_sewa ?? '-' }}</td>
                                    <td>{{ $row->tanggal_checkin ?? '-' }}</td>
                                    <td>{{ $row->tanggal_checkout ?? '-' }}</td>
                                    <td>
                                        @if ($row->deposit)
                                            Rp{{ number_format($row->deposit, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
