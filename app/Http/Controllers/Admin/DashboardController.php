<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_laporan'     => InputAspirasi::count(),
            'total_siswa'  => User::where('role', 'siswa')->count(),
            'status_dikirim'    => InputAspirasi::where('status', 'menunggu')->count(),
            'status_proses'     => InputAspirasi::where('status', 'proses')->count(),
            'status_selesai'    => InputAspirasi::where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}
