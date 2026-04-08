<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                    {{ __('Laporan Siswa Lain') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Transparansi aspirasi siswa untuk perubahan nyata.</p>
            </div>
            <div class="bg-indigo-600 text-white px-5 py-2 rounded-2xl text-xs font-bold shadow-lg shadow-indigo-200">
                {{ $laporans->count() }} Laporan Masuk
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full">Explore Aspirations</span>
                <h3 class="text-3xl font-extrabold text-slate-900 mt-4">Seluruh Aspirasi Siswa</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($laporans as $laporan)
                    <div class="group bg-white rounded-[2.5rem] border border-slate-200 overflow-hidden hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 hover:-translate-y-2 flex flex-col h-full">
                        
                        <div class="relative h-56 w-full overflow-hidden">
                            @if($laporan->foto)
                                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kejadian" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="flex flex-col items-center justify-center h-full bg-slate-100 text-slate-400 gap-2">
                                    <svg class="w-10 h-10 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-black uppercase tracking-wider">No Attachment</span>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                @if($laporan->status == 'menunggu')
                                    <span class="bg-white/90 backdrop-blur px-3 py-1.5 rounded-xl text-[10px] font-black uppercase text-slate-500 shadow-sm border border-slate-100">Menunggu</span>
                                @elseif($laporan->status == 'proses')
                                    <span class="bg-amber-500/90 backdrop-blur px-3 py-1.5 rounded-xl text-[10px] font-black uppercase text-white shadow-sm">Proses</span>
                                @else
                                    <span class="bg-green-500/90 backdrop-blur px-3 py-1.5 rounded-xl text-[10px] font-black uppercase text-white shadow-sm">Selesai</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-8 flex-1 flex flex-col">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-[10px]">
                                        {{ substr($laporan->user->username, 0, 1) }}
                                    </div>
                                    <span class="text-[11px] font-bold text-slate-700">
                                        {{ Str::mask($laporan->user->username, '*', 1, 8) }}
                                    </span>
                                </div>
                                <span class="text-[10px] font-medium text-slate-400">
                                    {{ \Carbon\Carbon::parse($laporan->tg_pengaduan)->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            <p class="text-slate-600 text-sm leading-relaxed mb-8 italic line-clamp-3">
                                "{{ $laporan->isi_laporan }}"
                            </p>

                            <div class="mt-auto pt-6 border-t border-slate-50 flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    <div class="w-7 h-7 rounded-full border-2 border-white bg-slate-100"></div>
                                    <div class="w-7 h-7 rounded-full border-2 border-white bg-slate-200"></div>
                                </div>
                                <a href="{{ route('siswa.laporan.show', $laporan->id) }}" class="flex items-center gap-2 text-xs font-black uppercase tracking-widest text-indigo-600 hover:text-indigo-800 transition-colors">
                                    Detail Laporan
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h4 class="text-slate-900 font-bold">Belum Ada Laporan</h4>
                            <p class="text-slate-400 text-sm italic mt-1">Jadilah yang pertama menyuarakan perubahan.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
        </div>
    </div>
</x-app-layout>