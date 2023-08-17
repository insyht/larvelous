<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
</head>
<body>
<div id="app" class="dashboard">
    <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <p>{{ __('Welcome') }},  {{ Auth::user()->name }}
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            </p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </div>

    <div class="contents">
        <nav class="menu">
            <ul>
                <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>

                <li class="newline"><a href="{{ route('dashboard.blocks.index') }}">Blocks</a></li>
                <li><a href="{{ route('dashboard.forms.index') }}">Forms</a></li>
                <li><a href="{{ route('dashboard.templates.index') }}">Templates</a></li>
                <li><a href="{{ route('dashboard.pages.index') }}">Pages</a></li>
                <li><a href="{{ route('dashboard.menus.index') }}">Menus</a></li>

                <li class="newline"><a href="{{ route('dashboard.media.index') }}">Media</a></li>
                <li><a href="{{ route('dashboard.design.index') }}">Design</a></li>

                <li class="newline"><a href="{{ route('dashboard.plugins.index') }}">Plugins</a></li>
                <li><a href="{{ route('dashboard.settings.index') }}">Settings</a></li>
                <li><a href="{{ route('dashboard.statistics.index') }}">Statistics</a></li>
            </ul>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
