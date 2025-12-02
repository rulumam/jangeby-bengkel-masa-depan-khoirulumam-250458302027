<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'JangeBy' }}</title>

    {{-- CSS TEMPLATE LANDING PAGE --}}
    <link href="{{ asset('build/assets-1/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets-1/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets-1/lib/fontawesome/css/all.min.css') }}" rel="stylesheet">

    {{-- VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0D1117] text-white">

<nav class="fixed top-0 left-0 w-full bg-slate-900/70 backdrop-blur-xl shadow-lg z-50 border-b border-[#4CE9C3]/20">
    <div class="container mx-auto flex items-center justify-between px-6 py-4">

        {{-- Logo --}}
        <a href="/" class="text-2xl font-bold tracking-wide hover:text-[#4CE9C3] transition">
            JangeBy
        </a>

        {{-- Menu Desktop --}}
        <div class="hidden md:flex space-x-8 font-medium">
            <a href="{{ route('homepage') }}" class="hover:text-[#4CE9C3] transition">Dashboard</a>
            <a href="{{ route('repairs.index') }}" class="hover:text-[#4CE9C3] transition">Daftar Perbaikan</a>
            <a href="{{ url('/#services') }}" class="hover:text-[#4CE9C3] transition">Layanan Kami</a>
            <a href="https://shopee.co.id/jangebyofficial?entryPoint=ShopBySearch&searchKeyword=jangeby" 
               target="_blank"
               class="hover:text-[#4CE9C3] transition">
               Sparepart
            </a>

            <a href="{{ url('/#mechanic') }}" class="hover:text-[#4CE9C3] transition">Mekanik</a>
        </div>

        {{-- Tombol Login / Booking / Dashboard / Logout --}}
        <div class="hidden md:flex items-center space-x-4">

            @auth
                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-lg font-bold bg-red-600 text-white hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>

                {{-- TOMBOL BERDASARKAN ROLE --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-5 py-2 rounded-lg font-medium bg-yellow-400 text-black hover:bg-yellow-300 transition shadow-lg shadow-yellow-300/10">
                        Dashboard Admin
                    </a>
                @else
                    {{-- USER BUTTON: Booking Saya --}}
                    <a href="{{ route('booking.form') }}"
                       class="px-5 py-2 rounded-lg font-medium bg-[#4CE9C3] text-black hover:bg-[#3bd5b0] transition shadow-lg shadow-blue-500/20">
                        Booking Sekarang
                    </a>

                    {{-- USER: Lapor Sekarang --}}
                    <a href="{{ route('repairs.form') }}"
                       class="px-5 py-2 rounded-lg font-medium bg-[#4CE9C3] text-black hover:bg-[#3bd5b0] transition shadow-lg shadow-[#4CE9C3]/20">
                        Lapor Sekarang
                    </a>
                @endif

            @else
                {{-- Belum Login --}}
                <a href="{{ route('login') }}"
                   class="px-5 py-2 rounded-lg font-medium bg-[#4CE9C3] text-black hover:bg-[#3bd5b0] transition shadow-lg shadow-[#4CE9C3]/20">
                    Login
                </a>
            @endauth

        </div>

        {{-- Menu Mobile --}}
        <button class="md:hidden focus:outline-none" onclick="toggleMenu()">
            <i class="fa-solid fa-bars text-2xl text-[#4CE9C3]"></i>
        </button>
    </div>

    <div id="mobileMenu" class="hidden md:hidden bg-slate-800/90 backdrop-blur-lg px-6 py-4 space-y-3 border-t border-[#4CE9C3]/20">
        <a href="{{ route('homepage') }}" class="block hover:text-[#4CE9C3]">Dashboard</a>
        <a href="{{ url('/#services') }}" class="block hover:text-[#4CE9C3]">Layanan Kami</a>
        <a href="https://shopee.co.id/jangebyofficial?entryPoint=ShopBySearch&searchKeyword=jangeby" 
           target="_blank"
           class="hover:text-[#4CE9C3] transition">
           Sparepart
        </a>
        <a href="{{ url('/#mechanic') }}" class="block hover:text-[#4CE9C3]">Mekanik</a>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                   class="block mt-3 px-4 py-2 bg-yellow-400 text-black rounded-lg hover:bg-yellow-300 transition">
                    Dashboard Admin
                </a>
            @else
                {{-- USER MOBILE: Booking Saya --}}
                <a href="{{ route('booking.form') }}"
                   class="block mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Booking Saya
                </a>

                {{-- USER MOBILE: Booking --}}
                <a href="{{ route('repairs.form') }}"
                   class="block mt-3 px-4 py-2 bg-[#4CE9C3] text-black rounded-lg hover:bg-[#3bd5b0] transition">
                    Booking Sekarang
                </a>
            @endif
        @else
            <a href="{{ route('login') }}"
               class="block mt-3 px-4 py-2 bg-[#4CE9C3] text-black rounded-lg hover:bg-[#3bd5b0] transition">
                Login
            </a>
        @endauth
    </div>
</nav>

<script>
    function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
</script>

<main class="pt-24">
    {{ $slot }}
</main>

</body>
</html>
