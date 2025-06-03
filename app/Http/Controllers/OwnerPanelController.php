<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Support\Facades\Auth;

class OwnerPanelController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Brak dostępu');
        }

        $stats = [
            'total'     => Bike::count(),
            'ready'     => Bike::where('status', 'gotowy')->count(),
            'inRepair'  => Bike::where('status', 'w naprawie')->count(),
            'waiting'   => Bike::where('status', 'oczekuje')->count(),
            'collected' => Bike::where('status', 'odebrany')->count(), // ⬅️ dodane
        ];

        return view('owner.panel', compact('stats'));
    }

}
