@extends('web.layouts.website')

@section('title', ($item->judul ?? 'Prestasi Siswa') . ' | ' . $globalSchoolProfile->nama_sekolah)

@section('content')
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl py-8 sm:py-12">
        <nav class="mb-2" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-black dark:text-slate-400">
                <li>
                    <span class="text-gray-400 dark:text-slate-500 cursor-default">Profil</span>
                </li>
                <li>
                    <svg class="w-4 h-4 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>
                    <a href="{{ route('profil.prestasi') }}"
                        class="hover:text-green-700 dark:hover:text-green-400 transition-colors">Prestasi Siswa</a>
                </li>
                <li>
                    <svg class="w-4 h-4 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li class="text-black dark:text-slate-100 font-medium line-clamp-1" title="{{ $item->judul }}">
                    {{ str()->limit($item->judul, 60) }}
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mt-4">
            <div class="lg:col-span-2">
                <article>
                    <div class="space-y-4">
                        <h1
                            class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 dark:text-slate-100 leading-tight">
                            {{ $item->judul }}
                        </h1>
                        <div
                            class="flex flex-wrap items-center gap-2 text-xs text-black dark:text-slate-400 uppercase tracking-wide">
                            @if($item->jenis_prestasi)
                                <span
                                    class="inline-block px-2 py-0.5 text-[10px] font-bold text-green-700 bg-green-100 dark:bg-green-900/30 dark:text-green-300 rounded">{{ $item->jenis_prestasi }}</span>
                            @endif
                            @if($item->tingkat_prestasi)
                                <span
                                    class="inline-block px-2 py-0.5 text-[10px] font-bold text-white bg-green-600 rounded">{{ $item->tingkat_prestasi }}</span>
                            @endif
                            <span>{{ $item->tanggal_prestasi ? $item->tanggal_prestasi->translatedFormat('d F Y') : '' }}</span>
                        </div>

                        @if($item->gambar)
                            <div class="w-full overflow-hidden max-w-2xl mx-auto">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="w-full aspect-square object-cover js-img-fallback" loading="lazy"
                                    data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                            </div>
                        @endif



                        <div class="p-0 mt-6">
                            <!-- Header with Name and Class (No Avatar) -->
                            <div class="mb-3">
                                <p
                                    class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 dark:text-slate-100 mb-0.5">
                                    {{ $item->nama_siswa }}
                                </p>
                                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">
                                    {{ $item->kelas ? 'Kelas ' . $item->kelas : 'Siswa Berprestasi' }}
                                </p>
                            </div>

                            <div
                                class="prose prose-base max-w-none prose-slate dark:prose-invert prose-p:text-black dark:prose-p:text-slate-100 prose-headings:font-semibold prose-headings:tracking-tight prose-h1:text-lg sm:prose-h1:text-xl md:prose-h1:text-2xl prose-h2:text-lg sm:prose-h2:text-xl md:prose-h2:text-2xl prose-h3:text-base sm:prose-h3:text-xl prose-a:text-green-700 dark:prose-a:text-green-400 prose-a:no-underline hover:prose-a:underline prose-img:rounded-none prose-pre:bg-slate-900 dark:prose-pre:bg-slate-800 prose-code:bg-slate-100 dark:prose-code:bg-slate-800 prose-table:w-full prose-th:border prose-td:border prose-th:border-slate-300 dark:prose-th:border-slate-700 prose-td:border-slate-300 dark:prose-td:border-slate-700">
                                <div class="editor-content overflow-x-auto">{!! $item->deskripsi !!}</div>
                            </div>

                            <!-- Sertifikat Section -->
                            @if($item->foto_sertifikat)
                                <div class="mt-8">
                                    <h3
                                        class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 dark:text-slate-100 mb-4 text-center">
                                        Sertifikat
                                        / Piagam</h3>
                                    <div
                                        class="rounded-lg overflow-hidden border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50 p-2 max-w-2xl mx-auto">
                                        <a href="{{ asset('storage/' . $item->foto_sertifikat) }}" target="_blank"
                                            rel="noopener" class="block">
                                            <img src="{{ asset('storage/' . $item->foto_sertifikat) }}"
                                                alt="Sertifikat {{ $item->judul }}"
                                                class="w-full h-auto rounded shadow-sm hover:scale-[1.02] transition-transform duration-300">
                                        </a>
                                        <p class="text-xs text-center text-black dark:text-slate-400 mt-2">Klik gambar untuk
                                            memperbesar</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Share Buttons (Moved to bottom) -->
                            <div class="mt-6">
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Bagikan Prestasi
                                    Ini:</p>
                                <div class="flex items-center gap-3">
                                    @php
                                        $shareUrl = url()->current();
                                        $shareText = 'Prestasi Siswa: ' . $item->judul . ' - ' . $item->nama_siswa;
                                    @endphp
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300 rounded"
                                        aria-label="Facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                        </svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center bg-black text-white hover:bg-gray-800 transition-colors duration-300 rounded"
                                        aria-label="Twitter">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                        </svg>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $shareUrl) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition-colors duration-300 rounded"
                                        aria-label="WhatsApp">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <!-- Sidebar (1/3 width) -->
            <div class="lg:col-span-1">
                @include('web.components.post-sidebar', [
                    'articles' => $latestPosts ?? [],
                    'announcements' => [],
                    'agenda' => $agendaItems ?? [],
                    'showSocialMedia' => false,
                    'articleFirst' => true,
                    'schoolProfile' => null
                ])
                                        </div>
                                    </div>
                                </div>
@endsection
