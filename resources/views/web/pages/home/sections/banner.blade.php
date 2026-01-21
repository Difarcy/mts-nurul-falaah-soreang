<!-- Banner Hero -->
@php
    $visualIdentity = \App\Models\VisualIdentity::first();
    $logoPath = $visualIdentity && $visualIdentity->logo_path ? ('storage/' . $visualIdentity->logo_path) : 'images/logo/logo.png';
    // Cache busting: untuk storage gunakan updated_at, untuk file default gunakan filemtime
    if ($visualIdentity && $visualIdentity->logo_path) {
        $logoVersion = $visualIdentity->updated_at ? $visualIdentity->updated_at->timestamp : time();
    } else {
        $logoVersion = file_exists(public_path($logoPath)) ? filemtime(public_path($logoPath)) : null;
    }

    // Ambil banner dari database, jika tidak ada gunakan default
    $dbBanners = isset($banners) && $banners->count() > 0 ? $banners : collect();

    // Ambil pengaturan global banner (informasi yang dipakai semua slide)
    $globalSettings = $visualIdentity;
    $defaultSlides = [
        [
            'tagline' => 'Tagline belum tersedia',
            'title' => 'Judul banner belum tersedia',
            'description' => 'Deskripsi banner belum tersedia',
            'button_text' => 'Teks tombol',
            'button_route' => null,
            'image' => asset('images/background/default-backgrounds.png'),
        ],
        [
            'tagline' => 'Tagline belum tersedia',
            'title' => 'Judul banner belum tersedia',
            'description' => 'Deskripsi banner belum tersedia',
            'button_text' => 'Teks tombol',
            'button_route' => null,
            'image' => asset('images/background/default-backgrounds.png'),
        ],
        [
            'tagline' => 'Tagline belum tersedia',
            'title' => 'Judul banner belum tersedia',
            'description' => 'Deskripsi banner belum tersedia',
            'button_text' => 'Teks tombol',
            'button_route' => null,
            'image' => asset('images/background/default-backgrounds.png'),
        ],
    ];

    // Siapkan informasi konten (statis, tidak berubah)
    // Default values jika tidak ada banner dari database
    $tagline = 'Tagline belum tersedia';
    $title = 'Judul banner belum tersedia';
    $description = 'Deskripsi banner belum tersedia';
    $buttonText = 'Teks tombol';
    $buttonLink = null;
    $buttonRoute = null;
    $showLogo = true;
    $showTagline = true;
    $showTitle = true;
    $showDescription = true;
    $showButton = true;

    // Siapkan array gambar untuk slider
    $slideImages = [];
    $useDefaultSlides = false;

    // Gunakan informasi global untuk konten (jika ada) - Dipindah keluar agar tetap tampil meski tanpa banner slide
    if ($globalSettings) {
        $tagline = !empty($globalSettings->tagline) ? $globalSettings->tagline : 'Tagline belum tersedia';
        $title = !empty($globalSettings->judul) ? $globalSettings->judul : 'Judul banner belum tersedia';
        $description = !empty($globalSettings->deskripsi) ? $globalSettings->deskripsi : 'Deskripsi banner belum tersedia';
        $buttonText = !empty($globalSettings->button_text) ? $globalSettings->button_text : 'Teks tombol';
        $buttonLink = !empty($globalSettings->link) ? $globalSettings->link : null;
        $showLogo = $globalSettings->show_logo ?? true;
        $showTagline = $globalSettings->show_tagline ?? true;
        $showTitle = $globalSettings->show_title ?? true;
        $showDescription = $globalSettings->show_description ?? true;
        $showButton = $globalSettings->show_button ?? true;
    }

    // Jika ada banner dari DB, gunakan; jika tidak, gunakan default background
    if ($dbBanners->count() > 0) {
        // Ambil hanya gambar-gambar untuk slider (urutkan berdasarkan urutan)
        $slideImages = $dbBanners->filter(function ($banner) {
            return $banner->is_active && $banner->gambar;
        })->sortBy('urutan')->values()->map(function ($banner) {
            $bannerUpdatedAt = $banner->updated_at ? $banner->updated_at->timestamp : time();
            $imagePath = 'storage/' . $banner->gambar;
            $imageUrl = asset('storage/' . $banner->gambar);

            return [
                'image' => $imageUrl,
                'image_path' => $imagePath,
                'image_version' => $bannerUpdatedAt,
            ];
        })->toArray();

        // Jika tidak ada slide aktif, tampilkan "Belum Ada Banner" (tidak gunakan default)
        // $slideImages akan tetap kosong dan akan ditangani di bagian view
    }
