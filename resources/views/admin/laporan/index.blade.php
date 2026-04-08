<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 print:hidden">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
                    {{ __('Rekapitulasi Laporan') }}
                </h2>
                <p class="text-sm text-slate-500">Kelola dan cetak rekap data aspirasi siswa.</p>
            </div>

            <button onclick="window.print()"
                class="group bg-slate-900 hover:bg-black text-white font-bold py-3 px-6 rounded-2xl text-sm flex items-center shadow-lg transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2 text-indigo-400 group-hover:text-white transition" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Cetak Rekap Laporan
            </button>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-8 rounded-[2rem] shadow-sm mb-8 print:hidden border border-slate-200">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-1 h-4 bg-indigo-600 rounded-full"></div>
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Filter Data</h3>
                </div>

                <form action="{{ route('admin.laporan.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-500 uppercase mb-2 tracking-widest">Kategori</label>
                        <select name="kategori_id"
                            class="w-full rounded-xl border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}"
                                    {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->ket_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase mb-2 tracking-widest">Pilih
                            Siswa</label>
                        <select name="user_id"
                            class="w-full rounded-xl border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition">
                            <option value="">Semua Siswa</option>
                            @foreach ($siswas as $s)
                                <option value="{{ $s->id }}"
                                    {{ request('user_id') == $s->id ? 'selected' : '' }}>{{ $s->nis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-500 uppercase mb-2 tracking-widest">Tanggal
                            Laporan</label>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                            class="w-full rounded-xl border-slate-200 text-sm focus:ring-indigo-500 shadow-sm">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-xl text-sm transition shadow-md shadow-indigo-100">
                            Terapkan
                        </button>
                        <a href="{{ route('admin.laporan.index') }}"
                            class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-bold transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm overflow-hidden border border-slate-200" id="printableArea">

                <div class="hidden print:block p-10 text-center border-b-4 border-double border-slate-900 mb-8">
                    <h1 class="text-3xl font-black uppercase tracking-tighter text-slate-900">Laporan Rekapitulasi
                        Aspirasi Siswa</h1>
                    <p class="text-sm font-bold text-slate-600 mt-1 uppercase tracking-widest">SMKN 11 MALANG — RPL
                        PROJECT</p>
                    <div class="mt-6 grid grid-cols-3 text-[10px] text-slate-500 uppercase font-black tracking-widest">
                        <span>Tanggal Cetak: {{ now()->translatedFormat('d F Y') }}</span>
                        <span class="text-slate-900">Dokumen Internal Sekolah</span>
                        <span>Filter: {{ request('tanggal') ?? 'Semua Waktu' }}</span>
                    </div>
                </div>

                <div class="overflow-x-auto p-4 md:p-8">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-slate-100">
                                <th
                                    class="p-4 text-[10px] font-black uppercase tracking-widest text-slate-400 w-12 text-center">
                                    No</th>
                                <th class="p-4 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                    Identitas Pelapor</th>
                                <th class="p-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Kategori
                                </th>
                                <th class="p-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Isi
                                    Laporan</th>
                                <th
                                    class="p-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">
                                    Status</th>
                                <th
                                    class="p-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($laporans as $item)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="p-4 text-sm text-center font-bold text-slate-400">{{ $loop->iteration }}
                                    </td>
                                    <td class="p-4">
                                        <div class="font-black text-slate-900 uppercase text-xs">
                                            {{ $item->user->username }}</div>
                                        <div class="text-[10px] font-mono text-indigo-500 mt-0.5">NIS:
                                            {{ $item->user->nis ?? '-' }}</div>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="text-xs font-bold text-slate-600">{{ $item->kategori->ket_kategori }}</span>
                                    </td>
                                    <td class="p-4">
                                        <p class="text-sm text-slate-600 leading-relaxed max-w-xs">
                                            {{ Str::limit($item->keterangan, 85) }}
                                        </p>
                                        <span
                                            class="text-[10px] text-slate-400 italic">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}</span>
                                    </td>
                                    <td class="p-4 text-center">
                                        @php
                                            $status = $item->status;
                                        @endphp
                                        <span
                                            class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-tighter border {{ $status == 'selesai'
                                                ? 'bg-emerald-50 text-emerald-700 border-emerald-100'
                                                : ($status == 'proses'
                                                    ? 'bg-amber-50 text-amber-700 border-amber-100'
                                                    : 'bg-rose-50 text-rose-700 border-rose-100') }}">
                                            ● {{ ucfirst($status == '0' ? 'menunggu' : $status) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center print:hidden">
                                        <a href="{{ route('admin.laporan.show', $item->id) }}"
                                            class="inline-flex items-center self-center px-4 py-2 bg-white border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all shadow-sm">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-20 text-center">
                                        <p class="text-slate-400 font-bold italic">Tidak ada data laporan yang
                                            ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="hidden print:grid grid-cols-2 mt-16 p-10">
                    <div class="text-center w-64"></div>
                    <div class="text-center ml-auto w-64">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-20">Petugas
                            Penanggung Jawab,</p>
                        <p class="font-black text-slate-900 uppercase border-b-2 border-slate-900 pb-1">
                            {{ Auth::user()->name }}</p>
                        <p class="text-[9px] text-slate-400 mt-2 font-mono italic">Waktu Cetak:
                            {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 1cm;
            }

            body {
                background-color: white !important;
                -webkit-print-color-adjust: exact !important;
            }

            nav,
            aside,
            [role="navigation"],
            header,
            .print\:hidden {
                display: none !important;
            }

            .py-12 {
                padding: 0 !important;
            }

            .max-w-7xl {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
            }

            .bg-white {
                box-shadow: none !important;
                border: none !important;
            }

            table {
                border: 1px solid #e2e8f0 !important;
            }

            th {
                background-color: #f8fafc !important;
                color: #64748b !important;
            }
        }
    </style>
</x-app-layout>
