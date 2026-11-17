<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Auth::user()->workspaces;
        return view('dashboard', compact('workspaces'));
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