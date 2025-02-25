<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Team;

use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function create(Request $request)
    {
        $team_id = $request->input('team_id');
        return view('members.create', compact('team_id'));
    }

    public function store(Request $request)
    {
        $team = Team::findOrFail($request->team_id);

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'role' => 'required|string',
            'phone' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validatedData['role'] === 'Team Lead') {
            $existingTeamLead = Member::where('team_id', $team->id)->where('role', 'Team Lead')->first();
            if ($existingTeamLead) {
                return redirect()->back()->withErrors(['role' => 'There can only be one team lead in a team.']);
            }
        }

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Create a new member
        $member= $team->member()->create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'phone' => $validatedData['phone'],
            'profile_picture' => $path,
        ]);

        // Redirect to the team show page
        return redirect()->route('teams.show', $team->id)->with('success', 'Member created successfully.');
    }

    public function edit(Member $member)
    {
        return view('Members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->id,
            'role' => 'required|string',
            'phone' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validatedData['role'] === 'Team Lead') {
            $existingTeamLead = Member::where('team_id', $member->team_id)->where('role', 'Team Lead')->first();
            if ($existingTeamLead && $existingTeamLead->id !== $member->id) {
                return redirect()->back()->withErrors(['role' => 'There can only be one team lead in a team.']);
            }
        }

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $path;
        }

        // Update the member
        $member->update($validatedData);

        // Redirect to the team show page
        return redirect()->route('teams.show', $member->team_id)->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        // Redirect to the team show page
        return redirect()->route('teams.show', $member->team_id)->with('success', 'Member deleted successfully.');
    }
}
