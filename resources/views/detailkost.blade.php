@extends('layouts.app2')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Detail Kost</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Kost</a></li>
            <li class="breadcrumb-item active text-white">Detail Kost</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Kost Start -->
    <div class="container-fluid py-12 mt-12">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <!-- Foto Kost -->
                        <div class="col-lg-4">
                            <div class="border rounded">
                                <img src="{{ asset('storage/' . $properti->foto) }}" class="img-fluid rounded"
                                    alt="Foto Kost">
                            </div>
                        </div>

                        <!-- Detail Kost -->
                        <div class="col-lg-8">
                            <h4 class="fw-bold mb-3">{{ $properti->nama }}</h4>

                            <button class="btn btn-success btn-sm rounded-pill px-3 py-1 mb-3" disabled>
                                {{ $properti->kota }}
                            </button>

                            <p class="mb-3">{{ $properti->jeniskost->nama ?? 'Jenis Kost Tidak Diketahui' }}</p>

                            @if ($properti->rooms->count() > 0)
                                @php
                                    $firstRoom = $properti->rooms->first();
                                @endphp
                                <h5 class="fw-bold mb-3">Rp{{ number_format($firstRoom->harga, 0, ',', '.') }}</h5>
                            @else
                                <h5 class="fw-bold mb-3 text-muted">Harga belum tersedia</h5>
                            @endif

                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star-half-alt text-warning"></i>
                            </div>

                            <p class="mb-4">{{ $properti->deskripsi }}</p>
                            {{-- <p class="mb-4">Tersedia kamar mandi dalam, WiFi, dapur bersama, dan area parkir motor.</p> --}}

                            <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                <i class="bi bi-calendar-check me-2 text-primary"></i>Pesan
                            </a>
                        </div>

                        <!-- Tab Deskripsi, Fasilitas, Peraturan -->
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        data-bs-toggle="tab" data-bs-target="#deskripsi">Deskripsi</button>
                                    <button class="nav-link border-white border-bottom-0" type="button"
                                        data-bs-toggle="tab" data-bs-target="#fasilitas">Fasilitas</button>
                                    <button class="nav-link border-white border-bottom-0" type="button"
                                        data-bs-toggle="tab" data-bs-target="#peraturan">Peraturan</button>
                                </div>
                            </nav>

                            <div class="tab-content mb-5">
                                <div class="tab-pane fade show active" id="deskripsi">
                                    <p>{{ $properti->deskripsi }}</p>
                                    <p>Lokasi: {{ $properti->alamat ?? 'Alamat tidak tersedia' }}</p>
                                </div>

                                <div class="tab-pane fade" id="fasilitas">
                                    <ul>
                                        <li>WiFi</li>
                                        <li>Kamar mandi dalam</li>
                                        <li>Kasur & Lemari</li>
                                        <li>Meja Belajar</li>
                                        <li>Dapur Bersama</li>
                                        <li>CCTV & Keamanan 24 Jam</li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="peraturan">
                                    <ul>
                                        <li>Dilarang membawa tamu lawan jenis ke dalam kamar.</li>
                                        <li>Jam malam maksimal pukul 22.00 WIB.</li>
                                        <li>Dilarang merokok di dalam kamar.</li>
                                        <li>Menjaga kebersihan kamar dan lingkungan kost.</li>
                                        <li>Dilarang membawa barang elektronik berdaya besar tanpa izin.</li>
                                        <li>Biaya sewa dibayar setiap awal bulan.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        {{-- Form review / komentar penyewa bisa diaktifkan jika dibutuhkan --}}
                        {{-- 
                    <form action="#">
                        <h4 class="mb-5 fw-bold">Tinggalkan Ulasan</h4>
                        ...
                    </form> 
                    --}}
                    </div>
                    <h3 class="fw-bold mb-0 text-center">Kamar</h3>
                    <div class="vesitable">
                        <div class="owl-carousel vegetable-carousel justify-content-center">
                            @foreach ($properti->rooms as $room)
                                <div class="border border-primary rounded position-relative vesitable-item">
                                    <div class="vesitable-img">
                                        <img src="{{ asset('storage/' . $room->foto) }}" class="img-fluid w-100 rounded-top"
                                            alt="{{ $room->room_name }}" style="height: 200px; object-fit: cover;">
                                    </div>
    
                                    {{-- Ganti label di pojok kanan atas jadi "Jenis Kost" --}}
                                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; right: 10px;">
                                        {{ $room->properti->jenisKost->nama ?? 'Jenis Kost Tidak Diketahui' }}
                                    </div>
    
                                    <div class="p-4 rounded-bottom">
                                        <h4>{{ $room->room_name }}</h4>
    
                                        {{-- Tambahkan nama properti di bawah nama kamar --}}
                                        {{-- <small class="text-muted">dari:
                                            {{ $room->properti->nama ?? 'Properti Tidak Ditemukan' }}</small> --}}
    
                                        <p class="mt-2">{{ $room->room_deskription }}</p>
    
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">
                                                Rp{{ number_format($room->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <br>
                                        <a href="{{ route('login') }}"
                                            class="btn border border-secondary rounded-pill px-3 text-primary">
                                            <i class="bi bi-pencil-fill me-1 text-primary"></i> Pesan Sekarang
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            
                            
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <img src="fruitables/img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top"
                                        alt="">
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">Tersedia</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>Parsely</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
                                    </p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <img src="fruitables/img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top"
                                        alt="">
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">Tersedia</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>Parsely</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
                                    </p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <img src="fruitables/img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top"
                                        alt="">
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">Tersedia</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>Parsely</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
                                    </p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Single Kost End -->
@endsection
