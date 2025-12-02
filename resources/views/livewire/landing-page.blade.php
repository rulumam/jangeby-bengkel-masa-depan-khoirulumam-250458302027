{{-- @extends('components.layouts.landing')
@section('title', 'Home')

@section('content') --}}
<div> {{-- DITAMBAHKAN agar hanya ada 1 root element --}}

    {{-- =========================================
        HERO SECTION
    ========================================= --}}
    <section class="min-h-screen flex items-center bg-[#0D1117] pt-24">
        <div class="container mx-auto grid md:grid-cols-2 gap-10 px-6">
            <div class="flex flex-col justify-center space-y-6">
                <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                    Perawatan Motor <span class="text-[#4CE9C3]">Cepat & Profesional</span>
                </h1>
                <p class="text-gray-300 text-lg">
                    Aplikasi Bengkel modern untuk booking servis, cek sparepart, dan melihat mekanik profesional.
                </p>
                <div class="flex space-x-4">
                    <a href="{{ route('repairs.form') }}"
                       class="px-6 py-3 bg-[#4CE9C3] text-black font-semibold rounded-lg hover:bg-[#3bd5b0] transition">
                        Booking Sekarang
                    </a>
                    <a href="#services"
                       class="px-6 py-3 border border-[#4CE9C3] text-[#4CE9C3] rounded-lg hover:bg-[#4CE9C3] hover:text-black transition">
                        Lihat Layanan
                    </a>
                </div>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('build/assets/img/peby (1).png') }}"
                     class="w-4/5 drop-shadow-[0_0_25px_#4CE9C3]" alt="Motorcycle">
            </div>
        </div>
    </section>

    {{-- =========================================
        SERVICES SECTION
    ========================================= --}}
    <section id="services" class="py-24 bg-[#0F172A]">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-12">
                Layanan <span class="text-[#4CE9C3]">Kami</span>
            </h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-8 bg-slate-800 rounded-2xl border border-slate-700 hover:border-[#4CE9C3] transition">
                    <i class="fa-solid fa-screwdriver-wrench text-4xl mb-4 text-[#4CE9C3]"></i>
                    <h3 class="text-2xl font-semibold mb-2">Servis Rutin</h3>
                    <p class="text-gray-400">Perawatan motor agar tetap optimal setiap hari.</p>
                </div>
                <div class="p-8 bg-slate-800 rounded-2xl border border-slate-700 hover:border-[#4CE9C3] transition">
                    <i class="fa-solid fa-motorcycle text-4xl mb-4 text-[#4CE9C3]"></i>
                    <h3 class="text-2xl font-semibold mb-2">Perbaikan Mesin</h3>
                    <p class="text-gray-400">Penanganan cepat untuk kerusakan mesin.</p>
                </div>
                <div class="p-8 bg-slate-800 rounded-2xl border border-slate-700 hover:border-[#4CE9C3] transition">
                    <i class="fa-solid fa-bolt text-4xl mb-4 text-[#4CE9C3]"></i>
                    <h3 class="text-2xl font-semibold mb-2">Servis Kelistrikan</h3>
                    <p class="text-gray-400">Perbaikan dan pengecekan sistem kelistrikan.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================
        SPAREPART SECTION
    ========================================= --}}
    <section id="sparepart" class="py-24 bg-[#0D1117]">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold mb-12 text-center">
                Sparepart <span class="text-[#4CE9C3]">Terbaik</span>
            </h2>
            <div class="grid md:grid-cols-4 gap-10">
                <div class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-[#4CE9C3] transition text-center">
                    <h3 class="text-xl font-semibold">Oli Mesin</h3>
                    <p class="text-gray-400 text-sm">Oli terbaik untuk performa mesin.</p>
                </div>
                <div class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-[#4CE9C3] transition text-center">
                    <h3 class="text-xl font-semibold">Kampas Rem</h3>
                    <p class="text-gray-400 text-sm">Rem pakem & tahan lama.</p>
                </div>
                <div class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-[#4CE9C3] transition text-center">
                    <h3 class="text-xl font-semibold">Ban Motor</h3>
                    <p class="text-gray-400 text-sm">Ban kuat untuk segala kondisi.</p>
                </div>
                <div class="p-6 bg-slate-800 rounded-xl border border-slate-700 hover:border-[#4CE9C3] transition text-center">
                    <h3 class="text-xl font-semibold">Aki Motor</h3>
                    <p class="text-gray-400 text-sm">Aki awet & bergaransi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================
        MECHANIC SECTION
    ========================================= --}}
    <section id="mechanic" class="py-24 bg-[#0F172A]">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-12">
                Mekanik <span class="text-[#4CE9C3]">Profesional</span>
            </h2>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="bg-slate-800 rounded-2xl p-8 border border-slate-700 hover:border-[#4CE9C3] transition">
                    <img src="{{ asset('build/assets/img/orang.jpg') }}" class="w-32 h-32 mx-auto rounded-full border border-[#4CE9C3] shadow-lg mb-4">
                    <h3 class="text-2xl font-semibold">Jamal</h3>
                    <p class="text-gray-400">Senior Mekanik</p>
                </div>
                <div class="bg-slate-800 rounded-2xl p-8 border border-slate-700 hover:border-[#4CE9C3] transition">
                    <img src="{{ asset('build/assets/img/orang.jpg') }}" class="w-32 h-32 mx-auto rounded-full border border-[#4CE9C3] shadow-lg mb-4">
                    <h3 class="text-2xl font-semibold">Ehseneddin</h3>
                    <p class="text-gray-400">In Engine Mechanic</p>
                </div>
                <div class="bg-slate-800 rounded-2xl p-8 border border-slate-700 hover:border-[#4CE9C3] transition">
                    <img src="{{ asset('build/assets/img/orang.jpg') }}" class="w-32 h-32 mx-auto rounded-full border border-[#4CE9C3] shadow-lg mb-4">
                    <h3 class="text-2xl font-semibold">Rizky</h3>
                    <p class="text-gray-400">Teknisi Kelistrikan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================
        CTA BOOKING
    ========================================= --}}
    <section class="py-20 bg-[#0D1117] text-center">

    <h2 class="text-4xl font-bold mb-6">Siap Servis Motor Kamu?</h2>

    <p class="text-gray-300 mb-7 font-semibold">Booking mudah dan cepat hanya dengan satu klik.</p>

    <div class="mb-8">
        <a href="{{ route('repairs.form') }}"
           class="px-8 py-4 bg-[#4CE9C3] text-black font-bold text-lg rounded-lg hover:bg-[#3bd5b0] transition">
            Booking Sekarang
        </a>
    </div>

    <p class="text-gray-300 mb-7 font-semibold">
        Ingin konsultasi terlebih dahulu? Silahkan klik tombol di bawah ini!
    </p>

    <div>
        <a href="https://wa.me/6280000000000?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20servis."
           target="_blank"
           class="px-8 py-4 border border-[#4CE9C3] text-[#4CE9C3] font-bold text-lg rounded-lg hover:bg-[#4CE9C3] hover:text-black transition">
            Konsultasi Sekarang
        </a>
    </div>
</section>


    {{-- =========================================
        FOOTER
    ========================================= --}}
    <footer class="py-10 bg-slate-900/80 text-center border-t border-[#4CE9C3]/20">
        <p class="text-gray-400">© {{ date('Y') }} JangeBy. All rights reserved.</p>
    </footer>

</div>
{{-- @endsection --}}
