<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Team;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create()
    {

        return view('Teams.create');
    }

    public function store(Request $request)
    {

        $user = User::where('id', Auth::id())->first();


        // Validate the request data
        $validatedData = $request->validate([
            'team_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new project
        $team = $user->team()->create([
            'user_id' => $user->id,
            'team_name' => $validatedData['team_name'],
            'description' => $validatedData['description'],
        ]);

        // Redirect to the home page
        return redirect()->route('teams.index')->with('success', 'team created successfully.');
    }

    public function index()
    {
        $teams = Team::all();
        return view('Teams.index', compact('teams'));
    }

    public function show(Team $team)
    {
        $members = Member::where('team_id', $team->id)->get();
        return view('Teams.show', compact('team','members' ));
    }

    public function members(Team $team)
    {
        $members= Member::where('team_id', $team->id)->get();
        return view('Members.show', compact('members','team'));
    }

    public function edit(Team $team)
    {
        return view('Teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'team_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Update the team
        $team->update($validatedData);

        // Redirect to the team show page
        return redirect()->route('teams.show', $team->id)->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        // Redirect to the teams index page
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}
