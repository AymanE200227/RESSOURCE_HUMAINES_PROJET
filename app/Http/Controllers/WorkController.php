<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Work;
use App\Models\project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $user = auth()->user();

        $projects = project::all();

        
        return view('works.create', compact('user', 'projects'));
    }


    /**
     * Show the form for creating a new resource (start).
     *
     * @return \Illuminate\Http\Response
     */
    public function createStart()
    {
        $user = User::findOrFail(Auth::id());
        return view('works.create', [
            'user' => $user,
            'work' => new Work(),
            'option' => "createStart",
        ]);
    }

    /**
     * Show the form for creating a new resource (end).
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function createEnd(int $id)
    {
        $work_unit = Work::find($id);
        $user = User::findOrFail(Auth::id());
        return view('works.create', [
            'user' => $user,
            'work' => $work_unit,
            'option' => "createEnd",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = $request->get('option') ?? "";
        $rate = $request->get('rate') ?? Auth::user()->rate;
        $projectId = null; 

        if ($option === "createStart") {
            $projectId = $request->get('project');
            

            $start = Carbon::now();
            $end = Carbon::now();
            $hours = round($end->diffInMinutes($start) / 60, 2);

            Work::create([
                'user_id' => Auth::id(),
                'project_id' => $projectId,
                'start' => $start,
                'hours' => $hours,
                'work_done' => $request->get('work_done') ?? "",
                'rate' => $rate,
                'ip_address_start' => $_SERVER['REMOTE_ADDR'],
            ]);
        } elseif ($option === "createEnd") {
            $work_unit = Work::find($request->get("work_unit"));
            $projectId = $work_unit->project->id;

            $start = $work_unit->start;
            $end = Carbon::now();
            $hours = round($end->diffInMinutes($start) / 60, 2);

            $work_unit->hours = $hours;
            $work_unit->work_done = $request->get('work_done') ?? "";
            $work_unit->ip_address_end = $_SERVER['REMOTE_ADDR'];

            $work_unit->save();
        } else {
            $projectId = $request->get('project');
            

            $start = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('start'));
            $end = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('end'));
            $hours = round($end->diffInMinutes($start) / 60, 2);

            $rate = $request->get('rate') ?? Auth::user()->rate;

            Work::create([
                'user_id' => Auth::id(),
                'project_id' => $projectId,
                'start' => $start,
                'hours' => $hours,
                'work_done' => $request->get('work_done') ?? "",
                'rate' => $rate,
                'ip_address_start' => $_SERVER['REMOTE_ADDR'],
                'ip_address_end' => $_SERVER['REMOTE_ADDR'],
            ]);
        }

        

        return redirect("/projects/$projectId");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        return view('works.show', ['work' => $work]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        return view('works.edit', ['work' => $work, 'user' => User::findOrFail(Auth::id())]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        $start = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('start'));
        $end = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('end'));
        $hours = round($end->diffInMinutes($start) / 60, 2);

        $rate = $request->get('rate') ?? Auth::user()->rate;

        $projectId = $request->get('project');

        $work->update([
            'project_id' => $projectId,
            'start' => $start,
            'hours' => $hours,
            'work_done' => $request->get('work_done'),
            'rate' => $rate,
        ]);

        return redirect("/projects/$projectId");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $projectId = $work->project_id;
        $work->delete();
        return redirect("/projects/$projectId");
    }
}
