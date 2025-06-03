<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100"
                alt="main_logo">
            <span class="ms-1 font-weight-bold">Creative Tim</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Contoh item menu -->
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @can('booking-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('historybooking') }}">
                        <div
                            class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Riwayat Pemesanan</span>
                    </a>
                </li>
            @endcan
            @can('booking-create')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookings.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-check text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Bookings</span>
                    </a>
                </li>
            @endcan

            @can('history_pengeluarans-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('history_pengeluarans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-receipt text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Histori Pengeluaran</span>
                    </a>
                </li>
            @endcan

            @can('history_pesans-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('history_pesans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-comments text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Histori Pesan</span>
                    </a>
                </li>
            @endcan

            @can('jeniskost-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jeniskosts.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-home text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Jenis Kost</span>
                    </a>
                </li>
            @endcan

            @can('kategori_pengeluaran-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kategori_pengeluarans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tags text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kategori Pengeluaran</span>
                    </a>
                </li>
            @endcan

            @can('payment-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-credit-card text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pembayaran</span>
                    </a>
                </li>
            @endcan

            @can('pengelola-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengelolas.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-tie text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengelola</span>
                    </a>
                </li>
            @endcan

            @can('penyewa-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('penyewas.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Penyewa</span>
                    </a>
                </li>
            @endcan

            @can('properti-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('properties.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-building text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Properti</span>
                    </a>
                </li>
            @endcan

            @can('room-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rooms.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-door-closed text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kamar</span>
                    </a>
                </li>
            @endcan

            @can('fasilita-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fasilitas.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-tools text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Fasilitas</span>
                    </a>
                </li>
            @endcan

            @can('peraturan-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('peraturans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-clipboard-list text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Peraturan</span>
                    </a>
                </li>
            @endcan

            @can('metode_pembayaran-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('metode_pembayarans.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-hand-holding-usd text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Metode Pembayaran</span>
                    </a>
                </li>
            @endcan

            @can('user-edit')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('User.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">User</span>
                    </a>
                </li>
            @endcan

            @can('role-list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-shield text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>


    </ul> <!-- Menutup ul navbar-nav sebelumnya -->

    <!-- Account pages section -->
    <ul class="navbar-nav mt-3">
        <li class="nav-item">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>

        {{-- @if (auth()->user()->roles === 'Penyewa') --}}
        @can('user-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-id-badge text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        @endcan
        {{-- @elseif(in_array(auth()->user()->roles, ['Admin', 'Pemilik', 'Pengelola'])) --}}
        @can('properti-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.show', auth()->user()->id) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-address-card text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profil Saya</span>
                </a>
            </li>
        @endcan
        {{-- @endif --}}
    </ul>
    </div> <!-- menutup div collapse navbar-collapse -->
</aside>
