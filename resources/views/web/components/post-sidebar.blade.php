@props([
    'articles' => [],
    'articlesSecondary' => [],
    'announcements' => [],
    'agenda' => [],
    'agendaStyle' => 'homepage',
    'schoolProfile' => null,
    'showSocialMedia' => false,
    'articleTitle' => 'Artikel Terbaru',
    'articleSecondaryTitle' => 'Berita Terbaru',
    'articleEmptyMessage' => 'Belum ada artikel',
    'articleSecondaryEmptyMessage' => 'Belum ada berita',
    'articleFirst' => false,
    'articleSecondaryFirst' => false,
    'announcementFirst' => false,
    'agendaFirst' => false,
    'agendaLast' => false,
    'schoolProfileFirst' => false,
    'socialMediaFirst' => false,
    'calendar' => null,
    'calendarOrder' => 15,
])

@php
    $footerFacebook = \App\Models\InfoText::where('key', '=', 'footer_facebook_url', 'and')->first();
    $footerInstagram = \App\Models\InfoText::where('key', '=', 'footer_instagram_url', 'and')->first();
    $footerTwitter = \App\Models\InfoText::where('key', '=', 'footer_twitter_url', 'and')->first();
    $footerYoutube = \App\Models\InfoText::where('key', '=', 'footer_youtube_url', 'and')->first();
    $footerTiktok = \App\Models\InfoText::where('key', '=', 'footer_tiktok_url', 'and')->first();

    $facebookUrlValue = $footerFacebook?->value ?? route('social-media-unavailable');
    $instagramUrlValue = $footerInstagram?->value ?? route('social-media-unavailable');
    $twitterUrlValue = $footerTwitter?->value ?? route('social-media-unavailable');
    $youtubeUrlValue = $footerYoutube?->value ?? route('social-media-unavailable');
    $tiktokUrlValue = $footerTiktok?->value ?? route('social-media-unavailable');
@endphp

