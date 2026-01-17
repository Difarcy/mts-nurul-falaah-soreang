@extends('web.layouts.website')

@section('title', 'Kontak')

@section('content')
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl py-8 sm:py-12 relative">
        <x-breadcrumb :items="[
            ['label' => 'Kontak']
        ]" />

        <x-page-title title="Kontak" />

        <div class="flex flex-col lg:flex-row gap-12 mt-8 animate-on-scroll">
            <!-- Kolom Kiri: Informasi Kontak -->
            <div class="flex flex-row gap-8 sm:gap-12 shrink-0">
                <div class="space-y-8">
                    <h1 class="text-2xl font-bold text-black dark:text-slate-100 uppercase mb-6 hidden">HUBUNGI KAMI</h1>

                    <!-- Kontak -->
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-green-700 dark:text-green-500 mb-4">Kontak :</h2>
                        <ul class="space-y-3">
                            @if($siteWhatsapp)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-green-700 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                        </svg>
                                    </div>
                                    @php
                                        // Unified formatting logic
                                        $waRaw = preg_replace('/[^0-9]/', '', $siteWhatsapp);
                                        $waBase = preg_replace('/^62|^0/', '', $waRaw);
                                        $formattedWa = '+62 ' . substr($waBase, 0, 3) . '-' . substr($waBase, 3, 4) . '-' . substr($waBase, 7);
                                        $waLink = '62' . $waBase;
                                    @endphp
                                    <a href="https://wa.me/{{ $waLink }}" target="_blank" rel="noopener noreferrer"
                                        title="Chat on WhatsApp with {{ $formattedWa }}"
                                        class="text-black dark:text-slate-300 text-base hover:text-green-700 transition-colors">{{ $formattedWa }}</a>
                                </li>
                            @endif
                            @if($sitePhone)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-green-700 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    @php
                                        $phRaw = preg_replace('/[^0-9]/', '', $sitePhone);
                                        $phBase = preg_replace('/^62|^0/', '', $phRaw);
                                        $formattedPh = '+62 ' . substr($phBase, 0, 3) . '-' . substr($phBase, 3, 4) . '-' . substr($phBase, 7);
                                    @endphp
                                    <a href="tel:{{ $phRaw }}" title="Call {{ $formattedPh }}"
                                        class="text-black dark:text-slate-300 text-base hover:text-green-700 transition-colors">{{ $formattedPh }}</a>
                                </li>
                            @endif
                            @if($siteEmail)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-green-700 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <a href="mailto:{{ $siteEmail }}" title="Email {{ $siteEmail }}"
                                        class="text-black dark:text-slate-300 text-base hover:text-green-700 transition-colors">{{ $siteEmail }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-green-700 dark:text-green-500 mb-4">Alamat :</h2>
                        @if($siteAddress)
                            <div class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-green-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <p class="text-black dark:text-slate-100 text-base leading-relaxed max-w-62.5">
                                    {!! nl2br(e($siteAddress)) !!}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Social Media Buttons (Middle Position) -->
                <div class="flex flex-col gap-4 w-14 pt-0 mt-1">
                    <!-- Facebook -->
                    <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer"
                        class="group w-10 h-10 sm:w-14 sm:h-14 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 flex items-center justify-center hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-200 dark:hover:border-blue-800 transition-all duration-300 rounded-none overflow-hidden">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600 group-hover:scale-110 transition-all duration-300"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer"
                        class="group w-10 h-10 sm:w-14 sm:h-14 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 flex items-center justify-center hover:bg-pink-50 dark:hover:bg-pink-900/20 hover:border-pink-200 dark:hover:border-pink-800 transition-all duration-300 rounded-none overflow-hidden">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-pink-600 group-hover:scale-110 transition-all duration-300"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5A4.25 4.25 0 0020.5 16.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 1.5a3.5 3.5 0 100 7 3.5 3.5 0 000-7zm5.25-2.5a1 1 0 110 2 1 1 0 010-2z" />
                        </svg>
                    </a>
                    <!-- X (Twitter) -->
                    <a href="{{ $socialTwitter }}" target="_blank" rel="noopener noreferrer"
                        class="group w-10 h-10 sm:w-14 sm:h-14 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-slate-700 hover:border-gray-300 dark:hover:border-slate-600 transition-all duration-300 rounded-none overflow-hidden"
                        aria-label="X (Twitter)">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-black dark:text-white group-hover:scale-110 transition-all duration-300"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a href="{{ $socialYoutube }}" target="_blank" rel="noopener noreferrer"
                        class="group w-10 h-10 sm:w-14 sm:h-14 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 flex items-center justify-center hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-200 dark:hover:border-red-800 transition-all duration-300 rounded-none overflow-hidden">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-red-600 group-hover:scale-110 transition-all duration-300"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                        </svg>
                    </a>
                    <!-- TikTok -->
                    <a href="{{ $socialTiktok }}" target="_blank" rel="noopener noreferrer"
                        class="group w-10 h-10 sm:w-14 sm:h-14 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-slate-700 hover:border-gray-300 dark:hover:border-slate-600 transition-all duration-300 rounded-none overflow-hidden">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-black dark:text-white group-hover:scale-110 transition-all duration-300"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Kolom Kanan: Form -->
            <div class="flex-1 mt-1">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" autocomplete="name"
                        required
                        class="w-full border border-gray-300 dark:border-slate-600 p-3 text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent bg-white dark:bg-slate-800 rounded-none">
                    @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email"
                        autocomplete="email" required
                        class="w-full border border-gray-300 dark:border-slate-600 p-3 text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent bg-white dark:bg-slate-800 rounded-none">
                    @error('email') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror

                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Nomor Telepon / WhatsApp"
                        autocomplete="tel"
                        class="w-full border border-gray-300 dark:border-slate-600 p-3 text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent bg-white dark:bg-slate-800 rounded-none">
                    @error('phone') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror

                    <textarea name="message" rows="8" placeholder="Tulis pesan Anda di sini..." required
                        class="w-full border border-gray-300 dark:border-slate-600 p-3 text-base focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent bg-white dark:bg-slate-800 rounded-none resize-none">{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror

                    <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-6 sm:px-8 text-base uppercase transition-colors rounded-none">
                        KIRIM PESAN
                    </button>
                </form>
            </div>
        </div>

        <!-- Peta Lokasi -->
        <div class="mt-12 animate-on-scroll">
            <h2
                class="text-lg sm:text-xl md:text-2xl font-bold text-black dark:text-slate-100 mb-6 flex items-center gap-3">
                <span class="w-px h-6 sm:h-8 bg-green-700 dark:bg-green-500"></span>
                Peta Lokasi
            </h2>

            @if($siteCoordinates)
                <div class="w-full aspect-video overflow-hidden rounded-none border border-gray-300 dark:border-slate-600">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.1234567890123!2d107.5368!3d-7.0339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDInMDIuMCJTIDEwN8KwMzInMTIuNSJF!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid"
                        width="100%" height="100%" class="border-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full h-full"></iframe>
                </div>

                <div class="mt-4 text-center">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $siteCoordinates }}" target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-base transition-colors duration-300 group">
                        Buka di Google Maps
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            @else
                <div
                    class="w-full aspect-video bg-gray-100 dark:bg-slate-800 flex items-center justify-center rounded-none border border-gray-300 dark:border-slate-600">
                    <p class="text-black dark:text-slate-400 font-medium">Peta belum ada</p>
                </div>
            @endif
        </div>

        <!-- Floating WhatsApp Button -->
        @if($siteWhatsapp)
            <a href="https://wa.me/{{ $waLink }}" target="_blank" rel="noopener noreferrer"
                title="Chat on WhatsApp with {{ $formattedWa }}"
                class="fixed bottom-6 right-6 z-50 w-12 h-12 sm:w-16 sm:h-16 bg-white rounded-full shadow-lg flex items-center justify-center border-2 border-green-600 hover:scale-110 transition-transform duration-300"
                aria-label="Chat on WhatsApp with {{ $formattedWa }}">
                <div class="w-9 h-9 sm:w-12 sm:h-12 bg-green-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                </div>
            </a>
        @endif
    </div>
@endsection