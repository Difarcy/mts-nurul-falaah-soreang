@php
    // Use ViewServiceProvider shared data
    $visualIdentity = $visualIdentity ?? \App\Models\VisualIdentity::first();
    $logoPath = $visualIdentity && $visualIdentity->logo_path ? ('storage/' . $visualIdentity->logo_path) : 'images/logo/logo.png';
    // Cache busting: untuk storage gunakan updated_at, untuk file default gunakan filemtime
    if ($visualIdentity && $visualIdentity->logo_path) {
        $logoVersion = $visualIdentity->updated_at ? $visualIdentity->updated_at->timestamp : time();
    } else {
        $logoVersion = file_exists(public_path($logoPath)) ? filemtime(public_path($logoPath)) : null;
    }
    $logoSrc = asset($logoPath) . ($logoVersion ? '?v=' . $logoVersion : '');
@endphp
<header class="bg-green-700 dark:bg-green-700 shadow-md sticky top-0 z-50 transition-colors duration-200">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl">
        <!-- Header Normal -->
        <div id="header-normal" class="flex items-center justify-between py-1.5 md:flex-row md:h-20 md:py-0">
            <!-- Logo dan Nama Sekolah -->
            <div class="flex items-center gap-3 sm:gap-4">
                <a href="{{ route('web.home') }}"
                    class="flex items-center gap-2 sm:gap-3 hover:opacity-90 transition-opacity">
                    <img src="{{ $logoSrc }}" alt="Logo {{ $globalSchoolProfile->nama_sekolah }}"
                        class="h-8 w-8 sm:h-10 sm:w-10 md:h-12 md:w-12 lg:h-14 lg:w-14 object-contain shrink-0">
                    <div class="flex flex-col justify-center">
                        @php
                            $namaLengkap = $globalSchoolProfile->nama_sekolah;
                            // Logika pemisahan untuk tampilan dua baris
                            $parts = explode('Soreang', $namaLengkap);
                            $mainName = trim($parts[0] ?? $namaLengkap);
                            $locName = count($parts) > 1 ? 'Soreang' : '';
                        @endphp
                        <span class="text-lg md:text-xl lg:text-2xl font-bold text-white leading-tight font-sans">
                            {{ $mainName }}
                        </span>
                        @if($locName)
                            <span class="text-lg md:text-xl lg:text-2xl font-bold text-white leading-tight font-sans">
                                {{ $locName }}
                            </span>
                        @endif
                    </div>
                </a>
            </div>

            <!-- Hamburger Button (MobileOnly) -->
            <button id="open-sidebar"
                class="lg:hidden p-1.5 sm:p-2 hover:bg-green-700 dark:hover:bg-green-800 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-[22px] sm:w-[22px] text-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Menu Navigasi (Desktop Only) -->
            <nav class="hidden lg:flex lg:w-auto lg:flex-nowrap lg:justify-end lg:gap-5 xl:gap-6 font-sans">
                <a href="{{ route('web.home') }}"
                    class="text-white hover:text-gray-200 transition-colors duration-200 font-bold px-2 py-2 text-sm md:text-base uppercase {{ request()->routeIs('home') ? 'border-b-2 border-white' : 'hover:border-b-2 hover:border-white border-b-2 border-transparent' }}">
                    BERANDA
                </a>
                <!-- Menu PROFIL dengan Dropdown -->
                <div class="relative group" id="profil-dropdown">
                    <button
                        class="text-white hover:text-gray-200 transition-colors duration-200 font-bold px-2 py-2 text-sm md:text-base uppercase flex items-center gap-1 {{ ((request()->routeIs('profil.*') || request()->routeIs('profil')) && !request()->routeIs('profil.kepala-madrasah')) ? 'border-b-2 border-white' : 'hover:border-b-2 hover:border-white border-b-2 border-transparent' }}"
                        id="profil-toggle">
                        PROFIL
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="profil-dropdown-menu"
                        class="absolute top-full left-0 mt-2 w-56 md:w-64 bg-white dark:bg-slate-800 shadow-lg border border-gray-200 dark:border-slate-700 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 md:group-hover:opacity-100 md:group-hover:visible transition-all duration-300 ease-out z-50 rounded-md overflow-hidden">
                        <div class="py-2">
                            <a href="{{ route('profil') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('profil') && !request()->routeIs('profil.*') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Tentang Sekolah
                            </a>
                            <a href="{{ route('profil.visi-misi') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('profil.visi-misi') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Visi, Misi, Tujuan
                            </a>
                            <a href="{{ route('profil.kepala-madrasah') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('profil.kepala-madrasah') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Kepala Madrasah
                            </a>
                            <a href="{{ route('profil.struktur-organisasi') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('profil.struktur-organisasi') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Struktur Organisasi
                            </a>
                            <a href="{{ route('profil.prestasi') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('profil.prestasi') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Prestasi Siswa
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Menu INFORMASI dengan Dropdown -->
                <div class="relative group" id="informasi-dropdown">
                    <button
                        class="text-white hover:text-gray-200 transition-colors duration-200 font-bold px-2 py-2 text-sm md:text-base uppercase flex items-center gap-1 {{ request()->routeIs('informasi.*') || request()->routeIs('pengumuman') ? 'border-b-2 border-white' : 'hover:border-b-2 hover:border-white' }}"
                        id="informasi-toggle">
                        INFORMASI
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="informasi-dropdown-menu"
                        class="absolute top-full left-0 mt-2 w-56 md:w-64 bg-white dark:bg-slate-800 shadow-lg border border-gray-200 dark:border-slate-700 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 md:group-hover:opacity-100 md:group-hover:visible transition-all duration-300 ease-out z-50 rounded-md overflow-hidden">
                        <div class="py-2">
                            <a href="{{ route('informasi.berita') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('informasi.berita') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Berita
                            </a>
                            <a href="{{ route('informasi.artikel') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('informasi.artikel') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Artikel
                            </a>
                            <a href="{{ route('informasi.pengumuman') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('informasi.pengumuman') || request()->routeIs('pengumuman') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Pengumuman
                            </a>
                            <a href="{{ route('informasi.agenda') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('informasi.agenda') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Agenda
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Menu SPMB (Langsung) -->
                <a href="{{ route('spmb.index') }}"
                    class="text-white hover:text-gray-200 transition-colors duration-200 font-bold px-2 py-2 text-sm md:text-base uppercase {{ request()->routeIs('spmb.index') ? 'border-b-2 border-white' : 'hover:border-b-2 hover:border-white' }}">
                    SPMB
                </a>

                <!-- Menu PORTAL (RDM & EMIS) -->
                <div class="relative group" id="portal-dropdown">
                    <button
                        class="text-white hover:text-gray-200 transition-colors duration-200 font-bold px-2 py-2 text-sm md:text-base uppercase flex items-center gap-1 hover:border-b-2 hover:border-white"
                        id="portal-toggle">
                        PORTAL
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="portal-dropdown-menu"
                        class="absolute top-full left-0 mt-2 w-48 bg-white dark:bg-slate-800 shadow-lg border border-gray-200 dark:border-slate-700 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 md:group-hover:opacity-100 md:group-hover:visible transition-all duration-300 ease-out z-50 rounded-md overflow-hidden">
                        <div class="py-2">
                            <a href="https://rdm.hdmadrasah.id/login/auth" target="_blank"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150">
                                RDM (Rapor Digital)
                            </a>
                            <a href="https://emis.kemenag.go.id/login" target="_blank"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150">
                                EMIS Kewenangan
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Menu GALERI dengan Dropdown -->
                <div class="relative group" id="galeri-dropdown">
                    <button
                        class="text-white hover:text-gray-200 transition-colors duration-200 font-bold px-2 py-2 text-sm md:text-base uppercase flex items-center gap-1 {{ (request()->routeIs('galeri.*') || request()->routeIs('galeri')) ? 'border-b-2 border-white' : 'hover:border-b-2 hover:border-white border-b-2 border-transparent' }}"
                        id="galeri-toggle">
                        GALERI
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="galeri-dropdown-menu"
                        class="absolute top-full left-0 mt-2 w-56 md:w-64 bg-white dark:bg-slate-800 shadow-lg border border-gray-200 dark:border-slate-700 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 md:group-hover:opacity-100 md:group-hover:visible transition-all duration-300 ease-out z-50 rounded-md overflow-hidden">
                        <div class="py-2">
                            <a href="{{ route('galeri.foto-kegiatan') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('galeri.foto-kegiatan') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Foto Kegiatan
                            </a>
                            <a href="{{ route('galeri.video-kegiatan') }}"
                                class="block px-4 py-2 text-sm md:text-base font-bold text-slate-900 dark:text-white hover:bg-green-800 hover:text-white dark:hover:bg-green-800 dark:hover:text-white transition-colors duration-150 {{ request()->routeIs('galeri.video-kegiatan') ? 'bg-green-800 text-white dark:bg-green-800 dark:text-white' : '' }}">
                                Video Kegiatan
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('contact') }}"
                    class="text-white hover:text-gray-200 transition-colors duration-200 font-bold px-2 py-2 text-sm md:text-base uppercase {{ request()->routeIs('contact') ? 'border-b-2 border-white' : 'hover:border-b-2 hover:border-white border-b-2 border-transparent' }}">
                    KONTAK
                </a>
                <!-- Icon Search -->
                <button id="search-toggle"
                    class="text-white hover:text-gray-200 transition-colors duration-200 font-bold p-2 rounded-full"
                    aria-label="Cari">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </nav>
        </div>

        <!-- Header Search Mode -->
        <div id="header-search"
            class="hidden flex-col gap-3 py-2 md:flex-row md:items-center md:justify-between md:h-20 md:py-0">
            <div class="flex items-center gap-3">
                <a href="{{ route('web.home') }}"
                    class="flex items-center gap-2 sm:gap-3 hover:opacity-90 transition-opacity">
                    <img src="{{ $logoSrc }}" alt="Logo {{ $globalSchoolProfile->nama_sekolah }}"
                        class="h-8 w-8 sm:h-10 sm:w-10 md:h-12 md:w-12 lg:h-14 lg:w-14 object-contain shrink-0">
                    <div class="flex flex-col justify-center text-slate-900 dark:text-white">
                        <span class="text-base md:text-lg lg:text-xl font-bold leading-tight font-sans">
                            {{ $mainName }}
                        </span>
                        @if($locName)
                            <span class="text-base md:text-lg lg:text-xl font-bold leading-tight font-sans">
                                {{ $locName }}
                            </span>
                        @endif
                    </div>
                </a>
            </div>

            <!-- Form Pencarian -->
            <div class="flex w-full items-center md:w-auto">
                <div class="relative">
                    <div class="flex w-full items-center gap-1 md:w-150 md:max-w-150">
                        <div class="flex-1 relative" data-search-url="{{ route('search.global') }}"
                            data-info-base-url="{{ url('/informasi') }}" data-storage-url="{{ asset('storage') }}"
                            data-fallback-image="{{ asset('img/banner1.jpg') }}">
                            <input type="text" id="search-input" name="q" placeholder="Cari informasi..."
                                class="w-full px-4 py-2 border-2 border-gray-200 dark:border-slate-700 rounded-lg focus:border-green-700 focus:outline-none text-[13px] sm:text-sm font-sans bg-white dark:bg-slate-800 text-gray-900 dark:text-slate-100 placeholder-gray-500 dark:placeholder-slate-400"
                                autofocus autocomplete="off">
                            <!-- Dropdown Hasil Pencarian -->
                            <div id="search-results"
                                class="absolute z-50 w-full mt-1 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 rounded-md shadow-lg max-h-96 overflow-y-auto hidden overflow-hidden">
                                <div id="search-results-list" class="py-1"></div>
                            </div>
                        </div>
                        <button type="button" id="search-close"
                            class="text-gray-900 dark:text-gray-100 hover:text-white dark:hover:text-white p-1.5 hover:bg-green-800 dark:hover:bg-green-900 rounded-full transition-colors duration-200"
                            aria-label="Tutup pencarian">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Include Mobile Sidebar --}}
@include('web.components.mobile-sidebar')