<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $workspace->name }} - TeamForge</title>
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

    <!-- Top Navigation -->
    <header class="h-20 bg-white border-b border-slate-200 flex justify-between items-center px-4 md:px-8 sticky top-0 z-50">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-blue-600 transition-colors bg-slate-50 p-2.5 rounded-xl border border-slate-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-xl md:text-2xl font-heading font-extrabold text-slate-900">{{ $workspace->name }}</h1>
                <div class="flex items-center gap-2 mt-0.5">
                    <span class="bg-blue-50 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded-md border border-blue-100 uppercase tracking-wider">Owner: {{ $workspace->owner->name }}</span>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center font-bold shadow-sm">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-4 md:p-8 max-w-7xl mx-auto w-full">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-medium shadow-sm">{{ session('success') }}</div>
        @endif

        <!-- Header & Add Project Form -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-6">
                <div>
                    <h2 class="text-3xl font-heading font-bold text-slate-900 mb-1">Projects</h2>
                    <p class="text-slate-500 text-sm">Manage your projects and tasks in this workspace.</p>
                </div>
            </div>

            <!-- Add Project Panel -->
            <div class="bg-white p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60">
                <form action="{{ route('projects.store', $workspace->id) }}" method="POST" class="flex flex-col md:flex-row gap-3">
                    @csrf
                    <input type="text" name="name" placeholder="Enter new project name..." required class="flex-grow bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow">
                    <button type="submit" class="bg-slate-900 hover:bg-black text-white font-semibold py-3 px-8 rounded-xl shadow-md whitespace-nowrap transition-all">
                        + Create Project
                    </button>
                </form>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($workspace->projects as $project)
                <div class="bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 flex flex-col justify-between hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 group">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                            </div>
                            <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2.5 py-1 rounded-md border border-slate-200">{{ $project->tasks->count() }} Tasks</span>
                        </div>
                        <h3 class="text-xl font-heading font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors">{{ $project->name }}</h3>
                        <p class="text-sm text-slate-500 mb-6 line-clamp-2">{{ $project->description ?? 'No description provided for this project.' }}</p>
                    </div>
                    
                    <div class="border-t border-slate-100 pt-4 mt-auto">
                        <a href="{{ route('projects.show', $project->id) }}" class="w-full flex items-center justify-between text-sm font-bold text-slate-600 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 px-4 py-2.5 rounded-xl transition-all border border-transparent hover:border-blue-100">
                            Open Project
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl p-16 text-center border border-slate-200 shadow-sm flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">No Projects Found</h3>
                    <p class="text-slate-500 text-sm max-w-sm">This workspace is currently empty. Create your first project using the form above.</p>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>