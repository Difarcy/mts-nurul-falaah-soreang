<!-- Berita Terbaru dengan Sidebar -->
<section class="bg-white dark:bg-slate-900 pt-1 sm:pt-2 pb-8 sm:pb-12 fade-in-section">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl">
        <div class="flex flex-col lg:flex-row gap-4 lg:gap-4">
            <!-- Kiri: Berita Terbaru (70%) -->
            <div class="w-full lg:w-[70%]">
                @php
                    $fallbackImages = ['img/banner1.jpg', 'img/banner2.jpg', 'img/banner3.jpg'];

                @endphp

                <!-- Highlight News Slider -->
                <div class="mb-8 animate-on-scroll">
                    <div class="relative overflow-hidden shadow-lg group" id="highlight-slider">
                        <div class="highlight-slides flex transition-transform duration-500 ease-in-out"
                            id="highlight-slides">
                            @if(isset($highlightNews) && $highlightNews->count() > 0)
                                @foreach($highlightNews as $index => $news)
                                    @php
                                        $image = $news->thumbnail_path
                                            ? asset('storage/' . $news->thumbnail_path)
                                            : asset($fallbackImages[$index % count($fallbackImages)]);
                                        $dateObj = $news->published_at ?? $news->created_at;
                                        $date = $dateObj->translatedFormat('d F Y');
                                    @endphp
                                    <div class="highlight-slide shrink-0 w-full relative cursor-pointer"
                                        data-href="{{ route('informasi.show', ['type' => $news->type, 'slug' => $news->slug]) }}">
                                        <img src="{{ $image }}" alt="{{ $news->title }}"
                                            class="w-full h-72 sm:h-80 md:h-96 lg:h-112 object-cover js-img-fallback"
                                            loading="lazy"
                                            data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                        <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/20 to-transparent">
                                        </div>
                                        <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 text-white">
                                            <h3
                                                class="text-lg sm:text-xl md:text-2xl font-bold mb-2 line-clamp-2 drop-shadow-lg">
                                                {{ $news->title }}
                                            </h3>
                                            <p class="text-sm sm:text-base opacity-90 drop-shadow-md">
                                                {{ $date }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Default Highlight dengan Default Background -->
                                @php
                                    $defaultBackground = asset('images/background/default-backgrounds.png') . (file_exists(public_path('images/background/default-backgrounds.png')) ? '?v=' . filemtime(public_path('images/background/default-backgrounds.png')) : '');
                                @endphp
                                <div class="highlight-slide shrink-0 w-full relative">
                                    <img src="{{ $defaultBackground }}" alt="{{ $globalSchoolProfile->nama_sekolah }}"
                                        class="w-full h-72 sm:h-80 md:h-96 lg:h-112 object-cover">
                                    <div class="absolute inset-0 bg-linear-to-t from-black/70 via-black/20 to-transparent">
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 text-white">
                                        <h3
                                            class="text-lg sm:text-xl md:text-2xl font-bold mb-2 line-clamp-2 drop-shadow-lg">
                                            Berita Terbaru
                                        </h3>
                                        <p class="text-sm sm:text-base opacity-90 drop-shadow-md">
                                            @php
                                                $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                                $currentDate = now();
                                                $formattedDate = $currentDate->format('d') . ' ' . $monthNames[$currentDate->month - 1] . ' ' . $currentDate->format('Y');
                                            @endphp
                                            {{ $formattedDate }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Navigation Arrows (hanya tampil jika ada lebih dari 1 slide) -->
                        @if(isset($highlightNews) && $highlightNews->count() > 1)
                            <button
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-200 backdrop-blur-sm opacity-0 group-hover:opacity-100"
                                id="highlight-prev">
                                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-200 backdrop-blur-sm opacity-0 group-hover:opacity-100"
                                id="highlight-next">
                                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        @endif

                        <!-- Indicators (hanya tampil jika ada lebih dari 1 slide) -->
                        @if(isset($highlightNews) && $highlightNews->count() > 1)
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300"
                                id="highlight-indicators">
                                @for($i = 0; $i < $highlightNews->count(); $i++)
                                    <button
                                        class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-white/50 hover:bg-white/80 transition-all duration-200 {{ $i === 0 ? 'bg-white' : '' }}"
                                        data-slide="{{ $i }}"></button>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>

                <h2
                    class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-3 animate-on-scroll">
                    <span class="w-px h-6 sm:h-8 bg-green-700 dark:bg-green-500"></span>
                    Berita Terbaru
                </h2>
                @php
                    $newsItems = $latestNews ?? collect();
                    $articleItems = ($latestArticles ?? collect())->take(4);
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 lg:gap-6 animate-on-scroll">
                    @forelse($newsItems as $index => $item)
                        @php
                            $image = $item->thumbnail_path
                                ? asset('storage/' . $item->thumbnail_path)
                                : asset($fallbackImages[$index % count($fallbackImages)]);
                            $dateObj = $item->published_at ?? $item->created_at;
                            $date = $dateObj->translatedFormat('d F Y');
                            $time = $dateObj->format('H:i');
                        @endphp
                        <article
                            class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                            <div class="w-full pointer-events-none">
                                <img src="{{ $image }}" alt="{{ $item->title }}"
                                    class="w-full aspect-video object-cover js-img-fallback" loading="lazy"
                                    data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                            </div>
                            <div class="w-full p-4 flex flex-col grow">
                                <h3
                                    class="text-sm sm:text-lg md:text-xl font-bold text-gray-900 dark:text-slate-100 mb-1 line-clamp-2 hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                    <a href="{{ route('informasi.show', ['type' => $item->type, 'slug' => $item->slug]) }}"
                                        class="hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                        {{ $item->title }}
                                    </a>
                                </h3>
                                <p
                                    class="text-xs sm:text-base text-gray-600 dark:text-slate-400 line-clamp-2 mb-3 grow text-justify">
                                    {{ $item->excerpt }}
                                </p>
                                <div class="mt-auto flex items-center justify-between">
                                    <p class="text-xs sm:text-xs text-gray-500 dark:text-slate-400">
                                        {{ $date }} | {{ $time }}
                                    </p>
                                    <a href="{{ route('informasi.show', ['type' => $item->type, 'slug' => $item->slug]) }}"
                                        class="inline-flex items-center gap-1.5 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-bold text-xs sm:text-base transition-colors duration-300 group">
                                        Baca Berita
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full flex items-center justify-center min-h-150">
                            <p class="text-lg md:text-xl font-semibold text-gray-400 dark:text-slate-500 text-center">
                                Belum Ada Berita
                            </p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-6 text-center">
                    <a href="{{ route('informasi.berita') }}"
                        class="inline-flex items-center gap-2 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-xs sm:text-base transition-colors duration-300 group">
                        Lihat Semua Berita
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Banner Promosi -->
                <div class="mt-8">
                    @if(isset($promosiBannerPath) && $promosiBannerPath)
                        <div
                            class="bg-gray-100 dark:bg-slate-800 border border-gray-300 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-all duration-300 aspect-1920/600">
                            <div class="w-full h-full">
                                <img src="{{ asset('storage/' . $promosiBannerPath) }}" alt="Banner Promosi"
                                    class="w-full h-full object-cover hover:opacity-90 transition-opacity">
                            </div>
                        </div>
                    @else
                        <div
                            class="bg-gray-100 dark:bg-slate-800 border border-gray-300 dark:border-slate-700 overflow-hidden aspect-1920/600">
                            <img src="{{ asset('images/background/default-backgrounds.png') }}@if(file_exists(public_path('images/background/default-backgrounds.png')))?v={{ filemtime(public_path('images/background/default-backgrounds.png')) }}@endif"
                                alt="Banner Promosi Default" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>

                <!-- Artikel -->
                <div class="mt-6 animate-on-scroll">
                    <h2
                        class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-3">
                        <span class="w-px h-6 sm:h-8 bg-green-700 dark:bg-green-500"></span>
                        Artikel Terbaru
                    </h2>
                    <div class="space-y-4 min-h-100">
                        @forelse($articleItems as $index => $item)
                            @php
                                $image = $item->thumbnail_path
                                    ? asset('storage/' . $item->thumbnail_path)
                                    : asset($fallbackImages[($index + 1) % count($fallbackImages)]);
                                $dateObj = $item->published_at ?? $item->created_at;
                                $date = $dateObj->translatedFormat('d F Y');
                                $time = $dateObj->format('H:i');
                            @endphp
                            <article
                                class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                                <div class="flex flex-col sm:flex-row">
                                    <div class="w-full sm:w-[38%] shrink-0">
                                        <div class="w-full aspect-video bg-gray-100 dark:bg-slate-700 overflow-hidden">
                                            <img src="{{ $image }}" alt="{{ $item->title }}"
                                                class="w-full aspect-video object-cover js-img-fallback" loading="lazy"
                                                data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                        </div>
                                    </div>
                                    <div class="w-full sm:w-[62%] p-2 sm:p-2.5 flex flex-col justify-between">
                                        <div>
                                            <h3
                                                class="text-sm sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-0.5 line-clamp-2 hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                                <a href="{{ route('informasi.show', ['type' => $item->type, 'slug' => $item->slug]) }}"
                                                    class="hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                                    {{ $item->title }}
                                                </a>
                                            </h3>
                                            <p
                                                class="text-xs sm:text-base text-gray-600 dark:text-slate-400 line-clamp-2 mb-1 text-justify">
                                                {{ $item->excerpt }}
                                            </p>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs sm:text-xs text-gray-500 dark:text-slate-400">
                                                {{ $date }} | {{ $time }}
                                            </p>
                                            <a href="{{ route('informasi.show', ['type' => $item->type, 'slug' => $item->slug]) }}"
                                                class="inline-flex items-center gap-1.5 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-bold text-xs sm:text-base transition-colors duration-300 group">
                                                Baca Artikel
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="flex items-center justify-center min-h-100">
                                <p class="text-lg md:text-xl font-semibold text-gray-400 dark:text-slate-500 text-center">
                                    Belum Ada Artikel
                                </p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('informasi.artikel') }}"
                            class="inline-flex items-center gap-2 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-sm md:text-base transition-colors duration-300 group">
                            Lihat Semua Artikel
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                @include('web.pages.home.sections.student-achievement', ['prestasiSiswa' => $prestasiSiswa ?? collect()])
                @include('web.pages.home.sections.activity-photo', ['fotoKegiatan' => $fotoKegiatan ?? collect()])
                @include('web.pages.home.sections.activity-video', ['videoKegiatan' => $videoKegiatan ?? collect()])
            </div>

            <!-- Kanan: Sambutan Kepala Madrasah (30%) -->
            <div class="w-full lg:w-[30%] lg:-mt-4 lg:translate-x-4">
                <div class="bg-transparent dark:bg-transparent animate-on-scroll">
                    <div class="p-4">
                        <div class="mb-3">
                            @if($globalSchoolProfile && $globalSchoolProfile->kepala_sekolah_foto)
                                <img src="{{ asset('storage/' . $globalSchoolProfile->kepala_sekolah_foto) }}"
                                    alt="Kepala Madrasah {{ $globalSchoolProfile->nama_sekolah }}"
                                    class="w-full aspect-3/4 object-cover mx-auto kepala-madrasah max-h-112">
                            @else
                                <div
                                    class="w-full aspect-3/4 bg-gray-200 dark:bg-slate-700 flex items-center justify-center mx-auto max-h-112">
                                    <span class="text-gray-400 dark:text-slate-500 font-semibold text-center px-4">Belum ada
                                        foto</span>
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 text-center">
                            <p class="text-sm sm:text-lg text-gray-700 dark:text-slate-200 font-bold text-center">
                                {{ $globalSchoolProfile->kepala_sekolah_nama ?? 'Kepala Madrasah' }}
                            </p>
                            <p class="text-xs sm:text-xs text-gray-600 dark:text-slate-400 mt-1 text-center">
                                - Kepala Madrasah -
                            </p>
                        </div>
                        <div class="mb-0">
                            <div
                                class="prose prose-sm dark:prose-invert max-w-none text-xs sm:text-base text-black dark:text-slate-200 leading-relaxed text-justify line-clamp-5 [&>p]:mb-0 [&>p]:inline [&>p+p]:before:content-['_']">
                                @if($globalSchoolProfile && $globalSchoolProfile->kepala_sekolah_sambutan)
                                    {!! $globalSchoolProfile->kepala_sekolah_sambutan !!}
                                @else
                                    <p class="text-center italic text-gray-500 dark:text-slate-400">Belum ada sambutan
                                        kepala madrasah.</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-center mt-1">
                            <a href="{{ route('profil.kepala-madrasah') }}"
                                class="inline-flex items-center gap-1 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-xs sm:text-base transition-colors duration-300 group">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                @include('web.pages.home.sections.latest-info', ['infoTerkini' => $infoTerkini ?? collect()])
                @include('web.pages.home.sections.latest-schedule', ['agendaTerbaru' => $agendaTerbaru ?? collect()])
            </div>
        </div>
    </div>
</section>

{{-- Highlight slider sudah dipindahkan ke resources/js/web/ui/highlight-slider.js --}}