<div class="flex flex-col gap-8">
    {{-- Main Articles Section --}}
    @if(!empty($articles) && count($articles) > 0)
        <div class="order-{{ isset($articleFirst) && $articleFirst ? 'first' : '1' }}">
            <div class="p-4 bg-transparent dark:bg-transparent animate-on-scroll">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
                    <span class="text-green-700 dark:text-green-500 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </span>
                    {{ $articleTitle }}
                </h3>
                <div class="space-y-4">
                    @foreach($articles as $article)
                        @php
                            $dateObj = $article->published_at ?? $article->created_at;
                        @endphp
                        <div class="pb-3 border-b border-gray-100 dark:border-slate-700 last:border-0 last:pb-0">
                            <a href="{{ route('informasi.show', ['type' => $article->type, 'slug' => $article->slug]) }}"
                                class="block hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                <h4
                                    class="text-base sm:text-lg font-semibold text-gray-900 dark:text-slate-100 mb-1 line-clamp-2">
                                    {{ $article->title }}
                                </h4>
                                <p
                                    class="text-base text-gray-600 dark:text-slate-300 line-clamp-2 mb-1 text-justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?? $article->body), 100, '...') }}
                                </p>
                                <p class="text-xs sm:text-xs text-gray-500 dark:text-slate-400">
                                    {{ $dateObj->translatedFormat('d F Y') }} | {{ $dateObj->format('H.i') }} WIB
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
                @php
                    // Tentukan route berdasarkan tipe artikel pertama
                    $firstArticle = $articles->first();
                    $articleRoute = $firstArticle && $firstArticle->type === 'berita' ? route('informasi.berita') : route('informasi.artikel');
                @endphp
                <div class="mt-2 text-center">
                    <a href="{{ $articleRoute }}"
                        class="inline-flex items-center gap-1 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-sm md:text-base transition-colors duration-300 group">
                        Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Secondary Articles Section --}}
    @if(!empty($articlesSecondary) && count($articlesSecondary) > 0)
        <div class="order-{{ isset($articleSecondaryFirst) && $articleSecondaryFirst ? 'first' : '2' }}">
            <div class="p-4 bg-transparent dark:bg-transparent animate-on-scroll">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
                    <span class="text-green-700 dark:text-green-500 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </span>
                    {{ $articleSecondaryTitle }}
                </h3>
                <div class="space-y-4">
                    @foreach($articlesSecondary as $article)
                        @php
                            $dateObj = $article->published_at ?? $article->created_at;
                        @endphp
                        <div class="pb-3 border-b border-gray-100 dark:border-slate-700 last:border-0 last:pb-0">
                            <a href="{{ route('informasi.show', ['type' => $article->type, 'slug' => $article->slug]) }}"
                                class="block hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                <h4
                                    class="text-base sm:text-lg font-semibold text-gray-900 dark:text-slate-100 mb-1 line-clamp-2">
                                    {{ $article->title }}
                                </h4>
                                <p
                                    class="text-base text-gray-600 dark:text-slate-300 line-clamp-2 mb-1 text-justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?? $article->body), 100, '...') }}
                                </p>
                                <p class="text-xs sm:text-xs text-gray-500 dark:text-slate-400">
                                    {{ $dateObj->translatedFormat('d F Y') }} | {{ $dateObj->format('H.i') }} WIB
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Pengumuman --}}
    @if(!empty($announcements) && count($announcements) > 0)
        <div class="order-{{ isset($announcementFirst) && $announcementFirst ? 'first' : '3' }}">
            <div class="p-4 bg-transparent dark:bg-transparent animate-on-scroll">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
                    <span class="text-green-700 dark:text-green-500 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </span>
                    Pengumuman
                </h3>
                <div class="space-y-4">
                    @foreach($announcements as $info)
                        @php
                            $publishedAt = property_exists($info, 'published_at') ? $info->published_at : ($info->tanggal ?? $info->created_at ?? now());
                            $dateObj = \Carbon\Carbon::parse($publishedAt);
                        @endphp
                        <div class="pb-3 border-b border-gray-100 dark:border-slate-700 last:border-0 last:pb-0">
                            <a href="{{ route('informasi.pengumuman.show', $info->id) }}"
                                class="block hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                <h4
                                    class="text-base sm:text-lg font-semibold text-gray-900 dark:text-slate-100 mb-1 line-clamp-2">
                                    {{ $info->title ?? $info->judul }}
                                </h4>
                                <p
                                    class="text-base text-gray-600 dark:text-slate-300 line-clamp-2 mb-1 text-justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($info->isi ?? ($info->body ?? '')), 100, '...') }}
                                </p>
                                <p class="text-xs sm:text-xs text-gray-500 dark:text-slate-400">
                                    {{ $dateObj->translatedFormat('d F Y') }} | {{ $dateObj->format('H.i') }} WIB
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-2 text-center">
                    <a href="{{ route('informasi.pengumuman') }}"
                        class="inline-flex items-center gap-1 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-sm md:text-base transition-colors duration-300 group">
                        Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Agenda --}}
    @if(!empty($agenda) && count($agenda) > 0)
        <div class="order-{{ isset($agendaFirst) && $agendaFirst ? 'first' : (isset($agendaLast) && $agendaLast ? '[99]' : '10') }}">
            <div class="p-4 bg-transparent dark:bg-transparent animate-on-scroll">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
                    <span class="text-green-700 dark:text-green-500 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    Agenda
                </h3>
                <div class="space-y-3">
                    @foreach($agenda as $item)
                        @php
                            $isObject = is_object($item);
                            $judul = $isObject ? $item->judul : $item['judul'];
                            $tglRaw = $isObject ? ($item->tanggal_mulai ?? $item->tanggal) : ($item['tanggal_mulai'] ?? $item['tanggal']);
                            $dateObj = \Carbon\Carbon::parse($tglRaw);
                            $id = $isObject ? ($item->id ?? '#') : ($item['id'] ?? '#');
                            $waktuMulai = $isObject ? ($item->waktu_mulai ?? null) : ($item['waktu_mulai'] ?? null);
                            $waktuSelesai = $isObject ? ($item->waktu_selesai ?? null) : ($item['waktu_selesai'] ?? null);
                            $link = $id !== '#' ? route('informasi.agenda.show', $id) : route('informasi.agenda');
                        @endphp

                        @if($agendaStyle === 'homepage')
                            <div class="pb-3 border-b border-gray-100 dark:border-slate-700 last:border-0 last:pb-0">
                                <a href="{{ $link }}" class="block hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                    <div class="flex items-start gap-3">
                                        <div class="shrink-0 bg-green-700 dark:bg-green-600 text-white rounded-lg p-2 text-center min-w-12.5">
                                            <div class="text-sm md:text-base font-bold">{{ $dateObj->format('d') }}</div>
                                            <div class="text-xs uppercase">{{ $dateObj->translatedFormat('M') }}</div>
                                        </div>
                                        <div class="grow">
                                            <h4 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-slate-100 mb-1 line-clamp-2 hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                                {{ $judul }}
                                            </h4>
                                            <p class="text-base text-gray-600 dark:text-slate-300 line-clamp-2 mb-1 text-justify">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($isObject ? $item->deskripsi : ($item['deskripsi'] ?? '')), 80, '...') }}
                                            </p>
                                            <p class="text-xs sm:text-xs text-gray-500 dark:text-slate-400">
                                                @if($waktuMulai)
                                                    @php
                                                        $start = \Carbon\Carbon::parse($waktuMulai)->format('H.i');
                                                        $endTime = $waktuSelesai ? \Carbon\Carbon::parse($waktuSelesai)->format('H:i') : null;
                                                        $end = ($endTime && $endTime !== '00:00') ? str_replace(':', '.', $endTime) : 'Selesai';
                                                        $hasEndTime = $endTime && $endTime !== '00:00';
                                                    @endphp
                                                    {{ $start }} {{ $hasEndTime ? '– ' . $end . ' WIB' : 'WIB – Selesai' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="pb-3 border-b border-gray-100 dark:border-slate-700 last:border-0 last:pb-0">
                                <a href="{{ $link }}"
                                    class="block hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                    <h4
                                        class="text-base sm:text-lg font-semibold text-gray-900 dark:text-slate-100 mb-1 line-clamp-2">
                                        {{ $judul }}
                                    </h4>
                                    <p
                                        class="text-base text-gray-600 dark:text-slate-300 line-clamp-2 mb-1 text-justify">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($isObject ? $item->deskripsi : ($item['deskripsi'] ?? '')), 100, '...') }}
                                    </p>
                                    <p class="text-xs sm:text-xs text-gray-500 dark:text-slate-400">
                                        {{ $dateObj->translatedFormat('d F Y') }}
                                        @if($waktuMulai)
                                            @php
                                                $start = \Carbon\Carbon::parse($waktuMulai)->format('H.i');
                                                $endTime = $waktuSelesai ? \Carbon\Carbon::parse($waktuSelesai)->format('H:i') : null;
                                                $end = ($endTime && $endTime !== '00:00') ? str_replace(':', '.', $endTime) : 'Selesai';
                                                $hasEndTime = $endTime && $endTime !== '00:00';
                                            @endphp
                                            | {{ $start }} {{ $hasEndTime ? '– ' . $end . ' WIB' : 'WIB – Selesai' }}
                                        @endif
                                    </p>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="mt-2 text-center">
                    <a href="{{ route('informasi.agenda') }}"
                        class="inline-flex items-center gap-1 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-sm md:text-base transition-colors duration-300 group">
                        Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- Sambutan Kepala Madrasah --}}
    @if($schoolProfile)

        <div class="order-{{ isset($schoolProfileFirst) && $schoolProfileFirst ? '1' : '5' }}">
            <div class="bg-transparent dark:bg-transparent animate-on-scroll">
                <div class="p-4">
                    <div class="mb-3">
                        @if($schoolProfile->kepala_sekolah_foto)
                            <img src="{{ asset('storage/' . $schoolProfile->kepala_sekolah_foto) }}"
                                alt="Kepala Madrasah {{ $schoolProfile->nama_sekolah }}"
                                class="w-full aspect-3/4 object-cover mx-auto kepala-madrasah max-h-112">
                        @else
                            <div
                                class="w-full aspect-3/4 bg-gray-200 dark:bg-slate-700 flex items-center justify-center mx-auto max-h-112 border border-gray-100 dark:border-slate-800 rounded-lg">
                                <span class="text-gray-400 dark:text-slate-500 font-semibold text-center px-4">Belum ada
                                    foto</span>
                            </div>
                        @endif
                    </div>
                    <div class="mb-3 text-center">
                        <p class="text-base sm:text-lg text-gray-700 dark:text-slate-200 font-bold text-center">
                            {{ $schoolProfile->kepala_sekolah_nama ?? 'Kepala Madrasah' }}
                        </p>
                        <p class="text-xs sm:text-xs text-gray-600 dark:text-slate-400 mt-1 text-center">
                            - Kepala Madrasah -
                        </p>
                    </div>
                    <div class="mb-0">
                        <div
                            class="prose prose-sm dark:prose-invert max-w-none text-base text-gray-700 dark:text-slate-300 leading-relaxed text-justify line-clamp-5 [&>p]:mb-0 [&>p]:inline [&>p+p]:before:content-['_']">
                            @if($schoolProfile->kepala_sekolah_sambutan)
                                {!! $schoolProfile->kepala_sekolah_sambutan !!}
                            @else
                                <p class="text-center italic text-gray-500 dark:text-slate-400">Belum ada sambutan
                                    kepala madrasah.</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-center mt-1">
                        <a href="{{ route('profil.kepala-madrasah') }}"
                            class="inline-flex items-center gap-1 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-sm md:text-base transition-colors duration-300 group">
                            Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Social Media --}}
    @if($showSocialMedia)
        <div class="order-{{ isset($socialMediaFirst) && $socialMediaFirst ? 'first' : '20' }}">
            <div class="p-4">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700 dark:text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    Media Sosial
                </h3>
                <div class="flex flex-col gap-3">
                    @include('web.components.social-media-links', [
                        'facebookUrlValue' => $facebookUrlValue,
                        'instagramUrlValue' => $instagramUrlValue,
                        'youtubeUrlValue' => $youtubeUrlValue,
                        'twitterUrlValue' => $twitterUrlValue,
                        'tiktokUrlValue' => $tiktokUrlValue
                    ])
                </div>
            </div>
        </div>
    @endif

    {{-- Calendar (Optional for Agenda Page) --}}
    @if(isset($calendar) && $calendar)
        <div class="order-{{ isset($calendarOrder) ? $calendarOrder : '10' }}">
            {!! $calendar !!}
        </div>
    @endif
</div>
