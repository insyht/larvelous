<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Homepage</title>

    @if (isset($jsIncludes))
        @foreach ($jsIncludes as $jsInclude)
            <script src="{{ $jsInclude }}" defer></script>
        @endforeach
    @endif
    @if (isset($cssIncludes))
        @foreach ($cssIncludes as $cssInclude)
            <link rel="stylesheet" href="{{ $cssInclude }}">
        @endforeach
    @endif

    {{ Vite::useHotFile('vendor/insyht/larvelous/larvelous.hot')->useBuildDirectory("vendor/insyht/larvelous")->withEntryPoints(['resources/sass/app.scss', 'resources/js/app.js']) }}
    @if (isset($viteIncludes))
        @foreach ($viteIncludes as $viteInclude)
            {{ Vite::useHotFile($viteInclude['hotFile'])->useBuildDirectory($viteInclude['buildDirectory'])->withEntryPoints($viteInclude['entryPoints']) }}
        @endforeach
    @endif
</head>
<body>
    <div id="app">
