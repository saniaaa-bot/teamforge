<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - TeamForge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], heading: ['"Plus Jakarta Sans"', 'sans-serif'] }, colors: { forge: { blue: '#3B82F6', dark: '#0F172A', light: '#F8FAFC' } } } }
        }
    </script>
</head>
<body class="min-h-screen bg-forge-light font-sans text-slate-800 flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200">
        
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-blue-600 rounded-xl mx-auto flex items-center justify-center shadow-lg mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h2 class="text-3xl font-heading font-extrabold text-slate-900">Welcome Back</h2>
            <p class="text-slate-500 text-sm mt-2">Log in to your TeamForge workspace.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow text-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow text-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-sm text-slate-600">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 font-bold hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-black transition-all duration-300 shadow-md mt-6">
                Log In
            </button>

            <p class="text-center text-sm text-slate-500 mt-6">
                Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Sign up</a>
            </p>
        </form>
    </div>
</body>
</html>