@extends('web.layouts.website')

@section('title', 'Struktur Organisasi')

@section('content')
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl py-8 sm:py-12">
        <x-breadcrumb :items="[
            ['label' => 'Profil'],
            ['label' => 'Struktur Organisasi']
        ]" />
        <x-page-title title="Struktur Organisasi" />

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-4 mt-8">
            <!-- Kiri: Struktur Organisasi (70%) -->
            <div class="w-full lg:w-[70%]">
                @if($schoolProfile->struktur_organisasi)
                    <div class="relative w-full overflow-hidden animate-on-scroll">
                        <img src="{{ asset('storage/' . $schoolProfile->struktur_organisasi) }}"
                            alt="Struktur Organisasi {{ $schoolProfile->nama_sekolah }}"
                            class="w-full h-auto object-contain hover:scale-[1.02] transition-transform duration-500">
                    </div>
                @else
                    <div
                        class="w-full min-h-80 bg-gray-200 dark:bg-slate-700 rounded-xl flex items-center justify-center animate-on-scroll">
                        <span class="text-base text-gray-400 dark:text-slate-500 font-semibold text-center px-4">Belum
                            Ada Struktur
                            Organisasi</span>
                    </div>
                @endif
            </div>

            <!-- Kanan: Sidebar (30%) -->
            <div class="w-full lg:w-[30%] lg:-mt-4 space-y-8">
                @include('web.components.post-sidebar', [
                    'articles' => [],
                    'announcements' => $announcements ?? [],
                    'agenda' => $agenda ?? null,
                    'articleTitle' => 'Berita Terbaru',
                    'articleEmptyMessage' => 'Belum ada berita',
                    'schoolProfile' => null
                ])
                                                    </div>
                                                </div>
                                            </div>
@endsection
