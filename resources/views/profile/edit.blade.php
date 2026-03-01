<x-app-layout>
<style>
    @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap');
    * { font-family: 'Figtree', sans-serif; }

    .sidebar-link {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px; border-radius: 10px;
        font-size: 0.875rem; font-weight: 500; color: #4b5563;
        transition: all 0.15s ease; text-decoration: none;
    }
    .sidebar-link:hover { background: #f0fdf4; color: #16a34a; }
    .sidebar-link.active { background: #dcfce7; color: #15803d; font-weight: 600; }
    .sidebar-link svg { width: 18px; height: 18px; flex-shrink: 0; }

    .form-input {
        width: 100%; padding: 11px 16px;
        border: 1.5px solid #e5e7eb; border-radius: 12px;
        font-size: 0.875rem; color: #111827; background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s; outline: none;
    }
    .form-input:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    }
    .form-input::placeholder { color: #9ca3af; }

    .form-label {
        display: block; font-size: 0.8rem;
        font-weight: 600; color: #374151;
        margin-bottom: 6px;
    }

    .section-card {
        background: white; border-radius: 20px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        padding: 32px;
    }

    .btn-primary {
        display: inline-flex; align-items: center; gap-2: 8px;
        background: #16a34a; color: white;
        font-size: 0.875rem; font-weight: 600;
        padding: 10px 22px; border-radius: 12px;
        border: none; cursor: pointer;
        transition: background 0.15s, transform 0.1s;
    }
    .btn-primary:hover { background: #15803d; }
    .btn-primary:active { transform: scale(0.98); }

    .btn-danger {
        display: inline-flex; align-items: center;
        background: #fee2e2; color: #dc2626;
        font-size: 0.875rem; font-weight: 600;
        padding: 10px 22px; border-radius: 12px;
        border: 1px solid #fecaca; cursor: pointer;
        transition: background 0.15s;
    }
    .btn-danger:hover { background: #fecaca; }

    .btn-secondary {
        display: inline-flex; align-items: center;
        background: #f3f4f6; color: #374151;
        font-size: 0.875rem; font-weight: 600;
        padding: 10px 22px; border-radius: 12px;
        border: none; cursor: pointer;
        transition: background 0.15s;
    }
    .btn-secondary:hover { background: #e5e7eb; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .fade-up { animation: fadeUp 0.3s ease both; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.10s; }
    .delay-3 { animation-delay: 0.15s; }
</style>

<div class="flex min-h-screen bg-[#F8FAF9]">

    <!-- ══════════════════════════════════
         SIDEBAR
    ══════════════════════════════════ -->
    <aside class="hidden md:flex flex-col w-64 bg-white border-r border-gray-100 py-6 px-4 min-h-screen sticky top-0">

        <div class="flex items-center gap-2 px-2 mb-8">
            <div class="w-8 h-8 rounded-lg bg-green-600 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/>
                </svg>
            </div>
            <span class="font-bold text-gray-800 text-lg tracking-tight">Sheetsy</span>
        </div>

        <nav class="flex flex-col gap-1 flex-1">
            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-2 mb-1">General</p>

            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('profile.edit') }}" class="sidebar-link active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                My Profile
            </a>

            <div class="mt-4 mb-1">
                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-2 mb-1">My Colocations</p>
            </div>

            @php
                $sidebarColocations = auth()->user()->memberships()
                    ->with('colocation')->whereNull('left_at')
                    ->get()->pluck('colocation')->filter();
            @endphp

            @forelse($sidebarColocations as $sideColoc)
                <a href="{{ route('colocations.show', $sideColoc) }}" class="sidebar-link">
                    <span class="w-6 h-6 rounded-md bg-green-100 text-green-700 text-xs font-bold flex items-center justify-center flex-shrink-0">
                        {{ strtoupper(substr($sideColoc->name, 0, 1)) }}
                    </span>
                    <span class="truncate">{{ $sideColoc->name }}</span>
                    @if($sideColoc->status === 'active')
                        <span class="ml-auto w-2 h-2 rounded-full bg-green-400 flex-shrink-0"></span>
                    @endif
                </a>
            @empty
                <div class="px-2 py-3 text-xs text-gray-400 italic">No active colocation</div>
            @endforelse

            <div class="mt-4 mb-1">
                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-2 mb-1">Account</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left text-red-500 hover:bg-red-50 hover:text-red-600">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </nav>

        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center gap-3 px-2">
            <div class="w-9 h-9 rounded-full bg-green-600 flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </aside>

    <!-- ══════════════════════════════════
         MAIN CONTENT
     ══════════════════════════════════ -->
    <main class="flex-1 p-6 lg:p-10 overflow-auto">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-400 mb-6 fade-up">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-600 font-medium">My Profile</span>
        </div>

        <!-- Page header -->
        <div class="mb-8 fade-up delay-1">

            <!-- Profile hero -->
            <div class="section-card flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white text-3xl font-bold shadow-lg flex-shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="text-center sm:text-left">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                    <div class="flex items-center justify-center sm:justify-start gap-3 mt-3">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full
                            {{ ($user->reputation_score ?? 0) >= 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-600' }}">
                            ❤️ Reputation: {{ ($user->reputation_score ?? 0) >= 0 ? '+' : '' }}{{ $user->reputation_score ?? 0 }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full bg-blue-50 text-blue-700">
                            🏠 {{ $sidebarColocations->count() }} active colocation(s)
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">

            <!-- ── UPDATE PROFILE INFO ── -->
            <div class="section-card fade-up delay-1">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900">Profile Information</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Update your name and email address.</p>
                    </div>
                </div>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="form-label">Full Name</label>
                        <input id="name" name="name" type="text"
                               class="form-input"
                               value="{{ old('name', $user->name) }}"
                               required autofocus autocomplete="name"/>
                        @if($errors->get('name'))
                            <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" name="email" type="email"
                               class="form-input"
                               value="{{ old('email', $user->email) }}"
                               required autocomplete="username"/>
                        @if($errors->get('email'))
                            <p class="mt-1.5 text-xs text-red-500">{{ $errors->first('email') }}</p>
                        @endif

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-3 flex items-center gap-3 bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-3">
                                <svg class="w-4 h-4 text-yellow-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-yellow-700">
                                    Your email is unverified.
                                    <button form="send-verification" class="underline font-semibold hover:text-yellow-900 ml-1">
                                        Resend verification email
                                    </button>
                                </p>
                            </div>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-xs text-green-600 font-medium">
                                    ✅ Verification link sent to your email.
                                </p>
                            @endif
                        @endif
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="btn-primary">
                            Save Changes
                        </button>
                        @if (session('status') === 'profile-updated')
                            <span class="text-sm text-green-600 font-medium flex items-center gap-1"
                                  x-data="{ show: true }" x-show="show" x-transition
                                  x-init="setTimeout(() => show = false, 2000)">
                                ✅ Saved successfully
                            </span>
                        @endif
                    </div>
                </form>
            </div>

            <!-- ── UPDATE PASSWORD ── -->
            <div class="section-card fade-up delay-2">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900">Update Password</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Use a long, random password to stay secure.</p>
                    </div>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <div>
                        <label for="update_password_current_password" class="form-label">Current Password</label>
                        <input id="update_password_current_password" name="current_password"
                               type="password" class="form-input"
                               autocomplete="current-password" placeholder="••••••••"/>
                        @if($errors->updatePassword->get('current_password'))
                            <p class="mt-1.5 text-xs text-red-500">{{ $errors->updatePassword->first('current_password') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="update_password_password" class="form-label">New Password</label>
                        <input id="update_password_password" name="password"
                               type="password" class="form-input"
                               autocomplete="new-password" placeholder="••••••••"/>
                        @if($errors->updatePassword->get('password'))
                            <p class="mt-1.5 text-xs text-red-500">{{ $errors->updatePassword->first('password') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="update_password_password_confirmation" class="form-label">Confirm New Password</label>
                        <input id="update_password_password_confirmation" name="password_confirmation"
                               type="password" class="form-input"
                               autocomplete="new-password" placeholder="••••••••"/>
                        @if($errors->updatePassword->get('password_confirmation'))
                            <p class="mt-1.5 text-xs text-red-500">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="btn-primary">
                            Update Password
                        </button>
                        @if (session('status') === 'password-updated')
                            <span class="text-sm text-green-600 font-medium"
                                  x-data="{ show: true }" x-show="show" x-transition
                                  x-init="setTimeout(() => show = false, 2000)">
                                ✅ Password updated
                            </span>
                        @endif
                    </div>
                </form>
            </div>

            <!-- ── DELETE ACCOUNT ── -->
            <div class="section-card border-red-100 fade-up delay-3">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-50">
                    <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900">Delete Account</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Permanently delete your account and all data.</p>
                    </div>
                </div>

                <p class="text-sm text-gray-500 mb-5">
                    Once your account is deleted, all of its resources and data will be permanently removed.
                    Please download any data you wish to keep before proceeding.
                </p>

                <button
                    class="btn-danger"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete My Account
                </button>

                <!-- Delete Modal -->
                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Delete your account?</h2>
                                <p class="text-sm text-gray-500">This action cannot be undone.</p>
                            </div>
                        </div>

                        <p class="text-sm text-gray-500 mb-6">
                            All your data including colocations, expenses, and memberships will be permanently deleted.
                            Please enter your password to confirm.
                        </p>

                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="mb-6">
                                <label for="delete_password" class="form-label">Password</label>
                                <input id="delete_password" name="password"
                                       type="password" class="form-input"
                                       placeholder="Enter your password to confirm"/>
                                @if($errors->userDeletion->get('password'))
                                    <p class="mt-1.5 text-xs text-red-500">{{ $errors->userDeletion->first('password') }}</p>
                                @endif
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" class="btn-secondary" x-on:click="$dispatch('close')">
                                    Cancel
                                </button>
                                <button type="submit" class="btn-danger">
                                    Yes, Delete My Account
                                </button>
                            </div>
                        </form>
                    </div>
                </x-modal>
            </div>

        </div>
    </main>
</div>

</x-app-layout>