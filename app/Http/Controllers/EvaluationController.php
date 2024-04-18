<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;


class EvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $employees = User::all(); // Fetch all employees from the database
        return view('evaluations.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'criteria' => 'required|array',
            'criteria.*.name' => 'required|string',
            'criteria.*.goal' => 'required|string',
        ]);

        $evaluation = new Evaluation();
        $evaluation->employee_id = $request->employee_id;
        $evaluation->criteria = $request->criteria;
        $evaluation->save();

        return redirect()->route('evaluations.index')->withSuccess('Evaluation submitted successfully.');
    }

    public function index(): View
    {
        $evaluations = Evaluation::all(); // You may want to paginate if there are many evaluations
        return view('evaluations.index', compact('evaluations'));
    }
}
