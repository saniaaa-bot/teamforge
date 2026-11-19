<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workspaces = $user->workspaces;

        // Saare workspaces ke IDs nikaalein
        $workspaceIds = $workspaces->pluck('id');

        // Stats calculate karein
        $totalWorkspaces = $workspaces->count();
        
        $totalProjects = Project::whereIn('workspace_id', $workspaceIds)->count();
        
        $totalTasks = Task::whereHas('project', function($query) use ($workspaceIds) {
            $query->whereIn('workspace_id', $workspaceIds);
        })->count();

        $completedTasks = Task::whereHas('project', function($query) use ($workspaceIds) {
            $query->whereIn('workspace_id', $workspaceIds);
        })->where('status', 'done')->count();

        return view('dashboard', compact(
            'workspaces', 
            'totalWorkspaces', 
            'totalProjects', 
            'totalTasks', 
            'completedTasks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Workspace::create([
            'name' => $request->name,
            'owner_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Workspace created successfully!');
    }

    public function show(Workspace $workspace)
    {
        if ($workspace->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this workspace.');
        }

        $workspace->load('projects.tasks');
        
        return view('workspaces.show', compact('workspace'));
    }
}