<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight uppercase tracking-tight">
                    {{ __('Admin Control Center') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1 italic">Sistem Informasi Pengaduan Masyarakat (SIPM)</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">{{ date('d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-indigo-900 rounded-[2.5rem] p-8 mb-10 relative overflow-hidden shadow-2xl shadow-indigo-200">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-white">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-indigo-200 mt-2 max-w-xl text-sm leading-relaxed">
                        Anda memiliki akses penuh untuk mengelola laporan dan aspirasi masyarakat. Pastikan setiap pengaduan ditindaklanjuti dengan cepat dan transparan.
                    </p>
                </div>
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
                <div class="absolute right-10 top-1/2 -translate-y-1/2 opacity-10 hidden md:block">
                    <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Laporan</p>
                            <h4 class="text-3xl font-black text-slate-900 mt-1">{{ number_format($data['total_laporan']) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-red-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Menunggu Verifikasi</p>
                            <h4 class="text-3xl font-black text-red-600 mt-1">{{ number_format($data['status_dikirim']) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-amber-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Sedang Diproses</p>
                            <h4 class="text-3xl font-black text-amber-600 mt-1">{{ number_format($data['status_proses']) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-emerald-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Selesai</p>
                            <h4 class="text-3xl font-black text-emerald-600 mt-1">{{ number_format($data['status_selesai']) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-blue-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Siswa</p>
                            <h4 class="text-3xl font-black text-blue-600 mt-1">{{ number_format($data['total_siswa']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] mb-6">Aksi Cepat Manajemen</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.laporan.index') }}" class="group inline-flex items-center px-8 py-4 bg-indigo-600 rounded-2xl font-bold text-sm text-white transition-all hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200">
                        <span>Kelola Semua Laporan</span>
                        <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>