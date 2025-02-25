<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Team;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('Projects.index', compact('projects'));
    }

    public function create()
    {

        return view('Projects.create');
    }

    public function store(Request $request)
    {

        $user = User::where('id', Auth::id())->first();
        // Validate the request data
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'objectives' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        $project = $user->Project()->create([
            'project_name' => $validatedData['project_name'],
            'user_id' => $user->id,
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'objectives' => $validatedData['objectives'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'status' => $validatedData['status'],
        ]);

        // Redirect to the home page
        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $teams = Team::all();
        $tasks = Task::where('project_id', $project->id)->get();
        return view('Projects.show', compact('project', 'teams', 'tasks'));
    }

    public function tasks(Project $project)
    {
        $tasks = Task::where('project_id', $project->id)->get();
        return view('Tasks.index', compact('project', 'tasks'));
    }

    public function edit(Project $project)
    {
        return view('Projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'objectives' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        // Update the project
        $project->update($validatedData);

        // Redirect to the project show page
        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        // Redirect to the projects index page
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
