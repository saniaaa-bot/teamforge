<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TeamForge</title>
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
<body class="min-h-screen bg-forge-light font-sans text-slate-800 flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-forge-dark text-slate-400 hidden md:flex flex-col border-r border-slate-800 shadow-2xl z-20 relative">
        <div class="h-20 flex items-center px-8 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-xl font-heading font-bold text-white tracking-wide">TeamForge</span>
            </div>
        </div>
        
        <nav class="flex-grow py-8 px-4 space-y-1">
            <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Workspace Menu</p>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-slate-800/80 text-white font-medium rounded-xl border border-slate-700/50">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800/50 hover:text-white font-medium rounded-xl transition-all group">
                <svg class="w-5 h-5 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                My Tasks
            </a>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800/50 hover:text-white font-medium rounded-xl transition-all group">
                <svg class="w-5 h-5 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Team Members
            </a>
        </nav>
        
        <div class="p-4 border-t border-slate-800 relative z-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-red-500/10 hover:text-red-400 font-medium rounded-xl transition-all group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-20 bg-white/70 backdrop-blur-lg border-b border-slate-200 flex justify-between items-center px-8 z-10 sticky top-0">
            <div class="flex items-center gap-4">
                <h2 class="text-xl font-heading font-bold text-slate-800">Overview</h2>
                <span class="hidden sm:inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-200">System Online</span>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs font-medium text-slate-500">Workspace Owner</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center font-bold shadow-md ring-2 ring-white">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow p-8 overflow-y-auto relative z-0">
            <div class="max-w-6xl mx-auto">
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-medium shadow-sm">{{ session('success') }}</div>
                @endif

                <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-heading font-extrabold text-slate-900 mb-2">Workspace Overview</h1>
                        <p class="text-slate-500 font-medium text-sm">Manage your team projects, assign tasks, and track overall progress.</p>
                    </div>
                    
                    <form action="{{ route('workspaces.store') }}" method="POST" class="flex gap-2 w-full md:w-auto">
                        @csrf
                        <input type="text" name="name" placeholder="New Workspace Name" required class="w-full md:w-64 bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md whitespace-nowrap transition-all">
                            Create
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 relative overflow-hidden group hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-bl-[100px] z-0 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Total Workspaces</p>
                            <div class="flex items-end gap-3">
                                <h3 class="text-4xl font-heading font-extrabold text-slate-900">{{ auth()->user()->workspaces->count() }}</h3>
                                <span class="text-sm font-medium text-green-600 mb-1">+0% from last week</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 relative overflow-hidden group hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-indigo-50 rounded-bl-[100px] z-0 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Active Projects</p>
                            <div class="flex items-end gap-3">
                                <h3 class="text-4xl font-heading font-extrabold text-slate-900">0</h3>
                                <span class="text-sm font-medium text-slate-400 mb-1">No projects yet</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 relative overflow-hidden group hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-purple-50 rounded-bl-[100px] z-0 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pending Tasks</p>
                            <div class="flex items-end gap-3">
                                <h3 class="text-4xl font-heading font-extrabold text-slate-900">0</h3>
                                <span class="text-sm font-medium text-slate-400 mb-1">All caught up!</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-lg font-heading font-bold text-slate-800">Your Workspaces</h3>
                    </div>
                    
                    <div class="divide-y divide-slate-100">
                        @forelse($workspaces as $workspace)
                            <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between hover:bg-slate-50 transition-colors group">
                                <div class="flex items-center gap-5 w-full">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center text-white font-extrabold text-2xl shadow-md border border-slate-700">
                                        {{ substr($workspace->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $workspace->name }}</h4>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2 py-1 rounded-md border border-slate-200">Owner: {{ $workspace->owner->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('workspaces.show', $workspace->id) }}" class="mt-4 sm:mt-0 text-sm font-bold text-slate-600 hover:text-white bg-white hover:bg-blue-600 border border-slate-200 hover:border-blue-600 px-5 py-2.5 rounded-lg transition-all shadow-sm flex items-center gap-2">
                                    Open Workspace
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        @empty
                            <div class="p-16 text-center flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-slate-50 border border-slate-200 rounded-full flex items-center justify-center mb-6 shadow-inner">
                                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 mb-2">No Workspaces Found</h3>
                                <p class="text-slate-500 mb-6 max-w-sm mx-auto text-sm">You haven't created any workspaces yet. Create one to start managing your projects.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>