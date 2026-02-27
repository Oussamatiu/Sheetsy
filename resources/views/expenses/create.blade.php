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
        appearance: none;
    }
    .form-input:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    }
    .form-input::placeholder { color: #9ca3af; }
    .form-input.error { border-color: #ef4444; }

    .form-label {
        display: block; font-size: 0.8rem;
        font-weight: 600; color: #374151;
        margin-bottom: 6px; letter-spacing: 0.01em;
    }

    .input-icon-wrap { position: relative; }
    .input-icon-wrap .icon {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        color: #9ca3af; pointer-events: none;
        display: flex; align-items: center;
    }
    .input-icon-wrap .form-input { padding-left: 42px; }

    .member-option {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px; border-radius: 10px; cursor: pointer;
        border: 1.5px solid #e5e7eb; background: white;
        transition: all 0.15s; width: 100%;
    }
    .member-option:hover { border-color: #86efac; background: #f0fdf4; }
    .member-option.selected { border-color: #16a34a; background: #f0fdf4; }
    .member-option input[type="radio"] { display: none; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .fade-up { animation: fadeUp 0.35s ease both; }
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

            <a href="{{ route('profile.edit') }}" class="sidebar-link">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                My Profile
            </a>

            <div class="mt-4 mb-1">
                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-2 mb-1">My Colocations</p>
            </div>

            @forelse($sidebarColocations as $sideColoc)
                <a href="{{ route('colocations.show', $sideColoc) }}"
                   class="sidebar-link {{ $sideColoc->id === $colocation->id ? 'active' : '' }}">
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
            <a href="{{ route('colocations.show', $colocation) }}" class="hover:text-green-600 transition">
                {{ $colocation->name }}
            </a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-600 font-medium">Add Expense</span>
        </div>

        <!-- Page header -->
        <div class="mb-8 fade-up delay-1">
            <h1 class="text-2xl font-bold text-gray-900">Add a new Expense 💸</h1>
            <p class="text-gray-500 text-sm mt-1">
                Adding to <span class="font-semibold text-gray-700">{{ $colocation->name }}</span> —
                split equally between {{ $activeMembers->count() }} member(s).
            </p>
        </div>

        <!-- Errors -->
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

                    <form method="POST" action="{{ route('expenses.store', $colocation) }}">
                        @csrf

                        <!-- Title -->
                        <div class="mb-5">
                            <label for="title" class="form-label">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <div class="input-icon-wrap">
                                <span class="icon">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="e.g. Groceries, Electricity bill, Netflix…"
                                    required
                                    class="form-input {{ $errors->has('title') ? 'error' : '' }}"
                                />
                            </div>
                            @error('title')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">

                            
                            <div>
                                <label for="amount" class="form-label">
                                    Amount (MAD) <span class="text-red-500">*</span>
                                </label>
                                <div class="input-icon-wrap">
                                    <span class="icon font-semibold text-gray-400 text-sm">MAD</span>
                                    <input
                                        type="number"
                                        id="amount"
                                        name="amount"
                                        value="{{ old('amount') }}"
                                        placeholder="0.00"
                                        min="0.01"
                                        step="0.01"
                                        required
                                        oninput="updateSplitPreview()"
                                        class="form-input pl-14 {{ $errors->has('amount') ? 'error' : '' }}"
                                    />
                                </div>
                                @error('amount')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div>
                                <label for="date" class="form-label">
                                    Date <span class="text-red-500">*</span>
                                </label>
                                <div class="input-icon-wrap">
                                    <span class="icon">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </span>
                                    <input
                                        type="date"
                                        id="date"
                                        name="expense_date"
                                        value="{{ old('expense_date', date('Y-m-d')) }}"
                                        required
                                        class="form-input {{ $errors->has('expense_date') ? 'error' : '' }}"
                                    />
                                </div>
                                @error('expense_date')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="mb-5">
                            <label for="category_id" class="form-label">
                                Category <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <div class="input-icon-wrap">
                                <span class="icon">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </span>
                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-input {{ $errors->has('category_id') ? 'error' : '' }}"
                                >
                                    <option value="">— No category —</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Paid By -->
                        <div class="mb-8">
                            <label class="form-label">
                                Paid By <span class="text-red-500">*</span>
                            </label>
                            <p class="text-xs text-gray-400 mb-3">Who paid for this expense?</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($activeMembers as $membership)
                                    <label class="member-option {{ old('paid_by', auth()->id()) == $membership->user->id ? 'selected' : '' }}"
                                           onclick="selectMember(this)">
                                        <input
                                            type="radio"
                                            name="paid_by"
                                            value="{{ $membership->user->id }}"
                                            {{ old('paid_by', auth()->id()) == $membership->user->id ? 'checked' : '' }}
                                        />
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs text-white flex-shrink-0
                                            {{ $membership->user->id === auth()->id() ? 'bg-green-600' : 'bg-gray-400' }}">
                                            {{ strtoupper(substr($membership->user->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 truncate">
                                                {{ $membership->user->name }}
                                                @if($membership->user->id === auth()->id())
                                                    <span class="text-xs text-green-600 font-normal">(you)</span>
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-400 truncate">{{ $membership->user->email }}</p>
                                        </div>
                                        <!-- Checkmark -->
                                        <svg class="w-4 h-4 text-green-600 ml-auto flex-shrink-0 {{ old('paid_by', auth()->id()) == $membership->user->id ? '' : 'hidden' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </label>
                                @endforeach
                            </div>

                            @error('paid_by')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100 mb-6"></div>

                        <!-- Actions -->
                        <div class="flex items-center gap-3">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 active:scale-[0.98] text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Save Expense
                            </button>
                            <a href="{{ route('colocations.show', $colocation) }}"
                               class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm px-6 py-3 rounded-xl transition">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- ── RIGHT COLUMN ── -->
            <div class="flex flex-col gap-5 fade-up delay-3">

                <!-- Split preview -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Split Preview</p>

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500">Total amount</span>
                        <span class="font-bold text-gray-900" id="previewTotal">0.00 MAD</span>
                    </div>
                    <div class="flex items-center justify-between mb-5 pb-4 border-b border-gray-100">
                        <span class="text-sm text-gray-500">Split between</span>
                        <span class="font-semibold text-gray-700">{{ $activeMembers->count() }} member(s)</span>
                    </div>

                    <p class="text-xs font-semibold text-gray-400 mb-3">Each person owes</p>
                    <div class="space-y-2">
                        @foreach($activeMembers as $membership)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white
                                        {{ $membership->user->id === auth()->id() ? 'bg-green-600' : 'bg-gray-300' }}">
                                        {{ strtoupper(substr($membership->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm text-gray-600">{{ explode(' ', $membership->user->name)[0] }}</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-800 split-amount">0.00 MAD</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-green-50 border border-green-100 rounded-2xl p-5">
                    <p class="text-sm font-semibold text-green-800 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                        How it works
                    </p>
                    <ul class="space-y-2.5">
                        @foreach([
                            'The expense is split equally among all active members.',
                            'The person who paid gets credited automatically.',
                            'Balances update instantly after saving.',
                            'You can filter expenses by month on the colocation page.',
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

                <!-- Recent expenses -->
                @if($recentExpenses->count() > 0)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Recent Expenses</p>
                        <div class="space-y-3">
                            @foreach($recentExpenses as $recent)
                                <div class="flex items-center justify-between">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-700 truncate">{{ $recent->title }}</p>
                                        <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($recent->date)->format('d M') }} · {{ $recent->paidBy->name }}</p>
                                    </div>
                                    <span class="text-sm font-bold text-green-700 ml-3 flex-shrink-0">
                                        {{ number_format($recent->amount, 2) }} MAD
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>
</div>

<script>
    const memberCount = {{ $activeMembers->count() }};

    function updateSplitPreview() {
        const amount = parseFloat(document.getElementById('amount').value) || 0;
        const perPerson = memberCount > 0 ? amount / memberCount : 0;

        document.getElementById('previewTotal').textContent = amount.toFixed(2) + ' MAD';
        document.querySelectorAll('.split-amount').forEach(el => {
            el.textContent = perPerson.toFixed(2) + ' MAD';
        });
    }

    function selectMember(label) {
        // Remove selected from all
        document.querySelectorAll('.member-option').forEach(el => {
            el.classList.remove('selected');
            el.querySelector('svg:last-child').classList.add('hidden');
        });
        // Select clicked
        label.classList.add('selected');
        label.querySelector('input[type="radio"]').checked = true;
        label.querySelector('svg:last-child').classList.remove('hidden');
    }
</script>

</x-app-layout>