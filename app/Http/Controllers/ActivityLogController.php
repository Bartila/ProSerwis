<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('activity_logs.index', compact('logs'));
    }

    public function destroyAll()
    {
        // Ochrona: tylko admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Brak uprawnień do czyszczenia logów.');
        }

        \App\Models\ActivityLog::truncate();

        return redirect()->route('activity_logs.index')->with('success', 'Wszystkie logi zostały usunięte.');
    }

}
