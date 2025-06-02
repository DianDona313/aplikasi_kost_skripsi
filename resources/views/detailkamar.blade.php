@extends('layouts.app2')

@section('content')
    <!-- Detail Kost Start -->
    <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Detail Kamar</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Detail Kamar</li>
            </ol>
        </div>
    <div class="container-fluid py-12 mt-12">
        <div class="container py-5">
            <div class="row g-4 mb-4">
                <div class="col-lg-12 col-xl-12">
                    <div class="row g-4">
                        <h2 class="fw-bold mb-3 text-center">Kamar 10A</h2>
                        <div class="col-lg-4">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('fruitables/img/vegetable-item-5.jpg') }}" class="img-fluid rounded"
                                        alt="Kost Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            
                            <p class="mb-2">Kategori: Kost Putri</p>


                            <button class="btn btn-success btn-sm rounded-pill px-3 py-1 mb-3" disabled>
                                Tersedia
                            </button>

                            <h5 class="fw-bold mb-3">Rp 1.200.000 / bulan</h5>
                            <div class="d-flex justify-content mb-4">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star-half-alt text-warning"></i>
                            </div>
                            <p class="mb-4">Kost nyaman dan strategis dekat kampus, cocok untuk mahasiswa. Lingkungan aman
                                dan bersih.</p>
                            <p class="mb-4">Fasilitas lengkap seperti WiFi, kamar mandi dalam, lemari, kasur, dan meja
                                belajar.</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                <i class="fa fa-phone me-2 text-primary"></i>Hubungi Pemilik
                            </a>
                        </div>

                        <div class="col-lg-4">
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
                                    <p>Kost Ibung terletak di lokasi strategis dekat kampus dan pusat kota. Dilengkapi
                                        dengan fasilitas modern dan sistem keamanan 24 jam.</p>
                                    <p>Lokasi: Jl. Merdeka No. 123, Yogyakarta</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail Kost End -->
@endsection
