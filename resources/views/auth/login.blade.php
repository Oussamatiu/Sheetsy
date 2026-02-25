<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1200&h=600&fit=crop');
                 background-position: center;">
        
        <div class="flex w-4/6 h-5/6 max-h-[600px] overflow-hidden rounded-lg lg:rounded-3xl shadow-2xl">
            <!-- Left Side - Form -->
            <div class="flex-1 flex items-center justify-center p-8 lg:p-12 bg-white/95 backdrop-blur-sm">
                <form method="POST" action="{{ route('login') }}" class="w-full max-w-md">
                    @csrf

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h1>
                    <p class="text-gray-600 mb-8">Sign in to manage your shared expenses</p>

                    <!-- Email Address -->
                    <div class="mb-5">
                        <x-input-label for="email" :value="__('Email Address')" class="text-xs text-gray-700 font-semibold" />
                        <div class="relative mt-2">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                            </span>
                            <x-text-input id="email" class="block w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:border-green-500 focus:ring-green-500" 
                                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-xs text-gray-700 font-semibold" />
                        <div class="relative mt-2">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            </span>
                            <x-text-input id="password" class="block w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:border-green-500 focus:ring-green-500"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                            <span class="ms-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-green-600 hover:text-green-700 font-semibold" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full bg-green-600 text-white hover:bg-green-700 px-6 py-3 rounded-xl font-semibold transition duration-200 mb-4">
                        {{ __('Sign In') }}
                    </x-primary-button>

                    <p class="text-center text-gray-600 text-sm">
                        {{ __('Don\'t have an account?') }}
                        <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">
                            {{ __('Register here') }}
                        </a>
                    </p>
                </form>
            </div>

            <!-- Right Side - Marketing Panel -->
            <div class="hidden lg:flex flex-col justify-center w-1/2 p-12 backdrop-blur-lg bg-gradient-to-br from-green-600 to-green-800 text-white rounded-r-3xl">
                <div class="mb-8">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">Welcome to ColoShare!</h2>
                    <p class="text-green-50 text-sm leading-relaxed mb-6">Manage your shared living expenses effortlessly and share costs fairly with your roommates.</p>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-center gap-3">
                        <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-lg bg-white/20">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="text-sm">Easy Expense Tracking</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-lg bg-white/20">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-sm">Fair Cost Splitting</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="flex-shrink-0 flex items-center justify-center h-8 w-8 rounded-lg bg-white/20">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3a6 6 0 016-6h6a6 6 0 016 6h-2m-6-10.5a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </div>
                        <span class="text-sm">Manage Roommates</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-guest-layout>
