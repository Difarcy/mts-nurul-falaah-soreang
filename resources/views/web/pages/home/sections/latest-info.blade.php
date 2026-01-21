<!-- Pengumuman -->
<div class="mt-6">
    <div class="p-4">
        <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-700 dark:text-green-500"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
            Pengumuman
        </h3>
        @php
            $infoTerkiniData = isset($infoTerkini) && $infoTerkini->count() > 0 ? $infoTerkini : collect();
        @endphp
        <div class="space-y-3">
            @if($infoTerkiniData->count() > 0)
                @foreach($infoTerkiniData as $item)
                    <div class="pb-3 border-b border-gray-100 dark:border-slate-700 last:border-0 last:pb-0">
                        <a href="{{ route('informasi.pengumuman.show', $item) }}"
                            class="block hover:text-green-700 dark:hover:text-green-400 transition-colors">
                            <h4
                                class="text-base sm:text-lg font-semibold text-gray-900 dark:text-slate-100 mb-1 line-clamp-2 hover:text-green-700 dark:hover:text-green-400">
                                {{ $item->judul }}
                            </h4>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-slate-300 line-clamp-2 mb-1 text-justify">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100, '...') }}
                            </p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-slate-400">
                                @if($item->tanggal)
                                    @php
                                        $dateObj = \Carbon\Carbon::parse($item->tanggal);
                                    @endphp
                                    {{ $dateObj->translatedFormat('d F Y') }} | {{ $dateObj->format('H.i') }} WIB
                                @else
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                @endif
                            </p>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="flex items-center justify-center min-h-50">
                    <p class="text-base md:text-lg font-semibold text-gray-400 dark:text-slate-500 text-center">
                        Belum Ada Pengumuman
                    </p>
                </div>
            @endif
        </div>
        <div class="mt-2 text-center">
            <a href="{{ route('informasi.pengumuman') }}"
                class="inline-flex items-center gap-1 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-xs sm:text-base transition-colors duration-300 group">
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

<!-- Media Sosial -->
<div class="mt-6">
    <div class="p-4">
        <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-700 dark:text-green-500"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
            Media Sosial
        </h3>
        @php
            $footerFacebook = $facebookUrl ?? \App\Models\InfoText::firstWhere('key', 'footer_facebook_url');
            $footerInstagram = $instagramUrl ?? \App\Models\InfoText::firstWhere('key', 'footer_instagram_url');
            $footerTwitter = $twitterUrl ?? \App\Models\InfoText::firstWhere('key', 'footer_twitter_url');
            $footerYoutube = $youtubeUrl ?? \App\Models\InfoText::firstWhere('key', 'footer_youtube_url');
            $footerTiktok = $tiktokUrl ?? \App\Models\InfoText::firstWhere('key', 'footer_tiktok_url');

            $facebookUrlValue = ($footerFacebook && is_object($footerFacebook) && $footerFacebook->value) ? $footerFacebook->value : (is_string($footerFacebook) ? $footerFacebook : route('social-media-unavailable'));
            $instagramUrlValue = ($footerInstagram && is_object($footerInstagram) && $footerInstagram->value) ? $footerInstagram->value : (is_string($footerInstagram) ? $footerInstagram : route('social-media-unavailable'));
            $twitterUrlValue = ($footerTwitter && is_object($footerTwitter) && $footerTwitter->value) ? $footerTwitter->value : (is_string($footerTwitter) ? $footerTwitter : route('social-media-unavailable'));
            $instagramUrlValue = ($footerInstagram && is_object($footerInstagram) && $footerInstagram->value) ? $footerInstagram->value : (is_string($footerInstagram) ? $instagramUrl : route('social-media-unavailable'));
            $twitterUrlValue = ($footerTwitter && is_object($footerTwitter) && $footerTwitter->value) ? $footerTwitter->value : (is_string($footerTwitter) ? $twitterUrl : route('social-media-unavailable'));
            $youtubeUrlValue = ($footerYoutube && is_object($footerYoutube) && $footerYoutube->value) ? $footerYoutube->value : (is_string($footerYoutube) ? $youtubeUrl : route('social-media-unavailable'));
            $tiktokUrlValue = ($footerTiktok && is_object($footerTiktok) && $footerTiktok->value) ? $footerTiktok->value : (is_string($footerTiktok) ? $tiktokUrl : route('social-media-unavailable'));
        @endphp
        <div class="flex flex-col gap-3">
            <!-- Facebook -->
            <a href="{{ $facebookUrlValue }}" target="_blank" rel="noopener noreferrer"
                class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-200 dark:hover:border-blue-800 transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div
                        class="text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-sm sm:text-base text-gray-700 dark:text-slate-200 group-hover:text-blue-700 dark:group-hover:text-blue-400">Facebook</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition-transform dark:text-slate-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <!-- Instagram -->
            <a href="{{ $instagramUrlValue }}" target="_blank" rel="noopener noreferrer"
                class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 hover:bg-pink-50 dark:hover:bg-pink-900/20 hover:border-pink-200 dark:hover:border-pink-800 transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div
                        class="text-pink-600 dark:text-pink-400 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-sm sm:text-base text-gray-700 dark:text-slate-200 group-hover:text-pink-700 dark:group-hover:text-pink-400">Instagram</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-pink-500 group-hover:translate-x-1 transition-transform dark:text-slate-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <!-- YouTube -->
            <a href="{{ $youtubeUrlValue }}" target="_blank" rel="noopener noreferrer"
                class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-200 dark:hover:border-red-800 transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div class="text-red-600 dark:text-red-400 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-sm sm:text-base text-gray-700 dark:text-slate-200 group-hover:text-red-700 dark:group-hover:text-red-400">YouTube</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-red-500 group-hover:translate-x-1 transition-transform dark:text-slate-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <!-- X (Twitter) -->
            <a href="{{ $twitterUrlValue }}" target="_blank" rel="noopener noreferrer"
                class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 hover:border-gray-300 dark:hover:border-slate-600 transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div
                        class="text-gray-900 dark:text-slate-300 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-gray-700 dark:text-slate-200 group-hover:text-gray-900 dark:group-hover:text-white">X</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-gray-400 group-hover:text-gray-600 group-hover:translate-x-1 transition-transform dark:text-slate-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <!-- TikTok -->
            <a href="{{ $tiktokUrlValue }}" target="_blank" rel="noopener noreferrer"
                class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 hover:border-gray-300 dark:hover:border-slate-600 transition-all duration-300 group">
                <div class="flex items-center gap-3">
                    <div class="text-black dark:text-slate-300 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                        </svg>
                    </div>
                    <span
                        class="font-semibold text-sm sm:text-base text-gray-700 dark:text-slate-200 group-hover:text-black dark:group-hover:text-white">TikTok</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-gray-800 group-hover:translate-x-1 transition-transform dark:text-slate-500"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Kalender -->
