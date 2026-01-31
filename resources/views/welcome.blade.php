<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payroll Application</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 min-h-screen">

    <!-- NAVBAR -->
    <nav class="flex items-center justify-between px-8 py-6 backdrop-blur-lg bg-white/10 border-b border-white/20">
        <h1 class="text-white text-2xl font-bold tracking-wide">
            {{ config('app.name', 'Laravel') }}
        </h1>

        <div class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="text-white font-medium hover:text-yellow-300 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-white font-medium hover:text-yellow-300 transition">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 px-4 py-2 bg-white text-purple-700 rounded-full font-semibold shadow hover:bg-purple-100 transition">
                           Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="flex flex-col items-center text-center text-white px-6 mt-24">
        <h2 class="text-5xl font-extrabold drop-shadow-lg animate-pulse">
            Welcome to {{ config('app.name', 'Laravel') }}
        </h2>

        <p class="text-lg max-w-xl mt-4 opacity-90">
            Your modern way to seek payment transcation to your employees
            with efficiency and ease
        </p>

        <a href=""
           class="mt-8 px-6 py-3 bg-white text-purple-600 text-lg font-bold rounded-full shadow-xl hover:bg-purple-100 transition-all">
            Explore Documentation →
        </a>
    </section>

  

    <!-- FOOTER -->
    <footer class="text-center text-white mt-16 mb-6 opacity-80">
        © {{ date('Y') }} {{ config('app.name') }} — Powered by Avisson Payroll Sysytem
    </footer>

</body>
</html>
