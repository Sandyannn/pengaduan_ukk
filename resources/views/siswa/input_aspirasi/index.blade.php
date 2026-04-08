<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                    {{ __('Aspirasi Siswa') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Sampaikan aspirasimu untuk sekolah yang lebih baik.</p>
            </div>
            <div class="flex items-center gap-2 text-sm font-semibold bg-indigo-50 text-indigo-700 px-4 py-2 rounded-2xl">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                Sistem Aktif
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-4">
                    <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-200 p-8 sticky top-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-indigo-600 rounded-xl text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Buat Laporan</h3>
                        </div>

                        {{-- Perhatikan route name: siswa.aspirasi.store --}}
                        <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <div>
                                <label for="kategori_id" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Kategori Aspirasi</label>
                                <select name="kategori_id" id="kategori_id" required class="w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-sm">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategoris as $k)
                                        <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->ket_kategori }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                            </div>

                            <div>
                                <label for="lokasi" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Lokasi Kejadian</label>
                                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Misal: Lab RPL, Kantin..." class="w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-sm" required>
                                <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                            </div>

                            <div>
                                <label for="keterangan" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Detail Kejadian</label>
                                <textarea id="keterangan" name="keterangan" class="w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl text-sm p-4 placeholder:text-slate-300" rows="4" placeholder="Ceritakan detail pengaduan Anda..." required>{{ old('keterangan') }}</textarea>
                                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                            </div>

                            <div>
                                <label for="foto" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Lampiran Foto</label>
                                <input type="file" id="foto" name="foto" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-dashed border-slate-300 p-2 rounded-2xl" />
                                <p class="text-[10px] text-slate-400 mt-2">* JPG, PNG (Max 2MB)</p>
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex justify-center items-center gap-2">
                                Kirim Aspirasi
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl flex items-center gap-3 animate-bounce">
                            <span class="font-bold text-sm">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-200">
                        <div class="p-8 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-slate-900">Riwayat Aspirasi</h3>
                            <span class="bg-slate-100 text-slate-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">{{ $input_aspirasis->count() }} Total</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50/50">
                                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Waktu Lapor</th>
                                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Kategori & Lokasi</th>
                                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Status</th>
                                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($input_aspirasis as $p)
                                        <tr class="hover:bg-slate-50/50 transition-colors group">
                                            <td class="px-8 py-6">
                                                <div class="text-sm font-bold text-slate-900">{{ $p->created_at->translatedFormat('d M Y') }}</div>
                                                <div class="text-[10px] text-slate-400 font-medium">Pukul {{ $p->created_at->format('H:i') }}</div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <div class="text-sm font-bold text-indigo-600">{{ $p->kategori->ket_kategori ?? 'Umum' }}</div>
                                                <p class="text-xs text-slate-500 line-clamp-1">{{ $p->lokasi }}</p>
                                            </td>
                                            <td class="px-8 py-6 text-center">
                                                @php
                                                    $status = $p->status ?? 'menunggu';
                                                @endphp
                                                
                                                @if ($status == 'menunggu')
                                                    <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-full text-[10px] font-black uppercase border border-slate-200">Menunggu</span>
                                                @elseif($status == 'proses')
                                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase border border-amber-100">Proses</span>
                                                @else
                                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[10px] font-black uppercase border border-green-100">Selesai</span>
                                                @endif
                                            </td>
                                            <td class="px-8 py-6 text-right">
                                                <a href="{{ route('siswa.laporan.show', $p->id) }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-600 hover:text-white transition">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-8 py-20 text-center text-slate-400 italic">Belum ada riwayat.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>