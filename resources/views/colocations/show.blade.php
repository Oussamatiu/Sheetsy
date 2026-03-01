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

    .badge {
        display: inline-flex; align-items: center;
        padding: 3px 10px; border-radius: 999px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.03em;
    }
    .badge-green  { background: #dcfce7; color: #15803d; }
    .badge-gray   { background: #f3f4f6; color: #6b7280; }
    .badge-red    { background: #fee2e2; color: #dc2626; }
    .badge-owner  { background: #fef9c3; color: #92400e; }
    .badge-blue   { background: #dbeafe; color: #1d4ed8; }

    .form-input {
        width: 100%; padding: 10px 14px;
        border: 1.5px solid #e5e7eb; border-radius: 10px;
        font-size: 0.875rem; color: #111827; background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s; outline: none;
    }
    .form-input:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.1);
    }
    .form-input::placeholder { color: #9ca3af; }

    .tab-btn {
        padding: 8px 18px; border-radius: 8px;
        font-size: 0.8rem; font-weight: 600; color: #6b7280;
        cursor: pointer; transition: all 0.15s; border: none; background: transparent;
    }
    .tab-btn.active { background: white; color: #15803d; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
    .tab-btn:hover:not(.active) { color: #374151; }

    .tab-panel { display: none; }
    .tab-panel.active { display: block; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .fade-up { animation: fadeUp 0.3s ease both; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.10s; }
    .delay-3 { animation-delay: 0.15s; }

    .member-row:hover { background: #f9fafb; }
    .danger-btn {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 14px; border-radius: 8px; font-size: 0.8rem; font-weight: 600;
        background: #fff0f0; color: #dc2626; border: 1px solid #fecaca;
        cursor: pointer; transition: all 0.15s;
    }
    .danger-btn:hover { background: #fee2e2; }
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

        <!-- Flash messages -->
        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium fade-up">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm font-medium fade-up">
                <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-400 mb-6 fade-up">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-600 font-medium">{{ $colocation->name }}</span>
        </div>

        <!-- ── HERO HEADER ── -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6 fade-up delay-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center text-white text-2xl font-bold shadow-md flex-shrink-0">
                        {{ strtoupper(substr($colocation->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="text-xl font-bold text-gray-900">{{ $colocation->name }}</h1>
                            @if($colocation->status === 'active')
                                <span class="badge badge-green">● Active</span>
                            @else
                                <span class="badge badge-red">Cancelled</span>
                            @endif
                            @if($isOwner)
                                <span class="badge badge-owner">⭐ You are Owner</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-3 mt-1 text-xs text-gray-400 flex-wrap">
                            @if($colocation->address)
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $colocation->address }}
                                </span>
                            @endif
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $activeMembers->count() }} member(s)
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Created {{ $colocation->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="flex items-center gap-2 flex-wrap">
                    @if($colocation->status === 'active')
                        <a href="{{ route('expenses.create', $colocation) }}"
                           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Expense
                        </a>
                        <a href=""
                           class="inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                            </svg>
                            Balances
                        </a>

                        @if($isOwner)
                            <form method="POST" action="{{ route('colocations.destroy', $colocation) }}"
                                  onsubmit="return confirm('Are you sure you want to cancel this colocation? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="danger-btn">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                    Cancel Colocation
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('colocations.leave', $colocation) }}"
                                  onsubmit="return confirm('Are you sure you want to leave this colocation?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="danger-btn">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                                    </svg>
                                    Leave
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>

            @if($colocation->description)
                <p class="mt-4 text-sm text-gray-500 border-t border-gray-50 pt-4">
                    {{ $colocation->description }}
                </p>
            @endif
        </div>

        <!-- ── STAT MINI CARDS ── -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6 fade-up delay-2">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Expenses</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($totalExpenses, 2) }}
                    <span class="text-sm font-medium text-gray-400">MAD</span>
                </p>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">I Paid</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($myPaid, 2) }}
                    <span class="text-sm font-medium text-gray-400">MAD</span>
                </p>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">My Balance</p>
                <p class="text-2xl font-bold {{ $myBalance >= 0 ? 'text-green-600' : 'text-red-500' }}">
                    {{ $myBalance >= 0 ? '+' : '' }}{{ number_format($myBalance, 2) }}
                    <span class="text-sm font-medium {{ $myBalance >= 0 ? 'text-green-400' : 'text-red-300' }}">MAD</span>
                </p>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Members</p>
                <p class="text-2xl font-bold text-gray-900">{{ $activeMembers->count() }}</p>
            </div>
        </div>

        <!-- ── TABS ── -->
        <div class="fade-up delay-3">
            <div class="bg-gray-100 rounded-xl p-1 flex gap-1 mb-6 w-fit">
                <button class="tab-btn active" onclick="switchTab('members', this)">👥 Members</button>
                <button class="tab-btn" onclick="switchTab('expenses', this)">💸 Expenses</button>
                @if($isOwner)
                    <button class="tab-btn" onclick="switchTab('invitations', this)">✉️ Invitations</button>
                    <button class="tab-btn" onclick="switchTab('categories', this)">🏷️ Categories</button>
                @endif
            </div>

            <!-- ── TAB: MEMBERS ── -->
            <div id="tab-members" class="tab-panel active">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Members</h2>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $activeMembers->count() }} active member(s)</p>
                    </div>
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                                <th class="px-6 py-3 font-semibold">Member</th>
                                <th class="px-6 py-3 font-semibold">Role</th>
                                <th class="px-6 py-3 font-semibold">Reputation</th>
                                <th class="px-6 py-3 font-semibold">Joined</th>
                                @if($isOwner)
                                    <th class="px-6 py-3 font-semibold">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($activeMembers as $membership)
                                <tr class="member-row transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm text-white flex-shrink-0
                                                {{ $membership->user->id === auth()->id() ? 'bg-green-600' : 'bg-gray-400' }}">
                                                {{ strtoupper(substr($membership->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $membership->user->name }}
                                                    @if($membership->user->id === auth()->id())
                                                        <span class="text-xs text-green-600 font-normal">(you)</span>
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-400">{{ $membership->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="badge {{ $membership->role === 'owner' ? 'badge-owner' : 'badge-gray' }}">
                                            {{ $membership->role === 'owner' ? '⭐ Owner' : 'Member' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold {{ ($membership->user->reputation_score ?? 0) >= 0 ? 'text-green-600' : 'text-red-500' }}">
                                            {{ ($membership->user->reputation_score ?? 0) >= 0 ? '+' : '' }}{{ $membership->user->reputation_score ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-400">
                                        {{ $membership->created_at->format('d M Y') }}
                                    </td>
                                    @if($isOwner)
                                        <td class="px-6 py-4">
                                            @if($membership->role !== 'owner')
                                                <form method="POST"
                                                      action=""
                                                      onsubmit="return confirm('Remove {{ $membership->user->name }} from this colocation?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="danger-btn py-1.5 px-3 text-xs">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"/>
                                                        </svg>
                                                        Remove
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-300">—</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">No members found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ── TAB: EXPENSES ── -->
            <div id="tab-expenses" class="tab-panel">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <h2 class="font-semibold text-gray-900">Expenses</h2>
                            <p class="text-xs text-gray-400 mt-0.5">All shared expenses for this colocation</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <form method="GET" action="{{ route('colocations.show', $colocation) }}">
                                <select name="month" onchange="this.form.submit()"
                                        class="text-xs border border-gray-200 rounded-lg px-3 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-green-300 bg-white">
                                    <option value="">All months</option>
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                            @if($colocation->status === 'active')
                                <a href="{{ route('expenses.create', $colocation) }}"
                                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-green-600 bg-green-50 hover:bg-green-100 px-4 py-2 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Add
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                                    <th class="px-6 py-3 font-semibold">Title</th>
                                    <th class="px-6 py-3 font-semibold">Category</th>
                                    <th class="px-6 py-3 font-semibold">Amount</th>
                                    <th class="px-6 py-3 font-semibold">Paid By</th>
                                    <th class="px-6 py-3 font-semibold">Date</th>
                                    @if($isOwner)
                                        <th class="px-6 py-3 font-semibold">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($expenses as $expense)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-800">{{ $expense->title }}</td>
                                        <td class="px-6 py-4">
                                            @if($expense->category)
                                                <span class="badge badge-blue">{{ $expense->category->name }}</span>
                                            @else
                                                <span class="text-gray-300 text-xs">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-bold text-green-700">
                                            {{ number_format($expense->amount, 2) }} MAD
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                                                    {{ strtoupper(substr($expense->payer->name, 0, 1)) }}
                                                </div>
                                                <span class="text-gray-600 text-xs">{{ $expense->payer->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}
                                        </td>
                                        @if($isOwner)
                                            <td class="px-6 py-4">
                                                <form method="POST" action="{{ route('expenses.destroy', $expense) }}"
                                                      onsubmit="return confirm('Delete this expense?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-2xl">💸</div>
                                                <p class="text-gray-500 font-medium">No expenses yet</p>
                                                <p class="text-gray-400 text-xs">Add the first expense for this colocation</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ── TAB: INVITATIONS (owner only) ── -->
            @if($isOwner)
                <div id="tab-invitations" class="tab-panel">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                            <h2 class="font-semibold text-gray-900 mb-1">Invite a Member</h2>
                            <p class="text-xs text-gray-400 mb-5">Send an invitation link to someone's email address.</p>

                            @if($errors->has('email'))
                                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('invitations.send', $colocation->id) }}">
                                @csrf
                                <label class="block text-xs font-semibold text-gray-500 mb-2">Email Address</label>
                                <div class="flex gap-2">
                                    <div class="relative flex-1">
                                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </span>
                                        <input type="email" name="email" placeholder="friend@example.com"
                                               value="{{ old('email') }}"
                                               class="form-input pl-10" required />
                                    </div>
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                            <h2 class="font-semibold text-gray-900 mb-1">Pending Invitations</h2>
                            <p class="text-xs text-gray-400 mb-5">Invitations that haven't been accepted yet.</p>

                            @forelse($pendingInvitations as $invitation)
                                <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 text-xs font-bold">
                                            {{ strtoupper(substr($invitation->email, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">{{ $invitation->email }}</p>
                                            <p class="text-xs text-gray-400">Sent {{ $invitation->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <span class="badge badge-gray">Pending</span>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <p class="text-gray-400 text-sm">No pending invitations</p>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            @endif
            @if($isOwner)
    <div id="tab-categories" class="tab-panel">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Add Category Form -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-semibold text-gray-900 mb-1">Add a Category</h2>
                <p class="text-xs text-gray-400 mb-5">Create a new category to organize your expenses.</p>

                @if($errors->has('name'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                        {{ $errors->first('name') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                    <label class="block text-xs font-semibold text-gray-500 mb-2">Category Name</label>
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </span>
                            <input type="text" name="name"
                                   placeholder="e.g. Groceries, Electricity, Netflix…"
                                   value="{{ old('name') }}"
                                   class="form-input pl-10" required />
                        </div>
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories List -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="font-semibold text-gray-900 mb-1">Existing Categories</h2>
                <p class="text-xs text-gray-400 mb-5">Categories available for this colocation.</p>

                @forelse($categories as $category)
                    <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ $category->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('categories.destroy', $category) }}"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-xl mx-auto mb-3">🏷️</div>
                        <p class="text-gray-400 text-sm">No categories yet</p>
                        <p class="text-gray-300 text-xs mt-1">Add your first category on the left</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endif

        </div>
    </main>
</div>

<script>
    function switchTab(tab, btn) {
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        btn.classList.add('active');
    }

    @if(request('month'))
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.querySelectorAll('.tab-btn')[1];
            switchTab('expenses', btn);
        });
    @endif
</script>

</x-app-layout>