<div class="mt-6">
    <div class="p-4">
        <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-700 dark:text-green-500"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Kalender
        </h3>
        @php
            $now = \Carbon\Carbon::now();
            $selectedMonth = request()->get('cal_month', $now->month);
            $selectedYear = request()->get('cal_year', $now->year);

            // Validate month and year
            $selectedMonth = max(1, min(12, (int) $selectedMonth));
            $selectedYear = max(2000, min(2100, (int) $selectedYear));

            $firstDay = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
            $lastDay = $firstDay->copy()->endOfMonth();
            $startDate = $firstDay->copy()->startOfWeek(\Carbon\CarbonInterface::SUNDAY);
            $endDate = $lastDay->copy()->endOfWeek(\Carbon\CarbonInterface::SATURDAY);

            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $daysShort = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

            // Calculate prev/next month
            $prevMonth = $selectedMonth - 1;
            $prevYear = $selectedYear;
            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear--;
            }
            $nextMonth = $selectedMonth + 1;
            $nextYear = $selectedYear;
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear++;
            }
        @endphp

        <!-- Premium Calendar Widget Design -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md border border-gray-100 dark:border-slate-700 overflow-hidden p-1"
            data-calendar-init="true" data-selected-month="{{ $selectedMonth }}"
            data-selected-year="{{ $selectedYear }}" data-now-year="{{ $now->year }}" data-now-month="{{ $now->month }}"
            data-now-day="{{ $now->day }}">

            <!-- Minimalist Header -->
            <div id="calendar-header"
                class="px-4 py-4 flex items-center justify-between border-b border-gray-100 dark:border-slate-700/50 mb-2">
                <button type="button" data-calendar-action="prev"
                    class="p-2 text-gray-400 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-xl transition-all duration-200 focus:outline-none group"
                    aria-label="Bulan Sebelumnya">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transform group-hover:-translate-x-0.5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <h4 id="calendar-title"
                    class="text-sm sm:text-base font-bold text-gray-800 dark:text-slate-100 uppercase tracking-normal">
                    {{ $months[$selectedMonth - 1] }} <span
                        class="text-green-700 dark:text-green-500 font-medium ml-1">{{ $selectedYear }}</span>
                </h4>

                <button type="button" data-calendar-action="next"
                    class="p-2 text-gray-400 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-xl transition-all duration-200 focus:outline-none group"
                    aria-label="Bulan Selanjutnya">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transform group-hover:translate-x-0.5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="p-3">
                <!-- Day Names -->
                <div id="calendar-grid" class="grid grid-cols-7 mb-3">
                    @foreach($daysShort as $day)
                        <div class="aspect-square p-0.5 flex items-center justify-center">
                            <span
                                class="text-base font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">{{ $day }}</span>
                        </div>
                    @endforeach

                    <div class="col-span-7 h-px bg-gray-100 dark:bg-slate-700 my-2"></div>

                    @php
                        $currentDate = $startDate->copy();
                    @endphp
                    @while($currentDate <= $endDate)
                        @php
                            $isCurrentMonth = $currentDate->month == $selectedMonth;
                            $isToday = $currentDate->isToday() && $currentDate->month == $now->month && $currentDate->year == $now->year;
                            $isSunday = $currentDate->dayOfWeek == 0;
                        @endphp
                        <div class="aspect-square p-0.5">
                            <div
                                class="w-full h-full flex items-center justify-center text-base font-medium rounded-lg transition-all duration-300 cursor-pointer
                                                                                        {{ $isCurrentMonth ? ($isSunday ? 'text-red-500 font-medium' : 'text-gray-700 dark:text-slate-300') : 'text-gray-300 dark:text-slate-600' }}
                                                                                        {{ $isToday ? '!bg-gradient-to-br !from-green-600 !to-green-700 !text-white !font-bold shadow-lg shadow-green-200 dark:shadow-none scale-105' : '!hover:bg-green-200 dark:hover:bg-green-900/40 !hover:text-green-900 dark:hover:!text-green-200 !hover:font-semibold' }}">
                                {{ $currentDate->day }}
                            </div>
                        </div>
                        @php
                            $currentDate->addDay();
                        @endphp
                    @endwhile
                </div>
            </div>
        </div>
    </div>
</div>