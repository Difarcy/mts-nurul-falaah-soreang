<!-- Prestasi Siswa -->
<div class="mt-6">
    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-slate-100 mb-6 flex items-center gap-3">
        <span class="w-px h-6 sm:h-8 bg-green-700 dark:bg-green-500"></span>
        Prestasi Siswa
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @if(isset($prestasiSiswa) && $prestasiSiswa->count() > 0)
            @foreach($prestasiSiswa->take(2) as $item)
                <a href="{{ route('galeri.prestasi-siswa.show', $item) }}"
                    class="group relative block w-full aspect-square overflow-hidden bg-gray-900 shadow-md">
                    <!-- Full Background Image -->
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/background/default-backgrounds.png') }}"
                        alt="{{ $item->judul }}" class="absolute inset-0 w-full h-full object-cover" loading="lazy">

                    <!-- Gradient Overlay (Hidden by default, shown on hover) -->
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Content Overlay (Hidden by default, shown on hover, slide from bottom) -->
                    <div
                        class="absolute inset-0 flex flex-col justify-end p-5 z-10 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300 ease-out">
                        <!-- Title -->
                        <h3 class="text-sm sm:text-lg font-bold leading-tight mb-1 line-clamp-2 drop-shadow-md text-green-400">
                            {{ $item->judul }}
                        </h3>

                        <!-- Student Name & Info -->
                        <p class="text-[10px] sm:text-sm font-medium text-gray-200 truncate drop-shadow-sm">
                            {{ $item->nama_siswa }} {{ $item->kelas ? '(' . $item->kelas . ')' : '' }}
                        </p>
                    </div>
                </a>
            @endforeach
        @else
            <div class="col-span-full flex items-center justify-center py-12">
                <p class="text-base md:text-lg font-semibold text-gray-400 dark:text-slate-500 text-center">
                    Belum Ada Prestasi
                </p>
            </div>
        @endif
    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('profil.prestasi') }}"
            class="inline-flex items-center gap-2 text-green-700 dark:text-green-500 hover:text-green-800 dark:hover:text-green-400 font-semibold text-xs sm:text-base transition-colors duration-300 group">
            Lihat Semua Prestasi
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-3 w-3 sm:h-4 sm:w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>