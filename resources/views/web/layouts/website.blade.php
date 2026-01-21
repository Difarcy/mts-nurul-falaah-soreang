<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>
        @yield('title'){{ View::hasSection('title') ? ' | ' : '' }}{{ $globalSchoolProfile->nama_sekolah }}
    </title>

    @php
        // Use ViewServiceProvider shared data
        $visualIdentity = $visualIdentity ?? \App\Models\VisualIdentity::first();
        $faviconPath = $visualIdentity && $visualIdentity->logo_path ? ('storage/' . $visualIdentity->logo_path) : 'images/logo/logo.png';
        // Cache busting: untuk storage gunakan updated_at, untuk file default gunakan filemtime
        if ($visualIdentity && $visualIdentity->logo_path) {
            $faviconVersion = $visualIdentity->updated_at ? $visualIdentity->updated_at->timestamp : time();
        } else {
            $faviconVersion = file_exists(public_path($faviconPath)) ? filemtime(public_path($faviconPath)) : null;
        }
    @endphp
    <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ asset($faviconPath) }}@if($faviconVersion)?v={{ $faviconVersion }}@endif">

    <!-- Google Fonts - Roboto (sudah diimport di app.css) -->

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/web.css', 'resources/js/app.js', 'resources/js/web/web.js'])
    @stack('styles')
</head>

<body class="bg-gray-50 dark:bg-slate-900">
    <div class="min-h-screen flex flex-col">
        @include('web.components.top-bar')
        @include('web.components.header')

        <main class="grow">
            @yield('content')
        </main>

        @include('web.components.footer')
    </div>

    {{-- Chatbot Widget (All pages) --}}
    @include('web.components.chatbot-widget')

    <x-notifications />

    @stack('scripts')
</body>

</html>