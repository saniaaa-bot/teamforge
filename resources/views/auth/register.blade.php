<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TeamForge</title>
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
<body class="min-h-screen bg-forge-light font-sans text-slate-800 flex items-start justify-center p-4 py-12">

    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200 my-8">
        
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-blue-600 rounded-xl mx-auto flex items-center justify-center shadow-lg mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h2 class="text-3xl font-heading font-extrabold text-slate-900">Create Account</h2>
            <p class="text-slate-500 text-sm mt-2">Join TeamForge to start managing your projects.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow text-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow text-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow text-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow text-sm">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500" />
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-black transition-all duration-300 shadow-md mt-6">
                Sign Up
            </button>

            <p class="text-center text-sm text-slate-500 mt-6">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Log in</a>
            </p>
        </form>
    </div>
</body>
</html>