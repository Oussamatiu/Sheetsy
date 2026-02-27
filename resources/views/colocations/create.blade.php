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
        width: 100%;
        padding: 11px 16px;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.875rem;
        color: #111827;
        background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s;
        outline: none;
    }
    .form-input:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    }
    .form-input::placeholder { color: #9ca3af; }
    .form-input.error { border-color: #ef4444; }

    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        letter-spacing: 0.01em;
    }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(14px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .fade-up { animation: fadeUp 0.35s ease both; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.10s; }
    .delay-3 { animation-delay: 0.15s; }

    .preview-avatar {
        width: 64px; height: 64px;
        border-radius: 18px;
        background: linear-gradient(135deg, #16a34a, #4ade80);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.75rem; font-weight: 700; color: white;
        transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(22,163,74,0.3);
    }

    .tip-card {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 14px;
        padding: 16px 18px;
    }
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

            <a href="{{ route('profile.edit') }}" class="sidebar-link">
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
                    ->with('colocation')
                    ->whereNull('left_at')
                    ->get()
                    ->pluck('colocation')
                    ->filter();
            @endphp

            @forelse($sidebarColocations as $coloc)
                <a href="{{ route('colocations.show', $coloc) }}" class="sidebar-link">
                    <span class="w-6 h-6 rounded-md bg-green-100 text-green-700 text-xs font-bold flex items-center justify-center flex-shrink-0">
                        {{ strtoupper(substr($coloc->name, 0, 1)) }}
                    </span>
                    <span class="truncate">{{ $coloc->name }}</span>
                    @if($coloc->status === 'active')
                        <span class="ml-auto w-2 h-2 rounded-full bg-green-400 flex-shrink-0"></span>
                    @endif
                </a>
            @empty
                <div class="px-2 py-3 text-xs text-gray-400 italic">No active colocation</div>
            @endforelse

            <a href="{{ route('colocations.create') }}"
               class="sidebar-link active mt-1 border border-dashed border-green-300">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Create Colocation
            </a>

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
            <span class="text-gray-600 font-medium">Create Colocation</span>
        </div>

        <!-- Page header -->
        <div class="mb-8 fade-up delay-1">
            <h1 class="text-2xl font-bold text-gray-900">Create a new Colocation 🏠</h1>
            <p class="text-gray-500 text-sm mt-1">Set up your shared living space and start managing expenses together.</p>
        </div>

        <!-- Error messages -->
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl px-5 py-4 fade-up">
                <p class="text-sm font-semibold text-red-700 mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-sm text-red-600">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- ── FORM ── -->
            <div class="lg:col-span-2 fade-up delay-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">

                    <form method="POST" action="{{ route('colocations.store') }}" id="createForm">
                        @csrf

                        <!-- Colocation Name -->
                        <div class="mb-6">
                            <label for="name" class="form-label">
                                Colocation Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3.5 flex items-center text-gray-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="e.g. Sunset Apartment, The Green House…"
                                    maxlength="80"
                                    required
                                    oninput="updatePreview(this.value)"
                                    class="form-input pl-10 {{ $errors->has('name') ? 'error' : '' }}"
                                />
                            </div>
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-400">Choose a name that represents your living space.</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="form-label">
                                Description <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                placeholder="Describe your colocation, house rules, or anything relevant…"
                                class="form-input resize-none {{ $errors->has('description') ? 'error' : '' }}"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Max members -->
                        <div class="mb-8">
                            <label for="max_members" class="form-label">
                                Max Members <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <div class="flex items-center gap-3">
                                @foreach([2, 3, 4, 5, 6, 8] as $n)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="max_members" value="{{ $n }}"
                                               class="sr-only peer"
                                               {{ old('max_members', 4) == $n ? 'checked' : '' }}>
                                        <span class="flex items-center justify-center w-11 h-11 rounded-xl border-2 border-gray-200 text-sm font-semibold text-gray-500
                                                     peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700
                                                     hover:border-green-300 transition">
                                            {{ $n }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-400">Maximum number of members including yourself.</p>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100 mb-6"></div>

                        <!-- Owner info note -->
                        <div class="flex items-start gap-3 bg-blue-50 border border-blue-100 rounded-xl p-4 mb-8">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-blue-800">You will become the Owner</p>
                                <p class="text-xs text-blue-600 mt-0.5">As the owner, you can invite members, manage expenses, and administer the colocation.</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-3">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 active:scale-[0.98] text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Create Colocation
                            </button>
                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm px-6 py-3 rounded-xl transition">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- ── RIGHT COLUMN ── -->
            <div class="flex flex-col gap-5 fade-up delay-3">

                <!-- Live Preview Card -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Live Preview</p>

                    <div class="flex items-center gap-4 mb-4">
                        <div class="preview-avatar" id="previewAvatar">🏠</div>
                        <div>
                            <p class="font-bold text-gray-900 text-lg leading-tight" id="previewName">
                                Your Colocation
                            </p>
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-green-700 bg-green-50 px-2.5 py-1 rounded-full mt-1">
                                ● Active
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Owner: <strong class="text-gray-700">{{ auth()->user()->name }}</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>1 member (just you)</span>
                        </div>
                    </div>
                </div>

                <!-- Tips card -->
                <div class="tip-card">
                    <p class="text-sm font-semibold text-green-800 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                        Quick Tips
                    </p>
                    <ul class="space-y-2.5">
                        @foreach([
                            'You can only be in one active colocation at a time.',
                            'After creation, invite members via email link.',
                            'As owner, you can create categorys of expenses, and manage them.',
                            'As owner, you manage expenses and categories.',
                            'Members can leave anytime, but owners must transfer ownership first.',
                            'Leaving or cancelling affects your reputation score.',
                        ] as $tip)
                        <li class="flex items-start gap-2 text-xs text-green-700">
                            <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $tip }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- What happens next -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">What happens next?</p>
                    <ol class="space-y-4">
                        @foreach([
                            ['icon' => '✅', 'title' => 'Colocation created', 'desc' => 'You become the owner automatically.'],
                            ['icon' => '✉️', 'title' => 'Invite members', 'desc' => 'Send email invitations with a unique link.'],
                            ['icon' => '💸', 'title' => 'Add expenses', 'desc' => 'Track shared costs and who paid.'],
                            ['icon' => '⚖️', 'title' => 'Settle up', 'desc' => 'View balances and mark payments done.'],
                        ] as $i => $step)
                        <li class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-gray-50 flex items-center justify-center text-sm flex-shrink-0">
                                {{ $step['icon'] }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $step['title'] }}</p>
                                <p class="text-xs text-gray-400">{{ $step['desc'] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    function updatePreview(val) {
        const nameEl = document.getElementById('previewName');
        const avatarEl = document.getElementById('previewAvatar');
        if (val.trim() === '') {
            nameEl.textContent = 'Your Colocation';
            avatarEl.textContent = '🏠';
        } else {
            nameEl.textContent = val;
            avatarEl.textContent = val.charAt(0).toUpperCase();
            avatarEl.style.fontSize = '1.75rem';
        }
    }
</script>

</x-app-layout>