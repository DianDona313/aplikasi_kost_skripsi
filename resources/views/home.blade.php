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
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Money</p>
                                            <h5 class="font-weight-bolder">$53,000</h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+55%</span> since
                                                yesterday
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add other cards here as needed -->
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                                            <h5 class="font-weight-bolder">2,300</h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+3%</span> since last
                                                week
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                            <h5 class="font-weight-bolder">
                                                +3,462
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-danger text-sm font-weight-bolder">-2%</span> since last
                                                quarter
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                            <h5 class="font-weight-bolder">
                                                $103,430
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">+5%</span> than last
                                                month
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
                                        <img src="{{ asset('storage/' . $property->foto) }}" class="d-block rounded mx-auto"
                                            alt="{{ $property->nama }}"
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
                                <h6 class="text-capitalize">Sales overview</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-arrow-up text-success"></i>
                                    <span class="font-weight-bold">4% more</span> in 2021
                                </p>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Pembayaran</h2>
                    @can('payment-create')
                        <a href="{{ route('payments.create') }}" class="btn btn-custom-orange mb-3">
                            <i class="fas fa-plus me-1"></i> Tambah Pembayaran
                        </a>
                    @endcan

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered text-center" id="payments-table">
                                <thead>
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
                            </table>
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
