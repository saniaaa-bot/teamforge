<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $workspace->name }} - TeamForge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        forge: { blue: '#3B82F6', dark: '#0F172A', light: '#F8FAFC' }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-forge-light font-sans text-slate-800 flex flex-col">

    <!-- Navbar -->
    <header class="h-20 bg-white border-b border-slate-200 flex justify-between items-center px-8 sticky top-0 z-50">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-blue-600 transition-colors bg-slate-50 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-2xl font-heading font-extrabold text-slate-900">{{ $workspace->name }}</h1>
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">Owner: {{ $workspace->owner->name }}</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center font-bold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-8 max-w-7xl mx-auto w-full">
        
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-heading font-bold text-slate-900 mb-1">Projects</h2>
                <p class="text-slate-500 text-sm">Manage your projects and tasks here.</p>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md">
                + New Project
            </button>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($workspace->projects as $project)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $project->name }}</h3>
                    <p class="text-sm text-slate-500 mb-4">{{ $project->description ?? 'No description.' }}</p>
                    
                    <div class="border-t border-slate-100 pt-4 mt-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tasks: {{ $project->tasks->count() }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-slate-200">
                    <p class="text-slate-500">No projects yet. Create one to get started!</p>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>