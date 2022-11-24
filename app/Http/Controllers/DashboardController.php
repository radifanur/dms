<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Dokumen::count();  
        return view('dashboard', [
            'total' => $total,
        ]);
    }
}
