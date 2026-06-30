<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BookLib</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Merriweather', serif; }
    </style>
</head>
<body class="bg-amber-50 text-amber-950">
    <nav class="bg-white border-b border-amber-200 sticky top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="font-merriweather text-2xl font-bold text-amber-900">
                        📚 BookLib
                    </a>
                    @auth
                        <div class="hidden sm:flex gap-6">
                            <a href="{{ route('dashboard') }}" class="text-amber-700 hover:text-amber-900 transition">Dashboard</a>
                            <a href="{{ route('library') }}" class="text-amber-700 hover:text-amber-900 transition">My Library</a>
                            <a href="{{ route('home') }}" class="text-amber-700 hover:text-amber-900 transition">Explore</a>
                        </div>
                    @endauth
                </div>

                @auth
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-amber-700">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-amber-700 hover:text-amber-900 transition text-sm">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-amber-700 hover:text-amber-900 transition text-sm">Login</a>
                        <a href="{{ route('register') }}" class="bg-amber-600 text-white px-4 py-1.5 rounded-lg hover:bg-amber-700 transition text-sm">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if ($message = Session::get('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                {{ $message }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-amber-200 mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-amber-700">
            <p>BookLib © 2026. Track your reading journey.</p>
        </div>
    </footer>
</body>
</html>