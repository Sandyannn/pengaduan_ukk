<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputAspirasiController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $input_aspirasis = InputAspirasi::where('user_id', Auth::id())
                            ->with('kategori') 
                            ->latest()
                            ->get();

        return view('siswa.input_aspirasi.index', compact('input_aspirasis', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string|min:10',
            'lokasi' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        InputAspirasi::create([
            'user_id' => Auth::id(),
            'tg_input' => now(),
            'kategori_id' => $request->kategori_id,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan, 
            'foto' => $fotoPath,
            'status' => 'menunggu', 
        ]);

        return redirect()->back()->with('success', 'Laporan Anda berhasil dikirim!');
    }
}