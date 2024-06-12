<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kosList = Kos::with('rooms')->where('owner_id', auth()->id())->get();
        return view('auth.owner.dashboard', compact('kosList'));
    }
}
