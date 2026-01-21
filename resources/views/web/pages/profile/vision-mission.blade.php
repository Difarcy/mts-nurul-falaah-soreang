@extends('web.layouts.website')

@section('title', 'Visi & Misi')

@section('content')
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl py-8 sm:py-12">
        <x-breadcrumb :items="[
            ['label' => 'Profil'],
            ['label' => 'Visi & Misi']
        ]" />
        <!-- Header Section -->
        <div class="mb-8">
            <x-page-title title="Visi, Misi, dan Tujuan" />
        </div>

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-4">
            <!-- Kiri: Visi, Misi, dan Tujuan (70%) -->
            <div class="w-full lg:w-[70%]">
                <div class="space-y-6 sm:space-y-8">
                    <!-- Visi -->
                    <div
                        class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                        <div class="p-6 sm:p-8">
                            <h3
                                class="text-lg sm:text-xl md:text-2xl font-bold text-green-700 dark:text-green-500 mb-4 text-center uppercase">
                                - VISI -
                            </h3>
                            <div
                                class="prose prose-base dark:prose-invert max-w-none text-black dark:text-slate-100 leading-relaxed text-justify">
                                @if($schoolProfile->visi)
                                    {!! $schoolProfile->visi !!}
                                @else
                                    <div class="flex items-center justify-center py-8">
                                        <p
                                            class="text-sm sm:text-lg font-semibold text-gray-400 dark:text-slate-500 text-center">
                                            Belum Ada Visi
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Misi -->
                    <div
                        class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                        <div class="p-6 sm:p-8">
                            <h3
                                class="text-lg sm:text-xl md:text-2xl font-bold text-green-700 dark:text-green-500 mb-4 text-center uppercase">
                                - MISI -
                            </h3>
                            <div
                                class="prose prose-base dark:prose-invert max-w-none text-black dark:text-slate-100 leading-relaxed">
                                @if($schoolProfile->misi)
                                    {!! $schoolProfile->misi !!}
                                @else
                                    <div class="flex items-center justify-center py-8">
                                        <p
                                            class="text-sm sm:text-lg font-semibold text-gray-400 dark:text-slate-500 text-center">
                                            Belum Ada Misi
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Tujuan -->
                    <div
                        class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                        <div class="p-6 sm:p-8">
                            <h3
                                class="text-lg sm:text-xl md:text-2xl font-bold text-green-700 dark:text-green-500 mb-4 text-center uppercase">
                                - TUJUAN -
                            </h3>
                            <div
                                class="prose prose-base dark:prose-invert max-w-none text-black dark:text-slate-100 leading-relaxed">
                                @if($schoolProfile->tujuan)
                                    {!! $schoolProfile->tujuan !!}
                                @else
                                    <div class="flex items-center justify-center py-8">
                                        <p
                                            class="text-sm sm:text-lg font-semibold text-gray-400 dark:text-slate-500 text-center">
                                            Belum Ada Tujuan
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Sidebar (30%) -->
            <div class="w-full lg:w-[30%] lg:-mt-4 space-y-8">
                @include('web.components.post-sidebar', [
                    'articles' => $articles ?? [],
                    'announcements' => $announcements ?? [],
                    'agenda' => null,
                    'articleFirst' => true,
                    'articleTitle' => 'Artikel Terbaru',
                    'articleEmptyMessage' => 'Belum ada artikel',
                    'schoolProfile' => null
                ])
                                                            </div>
                                                        </div>
                                                    </div>
@endsection
