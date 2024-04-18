<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProject;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('users.index', [
            'users' => User::latest('id')->paginate(5)
        ]);
    }

    public function create(): View
    {
        return view('users.create', [
            'user' => new User(),
            'roles' => Role::pluck('name')->all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
        ]);

        
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Email already in use.')->withInput();
        }

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->withSuccess('New user is added successfully.');
    }

    public function show(User $user): View
    {
        $now = Carbon::now()->subMonth();
        $works = Work::where('user_id', $user->id)
            ->where('start', '>=', $now)
            ->orderBy('start', 'desc')
            ->get();

        $days = [];
        $costs = [];
        $highest_cost = 0;

        foreach ($works as $work) {
            $day = $work->start->format('d');
            $hours = $work->hours;

            if (!isset($days[$day])) {
                $days[$day] = 0;
            }

            $days[$day] += $hours;

            if (!isset($costs[$day])) {
                $costs[$day] = 0;
            }

            $cost = $work->rate * $hours;
            $costs[$day] += $cost;

            if ($cost > $highest_cost) {
                $highest_cost = $cost;
            }
        }

        return view('users.show', [
            'user' => $user,
            'labels' => array_keys($days),
            'hours' => array_values($days),
            'costs' => array_values($costs),
            'highest_cost' => $highest_cost,
        ]);
    }

    public function edit(User $user): View
    {
        
        if ($user->hasRole('Super Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $input = $request->all();

        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }

        $user->update($input);

        $user->syncRoles($request->roles);

        return redirect()->back()
            ->withSuccess('User is updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id)
        {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')
            ->withSuccess('User is deleted successfully.');
    }
}
