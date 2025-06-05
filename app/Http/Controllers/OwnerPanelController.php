<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Support\Facades\Auth;

/**
 * Kontroler panelu właściciela (owner).
 */
class OwnerPanelController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'owner') {
            abort(403, 'Brak dostępu');
        }

        $bikes = Bike::with('user')->get();

        $stats = [
            'total'     => $bikes->count(),
            'gotowy'    => $bikes->where('status', 'gotowy')->count(),
            'naprawa'   => $bikes->where('status', 'w naprawie')->count(),
            'oczekuje'  => $bikes->where('status', 'oczekuje')->count(),
            'odebrany'  => $bikes->where('status', 'odebrany')->count(),
        ];

        // rowery deadline
        $overdueBikes = $bikes->filter(function ($bike) {
            return $bike->deadline && $bike->deadline < now() && $bike->status !== 'gotowy';
        });
        
        return view('owner.panel', compact('stats', 'overdueBikes'));
    }
}
