<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\DDT;
use App\Models\Lavoro;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalClienti = Cliente::count();
        $totalDDT = DDT::count();
        $totalLavori = Lavoro::count();
        $recentDDT = DDT::with('cliente')->latest()->take(5)->get();

        return view('dashboard', compact('totalUsers', 'totalClienti', 'totalDDT', 'totalLavori', 'recentDDT'));
    }
}
