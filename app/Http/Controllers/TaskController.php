<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        if ($project->workspace->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $project->tasks()->create([
            'title' => $request->title,
            'priority' => $request->priority,
            'status' => $request->status,
            'assigned_to' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    public function toggleStatus(Task $task)
    {
        if ($task->project->workspace->owner_id !== Auth::id()) {
            abort(403);
        }

        $task->status = $task->status === 'done' ? 'todo' : 'done';
        $task->save();

        return redirect()->back();
    }
}