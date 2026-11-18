<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function store(Request $request, Workspace $workspace)
    {
        if ($workspace->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $workspace->projects()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        if ($project->workspace->owner_id !== Auth::id()) {
            abort(403);
        }

        $project->load('tasks.assignee');
        
        return view('projects.show', compact('project'));
    }
}