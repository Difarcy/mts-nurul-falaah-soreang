@extends('web.layouts.website')

@section('title', 'Kepala Sekolah & Guru')

@section('content')
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl py-8 sm:py-12">
        <x-breadcrumb :items="[
            ['label' => 'Profil'],
            ['label' => 'Kepala Madrasah']
        ]" />
        <!-- Header Section -->
        <div class="mb-8">
            <x-page-title title="Sambutan Kepala Madrasah" />
        </div>

        <!-- Sambutan Kepala Madrasah -->
        <div class="mt-8">
            <!-- Konten Utama (Full Width) -->
            <div class="w-full">
                <div class="flex flex-col md:flex-row gap-8 items-start animate-on-scroll">
                    <!-- Gambar Kepala Madrasah (Kiri) -->
                    <div class="w-full md:w-[30%] lg:w-[25%] shrink-0">
                        @if($schoolProfile->kepala_sekolah_foto)
                            <img
                                src="{{ asset('storage/' . $schoolProfile->kepala_sekolah_foto) }}"
                                alt="Kepala Madrasah {{ $schoolProfile->nama_sekolah }}"
                                class="w-full aspect-3/4 object-cover max-h-144 rounded-lg shadow-md"
                            >
                        @else
                            <div class="w-full aspect-3/4 bg-gray-200 dark:bg-slate-700 flex items-center justify-center rounded-lg shadow-md">
                                <span class="text-gray-400 dark:text-slate-500 font-semibold text-center px-4">Belum Ada Foto</span>
                            </div>
                        @endif
                    </div>
                    <!-- Teks Sambutan (Kanan) -->
                    <div class="w-full md:w-[70%] lg:w-[75%] flex-1">
                        <div class="mb-6 text-center md:text-left border-b border-gray-200 dark:border-slate-700 pb-4">
                            <p class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-slate-100 mb-2">
                                {{ $schoolProfile->kepala_sekolah_nama ?? 'Kepala Madrasah' }}
                            </p>
                            <p class="text-sm sm:text-lg text-green-700 dark:text-green-500 font-medium">
                                - Kepala Madrasah -
                            </p>
                        </div>
                        <div class="prose prose-base max-w-none dark:prose-invert text-black dark:text-slate-100 text-justify leading-relaxed">
                            @if($schoolProfile->kepala_sekolah_sambutan)
                                {!! $schoolProfile->kepala_sekolah_sambutan !!}
                            @else
                                <div class="flex items-center justify-center py-12">
                                    <p class="text-sm sm:text-lg md:text-xl font-semibold text-gray-400 dark:text-slate-500 text-center">
                                        Belum Ada Sambutan Kepala Madrasah
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
