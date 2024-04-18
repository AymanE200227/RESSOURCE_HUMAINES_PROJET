<?php
namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CongeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:request-leave', ['only' => ['create', 'store']]);
        $this->middleware('permission:manage-leave', ['only' => ['index', 'update']]);
    }

    public function index(): View
    {
        
        $conges = Conge::latest()->paginate(10);
        return view('conges.index', compact('conges'));
    }

    public function create(): View
    {
        
        return view('conges.create');
    }

    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'type_conge' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $conge = new Conge();
        $conge->employee_id = Auth::id();
        $conge->type_conge = $request->type_conge;
        $conge->date_debut = $request->date_debut;
        $conge->date_fin = $request->date_fin;
        $conge->save();

        return redirect()->route('conges.my-requests')->withSuccess('Vacation request submitted successfully.');
    }
    public function update(Request $request, Conge $conge): RedirectResponse
    {
        
    
        
        $validatedData = $request->validate([
            'statut' => 'required|in:approved,rejected', 
        ]);
    
        
        DB::transaction(function () use ($conge, $validatedData) {
            $conge->update(['statut' => $validatedData['statut']]);
        });
    
        
        return redirect()->route('conges.index')->withSuccess('Leave request status updated successfully.');
    }
    public function myRequests(): View
{
    
    $conges = Conge::where('employee_id', Auth::id())->latest()->paginate(10);
    return view('conges.my-requests', compact('conges'));
}

}
