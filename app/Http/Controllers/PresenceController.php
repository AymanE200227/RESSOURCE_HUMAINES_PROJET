<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        // Logic to fetch all presence records
        $presences = Presence::latest()->paginate(10);
        return view('presences.index', compact('presences'));
    }

    public function create(): View
    {
        // Get the logged-in user
        $user = Auth::user();

        // Logic to show the form for managing presence
        return view('presences.create', compact('user'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate the presence record
        $request->validate([
            'status' => 'required|in:Present,Absent',
        ]);

        // Store the presence record with the logged-in user's ID and current date and time
        $user = Auth::user();
        $presence = new Presence();
        $presence->employee_id = $user->id;
        $presence->heure_arrivee = now(); // current date and time
        $presence->status = $request->status;
        $presence->save();

        return redirect()->route('presences.index')->withSuccess('Presence recorded successfully.');
    }
}
