<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Klinik Mini - Sistem Antrian Online</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-50">
        <nav class="bg-white shadow-sm border-b border-slate-200 py-4">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="text-xl font-bold text-slate-800">Klinik <span class="text-indigo-600">Mini</span></span>
                </div>
                
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-indigo-600 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">Daftar Akun</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2 space-y-6 text-center md:text-left">
                <h1 class="text-5xl md:text-6xl font-black text-slate-900 leading-tight">
                    Berobat Nggak Pakai <span class="text-indigo-600 underline decoration-indigo-200">Antri Lama.</span>
                </h1>
                <p class="text-lg text-slate-600 leading-relaxed max-w-lg">
                    Daftar antrian dari rumah, pantau nomor antrian secara real-time, dan datang tepat waktu. Layanan kesehatan modern untuk kenyamanan Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center md:justify-start">
                    @auth
                        <a href="{{ route('queues.create') }}" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-bold text-center hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">Daftar Antrian Sekarang</a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-bold text-center hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">Mulai Daftar Akun</a>
                        <a href="#cara-kerja" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-xl font-bold text-center hover:bg-slate-50 transition-all">Lihat Cara Kerja</a>
                    @endauth
                </div>
            </div>

            <div class="md:w-1/2 relative">
                <div class="w-full aspect-square bg-indigo-100 rounded-full flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#4f46e5_1px,transparent_1px)] [background-size:20px_20px]"></div>
                    <svg class="w-64 h-64 text-indigo-600 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <div class="absolute bottom-10 right-0 bg-white p-4 rounded-xl shadow-xl border border-slate-100 animate-bounce">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">#01</div>
                            <div class="text-xs">
                                <p class="font-bold text-slate-800">Sedang Dipanggil</p>
                                <p class="text-slate-500">Poli Umum - dr. Zaen</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <section id="cara-kerja" class="bg-white py-20 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-slate-900 mb-16">Cara Daftar Antrian</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold mx-auto">1</div>
                        <h3 class="font-bold text-xl">Buat Akun</h3>
                        <p class="text-slate-600">Daftarkan diri Anda menggunakan email aktif.</p>
                    </div>
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold mx-auto">2</div>
                        <h3 class="font-bold text-xl">Pilih Dokter</h3>
                        <p class="text-slate-600">Pilih poli, dokter favorit, dan jadwal kunjungan Anda.</p>
                    </div>
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold mx-auto">3</div>
                        <h3 class="font-bold text-xl">Ambil Nomor</h3>
                        <p class="text-slate-600">Dapatkan nomor antrian dan pantau statusnya dari mana saja.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-10 text-center text-slate-400 text-sm border-t border-slate-100">
            &copy; {{ date('Y') }} Klinik Mini. Built with ❤️ for better healthcare.
        </footer>
    </body>
</html>