@endphp
<section class="w-full relative overflow-hidden">
    <div class="relative group h-125 sm:h-150 md:h-165 lg:h-180 w-full overflow-hidden flex" data-banner-slider>
        @if(empty($slideImages))
            <!-- Jika tidak ada banner, gunakan default background -->
            <div class="absolute inset-0 z-10">
                <img src="{{ asset('images/background/default-backgrounds.png') }}@if(file_exists(public_path('images/background/default-backgrounds.png')))?v={{ filemtime(public_path('images/background/default-backgrounds.png')) }}@endif"
                    alt="Banner Default" class="w-full h-full object-cover" loading="lazy" decoding="async">
                <div class="absolute inset-0 bg-linear-to-b from-black/20 to-black/65 dark:from-black/40 dark:to-black/70">
                </div>
            </div>
            <!-- Konten Statis untuk Default Background -->
            <div class="absolute inset-0 flex items-end pb-10 md:pb-16 z-20 pointer-events-none">
                <div class="px-6 max-w-3xl sm:pl-10 lg:pl-20 pointer-events-auto">
                    @if($showLogo)
                        <div class="mb-4 sm:mb-6">
                            <img src="{{ asset($logoPath) }}@if($logoVersion)?v={{ $logoVersion }}@endif"
                                alt="Logo {{ $globalSchoolProfile->nama_sekolah }}"
                                class="h-24 w-24 sm:h-32 sm:w-32 md:h-36 md:w-36 lg:h-40 lg:w-40 object-contain drop-shadow-[1px_1px_2px_rgba(0,0,0,0.4)] md:drop-shadow-[2px_2px_4px_rgba(0,0,0,0.5)] dark:drop-shadow-[2px_2px_4px_rgba(0,0,0,0.7)]">
                        </div>
                    @endif
                    @if($showTagline && !empty($tagline))
                        <p class="text-sm sm:text-base md:text-lg font-bold text-white mb-2 drop-shadow-md">
                            {{ $tagline }}
                        </p>
                    @endif
                    @if($showTitle && !empty($title))
                        <h1
                            class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold text-white mb-4 drop-shadow-lg">
                            {{ $title }}
                        </h1>
                    @endif
                    @if($showDescription && !empty($description))
                        <p
                            class="text-xs sm:text-sm md:text-base lg:text-lg text-white mb-5 drop-shadow-md leading-relaxed max-w-2xl text-left">
                            {{ $description }}
                        </p>
                    @endif
                    @if($showButton)
                        @if($buttonLink)
                            <a href="{{ $buttonLink }}"
                                class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold py-1.5 px-4 sm:py-2.5 sm:px-6 rounded-lg transition-all duration-300 hover:shadow-xl shadow-lg uppercase text-xs sm:text-sm">
                                {{ $buttonText }}
                            </a>
                        @elseif($buttonRoute)
                            <a href="{{ route($buttonRoute) }}"
                                class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold py-1.5 px-4 sm:py-2.5 sm:px-6 rounded-lg transition-all duration-300 hover:shadow-xl shadow-lg uppercase text-xs sm:text-sm">
                                {{ $buttonText }}
                            </a>
                        @else
                            <button type="button"
                                class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold py-1.5 px-4 sm:py-2.5 sm:px-6 rounded-lg transition-all duration-300 hover:shadow-xl shadow-lg uppercase text-xs sm:text-sm">
                                {{ $buttonText }}
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        @else
            <!-- Hanya gambar yang di-slide -->
            @foreach ($slideImages as $index => $slideImage)
                @php
                    // Cache busting untuk banner images + fallback jika storage symlink belum ada
                    $imagePath = $slideImage['image_path'] ?? '';
                    $imageExists = $imagePath && file_exists(public_path($imagePath));
                    if (isset($slideImage['image_version']) && $imageExists) {
                        $imageSrc = asset($imagePath) . '?v=' . $slideImage['image_version'];
                    } elseif ($imageExists) {
                        $imageVersion = filemtime(public_path($imagePath));
                        $imageSrc = asset($imagePath) . ($imageVersion ? '?v=' . $imageVersion : '');
                    } else {
                        // Fallback ke default jika file tidak tersedia di public/storage
                        $imageSrc = asset('images/background/default-backgrounds.png');
                    }
                @endphp
                <div class="absolute inset-0 transition-transform duration-1000 ease-in-out transform bg-slate-900 {{ $index === 0 ? 'z-10' : 'z-0' }}"
                    data-banner-slide data-slide-index="{{ $index }}"
                    style="transform: translateX({{ $index === 0 ? '0' : '100' }}%);">
                    <img src="{{ $imageSrc }}" alt="Banner {{ $index + 1 }}"
                        class="w-full h-full object-cover bg-slate-800 js-img-fallback"
                        data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                    <div class="absolute inset-0 bg-linear-to-b from-black/20 to-black/65 dark:from-black/40 dark:to-black/70">
                    </div>
                </div>
            @endforeach

            <!-- Konten Statis (Logo, Teks, Tombol) - Tidak bergerak (hanya muncul jika ada banner) -->
            <div class="absolute inset-0 flex items-end pb-10 md:pb-16 z-20 pointer-events-none">
                <div class="px-6 max-w-3xl sm:pl-10 lg:pl-20 pointer-events-auto">
                    @if($showLogo)
                        <div class="mb-4 sm:mb-6">
                            <img src="{{ asset($logoPath) }}@if($logoVersion)?v={{ $logoVersion }}@endif"
                                alt="Logo {{ $globalSchoolProfile->nama_sekolah }}"
                                class="h-24 w-24 sm:h-32 sm:w-32 md:h-36 md:w-36 lg:h-40 lg:w-40 object-contain drop-shadow-[1px_1px_2px_rgba(0,0,0,0.4)] md:drop-shadow-[2px_2px_4px_rgba(0,0,0,0.5)] dark:drop-shadow-[2px_2px_4px_rgba(0,0,0,0.7)]">
                        </div>
                    @endif
                    @if($showTagline && !empty($tagline))
                        <p class="text-xs sm:text-base md:text-lg lg:text-xl font-bold text-white mb-2 drop-shadow-md">
                            {{ $tagline }}
                        </p>
                    @endif
                    @if($showTitle && !empty($title))
                        <h1
                            class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold text-white mb-4 drop-shadow-lg">
                            {{ $title }}
                        </h1>
                    @endif
                    @if($showDescription && !empty($description))
                        <p
                            class="text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl text-white mb-5 drop-shadow-md leading-relaxed max-w-2xl text-left">
                            {{ $description }}
                        </p>
                    @endif
                    @if($showButton)
                        @if($buttonLink)
                            <a href="{{ $buttonLink }}"
                                class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold py-1.5 px-4 sm:py-2.5 sm:px-6 rounded-lg transition-all duration-300 hover:shadow-xl shadow-lg uppercase text-xs sm:text-sm md:text-base">
                                {{ $buttonText }}
                            </a>
                        @elseif($buttonRoute)
                            <a href="{{ route($buttonRoute) }}"
                                class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold py-1.5 px-4 sm:py-2.5 sm:px-6 rounded-lg transition-all duration-300 hover:shadow-xl shadow-lg uppercase text-xs sm:text-sm md:text-base">
                                {{ $buttonText }}
                            </a>
                        @else
                            <button type="button"
                                class="inline-block bg-green-700 hover:bg-green-800 text-white font-bold py-1.5 px-4 sm:py-2.5 sm:px-6 rounded-lg transition-all duration-300 hover:shadow-xl shadow-lg uppercase text-xs sm:text-sm md:text-base">
                                {{ $buttonText }}
                            </button>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Indicators (hanya muncul jika ada banner) -->
            <div class="flex absolute bottom-8 left-1/2 -translate-x-1/2 items-center gap-3 z-50 px-4 py-2 pointer-events-auto opacity-0 invisible transition-all duration-300 ease-out group-hover:opacity-100 group-hover:visible"
                data-banner-indicators>
                @foreach ($slideImages as $index => $slideImage)
                    <button type="button"
                        class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full cursor-pointer transition-all duration-300 ease-in-out shrink-0 {{ $index === 0 ? 'bg-white' : 'bg-white/50 hover:bg-white/80' }}"
                        data-banner-dot data-slide-target="{{ $index }}" aria-label="Pilih slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        @endif
    </div>
</section>