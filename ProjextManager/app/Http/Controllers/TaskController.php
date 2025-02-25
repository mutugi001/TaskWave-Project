<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Team;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $project_id = $request->input('project_id');
        return view('tasks.create', compact('project_id'));
    }

    public function store(Request $request)
    {
        $project = Project::findOrFail($request->project_id);

        // Validate the request data
        $validatedData = $request->validate([
            'task_name.*' => 'required|string|max:255',
            'description.*' => 'required|string',
            'status.*' => 'nullable|string',
            'due_date.*' => 'required|date',
            'team_name.*' => 'required|exists:teams,team_name',
            'dependent_task_id.*' => 'nullable|exists:tasks,id',
        ]);

        // Create multiple tasks
        foreach ($request->task_name as $index => $task_name) {
            $dependentTaskId = $request->dependent_task_id[$index] ?? null;
            $dependentTask = $dependentTaskId ? Task::find($dependentTaskId) : null;
            $status = $request->status[$index] ?? 'pending';

            if ($status === 'running' && $dependentTask && $dependentTask->status !== 'completed') {
                return redirect()->back()->withErrors(['status' => 'A task cannot be in a running state while its dependent task is not completed.']);
            }

            $task = $project->task()->create([
                'title' => $task_name,
                'description' => $request->description[$index],
                'status' => $status,
                'due_date' => $request->due_date[$index],
                'assigned_team' => $request->team_name[$index],
                'dependent_task_id' => $dependentTaskId,
            ]);

            $members = Team::where('team_name', $request->team_name[$index])->first()->member()->get();
            $phoneNumbers = $members->pluck('phone')->toArray();
            $whatsappController = new WhatsappController();
            $whatsappController->store(new Request([
                'phoneNumbers' => $phoneNumbers,
                'message' => $task->title . ' has been assigned to you. Due date is ' . $task->due_date . '. Task description: ' . $task->description,
                'task_id' => $task->id,
                'button_url' => 'https://your-domain.com/confirm-task-completion?task_id=' . $task->id,
            ]));

        }

        // Redirect to the project show page
        return redirect()->route('projects.show', $project->id)->with('success', 'Tasks created successfully.');
    }

    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function confirmCompletion(Request $request)

    {
        $task = Task::findOrFail($request->task_id);
        $task->status = 'completed';
        $task->save();

        return redirect()->route('projects.show', $task->project_id)->with('success', 'Task marked as completed.');
    }
}
