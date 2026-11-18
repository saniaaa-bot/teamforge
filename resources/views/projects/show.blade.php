<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }} - TeamForge</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { 
                extend: { 
                    fontFamily: { sans: ['Inter', 'sans-serif'], heading: ['"Plus Jakarta Sans"', 'sans-serif'] }, 
                    colors: { forge: { blue: '#3B82F6', dark: '#0F172A', light: '#F8FAFC' } } 
                } 
            }
        }
    </script>
</head>
<body class="min-h-screen bg-forge-light font-sans text-slate-800 flex flex-col">

    <header class="h-20 bg-white border-b border-slate-200 flex justify-between items-center px-8 sticky top-0 z-50">
        <div class="flex items-center gap-4">
            <a href="{{ route('workspaces.show', $project->workspace_id) }}" class="text-slate-400 hover:text-blue-600 transition-colors bg-slate-50 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-heading font-extrabold text-slate-900">{{ $project->name }}</h1>
                <p class="text-xs text-slate-500 font-medium">Project Tasks</p>
            </div>
        </div>
    </header>

    <main class="flex-grow p-4 md:p-8 max-w-6xl mx-auto w-full">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-medium shadow-sm">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 mb-10 w-full overflow-hidden">
            <h3 class="text-xl font-heading font-bold text-slate-800 mb-6">Add a New Task</h3>
            
            <form action="{{ route('tasks.store', $project->id) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Task Title</label>
                    <input type="text" name="title" placeholder="e.g. Design Homepage Mockup" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                            <option value="todo" selected>To Do</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Priority</label>
                        <select name="priority" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                            <option value="low">Low Priority</option>
                            <option value="medium" selected>Medium Priority</option>
                            <option value="high">High Priority</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl shadow-md transition-all">
                        + Add Task
                    </button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-heading font-bold text-slate-900">Your Tasks</h2>
            <span class="bg-slate-200 text-slate-600 text-xs font-bold px-3 py-1 rounded-full">{{ $project->tasks->count() }} Total</span>
        </div>

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 overflow-hidden">
            <div class="divide-y divide-slate-100">
                @forelse($project->tasks as $task)
                    <div class="p-5 flex flex-col md:flex-row md:items-center justify-between hover:bg-slate-50 transition-colors group gap-4">
                        
                        <div class="flex items-center gap-4">
                            
                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="m-0 flex items-center">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox" onchange="this.form.submit()" {{ $task->status == 'done' ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            </form>

                            <div>
                                <h4 class="text-base font-bold text-slate-900 group-hover:text-blue-600 transition-colors {{ $task->status == 'done' ? 'line-through text-slate-400' : '' }}">
                                    {{ $task->title }}
                                </h4>
                                <p class="text-xs text-slate-500 mt-1">Assigned to: <span class="font-medium text-slate-700">{{ $task->assignee->name ?? 'Unassigned' }}</span></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 self-start md:self-auto ml-9 md:ml-0">
                            
                            @if($task->status == 'todo')
                                <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 text-xs font-bold px-3 py-1.5 rounded-lg border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> To Do
                                </span>
                            @elseif($task->status == 'in_progress')
                                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-blue-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> In Progress
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Done
                                </span>
                            @endif

                            @if($task->priority == 'high')
                                <span class="bg-red-50 text-red-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-red-200 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                    High
                                </span>
                            @elseif($task->priority == 'medium')
                                <span class="bg-orange-50 text-orange-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-orange-200 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 12h16"></path></svg>
                                    Medium
                                </span>
                            @else
                                <span class="bg-gray-50 text-gray-600 text-xs font-bold px-3 py-1.5 rounded-lg border border-gray-200 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                    Low
                                </span>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="p-16 text-center flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-slate-50 border border-slate-200 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">No tasks yet</h3>
                        <p class="text-slate-500 text-sm">Add your first task using the form above.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

</body>
</html>