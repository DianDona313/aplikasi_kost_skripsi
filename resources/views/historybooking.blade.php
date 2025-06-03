@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 style="color: #FDE5AF;">
                        <i class="fas fa-history me-2"></i>Riwayat Pemesanan Saya
                    </h2>
                    <a href="{{ route('bookings.create') }}" class="btn btn-custom-orange">
                        <i class="fas fa-plus me-1"></i> Booking Baru
                    </a>
                </div>

                {{-- Alert Messages --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>Daftar Pemesanan
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($bookings && $bookings->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover" id="historyBookingsTable">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th width="5%">No</th>
                                            <th width="20%">Properti</th>
                                            <th width="10%">Kamar</th>
                                            {{-- <th width="12%">Check In</th>
                                            <th width="12%">Check Out</th> --}}
                                            <th width="8%">Durasi</th>
                                            <th width="12%">Total Harga</th>
                                            <th width="10%">Status</th>
                                            <th width="12%">Tanggal Booking</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $index => $booking)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <strong
                                                            class="text-primary">{{ $booking->property->nama ?? 'N/A' }}</strong>
                                                        <small class="text-muted">
                                                            <i class="fas fa-map-marker-alt me-1"></i>
                                                            {{ Str::limit($booking->property->alamat ?? 'N/A', 30) }}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">
                                                        {{ $booking->room->room_name ?? 'N/A' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if ($booking->start_date && $booking->end_date)
                                                        @php
                                                            $durasi =
                                                                \Carbon\Carbon::parse($booking->start_date)->diffInDays(
                                                                    \Carbon\Carbon::parse($booking->end_date),
                                                                ) + 1;
                                                        @endphp
                                                        <span class="badge bg-secondary">{{ $durasi }} hari</span>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($booking->room && $booking->start_date && $booking->end_date)
                                                        @php
                                                            $durasi =
                                                                \Carbon\Carbon::parse($booking->start_date)->diffInDays(
                                                                    \Carbon\Carbon::parse($booking->end_date),
                                                                ) + 1;
                                                            $total_harga = $booking->room->harga; // Asumsi Room memiliki kolom price
                                                        @endphp
                                                        <div class="d-flex flex-column">
                                                            <strong class="text-success">Rp
                                                                {{ number_format($total_harga, 0, ',', '.') }}</strong>
                                                            <small class="text-muted">Rp
                                                                {{ number_format($booking->room->price, 0, ',', '.') }}/hari</small>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $statusConfig = [
                                                            'pending' => [
                                                                'class' => 'bg-warning text-dark',
                                                                'icon' => 'fas fa-clock',
                                                                'text' => 'Menunggu',
                                                            ],
                                                            'confirmed' => [
                                                                'class' => 'bg-success',
                                                                'icon' => 'fas fa-check',
                                                                'text' => 'Dikonfirmasi',
                                                            ],
                                                            'cancelled' => [
                                                                'class' => 'bg-danger',
                                                                'icon' => 'fas fa-times',
                                                                'text' => 'Dibatalkan',
                                                            ],
                                                            'completed' => [
                                                                'class' => 'bg-primary',
                                                                'icon' => 'fas fa-check-double',
                                                                'text' => 'Selesai',
                                                            ],
                                                            'active' => [
                                                                'class' => 'bg-info',
                                                                'icon' => 'fas fa-play',
                                                                'text' => 'Aktif',
                                                            ],
                                                            'paid' => [
                                                                'class' => 'bg-primary',
                                                                'icon' => 'fas fa-credit-card',
                                                                'text' => 'Sudah Bayar',
                                                            ],
                                                        ];
                                                        $status = $statusConfig[$booking->status] ?? [
                                                            'class' => 'bg-secondary',
                                                            'icon' => 'fas fa-question',
                                                            'text' => ucfirst($booking->status),
                                                        ];
                                                    @endphp
                                                    <span class="badge {{ $status['class'] }}">
                                                        <i class="{{ $status['icon'] }} me-1"></i>
                                                        {{ $status['text'] }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-column">
                                                        <strong>{{ $booking->created_at ? $booking->created_at->format('d/m/Y') : 'N/A' }}</strong>
                                                        <small
                                                            class="text-muted">{{ $booking->created_at ? $booking->created_at->format('H:i') : '' }}</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group-vertical" role="group">
                                                        {{-- Detail Button --}}
                                                        <a href="{{ route('bookings.show', $booking->id) }}"
                                                            class="btn btn-sm btn-outline-info mb-1"
                                                            title="Lihat Detail Booking">
                                                            <i class="fas fa-info-circle"></i> {{-- Atau ganti dengan teks "Detail" jika mau --}}
                                                        </a>

                                                        {{-- Payment Button - for confirmed bookings that need payment --}}
                                                        <button type="button" class="btn btn-sm btn-outline-warning mb-1"
                                                            onclick="processPayment({{ $booking->id }})"
                                                            title="Bayar Sekarang">
                                                            <i class="fas fa-credit-card"></i>
                                                        </button>

                                                        {{-- Cancel Button - for pending bookings --}}
                                                        @if ($booking->status == 'pending')
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger mb-1"
                                                                onclick="confirmCancel({{ $booking->id }})"
                                                                title="Batalkan Booking">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif

                                                        {{-- Download Invoice Button --}}
                                                        @if (in_array($booking->status, ['confirmed', 'completed', 'active', 'paid']) &&
                                                                (isset($booking->payment_status) && $booking->payment_status == 'paid'))
                                                            <button type="button" class="btn btn-sm btn-outline-success"
                                                                onclick="downloadInvoice({{ $booking->id }})"
                                                                title="Download Invoice">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        @endif
                                                    </div>

                                                </td>
                                            </tr>

                                            {{-- Modal Detail --}}
                                            <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1"
                                                aria-labelledby="detailModalLabel{{ $booking->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Header -->
                                                        <div class="modal-header bg-light">
                                                            <h5 class="modal-title"
                                                                id="detailModalLabel{{ $booking->id }}">
                                                                <i class="fas fa-info-circle me-2"></i>
                                                                Detail Booking
                                                                #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <!-- Body -->
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <!-- Informasi Properti -->
                                                                <div class="col-md-6">
                                                                    <div class="card h-100">
                                                                        <div class="card-header bg-success text-white">
                                                                            <h6 class="mb-0">
                                                                                <i
                                                                                    class="fas fa-calendar-check me-2"></i>Informasi
                                                                                Booking
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{-- Payment Button in Modal --}}
                                                            @if ($booking->status == 'confirmed' && (!isset($booking->payment_status) || $booking->payment_status != 'paid'))
                                                                <button type="button" class="btn btn-warning"
                                                                    onclick="processPayment({{ $booking->id }})">
                                                                    <i class="fas fa-credit-card me-1"></i> Bayar Sekarang
                                                                </button>
                                                            @endif

                                                            {{-- Download Invoice Button in Modal --}}
                                                            @if (in_array($booking->status, ['confirmed', 'completed', 'active', 'paid']) &&
                                                                    (isset($booking->payment_status) && $booking->payment_status == 'paid'))
                                                                <button type="button" class="btn btn-success"
                                                                    onclick="downloadInvoice({{ $booking->id }})">
                                                                    <i class="fas fa-download me-1"></i> Download Invoice
                                                                </button>
                                                            @endif

                                                            {{-- Cancel Button in Modal --}}
                                                            @if ($booking->status == 'pending')
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="confirmCancel({{ $booking->id }})">
                                                                    <i class="fas fa-times me-1"></i> Batalkan Booking
                                                                </button>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="fas fa-times me-1"></i> Tutup
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-calendar-times fa-5x text-muted"></i>
                                </div>
                                <h4 class="text-muted mb-3">Belum Ada Riwayat Pemesanan</h4>
                                <p class="text-muted mb-4">
                                    Anda belum memiliki riwayat pemesanan apapun.<br>
                                    Mulai mencari dan booking properti impian Anda sekarang!
                                </p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
                                        <i class="fas fa-search me-2"></i> Cari Properti
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-home me-2"></i> Ke Dashboard
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="cancelForm" method="POST" style="display: none;">
        @csrf
        @method('PUT')
    </form>
@endsection

@push('styles')
    <style>
        .btn-custom-orange {
            background-color: #FF8C00;
            border-color: #FF8C00;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-custom-orange:hover {
            background-color: #FF7F00;
            border-color: #FF7F00;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(255, 140, 0, 0.3);
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            border-top: none;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .badge {
            font-size: 0.75em;
            padding: 0.5em 0.8em;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .btn-group-vertical .btn {
            border-radius: 0.375rem !important;
            margin-bottom: 2px;
        }

        .modal-header {
            border-bottom: 2px solid #dee2e6;
        }

        .modal-footer {
            border-top: 2px solid #dee2e6;
        }

        .alert {
            border: none;
            border-radius: 0.5rem;
        }

        /* Payment button styles */
        .btn-outline-warning:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            color: #000;
        }

        @media (max-width: 768px) {
            .btn-group-vertical .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .modal-lg {
                max-width: 95%;
            }
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #0056b3 !important;
            border-color: #0056b3 !important;
            color: white !important;
        }
    </style>
@endpush

@push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Perbaikan JavaScript untuk processPayment --}}
<script>
function processPayment(bookingId) {
    Swal.fire({
        title: 'Pilih Metode Pembayaran',
        html: `
            <div class="text-start">
                <p class="mb-3">Pilih metode pembayaran untuk booking #${String(bookingId).padStart(4, '0')}:</p>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="transfer" value="transfer" checked>
                    <label class="form-check-label" for="transfer">
                        <i class="fas fa-university me-2 text-primary"></i>Transfer Bank
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="ewallet" value="ewallet">
                    <label class="form-check-label" for="ewallet">
                        <i class="fas fa-mobile-alt me-2 text-success"></i>E-Wallet
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="creditcard" value="creditcard">
                    <label class="form-check-label" for="creditcard">
                        <i class="fas fa-credit-card me-2 text-warning"></i>Kartu Kredit/Debit
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod">
                    <label class="form-check-label" for="cod">
                        <i class="fas fa-money-bill me-2 text-info"></i>COD (Cash on Delivery)
                    </label>
                </div>
            </div>
        `,
        confirmButtonText: '<i class="fas fa-arrow-right me-1"></i> Lanjut',
        cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false,
        preConfirm: () => {
            const selected = document.querySelector('input[name="paymentMethod"]:checked');
            if (!selected) {
                Swal.showValidationMessage('Pilih metode pembayaran terlebih dahulu');
                return false;
            }
            return selected.value;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const selectedMethod = result.value;
            
            // Show loading
            Swal.fire({
                title: 'Memuat...',
                text: 'Mengambil informasi pembayaran',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Fetch payment details
            fetch(`/get-payment-details?method=${selectedMethod}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                showPaymentUploadDialog(bookingId, selectedMethod, data);
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal mengambil informasi pembayaran. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}

function showPaymentUploadDialog(bookingId, method, paymentInfo) {
    const methodNames = {
        'transfer': 'Transfer Bank',
        'ewallet': 'E-Wallet',
        'creditcard': 'Kartu Kredit/Debit',
        'cod': 'COD (Cash on Delivery)'
    };

    const isCOD = method === 'cod';
    
    Swal.fire({
        title: 'Konfirmasi Pembayaran',
        html: `
            <div class="text-start">
                <div class="mb-3">
                    <strong>Metode Pembayaran:</strong> ${methodNames[method] || method}
                </div>
                
                ${!isCOD ? `
                    <div class="mb-3">
                        <strong>Detail Pembayaran:</strong><br>
                        <div class="p-3 bg-light rounded">
                            <div><strong>Bank:</strong> ${paymentInfo.nama_bank || 'N/A'}</div>
                            <div><strong>No. Rekening:</strong> ${paymentInfo.nomor_rekening || 'N/A'}</div>
                            <div><strong>Atas Nama:</strong> ${paymentInfo.atas_nama || 'N/A'}</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="paymentProof" class="form-label">
                            <i class="fas fa-upload me-1"></i>Upload Bukti Pembayaran *
                        </label>
                        <input type="file" class="form-control" id="paymentProof" 
                               accept="image/*,application/pdf" required>
                        <small class="form-text text-muted">Format: JPG, PNG, PDF (Max: 5MB)</small>
                    </div>
                ` : `
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Pembayaran akan dilakukan saat check-in
                    </div>
                `}
                
                <div class="mb-3">
                    <label for="paymentNotes" class="form-label">
                        <i class="fas fa-sticky-note me-1"></i>Catatan (Opsional)
                    </label>
                    <textarea class="form-control" id="paymentNotes" rows="3" 
                              placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: `<i class="fas fa-paper-plane me-1"></i> ${isCOD ? 'Konfirmasi' : 'Kirim Pembayaran'}`,
        cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false,
        preConfirm: () => {
            const fileInput = document.getElementById('paymentProof');
            const notes = document.getElementById('paymentNotes').value;

            // Validasi file untuk non-COD
            if (!isCOD && fileInput.files.length === 0) {
                Swal.showValidationMessage('Upload bukti pembayaran diperlukan untuk metode ini');
                return false;
            }

            // Validasi ukuran file
            if (!isCOD && fileInput.files[0] && fileInput.files[0].size > 5 * 1024 * 1024) {
                Swal.showValidationMessage('Ukuran file maksimal 5MB');
                return false;
            }

            return {
                files: fileInput.files,
                notes: notes
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Mengirim data pembayaran',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Prepare form data
            const formData = new FormData();
            formData.append('booking_id', bookingId);
            formData.append('payment_method', method);
            formData.append('notes', result.value.notes || '');
            
            // Add file if exists
            if (result.value.files && result.value.files.length > 0) {
                formData.append('payment_proof', result.value.files[0]);
            }

            // Send to server
            fetch(`/booking/${bookingId}/payment`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message || 'Pembayaran Anda telah berhasil disubmit dan sedang diproses.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Gagal!',
                    text: error.message || 'Terjadi kesalahan saat memproses pembayaran',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}
</script>

{{-- Perbaikan CSS untuk tombol payment --}}
<style>
/* Payment button improvements */
.btn-outline-warning {
    border-color: #ffc107;
    color: #ffc107;
    transition: all 0.3s ease;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #000;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
}

.btn-outline-warning:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* SweetAlert2 custom styles */
.swal2-popup {
    font-size: 0.9rem;
}

.swal2-html-container {
    max-height: 500px;
    overflow-y: auto;
}

.form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.form-check-label {
    cursor: pointer;
    display: flex;
    align-items: center;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}

/* File input styling */
.form-control[type="file"] {
    padding: 0.375rem 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control[type="file"]:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Loading animation */
.swal2-loader {
    border-color: #007bff transparent #007bff transparent;
}
</style>
@endpush
