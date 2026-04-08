<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Aspirasi Siswa - SMKN 11 Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="font-extrabold text-xl tracking-tight">ASPIRASI <span class="text-indigo-600">SISWA</span></span>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="relative py-20 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tighter mb-6">
                Suarakan Aspirasimu, <br> <span class="text-indigo-600">Bangun Perubahan.</span>
            </h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
                Platform resmi aspirasi siswa untuk lingkungan yang lebih baik. Cepat, transparan, dan terpercaya.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-indigo-700 transition transform hover:-translate-y-1 shadow-xl shadow-indigo-100">Buat Aspirasi</a>
                <a href="#laporan-publik" class="bg-slate-100 text-slate-700 px-8 py-4 rounded-2xl font-bold hover:bg-slate-200 transition">Lihat Laporan</a>
            </div>
        </div>
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-indigo-50 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-96 h-96 bg-blue-50 rounded-full blur-3xl"></div>
    </header>

    <section id="laporan-publik" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight">Laporan Terkini</h2>
                    <p class="text-slate-500 mt-2">Daftar aspirasi siswa yang sedang dalam penanganan.</p>
                </div>
                <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:text-indigo-700">Lihat Semua &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($laporans as $item)
                    <div class="bg-white p-8 rounded-3xl border border-slate-200 hover:border-indigo-300 transition-all hover:shadow-2xl group">
                        <div class="flex justify-between items-start mb-6">
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                {{ \Carbon\Carbon::parse($item->tg_input)->translatedFormat('d F Y') }}
                            </span>
                            <span class="px-3 py-1 text-[10px] font-black rounded-full border uppercase tracking-wider
                                {{ $item->status == 'selesai' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-amber-50 text-amber-700 border-amber-100' }}">
                                {{ $item->status }}
                            </span>
                        </div>
                        <p class="text-slate-700 font-medium leading-relaxed mb-6 italic">
                            "{{ Str::limit($item->keterangan, 120) }}"
                        </p>
                        <div class="flex items-center gap-3 pt-6 border-t border-slate-100">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs uppercase">
                                {{ substr($item->user->nis, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ $item->user->nis }}</p>
                                <p class="text-[10px] text-slate-400 uppercase tracking-tighter">NIS</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 font-medium italic text-lg">Belum ada Aspirasi dari siswa.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-500 text-sm font-medium">
                &copy; 2026 UKK RPL - Ryan Sandy Pratama - SMKN 11 Malang.
            </p>
        </div>
    </footer>

</body>
</html>