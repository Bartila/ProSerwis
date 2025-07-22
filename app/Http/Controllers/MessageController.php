<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\BikeStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Wyświetlenie wiadomości i licznika rowerów
    public function index()
    {
        $messages = Message::with('user')->latest()->paginate(7);

        // Upewnij się, że rekord BikeStat istnieje
        $stat = BikeStat::firstOrCreate([], ['total_added' => 0]);

        return view('messages.index', [
            'messages'    => $messages,
            'totalAdded'  => $stat->total_added,
        ]);
    }

    // Zapisanie nowej wiadomości
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('messages.index')->with('success', 'Wiadomość dodana!');
    }

    // Usuwanie wiadomości (admin lub autor)
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $user = auth()->user();

        if (!$user || (!$user->isAdmin() && $user->id !== $message->user_id)) {
            abort(403, 'Nie masz uprawnień do usunięcia tej wiadomości.');
        }

        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Wiadomość usunięta!');
    }

    // Resetowanie licznika rowerów (tylko admin/owner)
    public function resetCounter()
    {
        $user = auth()->user();

        if (!$user || (!$user->isAdmin() && !$user->isOwner())) {
            abort(403);
        }

        $stat = BikeStat::first();
        if ($stat) {
            $stat->update(['total_added' => 0]);
        }

        return redirect()->route('messages.index')->with('success', 'Licznik został zresetowany.');
    }
}
