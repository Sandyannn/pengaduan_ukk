<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = InputAspirasi::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tg_input', [$request->tgl_awal, $request->tgl_akhir]);
        }

        if ($request->filled('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }

        $laporans = $query->latest()->get();

        return view('siswa.laporan.index', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = InputAspirasi::with(['user', 'kategori', 'aspirasis'])->findOrFail($id);

        return view('siswa.laporan.show', compact('laporan'));
    }
}
