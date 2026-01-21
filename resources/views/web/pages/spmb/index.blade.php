@extends('web.layouts.website')

@section('title', 'Informasi SPMB - ' . ($globalSchoolProfile->nama_sekolah))

@section('content')
    <!-- Wrapper untuk Background Light/Dark -->
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">

        <!-- Hero Section (Updated to SPMB & Richer Green Gradient) -->
        <section
            class="relative overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-28 bg-linear-to-br from-green-900 via-green-800 to-green-700 rounded-b-[3rem] shadow-2xl">
            <!-- Pattern Overlay -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>

            <div class="container mx-auto px-4 relative z-10 text-center">
                @if($setting?->academic_year)
                    <div
                        class="inline-block py-2 px-6 rounded-full bg-green-600 text-white font-black text-base md:text-lg mb-6 shadow-xl transform -rotate-1">
                        {{ $setting->academic_year }}
                    </div>
                @endif
                <h1
                    class="text-3xl md:text-5xl lg:text-6xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-md">
                    {{ $globalSchoolProfile->nama_sekolah }}
                </h1>
                @if($setting?->hero_slogan)
                    <p class="text-lg md:text-xl text-white max-w-2xl mx-auto font-medium leading-relaxed">
                        {{ $setting?->hero_slogan }}
                    </p>
                @endif

                <div class="mt-10 flex justify-center gap-4">
                    <a href="#prosedur"
                        class="px-8 py-3 rounded-lg bg-white text-green-700 font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                        Lihat Prosedur
                    </a>
                    @php
                        $waNumber = $setting?->contact_wa ?? '6282117123456';
                        $waRaw = preg_replace('/[^0-9]/', '', $waNumber);
                        $waBase = preg_replace('/^62|^0/', '', $waRaw);
                        $formattedWaHero = '+62 ' . substr($waBase, 0, 3) . '-' . substr($waBase, 3, 4) . '-' . substr($waBase, 7);
                        $waLink = '62' . $waBase;
                    @endphp
                    <a href="https://wa.me/{{ $waLink }}" target="_blank"
                        title="Chat on WhatsApp with {{ $formattedWaHero }}"
                        aria-label="Chat on WhatsApp with {{ $formattedWaHero }}"
                        class="px-8 py-3 rounded-lg bg-green-600 text-white font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <!-- Info Cards (Floating Premium) -->
        <section class="-mt-16 relative z-20 pb-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                    <!-- Status Pendaftaran -->
                    @php
                        $status = $setting?->registration_status ?? 'closed';
                    @endphp

                    @if ($status == 'open')
                        <div
                            class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 border border-green-200 dark:border-green-700/50 rounded-2xl p-6 shadow-md hover:shadow-xl flex flex-col justify-between h-full min-h-[180px] hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300">
                            <p
                                class="text-xs font-bold text-green-700 dark:text-green-400 group-hover:text-white uppercase tracking-wide mb-3 opacity-90 transition-colors">
                                Status Pendaftaran</p>
                            <div class="flex items-center gap-4 mt-auto">
                                <div
                                    class="shrink-0 w-16 h-16 bg-white dark:bg-white/10 rounded-xl flex items-center justify-center text-green-600 dark:text-white group-hover:bg-white group-hover:text-green-600 shadow-sm transition-all duration-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3
                                    class="text-2xl font-black text-green-800 dark:text-white group-hover:text-white leading-tight transition-colors">
                                    DIBUKA</h3>
                            </div>
                        </div>
                    @elseif ($status == 'soon')
                        <div
                            class="group bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900 dark:to-yellow-800 border border-yellow-200 dark:border-yellow-700/50 rounded-2xl p-6 shadow-md hover:shadow-xl flex flex-col justify-between h-full min-h-[180px] hover:scale-105 hover:bg-gradient-to-br hover:from-yellow-500 hover:to-yellow-600 transition-all duration-300">
                            <p
                                class="text-xs font-bold text-yellow-700 dark:text-yellow-400 group-hover:text-white uppercase tracking-wide mb-3 opacity-90 transition-colors">
                                Status Pendaftaran</p>
                            <div class="flex items-center gap-4 mt-auto">
                                <div
                                    class="shrink-0 w-16 h-16 bg-white dark:bg-white/10 rounded-xl flex items-center justify-center text-yellow-600 dark:text-white group-hover:bg-white group-hover:text-yellow-600 shadow-sm transition-all duration-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3
                                    class="text-2xl font-black text-yellow-800 dark:text-white group-hover:text-white leading-tight transition-colors">
                                    SEGERA DIBUKA</h3>
                            </div>
                        </div>
                    @else
                        <div
                            class="group bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900 dark:to-red-800 border border-red-200 dark:border-red-700/50 rounded-2xl p-6 shadow-md hover:shadow-xl flex flex-col justify-between h-full min-h-[180px] hover:scale-105 hover:bg-gradient-to-br hover:from-red-500 hover:to-red-600 transition-all duration-300">
                            <p
                                class="text-xs font-bold text-red-700 dark:text-red-400 group-hover:text-white uppercase tracking-wide mb-3 opacity-90 transition-colors">
                                Status Pendaftaran</p>
                            <div class="flex items-center gap-4 mt-auto">
                                <div
                                    class="shrink-0 w-16 h-16 bg-white dark:bg-white/10 rounded-xl flex items-center justify-center text-red-600 dark:text-white group-hover:bg-white group-hover:text-red-600 shadow-sm transition-all duration-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3
                                    class="text-2xl font-black text-red-800 dark:text-white group-hover:text-white leading-tight transition-colors">
                                    DITUTUP</h3>
                            </div>
                        </div>
                    @endif

                    <!-- Masa Pendaftaran -->

                    <!-- Kuota -->
                    <div
                        class="group bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 rounded-2xl p-6 shadow-md hover:shadow-xl flex flex-col justify-between h-full min-h-[180px] hover:scale-105 hover:bg-gradient-to-br hover:from-purple-500 hover:to-purple-600 transition-all duration-300">
                        <p
                            class="text-xs font-bold text-purple-700 dark:text-purple-400 group-hover:text-white uppercase tracking-wide mb-3 opacity-90 transition-colors">
                            Kuota Tersedia</p>
                        <div class="flex items-center gap-4 mt-auto">
                            <div
                                class="shrink-0 w-16 h-16 bg-purple-200 dark:bg-purple-700/50 rounded-xl flex items-center justify-center text-purple-700 dark:text-white group-hover:bg-white group-hover:text-purple-600 shadow-sm transition-all duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3
                                class="text-2xl font-black text-purple-800 dark:text-white group-hover:text-white leading-tight transition-colors">
                                {{ $setting?->quota ? $setting?->quota . ' Siswa' : '-' }}
                            </h3>
                        </div>
                    </div>

                    <!-- Biaya -->
                    <div
                        class="group bg-gradient-to-br from-pink-50 to-pink-100 dark:from-pink-900 dark:to-pink-800 rounded-2xl p-6 shadow-md hover:shadow-xl flex flex-col justify-between h-full min-h-[180px] hover:scale-105 hover:bg-gradient-to-br hover:from-pink-500 hover:to-pink-600 transition-all duration-300">
                        <p
                            class="text-xs font-bold text-pink-700 dark:text-pink-400 group-hover:text-white uppercase tracking-wide mb-3 opacity-90 transition-colors">
                            Biaya Pendaftaran</p>
                        <div class="flex items-center gap-4 mt-auto">
                            <div
                                class="shrink-0 w-16 h-16 bg-pink-200 dark:bg-pink-700/50 rounded-xl flex items-center justify-center text-pink-700 dark:text-white group-hover:bg-white group-hover:text-pink-600 shadow-sm transition-all duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3
                                class="text-2xl font-black text-pink-800 dark:text-white group-hover:text-white leading-tight transition-colors">
                                @if (isset($setting?->registration_fee))
                                    @if ($setting?->registration_fee == 0)
                                        GRATIS
                                    @else
                                        Rp {{ number_format($setting?->registration_fee, 0, ',', '.') }}
                                    @endif
                                @else
                                    -
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keunggulan, Fasilitas, Ekskul, Syarat Pendaftaran (Poster Style) -->

        <!-- Keunggulan Section -->
        <section class="py-16 bg-white dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="text-center mb-10 scroll-animate">
                    <div
                        class="inline-block bg-green-600 text-white font-black text-xl md:text-2xl px-8 py-3 transform -skew-x-12 uppercase shadow-lg mb-2">
                        KEUNGGULAN KAMI
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 mt-4 max-w-2xl mx-auto">Kenapa memilih
                        {{ $globalSchoolProfile->nama_sekolah }}?
                        sebagai tempat menuntut ilmu?
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Item 1 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300 text-center scroll-animate scroll-delay-100">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-xl transition-colors">
                            Aktifitas interaktif dan menarik</h4>
                    </div>
                    <!-- Item 2 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-200">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-xl">Tenaga
                            pengajar yang kompeten</h3>
                    </div>
                    <!-- Item 3 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-300">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg transition-colors">
                            Pembelajaran keagamaan</h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- FASILITAS SEKOLAH -->
        <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 scroll-animate">
                    <div
                        class="inline-block bg-green-600 text-white font-black text-xl md:text-2xl px-8 py-3 transform -skew-x-12 uppercase shadow-lg mb-2">
                        FASILITAS SEKOLAH
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 mt-4 max-w-2xl mx-auto font-medium">Sarana pendukung lengkap
                        untuk kenyamanan belajar siswa.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    <!-- Item 1 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-100">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg transition-colors">
                            Bangunan Milik Sendiri</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white transition-colors">
                            Gedung sekolah permanen yang nyaman dan kondusif.</p>
                    </div>

                    <!-- Item 2 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-200">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg transition-colors">
                            Laboratorium Komputer</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white transition-colors">
                            Fasilitas praktek komputer dan teknologi informasi.</p>
                    </div>

                    <!-- Item 3 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-300">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg transition-colors">
                            Masjid Sekolah</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white">Pusat kegiatan ibadah
                            dan pembinaan keagamaan.</p>
                    </div>

                    <!-- Item 4 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300 text-center scroll-animate scroll-delay-100">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg transition-colors">
                            Gedung Aula</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white transition-colors">
                            Tempat pertemuan dan kegiatan serbaguna.</p>
                    </div>

                    <!-- Item 5 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300 text-center scroll-animate scroll-delay-200">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg transition-colors">
                            Perpustakaan</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white transition-colors">
                            Koleksi buku lengkap untuk menunjang literasi siswa.</p>
                    </div>

                    <!-- Item 6 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300 text-center scroll-animate scroll-delay-300">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4
                            class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg transition-colors">
                            Lapangan Olahraga</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white transition-colors">Area
                            olahraga yang luas untuk aktivitas fisik siswa.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- EKSTRAKURIKULER -->
        <section class="py-16 bg-white dark:bg-gray-900 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-green-100/20 dark:bg-green-900/10 rounded-full -mr-20 -mt-20 pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-40 h-40 bg-green-50 dark:bg-green-900/10 rounded-full -ml-10 -mb-10 pointer-events-none">
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center mb-12 scroll-animate">
                    <div
                        class="inline-block bg-green-600 text-white font-black text-xl md:text-2xl px-8 py-3 transform -skew-x-12 uppercase shadow-lg mb-2">
                        EKSTRAKURIKULER
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 mt-4 max-w-2xl mx-auto font-medium">Pengembangan bakat dan
                        minat siswa melalui berbagai kegiatan positif dan berprestasi.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    <!-- Ekskul 1 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-100">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg">Pramuka</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white transition-colors">
                            Membangun karakter kepemimpinan, kemandirian, dan kedisiplinan siswa.</p>
                    </div>

                    <!-- Ekskul 2 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-200">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H5a2 2 0 00-2-2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.5 2-2 2h4c-1.5 0-2-1.116-2-2z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg">OSIS</h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white transition-colors">Wadah
                            organisasi siswa intra sekolah untuk melatih berorganisasi.</p>
                    </div>

                    <!-- Ekskul 3 -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-lg shadow-md hover:shadow-xl hover:scale-105 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300  text-center scroll-animate scroll-delay-300">
                        <div
                            class="w-14 h-14 mx-auto bg-green-200 dark:bg-green-700 text-green-700 dark:text-green-300 group-hover:bg-white group-hover:text-green-600 rounded-full flex items-center justify-center mb-4 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-white mb-2 text-lg">Kaligrafi
                        </h4>
                        <p class="text-base text-black dark:text-slate-100 group-hover:text-white">Seni menulis indah Arab
                            dan Latin untuk kreativitas siswa.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SYARAT PENDAFTARAN -->
        <section class="py-12 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="text-center mb-10 scroll-animate">
                    <div
                        class="inline-block bg-green-700 text-white font-black text-xl md:text-2xl px-10 py-3 transform -skew-x-12 uppercase shadow-lg mb-2">
                        SYARAT PENDAFTARAN
                    </div>
                </div>

                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php
                            $requirements = [
                                "Mengisi formulir pendaftaran",
                                "Fotocopy Ijazah SD/MI (3 Lembar)",
                                "Fotocopy Kartu Keluarga (3 Lembar)",
                                "Fotocopy KTP Orang Tua (3 Lembar)",
                                "Fotocopy Akte Kelahiran (3 Lembar)",
                                "Fotocopy Kartu NISN (3 Lembar)",
                                "Surat Kelulusan dan SKKB asli",
                                "Fotocopy Kartu KIP 3 lembar (jika punya)",
                                "Surat Keterangan Tidak Mampu (jika ada)",
                                "Pas Foto ukuran 2x3 dan 3x4 (3 lembar)"
                            ];
                        @endphp

                        @foreach($requirements as $index => $req)
                            <div class="group bg-green-50 dark:bg-gray-800 p-4 rounded-lg shadow-sm flex items-center gap-4 hover:bg-green-700 transition-all duration-300 scroll-animate"
                                style="animation-delay: {{ ($index % 2) * 0.1 }}s">
                                <div
                                    class="shrink-0 w-8 h-8 bg-yellow-400 text-white rounded-lg flex items-center justify-center font-black shadow-sm transition-transform group-hover:scale-110">
                                    {{ $index + 1 }}
                                </div>
                                <span
                                    class="text-black dark:text-slate-100 group-hover:text-white font-medium transition-colors">{{ $req }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Alert Pendaftaran Offline -->
                <div
                    class="max-w-6xl mx-auto mt-8 bg-gray-50 dark:bg-gray-800/50 p-6 rounded-xl shadow-sm flex gap-4 items-center border border-gray-200 dark:border-gray-700">
                    <div
                        class="shrink-0 w-12 h-12 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-400 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white text-lg">Pendaftaran Offline</h3>
                        <p class="text-black dark:text-slate-100">Saat ini pendaftaran dilakukan secara langsung
                            (offline). Silakan datang ke sekretariat pendaftaran di sekolah dengan membawa persyaratan
                            lengkap di atas.</p>
                    </div>
                </div>
            </div>
        </section>



        <!-- ALUR PENDAFTARAN (TIMELINE) -->
        <section class="py-20 scroll-mt-20" id="prosedur">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    @php
                        $hasDate = isset($setting) && $setting->registration_start_date && $setting->registration_end_date;
                    @endphp

                    @if($hasDate)
                        @php
                            $startDate = \Carbon\Carbon::parse($setting?->registration_start_date)->translatedFormat('d F Y');
                            $endDate = \Carbon\Carbon::parse($setting?->registration_end_date)->translatedFormat('d F Y');
                        @endphp
                        <div class="relative inline-block group">
                            <div
                                class="absolute inset-0 bg-green-500 rounded-full blur opacity-20 group-hover:opacity-40 transition-opacity duration-300">
                            </div>
                            <div
                                class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-green-200 dark:border-green-800 rounded-full px-8 py-3 shadow-lg hover:shadow-xl transition-all duration-300 transform group-hover:-translate-y-1">
                                <span class="flex flex-col sm:flex-row items-center gap-2 sm:gap-3">
                                    <span
                                        class="flex items-center gap-2 text-green-700 dark:text-green-400 font-bold uppercase tracking-wider text-xs sm:text-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Masa Pendaftaran
                                    </span>
                                    <span class="hidden sm:block w-px h-4 bg-gray-300 dark:bg-gray-600"></span>
                                    <span class="text-gray-900 dark:text-gray-100 font-black text-sm sm:text-base">
                                        {{ $startDate }} <span class="text-green-500 mx-1">s/d</span> {{ $endDate }}
                                    </span>
                                </span>
                            </div>
                        </div>
                        <br><br>
                    @endif
                    <div
                        class="inline-block bg-green-700 text-white font-black text-2xl px-8 py-2 transform -skew-x-12 uppercase shadow-md">
                        ALUR PENDAFTARAN
                    </div>
                </div>

                <div class="relative py-4 max-w-5xl mx-auto">
                    <!-- Vertical Line -->
                    <div
                        class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-1 bg-green-500 dark:bg-green-800 rounded-full hidden md:block">
                    </div>
                    <!-- Mobile Vertical Line (Centered) -->
                    <div
                        class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-1 bg-green-500 dark:bg-green-800 rounded-full md:hidden">
                    </div>
                    @php
                        $timelineSteps = [
                            [
                                'name' => 'Pendaftaran',
                                'date' => $setting?->step_1_start_date
                                    ? ($setting?->step_1_start_date->format('d/m/Y') . ($setting?->step_1_end_date ? ' - ' . $setting?->step_1_end_date->format('d/m/Y') : ''))
                                    : 'Belum diatur',
                                'desc' => 'Calon siswa datang ke sekolah mengambil formulir pendaftaran'
                            ],
                            [
                                'name' => 'Pengembalian Berkas',
                                'date' => $setting?->step_2_start_date
                                    ? ($setting?->step_2_start_date->format('d/m/Y') . ($setting?->step_2_end_date ? ' - ' . $setting?->step_2_end_date->format('d/m/Y') : ''))
                                    : 'Belum diatur',
                                'desc' => 'Menyerahkan formulir yang sudah diisi beserta persyaratan lengkap'
                            ],
                            [
                                'name' => 'Tes Seleksi',
                                'date' => $setting?->step_3_start_date
                                    ? ($setting?->step_3_start_date->format('d/m/Y') . ($setting?->step_3_end_date ? ' - ' . $setting?->step_3_end_date->format('d/m/Y') : ''))
                                    : 'Belum diatur',
                                'desc' => 'Mengikuti tes Baca Tulis Al-Qur\'an dan Wawancara calon siswa & orang tua'
                            ],
                            [
                                'name' => 'Pengumuman Hasil',
                                'date' => $setting?->step_4_start_date
                                    ? ($setting?->step_4_start_date->format('d/m/Y') . ($setting?->step_4_end_date ? ' - ' . $setting?->step_4_end_date->format('d/m/Y') : ''))
                                    : 'Belum diatur',
                                'desc' => 'Melihat hasil seleksi yang ditempel di papan pengumuman sekolah'
                            ],
                            [
                                'name' => 'Daftar Ulang',
                                'date' => $setting?->step_5_start_date
                                    ? ($setting?->step_5_start_date->format('d/m/Y') . ($setting?->step_5_end_date ? ' - ' . $setting?->step_5_end_date->format('d/m/Y') : ''))
                                    : 'Belum diatur',
                                'desc' => 'Melakukan pembayaran administrasi dan pengambilan seragam sekolah'
                            ]
                        ];
                    @endphp

                    @foreach($timelineSteps as $index => $item)
                        <!-- Timeline Item -->
                        <div class="flex flex-col md:flex-row items-center mb-16 relative">

                            <!-- Content Left (Ganjil) -->
                            <div
                                class="w-full md:w-5/12 {{ $index % 2 == 0 ? 'order-1 md:text-right md:pr-10' : 'order-3 md:order-1 opacity-0 md:opacity-100 hidden md:block' }}">
                                @if($index % 2 == 0)
                                    <div
                                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-xl shadow-md hover:shadow-xl hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300">
                                        <div
                                            class="inline-block px-4 py-1.5 bg-yellow-400 text-white rounded-md text-sm font-black mb-3 shadow-sm uppercase tracking-wider transition-colors duration-300">
                                            {{ $item['date'] }}
                                        </div>
                                        <h4 class="font-bold text-gray-900 group-hover:text-white dark:text-white text-lg mb-2">
                                            {{ $item['name'] }}
                                        </h4>
                                        <p class="text-black group-hover:text-white dark:text-slate-100 leading-relaxed text-base">
                                            {{ $item['desc'] }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Center Line & Dot -->
                            <div class="w-full md:w-2/12 flex justify-center items-center order-2 py-4 md:py-0 relative z-10">
                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 bg-green-700 text-white border-4 border-white dark:border-gray-900 rounded-full shadow-lg flex items-center justify-center font-bold text-lg relative z-10">
                                    {{ $index + 1 }}
                                </div>
                            </div>

                            <!-- Content Right (Genap) -->
                            <div
                                class="w-full md:w-5/12 {{ $index % 2 != 0 ? 'order-3 md:pl-10 text-left' : 'order-3 opacity-0 md:opacity-100 hidden md:block' }}">
                                @if($index % 2 != 0)
                                    <div
                                        class="group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-xl shadow-md hover:shadow-xl hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300 text-left">
                                        <div
                                            class="inline-block px-4 py-1.5 bg-yellow-400 text-white rounded-md text-sm font-black mb-3 shadow-sm uppercase tracking-wider transition-colors duration-300">
                                            {{ $item['date'] }}
                                        </div>
                                        <h4 class="font-bold text-gray-900 group-hover:text-white dark:text-white text-lg mb-2">
                                            {{ $item['name'] }}
                                        </h4>
                                        <p class="text-black group-hover:text-white dark:text-slate-100 leading-relaxed text-base">
                                            {{ $item['desc'] }}
                                        </p>
                                    </div>
                                @endif

                                <!-- Mobile View for Ganjil (di bawah dot) -->
                                @if($index % 2 == 0)
                                    <div
                                        class="md:hidden group bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 p-6 rounded-xl shadow-md mt-2 hover:shadow-xl hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 transition-all duration-300">
                                        <div
                                            class="inline-block px-4 py-1.5 bg-yellow-400 text-white rounded-md text-sm font-black mb-3 shadow-sm uppercase tracking-wider transition-colors duration-300">
                                            {{ $item['date'] }}
                                        </div>
                                        <h4 class="font-bold text-gray-900 group-hover:text-white dark:text-white text-xl mb-2">
                                            {{ $item['name'] }}
                                        </h4>
                                        <p class="text-black group-hover:text-white dark:text-slate-100 leading-relaxed text-base">
                                            {{ $item['desc'] }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CONTACT CTA -->
        <section
            class="py-20 bg-linear-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800 dark:text-white">Butuh Informasi Lebih Lanjut?
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                    Jangan ragu untuk menghubungi panitia SPMB kami jika ada pertanyaan seputar pendaftaran, biaya, atau
                    program sekolah.
                </p>

                <div class="flex justify-center items-center">
                    @php
                        $waNumber = $setting?->contact_wa ?? '6282117123456';
                        $waRaw = preg_replace('/[^0-9]/', '', $waNumber);
                        $waBase = preg_replace('/^62|^0/', '', $waRaw);
                        $formattedWa = '+62 ' . substr($waBase, 0, 3) . '-' . substr($waBase, 3, 4) . '-' . substr($waBase, 7);
                        $waLink = '62' . $waBase;
                    @endphp
                    <a href="https://wa.me/{{ $waLink }}" target="_blank" title="Chat on WhatsApp with {{ $formattedWa }}"
                        aria-label="Chat on WhatsApp with {{ $formattedWa }}"
                        class="w-full sm:w-auto px-10 py-4 bg-green-700 hover:bg-green-800 text-white font-bold rounded-lg shadow-lg transition-all flex items-center justify-center gap-3 text-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Hubungi Kami
                    </a>
                </div>

            </div>
        </section>

    </div>
@endsection