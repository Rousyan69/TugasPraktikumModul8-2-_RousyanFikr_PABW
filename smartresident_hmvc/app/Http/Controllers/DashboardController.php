<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Aduan\Models\Aduan;
use Modules\Infrastruktur\Models\Infrastruktur;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'totalAset' => Infrastruktur::count(),
            'asetRusak' => Infrastruktur::whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->count(),
            'totalAduan' => Aduan::count(),
            'aduanUrgensiTinggi' => Aduan::where('tingkat_urgensi', 'Tinggi')->where('status', '!=', 'Selesai')->count(),
            'aduanTerbaru' => Aduan::latest()->take(5)->get(),
        ]);
    }
}