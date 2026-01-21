@php($title = $title ?? '')
@php($subtitle = $subtitle ?? null)
<div class="flex items-center gap-3 mb-6">
    <span class="w-px h-6 sm:h-8 bg-green-700 dark:bg-green-500"></span>
    <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 dark:text-slate-100">{{ $title }}</h1>
</div>
@if($subtitle)
    <p class="text-xs sm:text-xs text-gray-600 dark:text-slate-400 mb-4">{{ $subtitle }}</p>
@endif