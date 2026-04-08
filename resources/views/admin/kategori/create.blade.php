<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 leading-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-200 p-8">
                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div>
                        <x-input-label for="ket_kategori" :value="__('Nama Kategori')" class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2" />
                        <x-text-input id="ket_kategori" class="block mt-1 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl" type="text" name="ket_kategori" :value="old('ket_kategori')" required autofocus placeholder="Contoh: Sarana Prasarana" />
                        <x-input-error :messages="$errors->get('ket_kategori')" class="mt-2" />
                    </div>

                    <div class="mt-8 flex items-center gap-4">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-2xl font-bold">
                            {{ __('Simpan Kategori') }}
                        </x-primary-button>
                        <a href="{{ route('admin.kategori.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 transition">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>