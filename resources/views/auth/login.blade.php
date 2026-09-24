<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - E-GUDANG</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; margin: 0; padding: 0; }
        
        .blue-panel {
            background-color: #0c76f6;
            border-top-left-radius: 40px;
            border-bottom-left-radius: 40px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .circle-decor-1 {
            position: absolute;
            bottom: -150px;
            right: -150px;
            width: 400px;
            height: 400px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .circle-decor-2 {
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 400px;
            height: 400px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            pointer-events: none;
        }

        input:focus {
            outline: none;
            border-color: #0c76f6;
            box-shadow: 0 0 0 3px rgba(12, 118, 246, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex w-full">

    <!-- Left Side: Illustration -->
    <div class="hidden lg:flex w-1/2 flex-col p-12 relative bg-white">
        <!-- Logo -->
        <div class="absolute top-10 left-12 flex items-center gap-2">
            <div class="bg-blue-600 p-1.5 rounded-lg flex items-center justify-center">
                <i data-lucide="package" class="w-5 h-5 text-white"></i>
            </div>
            <span class="text-xl font-bold tracking-tight text-gray-900">E-GUDANG</span>
        </div>
        
        <div class="flex-1 flex items-center justify-center">
            <!-- Using the generated unDraw style illustration -->
            <img src="{{ asset('images/login_illustration.jpg') }}" alt="Login Illustration" class="max-w-md w-full h-auto mix-blend-multiply">
        </div>
    </div>

    <!-- Right Side: Login Panel -->
    <div class="w-full lg:w-1/2 blue-panel flex items-center justify-center p-6 lg:p-12 relative min-h-screen lg:min-h-0">
        
        <!-- Decorative circles -->
        <div class="circle-decor-1"></div>
        <div class="circle-decor-2"></div>

        <!-- Login Card -->
        <div class="bg-white p-10 sm:p-12 rounded-2xl shadow-xl w-full max-w-[420px] relative z-10">
            <h1 class="text-2xl font-bold text-gray-900 mb-8 tracking-tight text-center sm:text-left">LOGIN | E-GUDANG</h1>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="block w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-full text-sm text-gray-800 placeholder-gray-400 transition-all"
                            placeholder="Email Address">
                    </div>
                </div>

                <div>
                    <div class="relative" x-data="{ showPassword: false }">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input x-bind:type="showPassword ? 'text' : 'password'" name="password" id="password" required
                            class="block w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-full text-sm text-gray-800 placeholder-gray-400 transition-all"
                            placeholder="Password">
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#0c76f6] transition-colors focus:outline-none">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="showPassword" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#0c76f6] hover:bg-[#0a65d6] text-white font-medium py-3.5 rounded-full transition-colors">
                        Login
                    </button>
                </div>
                

            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
