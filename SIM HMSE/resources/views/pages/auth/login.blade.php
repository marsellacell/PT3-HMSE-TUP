<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login — SIM HMSE</title>
    <meta name="description" content="Login ke Sistem Informasi Manajemen HMSE Telkom University Purwokerto">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">

    <div class="min-h-screen flex" x-data="{ showPassword: false }">

        {{-- Left: Branding Panel --}}
        <div class="hidden lg:flex lg:w-1/2 xl:w-[55%] relative overflow-hidden items-center justify-center"
             style="background: linear-gradient(135deg, #1a2a6c 0%, #2C3DA6 30%, #1E2D8F 60%, #00C4D8 100%);">

            {{-- Animated Background Shapes --}}
            <div class="absolute inset-0 overflow-hidden">
                {{-- Large circle --}}
                <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-10 bg-white animate-pulse" style="animation-duration: 6s;"></div>
                <div class="absolute top-1/3 -right-20 w-72 h-72 rounded-full opacity-[0.07] bg-white animate-pulse" style="animation-duration: 8s;"></div>
                <div class="absolute -bottom-32 left-1/4 w-80 h-80 rounded-full opacity-[0.05] bg-white animate-pulse" style="animation-duration: 10s;"></div>

                {{-- Grid Pattern --}}
                <div class="absolute inset-0 opacity-[0.03]"
                     style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;">
                </div>

                {{-- Diagonal Lines --}}
                <div class="absolute top-0 left-0 w-full h-full opacity-[0.04]"
                     style="background-image: repeating-linear-gradient(45deg, transparent, transparent 80px, rgba(255,255,255,.1) 80px, rgba(255,255,255,.1) 81px);">
                </div>
            </div>

            {{-- Content --}}
            <div class="relative z-10 max-w-lg px-12 text-center">
                {{-- Logo --}}
                <div class="mb-8 inline-flex items-center justify-center">
                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center bg-white/10 backdrop-blur-sm border border-white/20 shadow-2xl">
                        <svg viewBox="0 0 40 40" fill="none" class="w-10 h-10">
                            <path d="M20 4L23.5 16.5L36 20L23.5 23.5L20 36L16.5 23.5L4 20L16.5 16.5L20 4Z" fill="white"/>
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-black text-white mb-3 tracking-tight">SIM HMSE</h1>
                <p class="text-lg text-white/60 font-medium mb-2">Sistem Informasi Manajemen</p>
                <p class="text-sm text-white/40 leading-relaxed mb-12">
                    Himpunan Mahasiswa Software Engineering<br>
                    Telkom University Purwokerto
                </p>

                {{-- Feature Highlights --}}
                <div class="space-y-4 text-left max-w-sm mx-auto">
                    @foreach([
                        ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'title' => 'Manajemen Program Kerja', 'desc' => 'Kelola proker dari persiapan hingga selesai'],
                        ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Proposal Otomatis', 'desc' => 'Generate PDF dengan tanda tangan digital'],
                        ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1', 'title' => 'Pencatatan Keuangan', 'desc' => 'Transparansi kas internal & per-proker'],
                    ] as $feature)
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 transition-all duration-300">
                            <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-[#00C4D8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">{{ $feature['title'] }}</p>
                                <p class="text-xs text-white/40 mt-0.5">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Bottom Decoration --}}
                <div class="mt-12 flex items-center justify-center gap-3">
                    <div class="w-8 h-0.5 bg-white/20 rounded-full"></div>
                    <span class="text-[10px] text-white/30 uppercase tracking-widest font-semibold">Secure Platform</span>
                    <div class="w-8 h-0.5 bg-white/20 rounded-full"></div>
                </div>
            </div>
        </div>

        {{-- Right: Login Form --}}
        <div class="w-full lg:w-1/2 xl:w-[45%] flex items-center justify-center p-6 sm:p-12 bg-[#f8f9fb]">
            <div class="w-full max-w-md">

                {{-- Mobile Logo (hidden on desktop) --}}
                <div class="lg:hidden text-center mb-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4"
                         style="background: linear-gradient(135deg, #2C3DA6, #00C4D8);">
                        <svg viewBox="0 0 40 40" fill="none" class="w-8 h-8">
                            <path d="M20 4L23.5 16.5L36 20L23.5 23.5L20 36L16.5 23.5L4 20L16.5 16.5L20 4Z" fill="white"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-black text-gray-800">SIM HMSE</h1>
                    <p class="text-sm text-gray-400">Sistem Informasi Manajemen</p>
                </div>

                {{-- Welcome Text --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-black text-gray-800 mb-1">Selamat Datang! 👋</h2>
                    <p class="text-sm text-gray-400">Masuk ke akun kamu untuk melanjutkan</p>
                </div>

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@student.telkomuniversity.ac.id"
                                required
                                autofocus
                                class="w-full pl-11 pr-4 py-3 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] focus:ring-3 focus:ring-[#2C3DA6]/10 transition-all duration-200 placeholder:text-gray-300"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <a href="#" class="text-xs font-semibold text-[#2C3DA6] hover:text-[#00C4D8] transition-colors">Lupa password?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                placeholder="Masukkan password"
                                required
                                class="w-full pl-11 pr-12 py-3 text-sm bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#2C3DA6] focus:ring-3 focus:ring-[#2C3DA6]/10 transition-all duration-200 placeholder:text-gray-300"
                            >
                            <button type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-2.5">
                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-[#2C3DA6] focus:ring-[#2C3DA6]/30 transition-colors cursor-pointer"
                        >
                        <label for="remember" class="text-sm text-gray-500 cursor-pointer select-none">Ingat saya di perangkat ini</label>
                    </div>

                    {{-- Error Alert --}}
                    @if(session('error'))
                        <div class="p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.134 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-red-700">Login gagal</p>
                                <p class="text-xs text-red-500 mt-0.5">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full py-3.5 text-sm font-bold text-white rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-4 focus:ring-[#2C3DA6]/20"
                        style="background: linear-gradient(135deg, #2C3DA6 0%, #1E2D8F 100%);"
                        onmouseover="this.style.background='linear-gradient(135deg, #3548b8 0%, #2C3DA6 100%)'"
                        onmouseout="this.style.background='linear-gradient(135deg, #2C3DA6 0%, #1E2D8F 100%)'"
                    >
                        Masuk ke Dashboard
                    </button>
                </form>

                {{-- Divider --}}
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400 font-medium">atau</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- SSO Button --}}
                <button
                    type="button"
                    class="w-full flex items-center justify-center gap-3 py-3 text-sm font-semibold text-gray-600 bg-white border-2 border-gray-200 rounded-xl hover:border-[#2C3DA6]/30 hover:bg-blue-50/30 transition-all duration-200"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Login dengan Google (SSO Kampus)
                </button>

                {{-- Back to Home --}}
                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-[#2C3DA6] transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke halaman utama
                    </a>
                </div>

                {{-- Footer --}}
                <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                    <p class="text-[11px] text-gray-300">
                        &copy; {{ date('Y') }} HMSE Telkom University Purwokerto
                    </p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
