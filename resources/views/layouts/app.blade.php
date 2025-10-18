<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Auto Servis')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
<nav class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="font-semibold">AutoServis</a>
            <a href="{{ route('workshops.index') }}" class="text-sm hover:underline">Radionice</a>
            @auth
                @if(auth()->user()->role === 'owner')
                    <a href="{{ route('owner.workshops.index') }}" class="text-sm hover:underline">Moji servisi</a>
                @endif
                <a href="{{ route('bookings.index') }}" class="text-sm hover:underline">Moje rezervacije</a>
            @endauth
        </div>
        <div class="flex items-center gap-3">
            @auth
                <span class="text-sm">Zdravo, {{ auth()->user()->name }}</span>
                <a href="{{ route('profile.edit') }}" class="text-sm hover:underline">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-600 hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-sm hover:underline">Register</a>
            @endauth
        </div>
    </div>
</nav>

<main class="max-w-6xl mx-auto px-4 py-6">
    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
