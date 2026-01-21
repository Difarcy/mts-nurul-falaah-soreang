@extends('web.layouts.website')

@section('title', 'Tentang Sekolah')

@section('content')
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl py-8 sm:py-12">
        <x-breadcrumb :items="[
            ['label' => 'Profil'],
            ['label' => 'Tentang Sekolah']
        ]" />
        <!-- Header Section -->
        <div class="mb-8">
            <x-page-title title="Tentang Sekolah" />
        </div>

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-4">
            <!-- Kiri: Konten (70%) -->
            <div class="w-full lg:w-[70%]">
                <!-- Subtitle -->
                <h2
                    class="text-base sm:text-lg md:text-xl font-bold text-gray-900 dark:text-slate-100 mb-6 text-center uppercase animate-on-scroll">
                    {{ $schoolProfile->nama_sekolah }}
                </h2>

                <!-- Foto Gedung Sekolah -->
                @if($schoolProfile->gambar_sekolah)
                    <img src="{{ asset('storage/' . $schoolProfile->gambar_sekolah) }}"
                        alt="Gedung {{ $schoolProfile->nama_sekolah }}"
                        class="w-full h-80 sm:h-96 md:h-112.5 object-cover mb-8 animate-on-scroll">
                @else
                    <div
                        class="w-full h-80 sm:h-96 md:h-112.5 bg-gray-200 dark:bg-slate-700 mb-8 flex items-center justify-center animate-on-scroll">
                        <span class="text-gray-400 dark:text-slate-500 font-semibold italic text-center px-4">Belum Ada Foto
                            Sekolah</span>
                    </div>
                @endif

                <div class="prose prose-base max-w-none dark:prose-invert animate-on-scroll text-black dark:text-slate-100">
                    @if($schoolProfile->deskripsi_sekolah)
                        {!! $schoolProfile->deskripsi_sekolah !!}
                    @else
                        <div class="flex items-center justify-center py-12">
                            <p class="text-base font-semibold text-gray-400 dark:text-slate-500 text-center">
                                Belum Ada Deskripsi Profil Sekolah
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Sejarah -->
                <div class="mt-8 animate-on-scroll">
                    <h2
                        class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-slate-100 mb-6 flex items-center gap-3">
                        <span class="w-px h-6 sm:h-8 bg-green-700 dark:bg-green-500"></span>
                        Sejarah
                    </h2>
                    <div class="w-full">
                        <div class="prose prose-base max-w-none dark:prose-invert text-black dark:text-slate-100">
                            @if($schoolProfile->sejarah)
                                {!! $schoolProfile->sejarah !!}
                            @else
                                <div class="flex items-center justify-center py-12">
                                    <p class="text-base font-semibold text-gray-400 dark:text-slate-500 text-center">
                                        Belum Ada Sejarah Singkat Sekolah
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Sidebar (30%) -->
            <div class="w-full lg:w-[30%] lg:-mt-4">
                @include('web.components.post-sidebar', [
                    'articles' => $articles ?? [],
                    'announcements' => $announcements ?? [],
                    'agenda' => null,
                    'articleFirst' => true,
                    'articleTitle' => 'Berita Terbaru',
                    'articleEmptyMessage' => 'Belum ada berita',
                    'schoolProfile' => null
                ])
                                                                        </div>
                                                                    </div>
                                                                </div>
@endsection
