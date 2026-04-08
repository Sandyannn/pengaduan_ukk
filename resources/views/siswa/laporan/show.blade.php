<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <a href="{{ route('siswa.laporan.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        KEMBALI KE RIWAYAT
                    </a>
                </div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                    Detail Aspirasi <span class="text-indigo-600">#{{ $laporan->id }}</span>
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest border
                    {{ $laporan->status == 'selesai' ? 'bg-green-50 text-green-700 border-green-100' : 
                        ($laporan->status == 'proses' ? 'bg-amber-50 text-amber-700 border-amber-100' : 'bg-slate-50 text-slate-500 border-slate-200') }}">
                    Status: {{ $laporan->status == 'dikirim' ? 'Menunggu' : $laporan->status }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-8 space-y-8">
                    <div class="bg-white rounded-[2.5rem] border border-slate-200 overflow-hidden shadow-sm">
                        <div class="p-8 md:p-10">
                            <div class="flex justify-between items-center mb-8">
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 border-l-4 border-indigo-600 pl-4">Isi Aspirasi </h3>
                                <span class="text-sm font-bold text-slate-500 bg-slate-50 px-4 py-1 rounded-full border border-slate-100">
                                    {{ \Carbon\Carbon::parse($laporan->tg_input)->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            <div class="mb-10 group">
                                @if($laporan->foto)
                                    <div class="relative overflow-hidden rounded-[2rem] border border-slate-100 shadow-xl">
                                        <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kejadian" class="w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                    </div>
                                @else
                                    <div class="bg-slate-50 h-48 flex flex-col items-center justify-center rounded-[2rem] border-2 border-dashed border-slate-200">
                                        <svg class="w-12 h-12 text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-slate-400 italic text-sm">Tidak ada lampiran foto bukti.</p>
                                    </div>
                                @endif
                            </div>

                            <div class="bg-slate-50/50 p-8 rounded-3xl border border-slate-100">
                                <p class="text-slate-700 text-lg leading-relaxed whitespace-pre-line italic">
                                    "{{ $laporan->keterangan }}"
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4 px-4">
                            <h3 class="text-xl font-extrabold text-slate-900">Respon Petugas</h3>
                            <div class="h-px bg-slate-200 flex-1"></div>
                        </div>
                        
                        @forelse($laporan->aspirasis as $aspirasi)
                            <div class="bg-white p-8 rounded-[2rem] border border-indigo-100 shadow-sm relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-1 bg-indigo-500 text-[8px] font-black text-white uppercase tracking-tighter rounded-bl-xl px-3">Official Response</div>
                                
                                <div class="flex justify-between items-center mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900 uppercase tracking-wide">{{ $aspirasi->user->role ?? 'Petugas' }}</p>
                                            <p class="text-[10px] text-indigo-500 font-bold uppercase tracking-widest">Yang Berwenang</p>
                                        </div>
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-400">{{ \Carbon\Carbon::parse($aspirasi->created_at)->diffForHumans() }}</span>
                                </div>
                                <div class="prose prose-indigo max-w-none">
                                    <p class="text-slate-600 leading-relaxed bg-indigo-50/30 p-6 rounded-2xl border border-indigo-50">
                                        {{ $aspirasi->isi_aspirasi }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white p-12 rounded-[2rem] border border-slate-200 text-center border-dashed">
                                <div class="inline-flex p-4 bg-slate-50 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-slate-300 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h4 class="text-slate-900 font-bold">Mohon Menunggu</h4>
                                <p class="text-slate-400 text-sm italic mt-1 max-w-xs mx-auto">Laporan Anda sedang dalam antrean verifikasi petugas. Kami akan segera merespon.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl sticky top-24 overflow-hidden group">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-600/20 rounded-full blur-3xl group-hover:bg-indigo-600/30 transition-colors"></div>
                        
                        <h3 class="text-xs font-black text-indigo-400 uppercase tracking-[0.3em] mb-10 relative z-10">Tracking Progress</h3>
                        
                        <div class="relative z-10 space-y-12">
                            <div class="relative flex items-start group/step">
                                <div class="absolute left-4 top-10 bottom-[-3rem] w-0.5 bg-slate-800"></div>
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center z-10 transition-transform group-hover/step:scale-110 {{ in_array($laporan->status, ['dikirim', 'proses', 'selesai']) ? 'bg-indigo-500 shadow-[0_0_15px_rgba(99,102,241,0.5)]' : 'bg-slate-800 text-slate-500' }}">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-black text-white uppercase tracking-wide">Terkirim</p>
                                    <p class="text-[11px] text-slate-500 mt-1">Laporan berhasil masuk ke sistem.</p>
                                </div>
                            </div>

                            <div class="relative flex items-start group/step">
                                <div class="absolute left-4 top-10 bottom-[-3rem] w-0.5 bg-slate-800"></div>
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center z-10 transition-transform group-hover/step:scale-110 {{ in_array($laporan->status, ['proses', 'selesai']) ? 'bg-amber-500 shadow-[0_0_15px_rgba(245,158,11,0.5)]' : 'bg-slate-800 text-slate-500' }}">
                                    @if($laporan->status == 'proses')
                                        <svg class="w-4 h-4 text-white animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    @else
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    @endif
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-black {{ $laporan->status == 'proses' ? 'text-amber-400' : 'text-white' }} uppercase tracking-wide">Proses Penanganan</p>
                                    <p class="text-[11px] text-slate-500 mt-1">Petugas sedang bekerja di lapangan.</p>
                                </div>
                            </div>

                            <div class="relative flex items-start group/step">
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center z-10 transition-transform group-hover/step:scale-110 {{ $laporan->status == 'selesai' ? 'bg-green-500 shadow-[0_0_15px_rgba(34,197,94,0.5)]' : 'bg-slate-800 text-slate-500' }}">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-black {{ $laporan->status == 'selesai' ? 'text-green-400' : 'text-white' }} uppercase tracking-wide">Selesai</p>
                                    <p class="text-[11px] text-slate-500 mt-1">Aspirasi ditutup dengan solusi.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-16 pt-8 border-t border-slate-800 text-center relative z-10">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Terima kasih atas Aspirasinya</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow {
            animation: spin-slow 3s linear infinite;
        }
    </style>
</x-app-layout>