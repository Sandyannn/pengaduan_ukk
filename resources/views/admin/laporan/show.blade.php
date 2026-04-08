<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Aspirasi #') . $laporan->id }}
            </h2>
            <a href="{{ route('admin.laporan.index') }}"
                class="text-sm font-medium text-gray-600 hover:text-indigo-600 italic">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Informasi Kejadian</h3>

                        <div class="mb-6">
                            <p class="text-sm font-medium text-gray-500 mb-2 italic">Bukti Foto:</p>
                            @if ($laporan->foto)
                                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan"
                                    class="w-full rounded-lg shadow-md border hover:scale-[1.01] transition-transform">
                            @else
                                <div
                                    class="bg-gray-100 h-48 flex items-center justify-center rounded-lg border-2 border-dashed">
                                    <span class="text-gray-400 font-italic">Tidak ada lampiran foto.</span>
                                </div>
                            @endif
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                                {{ $laporan->lokasi }}
                            </p>
                            <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                                {{ $laporan->keterangan }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div
                        class="bg-white shadow-sm sm:rounded-lg p-6 border-t-4 {{ $laporan->status == 'selesai' ? 'border-green-500' : ($laporan->status == 'proses' ? 'border-yellow-500' : 'border-red-500') }}">
                        <h3 class="text-sm font-bold text-gray-400 uppercase mb-4 tracking-wider">Status Saat Ini</h3>
                        <div class="flex items-center mb-6">
                            @if ($laporan->status == 'menunggu')
                                <span
                                    class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase">Menunggu</span>
                            @elseif($laporan->status == 'proses')
                                <span
                                    class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold uppercase">Proses</span>
                            @else
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold uppercase">Selesai</span>
                            @endif
                        </div>

                        <div class="text-sm space-y-2">
                            <p><span class="text-gray-500">Pelapor:</span> <br> <strong
                                    class="text-gray-900">{{ $laporan->user->username }}</strong></p>
                            <p><span class="text-gray-500">NIS:</span> <br> <strong
                                    class="text-gray-900">{{ $laporan->user->nis }}</strong></p>
                            <p><span class="text-gray-500">Tanggal Masuk:</span> <br> <strong
                                    class="text-gray-900">{{ $laporan->created_at->translatedFormat('d F Y') }}</strong>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-md font-bold text-gray-900 mb-4">Tindakan Petugas</h3>

                        @if ($laporan->status == 'menunggu')
                            <form action="{{ route('admin.aspirasi.proses', $laporan->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <x-primary-button class="w-full justify-center bg-yellow-600 hover:bg-yellow-700">
                                    {{ __('Proses Laporan Ini') }}
                                </x-primary-button>
                                <p class="mt-2 text-[10px] text-gray-400 text-center italic">Klik untuk menandakan
                                    aspirasi sedang ditangani.</p>
                            </form>
                        @elseif($laporan->status == 'proses')
                            <form action="{{ route('admin.aspirasi.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="laporan_id" value="{{ $laporan->id }}">

                                <div class="mb-4">
                                    <x-input-label for="feedback" :value="__('Feedback')" />
                                    <textarea name="feedback" rows="5"
                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm mt-1"
                                        placeholder="Tulis instruksi atau hasil akhir..." required></textarea>
                                    @error('feedback')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-3">
                                    <x-primary-button class="w-full justify-center bg-green-600 hover:bg-green-700">
                                        {{ __('Kirim & Selesaikan') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        @else
                            <div class="text-center py-4">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 bg-green-100 text-green-600 rounded-full mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-600">Laporan ini sudah ditanggapi dan selesai.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
