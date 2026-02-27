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

    .stat-card {
        background: white; border-radius: 16px;
        padding: 24px; border: 1px solid #f0f0f0;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }

    .coloc-card {
        background: white; border-radius: 14px;
        border: 1px solid #e5e7eb;
        padding: 18px 20px;
        display: flex; align-items: center; justify-content: space-between;
        transition: box-shadow 0.2s;
    }
    .coloc-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); }

    .badge {
        display: inline-flex; align-items: center;
        padding: 2px 10px; border-radius: 999px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.03em;
    }
    .badge-green  { background: #dcfce7; color: #15803d; }
    .badge-gray   { background: #f3f4f6; color: #6b7280; }
    .badge-red    { background: #fee2e2; color: #dc2626; }
    .badge-owner  { background: #fef9c3; color: #92400e; }

    @keyframes fadeUp {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .fade-up { animation: fadeUp 0.35s ease both; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.10s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.20s; }
    .delay-5 { animation-delay: 0.25s; }
</style>

<div class="flex min-h-screen bg-[#F8FAF9]">

    <!-- ════════════════════════════════════════════
         SIDEBAR
    ════════════════════════════════════════════ -->
    <aside class="hidden md:flex flex-col w-64 bg-white border-r border-gray-100 py-6 px-4 min-h-screen sticky top-0">

        <!-- Logo -->
        <div class="flex items-center gap-2 px-2 mb-8">
            <div class="w-8 h-8 rounded-lg bg-green-600 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/>
                </svg>
            </div>
            <span class="font-bold text-gray-800 text-lg tracking-tight">Sheetsy</span>
        </div>

        <!-- Nav -->
        <nav class="flex flex-col gap-1 flex-1">
            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-2 mb-1">General</p>

            <a href="{{ route('dashboard') }}" class="sidebar-link active">
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

            <!-- Colocations section -->
            <div class="mt-4 mb-1">
                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest px-2 mb-1">My Colocations</p>
            </div>

            @php
                $colocations = auth()->user()->memberships()
                    ->with('colocation')
                    ->whereNull('left_at')
                    ->get()
                    ->pluck('colocation')
                    ->filter();
            @endphp

            @forelse($colocations as $coloc)
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

            <!-- Create colocation shortcut -->
            @if(auth()->user()->memberships()->whereNull('left_at')->doesntExist())
                <a href="{{ route('colocations.create') }}"
                   class="sidebar-link mt-1 border border-dashed border-green-300 text-green-600 hover:bg-green-50">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Colocation
                </a>
            @endif

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

        <!-- User card at bottom -->
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

    <!-- ════════════════════════════════════════════
         MAIN CONTENT
    ════════════════════════════════════════════ -->
    <main class="flex-1 p-6 lg:p-10 overflow-auto">

        <!-- Flash messages -->
        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm font-medium">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Page header -->
        <div class="flex items-center justify-between mb-8 fade-up">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Welcome back, {{ explode(' ', auth()->user()->name)[0] }} 👋
                </h1>
                <p class="text-gray-500 text-sm mt-1">Here's an overview of your colocation activity.</p>
            </div>

            @if(auth()->user()->memberships()->whereNull('left_at')->doesntExist())
                <a href="{{ route('colocations.create') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Colocation
                </a>
            @endif
        </div>

        <!-- ── STAT CARDS ── -->
        @php
            $user = auth()->user();
            $allMemberships = $user->memberships()->with('colocation')->get();
            $totalColocations = $allMemberships->count();
            $activeColocation = $allMemberships->whereNull('left_at')->first()?->colocation;
            $ownedCount = $allMemberships->where('role', 'owner')->count();
            $reputation = $user->reputation_score ?? 0;
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-10">

            <!-- Total colocations -->
            <div class="stat-card fade-up delay-1">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Colocations</span>
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ $totalColocations }}</p>
                <p class="text-xs text-gray-400 mt-1">colocations joined total</p>
            </div>

            <!-- Active colocation -->
            <div class="stat-card fade-up delay-2">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Current Status</span>
                    <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                @if($activeColocation)
                    <p class="text-lg font-bold text-gray-900 truncate">{{ $activeColocation->name }}</p>
                    <span class="badge badge-green mt-1">● Active</span>
                @else
                    <p class="text-lg font-bold text-gray-400">None</p>
                    <span class="badge badge-gray mt-1">No active colocation</span>
                @endif
            </div>

            <!-- As owner -->
            <div class="stat-card fade-up delay-3">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Times as Owner</span>
                    <div class="w-9 h-9 rounded-xl bg-yellow-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ $ownedCount }}</p>
                <p class="text-xs text-gray-400 mt-1">colocations as owner</p>
            </div>

            <!-- Reputation -->
            <div class="stat-card fade-up delay-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Reputation</span>
                    <div class="w-9 h-9 rounded-xl {{ $reputation >= 0 ? 'bg-green-50' : 'bg-red-50' }} flex items-center justify-center">
                        <svg class="w-5 h-5 {{ $reputation >= 0 ? 'text-green-500' : 'text-red-500' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold {{ $reputation >= 0 ? 'text-green-600' : 'text-red-500' }}">
                    {{ $reputation >= 0 ? '+' : '' }}{{ $reputation }}
                </p>
                <p class="text-xs text-gray-400 mt-1">
                    @if($reputation >= 3) Excellent financial behavior
                    @elseif($reputation >= 1) Good standing
                    @elseif($reputation == 0) Neutral
                    @else Poor standing — pay your debts
                    @endif
                </p>
            </div>
        </div>

        <!-- ── COLOCATION HISTORY TABLE ── -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm fade-up delay-5">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="font-semibold text-gray-900">Colocation History</h2>
                    <p class="text-xs text-gray-400 mt-0.5">All colocations you have been part of</p>
                </div>
                @if(auth()->user()->memberships()->whereNull('left_at')->doesntExist())
                    <a href="{{ route('colocations.create') }}"
                       class="inline-flex items-center gap-1.5 text-sm font-semibold text-green-600 hover:text-green-700 bg-green-50 hover:bg-green-100 px-4 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Colocation
                    </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                            <th class="px-6 py-3 font-semibold">Colocation</th>
                            <th class="px-6 py-3 font-semibold">Role</th>
                            <th class="px-6 py-3 font-semibold">Status</th>
                            <th class="px-6 py-3 font-semibold">Joined</th>
                            <th class="px-6 py-3 font-semibold">Left</th>
                            <th class="px-6 py-3 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($allMemberships as $membership)
                            @php $coloc = $membership->colocation; @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center text-green-700 font-bold text-sm">
                                            {{ strtoupper(substr($coloc->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $coloc->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $coloc->memberships()->count() }} member(s)</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="badge {{ $membership->role === 'owner' ? 'badge-owner' : 'badge-gray' }}">
                                        {{ ucfirst($membership->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($coloc->status === 'active' && is_null($membership->left_at))
                                        <span class="badge badge-green">● Active</span>
                                    @elseif($coloc->status === 'cancelled')
                                        <span class="badge badge-red">Cancelled</span>
                                    @else
                                        <span class="badge badge-gray">Left</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">
                                    {{ $membership->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs">
                                    {{ $membership->left_at ? \Carbon\Carbon::parse($membership->left_at)->format('d M Y') : '—' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($coloc->status === 'active' && is_null($membership->left_at))
                                        <a href="{{ route('colocations.show', $coloc) }}"
                                           class="inline-flex items-center gap-1 text-xs font-semibold text-green-600 hover:text-green-700 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded-lg transition">
                                            View
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-300">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">No colocations yet</p>
                                        <p class="text-gray-400 text-xs">Create your first colocation to get started</p>
                                        <a href="{{ route('colocations.create') }}"
                                           class="mt-2 inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Create a Colocation
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>
</x-app-layout>
