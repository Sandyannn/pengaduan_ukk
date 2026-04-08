<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        $siswas = User::where('role', 'siswa')->get();

        $query = InputAspirasi::with(['user', 'kategori', 'aspirasis']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $laporans = $query->latest()->get();

        return view('admin.laporan.index', compact('laporans', 'kategoris', 'siswas'));
    }

    public function show($id)
    {
        $laporan = InputAspirasi::with(['user', 'kategori', 'aspirasis'])->findOrFail($id);

        return view('admin.laporan.show', compact('laporan'));
    }
}
