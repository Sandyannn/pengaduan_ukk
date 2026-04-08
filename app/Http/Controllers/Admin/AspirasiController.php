<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AspirasiController extends Controller
{
    public function updateStatus($id)
    {
        $input_aspirasis = InputAspirasi::findOrFail($id);
        $input_aspirasis->update(['status' => 'proses']);

        return redirect()->back()->with('success', 'Laporan berhasil diperbarui ke status PROSES.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:input_aspirasis,id',
            'feedback'   => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            Aspirasi::create([
                'input_aspirasis_id' => $request->laporan_id,
                'user_id'            => Auth::id(),
                'feedback'           => $request->feedback,
                'tg_feedback'        => now(),
            ]);

            $input_aspirasi = InputAspirasi::findOrFail($request->laporan_id);
            $input_aspirasi->update(['status' => 'selesai']);
        });

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim dan status laporan SELESAI!');
    }
}
