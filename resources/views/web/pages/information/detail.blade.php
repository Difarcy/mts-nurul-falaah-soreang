@extends('web.layouts.website')

@section('title', $post->title . ' - ' . $globalSchoolProfile->nama_sekolah)

@section('content')
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 max-w-7xl py-8 sm:py-12">
        <!-- Breadcrumb -->
        <nav class="mb-2" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-black dark:text-slate-400">
                <li>
                    <span class="text-gray-400 dark:text-slate-500 cursor-default">Informasi</span>
                </li>
                <li>
                    <svg class="w-4 h-4 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>
                    <a href="{{ $post->type === 'berita' ? route('informasi.berita') : route('informasi.artikel') }}"
                        class="hover:text-green-700 dark:hover:text-green-400 transition-colors">
                        {{ ucfirst($post->type) }}
                    </a>
                </li>
                <li>
                    <svg class="w-4 h-4 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li class="text-black dark:text-slate-100 font-medium line-clamp-1" title="{{ $post->title }}">
                    {{ str()->limit($post->title, 60) }}
                </li>
            </ol>
        </nav>

        @if(isset($displayTags) && !empty($displayTags))
            <div class="mb-6 flex flex-wrap items-center gap-2">
                @foreach($displayTags as $tag)
                    <a href="{{ route('informasi.tag', ['tag' => urlencode($tag), 'type' => $post->type]) }}"
                        class="inline-flex items-center px-1.5 py-0.5 text-[10px] font-bold bg-green-700 text-white hover:bg-green-800 dark:bg-green-600 dark:text-white dark:hover:bg-green-700 transition-colors cursor-pointer rounded-none">
                        {{ $tag }}
                    </a>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Main Content (2/3 width) -->
            <div class="lg:col-span-2">
                <article id="post-detail-container"
                    data-fallback-image="{{ asset('images/background/default-backgrounds.png') }}"
                    data-post-type="{{ $post->type }}" data-post-slug="{{ $post->slug }}">
                    <div class="space-y-4">
                        <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 dark:text-slate-100 leading-tight">
                            {{ $post->title }}
                        </h1>

                        <div
                            class="flex flex-wrap items-center justify-between gap-3 text-xs text-black dark:text-slate-400 uppercase tracking-wide">
                            <div class="flex flex-wrap items-center gap-3">
                                <span>{{ ucfirst($post->type) }} |
                                    {{ ($post->published_at ?? $post->created_at)->translatedFormat('d F Y') }} |
                                    {{ ($post->published_at ?? $post->created_at)->format('H:i') }}</span>
                                @if($post->author_name)
                                    <span class="normal-case">Oleh <strong
                                            class="font-bold text-black dark:text-white">{{ $post->author_name }}</strong></span>
                                @elseif($post->author?->name)
                                    <span class="normal-case">Oleh <strong
                                            class="font-bold text-black dark:text-white">{{ $post->author->name }}</strong></span>
                                @endif
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-black dark:text-slate-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    <span class="text-black dark:text-slate-400">{{ $post->view_count ?? 0 }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-black dark:text-slate-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    <span class="text-black dark:text-slate-400">{{ $comments->count() }}</span>
                                </div>
                            </div>
                        </div>

                        @php
                            // Use InfoText for social links if not provided by controller or shared data
                            $facebookUrl = \App\Models\InfoText::where('key', '=', 'top_bar_facebook_url', 'and')->value('value') ?? route('social-media-unavailable');
                            $instagramUrl = \App\Models\InfoText::where('key', '=', 'top_bar_instagram_url', 'and')->value('value') ?? route('social-media-unavailable');
                            $youtubeUrl = \App\Models\InfoText::where('key', '=', 'top_bar_youtube_url', 'and')->value('value') ?? route('social-media-unavailable');
                            $tiktokUrl = \App\Models\InfoText::where('key', '=', 'top_bar_tiktok_url', 'and')->value('value') ?? route('social-media-unavailable');
                            $twitterUrl = \App\Models\InfoText::where('key', '=', 'top_bar_twitter_url', 'and')->value('value') ?? route('social-media-unavailable');
                        @endphp

                        <!-- Social Media Icons (Follow) -->
                        <div class="flex items-center gap-3">
                            <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300 rounded"
                                aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                </svg>
                            </a>
                            <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center bg-pink-600 text-white hover:bg-pink-700 transition-colors duration-300 rounded"
                                aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center bg-red-600 text-white hover:bg-red-700 transition-colors duration-300 rounded"
                                aria-label="YouTube">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                            <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer"
                                class="w-10 h-10 flex items-center justify-center bg-black text-white hover:bg-gray-900 transition-colors duration-300 rounded"
                                aria-label="TikTok">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                                </svg>
                            </a>
                        </div>

                        @if(!empty($post->images))
                            @php
                                $imageCount = count($post->images);

                                if ($imageCount === 1) {
                                    // 1 gambar: full width landscape
                                    $gridCols = 'grid-cols-1';
                                } else {
                                    // 2-6 gambar: 2 kolom landscape (1 baris untuk 2 gambar, 2 baris untuk 4 gambar, 3 baris untuk 6 gambar)
                                    $gridCols = 'grid-cols-2';
                                }
                            @endphp
                            <div class="grid {{ $gridCols }} gap-4 my-6">
                                @foreach($post->images as $index => $image)
                                    @php
                                        $metadata = null;
                                        if ($post->image_metadata && is_array($post->image_metadata)) {
                                            $metadata = collect($post->image_metadata)->firstWhere('path', $image);
                                        }
                                    @endphp
                                    <div class="relative">
                                        <div class="overflow-hidden border border-gray-200 dark:border-slate-700 rounded-none">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Gambar {{ $loop->iteration }}"
                                                class="w-full aspect-video object-cover js-img-fallback" loading="lazy"
                                                data-fallback-src="{{ asset('images/background/default-backgrounds.png') }}">
                                        </div>
                                        @if($metadata && ($metadata['source_url'] || $metadata['source_name']))
                                            <div class="mt-2 text-xs text-black dark:text-slate-400">
                                                <span class="font-semibold">Sumber:</span>
                                                @if($metadata['source_url'])
                                                    <a href="{{ $metadata['source_url'] }}" target="_blank" rel="noopener noreferrer"
                                                        class="text-green-700 dark:text-green-400 hover:underline">
                                                        {{ $metadata['source_name'] ?? 'Link' }}
                                                    </a>
                                                @else
                                                    <span>{{ $metadata['source_name'] }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div
                            class="prose prose-base max-w-none prose-slate dark:prose-invert prose-p:text-black dark:prose-p:text-slate-100 prose-headings:font-semibold prose-headings:tracking-tight prose-h1:text-lg sm:prose-h1:text-xl md:prose-h1:text-2xl prose-h2:text-lg sm:prose-h2:text-xl md:prose-h2:text-2xl prose-h3:text-base sm:prose-h3:text-xl prose-a:text-green-700 dark:prose-a:text-green-400 prose-a:no-underline hover:prose-a:underline prose-img:rounded-none prose-pre:bg-slate-900 dark:prose-pre:bg-slate-800 prose-code:bg-slate-100 dark:prose-code:bg-slate-800 prose-table:w-full prose-th:border prose-td:border prose-th:border-slate-300 dark:prose-th:border-slate-700 prose-td:border-slate-300 dark:prose-td:border-slate-700">
                            <div class="editor-content overflow-x-auto">
                                {!! $post->body !!}
                            </div>
                        </div>

                        @if(isset($relatedPosts) && $relatedPosts->isNotEmpty() && $post->type !== 'berita')
                            <!-- Baca Juga Section (hanya untuk artikel) -->
                            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-slate-700">
                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-slate-100 mb-3">Baca Juga:</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($relatedPosts->take(3) as $item)
                                        @php
                                            $dateObj = $item->published_at ?? $item->created_at;
                                            $date = $dateObj->translatedFormat('d F Y');
                                            $time = $dateObj->format('H:i');
                                        @endphp
                                        <a href="{{ route('informasi.show', ['type' => $item->type, 'slug' => $item->slug]) }}"
                                            class="block">
                                            <div class="w-full hover:opacity-90 transition-opacity">
                                                @if($item->thumbnail_path)
                                                    <img src="{{ asset('storage/' . $item->thumbnail_path) }}" alt="{{ $item->title }}"
                                                        class="w-full h-32 object-cover" loading="lazy">
                                                @else
                                                    <img src="{{ asset('images/background/default-backgrounds.png') }}"
                                                        alt="{{ $item->title }}" class="w-full h-32 object-cover" loading="lazy">
                                                @endif
                                            </div>
                                            <div class="p-2.5">
                                                <h4
                                                    class="text-sm sm:text-base font-semibold text-black dark:text-slate-100 mb-1 line-clamp-2 hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                                    {{ $item->title }}
                                                </h4>
                                                <p class="text-sm text-black dark:text-slate-400">
                                                    {{ $date }} | {{ $time }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Share Section -->
                        <div class="pt-4 mt-4 border-t border-gray-200 dark:border-slate-700">
                            <p class="text-base font-semibold text-slate-700 dark:text-slate-300 mb-2">Bagikan
                                {{ $post->type === 'berita' ? 'berita' : 'artikel' }} ini:
                            </p>
                            <div class="flex items-center gap-3">
                                @php
                                    $shareUrl = url()->current();
                                    $shareTitle = $post->title;
                                    $shareText = $post->title;
                                @endphp
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300 rounded"
                                    aria-label="Bagikan di Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="w-10 h-10 flex items-center justify-center bg-black text-white hover:bg-gray-800 transition-colors duration-300 rounded"
                                    aria-label="Bagikan di Twitter">
                                    <!-- X Logo -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                    </svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $shareUrl) }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-10 h-10 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition-colors duration-300 rounded"
                                    aria-label="Bagikan di WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="w-10 h-10 flex items-center justify-center bg-blue-700 text-white hover:bg-blue-800 transition-colors duration-300 rounded"
                                    aria-label="Bagikan di LinkedIn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Suggested Posts Section (hanya untuk berita) -->
                @if($post->type === 'berita' && $suggestedPosts->isNotEmpty())
                    <section class="mt-10">
                        <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 dark:text-slate-100 mb-3">Berita yang Disarankan
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($suggestedPosts as $item)
                                @php
                                    $dateObj = $item->published_at ?? $item->created_at;
                                    $date = $dateObj->translatedFormat('d F Y');
                                    $time = $dateObj->format('H:i');
                                @endphp
                                <article
                                    class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 overflow-hidden hover:shadow-md transition-all duration-300">
                                    <a href="{{ route('informasi.show', ['type' => $item->type, 'slug' => $item->slug]) }}"
                                        class="block">
                                        <div class="w-full hover:opacity-90 transition-opacity">
                                            @if($item->thumbnail_path)
                                                <img src="{{ asset('storage/' . $item->thumbnail_path) }}" alt="{{ $item->title }}"
                                                    class="w-full h-32 object-cover">
                                            @else
                                                <div class="w-full h-32 bg-gray-200 dark:bg-slate-700 flex items-center justify-center">
                                                    <span class="text-black dark:text-slate-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-2.5">
                                            <h3
                                                class="text-sm sm:text-base font-semibold text-black dark:text-slate-100 mb-1 line-clamp-2 hover:text-green-700 dark:hover:text-green-400 transition-colors">
                                                {{ $item->title }}
                                            </h3>
                                            <p class="text-sm text-black dark:text-slate-400">
                                                {{ $date }} | {{ $time }}
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Comments Section -->
                <section class="mt-10">
                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 dark:text-slate-100 mb-6">Komentar ({{ $commentsCount }})
                    </h2>

                    @if($comments->isNotEmpty())
                        <div class="space-y-2 mb-8">
                            @foreach($comments as $comment)
                                @include('web.pages.information._comment_node', ['comment' => $comment, 'commentsByParent' => $commentsByParent, 'likedCommentIds' => $likedCommentIds, 'level' => 0])
                            @endforeach
                        </div>
                    @else
                        <p class="text-base text-slate-500 dark:text-slate-400 mb-8">Belum ada komentar. Jadilah yang pertama
                            berkomentar!</p>
                    @endif

                    <div id="inline-reply-template" class="hidden">
                        <div
                            class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-xl">
                            <div
                                class="px-4 pt-4 pb-3 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                                <h3 class="text-base sm:text-xl font-bold text-slate-900 dark:text-slate-100">Balas Komentar</h3>
                                <button type="button"
                                    class="inline-reply-close w-9 h-9 inline-flex items-center justify-center rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="p-4">
                                <form method="POST"
                                    action="{{ route('comments.store', ['type' => $post->type, 'slug' => $post->slug]) }}"
                                    class="space-y-4 inline-reply-form">
                                    @csrf
                                    <input type="hidden" name="parent_id" class="inline-reply-parent" value="">

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label for="inline-reply-name"
                                                class="block text-base font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama
                                                <span class="text-red-600 dark:text-red-500">*</span></label>
                                            <input type="text" id="inline-reply-name" name="name" maxlength="100" required
                                                autocomplete="name"
                                                class="inline-reply-name w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-600 focus:border-green-600"
                                                placeholder="Masukkan nama Anda">
                                        </div>
                                        <div>
                                            <label for="inline-reply-email"
                                                class="block text-base font-semibold text-slate-700 dark:text-slate-300 mb-2">Email
                                                <span
                                                    class="text-red-600 dark:text-red-500 inline-reply-email-required">*</span></label>
                                            <input type="email" id="inline-reply-email" name="email" maxlength="120"
                                                required autocomplete="email"
                                                class="inline-reply-email w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-600 focus:border-green-600"
                                                placeholder="Masukkan email Anda">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" name="anonymous" value="1"
                                                class="inline-reply-anonymous rounded border-gray-300 dark:border-slate-600 text-green-700 focus:ring-green-600">
                                            <span class="text-base text-slate-700 dark:text-slate-300">Komentar
                                                sebagai
                                                Anonymous</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label for="inline-reply-comment"
                                            class="block text-base font-semibold text-slate-700 dark:text-slate-300 mb-2">Komentar
                                            <span class="text-red-600 dark:text-red-500">*</span></label>
                                        <!-- Emoji Wrapper -->
                                        <div class="relative group">
                                            <textarea id="inline-reply-comment" name="comment" rows="5" required
                                                autocomplete="on"
                                                class="inline-reply-text text-base w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-lg px-4 py-2 pb-12 focus:ring-2 focus:ring-green-600 focus:border-green-600"
                                                placeholder="Tulis balasan..."></textarea>

                                            <!-- Emoji Trigger -->
                                            <button type="button"
                                                class="inline-reply-emoji-trigger absolute bottom-3 right-3 p-2 text-slate-400 hover:text-yellow-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors"
                                                title="Sisipkan Emoji">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>

                                            <!-- Emoji Picker Popover -->
                                            <div
                                                class="emoji-picker-container absolute bottom-14 right-0 z-50 hidden shadow-lg rounded-xl border border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 overflow-hidden transition-all duration-200">
                                                <emoji-picker class="light dark:dark"></emoji-picker>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-3 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-3">
                                        <button type="button"
                                            class="inline-reply-cancel px-5 py-2 text-base font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">Batal</button>
                                        <button type="submit"
                                            class="px-5 py-2 text-base font-semibold text-white bg-green-700 rounded-lg hover:bg-green-800 transition-colors">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Leave a Reply Form -->
                    <div class="pt-6">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 dark:text-slate-100 mb-6">Tinggalkan Komentar</h3>

                        @if(session('comment_success'))
                            <div
                                class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-300 text-base">
                                {{ session('comment_success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div
                                class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                <ul class="text-red-800 dark:text-red-300 text-base space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('comments.store', ['type' => $post->type, 'slug' => $post->slug]) }}"
                            method="POST" class="space-y-4" id="comment-form">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="name"
                                        class="block text-base font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama
                                        <span class="text-red-600 dark:text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                        autocomplete="name"
                                        class="w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-none px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
                                        placeholder="Masukkan nama Anda">
                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-base font-semibold text-slate-700 dark:text-slate-300 mb-2">Email
                                        <span class="text-red-600 dark:text-red-500" id="email-required">*</span></label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                        autocomplete="email"
                                        class="w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-none px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition-colors"
                                        placeholder="Masukkan email Anda">
                                </div>
                            </div>
                            <div>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" id="anonymous" name="anonymous" value="1"
                                        class="rounded border-gray-300 dark:border-slate-600 text-green-700 focus:ring-green-600"
                                        {{ old('anonymous') ? 'checked' : '' }}>
                                    <span class="text-base text-slate-700 dark:text-slate-300">Komentar sebagai
                                        Anonymous</span>
                                </label>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Centang jika Anda tidak ingin
                                    mencantumkan nama dan email</p>
                            </div>
                            <div>
                                <label for="comment"
                                    class="block text-base font-semibold text-slate-700 dark:text-slate-300 mb-2">Komentar
                                    <span class="text-red-600 dark:text-red-500">*</span></label>

                                <!-- Emoji Wrapper -->
                                <div class="relative">
                                    <textarea id="comment" name="comment" rows="6" required autocomplete="on"
                                        class="text-base w-full border border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-none px-4 py-2 pb-12 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent"
                                        placeholder="Tulis komentar Anda di sini...">{{ old('comment') }}</textarea>

                                    <!-- Emoji Trigger -->
                                    <button type="button" id="public-emoji-trigger-btn"
                                        class="absolute bottom-3 right-3 p-2 text-slate-400 hover:text-yellow-500 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors pointer-events-auto z-30"
                                        title="Sisipkan Emoji">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>

                                    <!-- Emoji Picker Popover -->
                                    <div id="public-emoji-picker-container"
                                        class="absolute bottom-12 right-0 z-50 hidden shadow-lg rounded-xl border border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-800 overflow-hidden transition-all duration-200">
                                        <emoji-picker class="light dark:dark"></emoji-picker>
                                    </div>
                                </div>

                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Maksimal 1000 karakter</p>
                            </div>
                            <div>
                                <button type="submit"
                                    class="px-6 py-2 bg-green-700 text-white font-semibold rounded-none hover:bg-green-800 text-base transition-colors">
                                    Kirim Komentar
                                </button>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">* Komentar akan ditinjau oleh
                                    admin sebelum dipublikasikan</p>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

            <!-- Sidebar (1/3 width) -->
            <div class="lg:col-span-1">
                @if($post->type === 'berita')
                    {{-- If News Detail, show Announcements and Agenda --}}
                    @include('web.components.post-sidebar', [
                        'articles' => [],
                        'announcements' => $announcements ?? [],
                        'agenda' => $agendaItems ?? [],
                        'showSocialMedia' => false,
                        'announcementFirst' => true,
                        'schoolProfile' => null
                    ])
                @else
            {{-- If Article Detail, show Agenda and Social Media like Homepage --}}
            @include('web.components.post-sidebar', [
                'articles' => [],
                'announcements' => [],
                'agenda' => $agendaItems ?? [],
                'showSocialMedia' => true,
                'agendaFirst' => true,
                'schoolProfile' => null
            ])
        @endif
                        </div>
                    </div>
                </div>
                <!-- Bottom Sheet Reply Modal -->
                <div id="public-reply-bottom-sheet"
                    class="hidden fixed inset-0 z-50 items-end justify-center bg-black/30 dark:bg-black/50">
                    <div
                        class="w-full max-w-2xl bg-white dark:bg-slate-800 rounded-t-xl shadow-2xl border border-gray-200 dark:border-slate-700">
                        <div id="public-reply-bottom-sheet-content" class="p-4"></div>
                    </div>
                </div>
                </div>

@endsection
