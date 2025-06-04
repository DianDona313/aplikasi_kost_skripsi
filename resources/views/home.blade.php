@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="mb-3" style="color: #FDE5AF;">Dashboard</h3>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Summary Cards -->
                <div class="row">
                    <div class="row">
                        <!-- Kamar Tidak Tersedia -->
                        <div class="row">
                            <!-- Kamar Tidak Tersedia -->
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Kamar Terisi</p>
                                                    <h5 class="font-weight-bolder">
                                                        {{ $rooms->where('is_available', 'no')->count() }}</h5>
                                                    <p class="mb-0">
                                                        <span class="text-danger text-sm font-weight-bolder">Tidak
                                                            tersedia</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                    <i class="ni ni-key-25 text-lg opacity-10" aria-hidden="true" ></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Jumlah Penyewa -->
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Penyewa
                                                    </p>
                                                    <h5 class="font-weight-bolder">{{ $penyewaCount }}</h5>
                                                    <p class="mb-0">
                                                        <span class="text-primary text-sm font-weight-bolder">Data
                                                            terbaru</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Pembayaran -->
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pembayaran
                                                    </p>
                                                    <h5 class="font-weight-bolder">
                                                        Rp{{ number_format($totalPembayaran, 0, ',', '.') }}
                                                    </h5>
                                                    <p class="mb-0">
                                                        <span class="text-success text-sm font-weight-bolder">+10%</span>
                                                        dari bulan lalu
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                    <i class="ni ni-money-coins text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Pengeluaran -->
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total
                                                        Pengeluaran</p>
                                                    <h5 class="font-weight-bolder">
                                                        Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}
                                                    </h5>
                                                    <p class="mb-0">
                                                        <span class="text-success text-sm font-weight-bolder">+5%</span>
                                                        dari bulan lalu
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Add more cards if needed -->

                </div>

                <!-- Carousel with Spacing -->
                <div class="row mt-5">
                    <!-- Gambar Kiri -->
                    <div class="col-lg-5 mb-4">
                        <div id="kostCarousel" class="carousel slide" data-bs-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                @foreach ($properties as $index => $property)
                                    <button type="button" data-bs-target="#kostCarousel"
                                        data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                        aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            <!-- Gambar Carousel -->
                            <div class="carousel-inner rounded">
                                @foreach ($properties as $index => $property)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $property->foto) }}"
                                            class="d-block rounded mx-auto" alt="{{ $property->nama }}"
                                            style="width: 500px; height: 400px; object-fit: cover;">



                                        <div class="carousel-caption d-none d-md-block">
                                            <h5
                                                style="background-color: #4CAF50; color: #fff; padding: 5px 10px; border-radius: 5px;">
                                                {{ $property->nama }}
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Kontrol -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#kostCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#kostCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <!-- Chart Kanan -->
                    <div class="col-lg-7 mb-4">
                        <div class="card z-index-2 h-100">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h6 class="text-capitalize">Tentang Kami</h6>
                                <p class="text-sm mb-0">
                                    Aplikasi Kost adalah solusi modern untuk membantu pengelolaan kos-kosan secara efisien
                                    dan terorganisir.
                                </p>
                            </div>
                            <div class="card-body p-3">
                                <div class="about-text">
                                    <p>Fitur-fitur unggulan kami meliputi:</p>
                                    <ul class="text-sm ps-3">
                                        <li>Pencatatan keuangan otomatis dan terperinci</li>
                                        <li>Pengelolaan data penghuni secara digital</li>
                                        <li>Pengingat pembayaran untuk pemilik dan penyewa</li>
                                        <li>Laporan bulanan keuangan dan aktivitas</li>
                                        <li>Notifikasi real-time dan pengingat otomatis</li>
                                        <li>Akses mudah melalui perangkat mobile dan desktop</li>
                                        <li>User-friendly dan hemat waktu</li>
                                    </ul>
                                    <p class="mt-3">
                                        Tujuan kami adalah menjadikan pengelolaan kost lebih mudah, praktis, dan profesional
                                        bagi semua kalangan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div>
                    {{-- <h2 class="mb-4" style="color: #FDE5AF;">Daftar Pembayaran</h2>
                    @can('payment-create')
                        <a href="{{ route('payments.create') }}" class="btn btn-custom-orange mb-3">
                            <i class="fas fa-plus me-1"></i> Tambah Pembayaran
                        </a>
                    @endcan --}}

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5 class="mb-0" style="color: #FDE5AF;">Daftar Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover text-center"
                                    id="payments-table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            {{-- <th>Booking</th> --}}
                                            <th>Penyewa</th>
                                            <th>Jumlah</th>
                                            {{-- <th>Sisa</th> --}}
                                            {{-- <th>Metode</th> --}}
                                            <th>Status</th>
                                            <th>Bukti</th>
                                            {{-- <th>Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Data akan di-load dari backend / DataTables --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {
            $('#payments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('payments.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user',
                        name: 'user.name'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'status',
                        name: 'payment_status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'bukti',
                        name: 'foto',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
