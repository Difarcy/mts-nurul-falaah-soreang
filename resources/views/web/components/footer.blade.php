<!-- Footer -->
<footer class="bg-green-700 text-white mt-auto">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl pt-8 sm:pt-12 pb-2">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Logo dan Nama Sekolah -->
            @php
                // Use ViewServiceProvider shared data
                $visualIdentity = $visualIdentity ?? \App\Models\VisualIdentity::first(['*']);
                $logoPath = $visualIdentity && $visualIdentity->logo_path ? ('storage/' . $visualIdentity->logo_path) : 'images/logo/logo.png';
                // Cache busting: untuk storage gunakan updated_at, untuk file default gunakan filemtime
                if ($visualIdentity && $visualIdentity->logo_path) {
                    $logoVersion = $visualIdentity->updated_at ? $visualIdentity->updated_at->timestamp : time();
                } else {
                    $logoVersion = file_exists(public_path($logoPath)) ? filemtime(public_path($logoPath)) : null;
                }
            @endphp
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <a href="{{ route('web.home') }}"
                        class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                        <img src="{{ asset($logoPath) }}@if($logoVersion)?v={{ $logoVersion }}@endif"
                            alt="Logo {{ $globalSchoolProfile->nama_sekolah }}"
                            class="h-10 w-10 sm:h-12 sm:w-12 object-contain shrink-0">
                        <div class="flex flex-col justify-center">
                            @php
                                $namaSekolah = $globalSchoolProfile->nama_sekolah;
                                // Coba pisahkan jika mengandung kata "Soreang"
                                $parts = explode('Soreang', $namaSekolah);
                                $mainName = trim($parts[0]);
                                $locationName = count($parts) > 1 ? 'Soreang' . trim($parts[1] ?? '') : '';

                                // Fallback jika tidak ada "Soreang" (tapi biasanya ada karena default)
                                if (empty($locationName) && str_contains($namaSekolah, 'Soreang')) {
                                    $locationName = 'Soreang';
                                }
                            @endphp

                            @if(!empty($locationName))
                                <span class="text-xs sm:text-base md:text-lg font-bold leading-tight font-sans">
                                    {{ $mainName }}
                                </span>
                                <span class="text-xs sm:text-base md:text-lg font-bold leading-tight font-sans">
                                    {{ $locationName }}
                                </span>
                            @else
                                <span class="text-base sm:text-lg font-bold leading-tight font-sans">
                                    {{ $namaSekolah }}
                                </span>
                            @endif
                        </div>
                    </a>
                </div>
                @php
                    $footerDescription = $siteFooterDescription ?? \App\Models\InfoText::where('key', '=', 'site_footer_description', 'and')->first(['*']);
                @endphp
                <p class="text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed mb-4">
                    {{ $footerDescription?->value ?? '' }}
                </p>
                @php
                    // Use ViewServiceProvider shared data (fallback to direct query if not available)
                    $footerFacebook = $facebookUrl ?? \App\Models\InfoText::where('key', '=', 'footer_facebook_url', 'and')->first(['*']);
                    $footerInstagram = $instagramUrl ?? \App\Models\InfoText::where('key', '=', 'footer_instagram_url', 'and')->first(['*']);
                    $footerTwitter = $twitterUrl ?? \App\Models\InfoText::where('key', '=', 'footer_twitter_url', 'and')->first(['*']);
                    $footerYoutube = $youtubeUrl ?? \App\Models\InfoText::where('key', '=', 'footer_youtube_url', 'and')->first(['*']);
                    $footerTiktok = $tiktokUrl ?? \App\Models\InfoText::where('key', '=', 'footer_tiktok_url', 'and')->first(['*']);
                    $facebookUrlValue = ($footerFacebook && is_object($footerFacebook) && $footerFacebook->value) ? $footerFacebook->value : (is_string($footerFacebook) ? $footerFacebook : route('social-media-unavailable'));
                    $instagramUrlValue = ($footerInstagram && is_object($footerInstagram) && $footerInstagram->value) ? $footerInstagram->value : (is_string($footerInstagram) ? $footerInstagram : route('social-media-unavailable'));
                    $twitterUrlValue = ($footerTwitter && is_object($footerTwitter) && $footerTwitter->value) ? $footerTwitter->value : (is_string($footerTwitter) ? $footerTwitter : route('social-media-unavailable'));
                    $youtubeUrlValue = ($footerYoutube && is_object($footerYoutube) && $footerYoutube->value) ? $footerYoutube->value : (is_string($footerYoutube) ? $footerYoutube : route('social-media-unavailable'));
                    $tiktokUrlValue = ($footerTiktok && is_object($footerTiktok) && $footerTiktok->value) ? $footerTiktok->value : (is_string($footerTiktok) ? $footerTiktok : route('social-media-unavailable'));
                @endphp
                <div class="flex items-center gap-4">
                    <a href="{{ $facebookUrlValue }}" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-blue-300 transition-colors duration-300 transform hover:scale-110"
                        aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="{{ $instagramUrlValue }}" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-pink-300 transition-colors duration-300 transform hover:scale-110"
                        aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="{{ $twitterUrlValue }}" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-blue-400 transition-colors duration-300 transform hover:scale-110"
                        aria-label="X (Twitter)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                    <a href="{{ $youtubeUrlValue }}" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-red-300 transition-colors duration-300 transform hover:scale-110"
                        aria-label="YouTube">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                    <a href="{{ $tiktokUrlValue }}" target="_blank" rel="noopener noreferrer"
                        class="text-white hover:text-gray-300 transition-colors duration-300 transform hover:scale-110"
                        aria-label="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Menu Cepat -->
            <div>
                <h3 class="text-sm sm:text-xl font-bold mb-4">Menu Cepat</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('web.home') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Profil Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil.visi-misi') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Visi & Misi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil.prestasi') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Prestasi Siswa
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Layanan Publik -->
            <div>
                <h3 class="text-sm sm:text-xl font-bold mb-4">Layanan Publik</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('informasi.berita') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Berita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('informasi.artikel') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Artikel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('informasi.pengumuman') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Pengumuman
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('galeri.foto-kegiatan') }}"
                            class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                            Foto Kegiatan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-sm sm:text-xl font-bold mb-4">Kontak</h3>

                <!-- Footer Search -->
                <div id="footer-search-container" class="relative mb-4" data-search-url="{{ route('search.global') }}"
                    data-info-base-url="{{ url('/informasi') }}" data-storage-url="{{ asset('storage') }}"
                    data-fallback-image="{{ asset('img/banner1.jpg') }}">
                    <input type="text" id="footer-search-input" placeholder="Cari ..."
                        class="w-full px-3 py-1.5 text-xs sm:text-sm text-gray-900 bg-white border border-gray-300 focus:outline-none focus:border-green-500 rounded-none placeholder-gray-500"
                        autocomplete="off">
                    <div id="footer-search-results"
                        class="absolute bottom-full mb-1 left-0 z-50 w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 shadow-lg max-h-60 overflow-y-auto hidden">
                        <div id="footer-search-results-list" class="py-1"></div>
                    </div>
                </div>

                <ul class="space-y-3">
                    @php
                        // Use ViewServiceProvider shared data (fallback to direct query if not available)
                        $footerAlamat = $alamat ?? \App\Models\InfoText::where('key', '=', 'site_address', 'and')->first(['*']);
                        $footerEmail = $email ?? \App\Models\InfoText::where('key', '=', 'site_email', 'and')->first(['*']);
                        $footerWhatsapp = $whatsapp ?? \App\Models\InfoText::where('key', '=', 'site_whatsapp', 'and')->first(['*']);
                    @endphp
                    @if($footerAlamat && $footerAlamat->value)
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 mt-0.5 shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed">
                                {{ $footerAlamat->value }}
                            </span>
                        </li>
                    @endif
                    @if($footerEmail && $footerEmail->value)
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 mt-0.5 shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ $footerEmail->value }}"
                                class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                                {{ $footerEmail->value }}
                            </a>
                        </li>
                    @endif
                    @if($footerWhatsapp && $footerWhatsapp->value)
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 mt-0.5 shrink-0"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            @php
                                $rawWaFooter = preg_replace('/[^0-9]/', '', $footerWhatsapp->value);
                                $waBaseFooter = preg_replace('/^62|^0/', '', $rawWaFooter);
                                $formattedWaFooter = '+62 ' . substr($waBaseFooter, 0, 3) . '-' . substr($waBaseFooter, 3, 4) . '-' . substr($waBaseFooter, 7);
                                $waLinkFooter = '62' . $waBaseFooter;
                            @endphp
                            <a href="https://wa.me/{{ $waLinkFooter }}" target="_blank" rel="noopener noreferrer"
                                title="Chat on WhatsApp with {{ $formattedWaFooter }}"
                                class="inline-block text-xs sm:text-sm md:text-base text-gray-200 hover:text-white transition-all duration-200 pb-1 hover:border-b-2 hover:border-white border-b-2 border-transparent">
                                {{ $formattedWaFooter }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="w-full mt-8 pt-6 pb-2">
        <p class="text-xs sm:text-sm md:text-base text-gray-200 text-center">
            Copyright © {{ $globalSchoolProfile->nama_sekolah }}
        </p>
    </div>
</footer>