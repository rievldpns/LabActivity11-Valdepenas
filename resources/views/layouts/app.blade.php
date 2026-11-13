<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barangay Bulletin – Purok Valdepenas')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 flex flex-col justify-between">

    <nav class="bg-sky-500 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            <a href="{{ route('posts.index') }}" class="font-bold text-xl tracking-tight text-white">
                Barangay Bulletin – Purok Valdepenas
            </a>

            <div class="flex items-center gap-4">
                <a href="{{ route('posts.index') }}" class="text-sky-100 hover:text-white text-sm font-medium transition-colors">
                    All Posts
                </a>

                @auth
                    <span class="text-sm text-sky-100">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-sky-100 hover:text-white transition-colors">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="text-sky-100 hover:text-white text-sm font-medium transition-colors">Sign in</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-grow">
        @if (session('status'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 text-sm rounded px-4 py-2">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-slate-200 text-slate-600 text-center py-4 text-xs border-t border-slate-300">
        © 2026 Barangay Matina Crossing Hall
    </footer>

</body>
</html>