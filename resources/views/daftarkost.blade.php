@extends('layouts.app2')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Kost</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{route('landing')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('landing')}}">Pages</a></li>
            <li class="breadcrumb-item active text-white">Kost</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-12">
        <div class="container py-5">
            <h1 class="mb-4">Kost List</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4 justify-content-center">
                                @foreach ($properties as $property)
                                    <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
                                        <div
                                            class="rounded position-relative fruite-item border-bottom border-4 border-warning fixed-card-height w-100">
                                            <div class="fruite-img" style="height: 230px; overflow: hidden;">
                                                <img src="{{ asset('storage/' . $property->foto) }}"
                                                    class="img-fluid w-100 rounded-top" alt="{{ $property->nama }}"
                                                    style="height: 100%; object-fit: cover;">
                                            </div>
                                            <div
                                                class="p-4 border border-secondary border-top-0 rounded-bottom fixed-card-body">
                                                <h4>{{ $property->nama }}</h4>
                                                <p>{{ $property->deskripsi }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap mt-auto">
                                                    <p class="text-dark fs-5 fw-bold mb-0">
                                                        @if ($property->rooms->count())
                                                            Rp{{ number_format($property->rooms->min('harga'), 0, ',', '.') }}
                                                            / bulan
                                                        @else
                                                            Harga belum tersedia
                                                        @endif
                                                    </p>
                                                    <a href="{{ route('detailkost', $property->id) }}"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Lihat Detail
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <a href="#" class="rounded">&laquo;</a>
                                    <a href="#" class="active rounded">1</a>
                                    <a href="#" class="rounded">2</a>
                                    <a href="#" class="rounded">3</a>
                                    <a href="#" class="rounded">4</a>
                                    <a href="#" class="rounded">5</a>
                                    <a href="#" class="rounded">6</a>
                                    <a href="#" class="rounded">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
