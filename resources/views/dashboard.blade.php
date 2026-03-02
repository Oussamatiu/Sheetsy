<x-app-layout>
<style>
    @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&family=playfair-display:700,900i&display=swap');
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --green:     #2D6A4F;
        --green-mid: #40916C;
        --green-lt:  #52B788;
        --mint:      #95D5B2;
        --cream:     #F8FAF9;
        --ink:       #0D1F17;
        --muted:     #5A7A6A;
        --line:      #D8EDE3;
        --white:     #FFFFFF;
    }

    body, * { font-family: 'Figtree', sans-serif; }

    .sh-layout { display: flex; min-height: 100vh; background: var(--cream); }

    /* SIDEBAR */
    .sh-sidebar {
        width: 252px; flex-shrink: 0;
        background: var(--white); border-right: 1px solid var(--line);
        display: flex; flex-direction: column;
        padding: 24px 16px;
        position: sticky; top: 0; height: 100vh; overflow-y: auto;
    }
    @media (max-width: 768px) { .sh-sidebar { display: none; } }

    .sh-logo { display: flex; align-items: center; gap: 9px; padding: 0 6px; margin-bottom: 32px; text-decoration: none; }
    .sh-logo-icon { width: 32px; height: 32px; border-radius: 9px; background: var(--green); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .sh-logo-text { font-size: 1.1rem; font-weight: 800; color: var(--ink); letter-spacing: -0.03em; }

    .sh-nav-label { font-size: 0.62rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.08em; padding: 0 8px; margin: 0 0 6px; }
    .sh-nav-section { margin-bottom: 20px; }

    .sh-nav-link {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 10px; border-radius: 10px;
        font-size: 0.85rem; font-weight: 500; color: var(--muted);
        text-decoration: none; transition: all 0.15s; white-space: nowrap;
        background: none; border: none; cursor: pointer; width: 100%; text-align: left;
    }
    .sh-nav-link svg { width: 17px; height: 17px; flex-shrink: 0; }
    .sh-nav-link:hover { background: #f0fdf4; color: var(--green-mid); }
    .sh-nav-link.active { background: #dcfce7; color: var(--green); font-weight: 700; }
    .sh-nav-link.dashed { border: 1.5px dashed var(--mint); color: var(--green-mid); margin-top: 6px; }
    .sh-nav-link.dashed:hover { background: #f0fdf4; }
    .sh-nav-link.danger { color: #ef4444; }
    .sh-nav-link.danger:hover { background: #fef2f2; color: #dc2626; }

    .coloc-initial { width: 22px; height: 22px; border-radius: 6px; background: #dcfce7; color: var(--green); font-size: 0.7rem; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .active-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--mint); margin-left: auto; flex-shrink: 0; }

    .sh-sidebar-footer { margin-top: auto; padding-top: 16px; border-top: 1px solid var(--line); display: flex; align-items: center; gap: 10px; padding-left: 4px; }
    .sh-avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--green); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; color: white; flex-shrink: 0; }
    .sh-avatar-name { font-size: 0.82rem; font-weight: 700; color: var(--ink); }
    .sh-avatar-email { font-size: 0.7rem; color: var(--muted); }

    /* MAIN */
    .sh-main { flex: 1; padding: 40px 48px; overflow: auto; min-width: 0; }
    @media (max-width: 1024px) { .sh-main { padding: 28px 24px; } }

    /* FLASH */
    .sh-flash { display: flex; align-items: center; gap: 10px; padding: 12px 16px; border-radius: 14px; font-size: 0.85rem; font-weight: 600; margin-bottom: 24px; }
    .sh-flash.success { background: #f0fdf4; border: 1px solid #bbf7d0; color: var(--green); }
    .sh-flash.error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }
    .sh-flash svg { width: 18px; height: 18px; flex-shrink: 0; }

    /* PAGE HEADER */
    .sh-page-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 32px; }
    .sh-page-greeting { font-family: 'Playfair Display', serif; font-size: 1.75rem; font-weight: 900; color: var(--ink); letter-spacing: -0.02em; margin-bottom: 4px; }
    .sh-page-sub { font-size: 0.875rem; color: var(--muted); }

    /* BUTTONS */
    .btn-primary { display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px; border-radius: 12px; background: var(--green); color: white; font-size: 0.875rem; font-weight: 700; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s; box-shadow: 0 3px 10px rgba(45,106,79,0.28); }
    .btn-primary:hover { background: #245740; transform: translateY(-1px); box-shadow: 0 5px 16px rgba(45,106,79,0.34); }
    .btn-primary svg { width: 15px; height: 15px; }

    .btn-ghost { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 10px; background: #f0fdf4; color: var(--green-mid); border: 1px solid #bbf7d0; font-size: 0.82rem; font-weight: 700; text-decoration: none; transition: all 0.15s; }
    .btn-ghost:hover { background: #dcfce7; }
    .btn-ghost svg { width: 14px; height: 14px; }

    /* STATS */
    .sh-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px; }
    @media (max-width: 1100px) { .sh-stats { grid-template-columns: repeat(2, 1fr); } }

    .sh-stat { background: var(--white); border: 1px solid var(--line); border-radius: 18px; padding: 22px 24px; box-shadow: 0 2px 12px rgba(45,106,79,0.04); transition: transform 0.18s, box-shadow 0.18s; }
    .sh-stat:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(45,106,79,0.09); }
    .sh-stat-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }
    .sh-stat-label { font-size: 0.65rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; }
    .sh-stat-icon { width: 34px; height: 34px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
    .sh-stat-icon svg { width: 17px; height: 17px; }
    .sh-stat-icon.blue  { background: #eff6ff; } .sh-stat-icon.blue svg  { color: #3b82f6; }
    .sh-stat-icon.green { background: #f0fdf4; } .sh-stat-icon.green svg { color: var(--green-mid); }
    .sh-stat-icon.amber { background: #fefce8; } .sh-stat-icon.amber svg { color: #d97706; }
    .sh-stat-icon.red   { background: #fef2f2; } .sh-stat-icon.red svg   { color: #ef4444; }
    .sh-stat-value { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 900; color: var(--ink); letter-spacing: -0.02em; line-height: 1; margin-bottom: 4px; }
    .sh-stat-value.positive { color: var(--green); }
    .sh-stat-value.negative { color: #dc2626; }
    .sh-stat-hint { font-size: 0.75rem; color: var(--muted); }

    /* BADGES */
    .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 999px; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.02em; }
    .badge-green { background: #dcfce7; color: var(--green); }
    .badge-amber { background: #fef9c3; color: #92400e; }
    .badge-gray  { background: #f3f4f6; color: #6b7280; }
    .badge-red   { background: #fee2e2; color: #dc2626; }

    /* CARD */
    .sh-card { background: var(--white); border: 1px solid var(--line); border-radius: 20px; overflow: hidden; box-shadow: 0 2px 12px rgba(45,106,79,0.04); }
    .sh-card-header { padding: 20px 28px; border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .sh-card-title { font-size: 0.95rem; font-weight: 700; color: var(--ink); }
    .sh-card-sub { font-size: 0.75rem; color: var(--muted); margin-top: 2px; }

    /* TABLE */
    .sh-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .sh-table thead tr { border-bottom: 1px solid var(--line); }
    .sh-table th { padding: 10px 20px; text-align: left; font-size: 0.67rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; }
    .sh-table tbody tr { border-bottom: 1px solid #f3f8f5; transition: background 0.12s; }
    .sh-table tbody tr:last-child { border-bottom: none; }
    .sh-table tbody tr:hover { background: #fafcfa; }
    .sh-table td { padding: 14px 20px; color: var(--ink); vertical-align: middle; }

    .coloc-avatar { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, var(--green-mid), var(--green)); display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 0.9rem; font-weight: 900; color: white; flex-shrink: 0; }

    /* EMPTY */
    .sh-empty { padding: 64px 24px; text-align: center; }
    .sh-empty-icon { width: 60px; height: 60px; border-radius: 18px; background: var(--cream); border: 1px solid var(--line); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
    .sh-empty-icon svg { width: 28px; height: 28px; color: var(--line); }
    .sh-empty-title { font-size: 0.95rem; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
    .sh-empty-sub { font-size: 0.8rem; color: var(--muted); margin-bottom: 20px; }

    @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
    .fade-up { animation: fadeUp 0.32s ease both; }
    .d1 { animation-delay: 0.04s; } .d2 { animation-delay: 0.08s; }
    .d3 { animation-delay: 0.12s; } .d4 { animation-delay: 0.16s; }
    .d5 { animation-delay: 0.22s; }
</style>

<div class="sh-layout">

    {{-- SIDEBAR --}}
    <aside class="sh-sidebar">
        <a href="{{ route('dashboard') }}" class="sh-logo">
            <div class="sh-logo-icon">
                <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/>
                </svg>
            </div>
            <span class="sh-logo-text">Sheetsy</span>
        </a>

        <div class="sh-nav-section">
            <p class="sh-nav-label">General</p>
            <a href="{{ route('dashboard') }}" class="sh-nav-link active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="sh-nav-link">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                My Profile
            </a>
        </div>

        <div class="sh-nav-section">
            <p class="sh-nav-label">My Colocations</p>
            @php
                $navColocs = auth()->user()->memberships()->with('colocation')->whereNull('left_at')->get()->pluck('colocation')->filter();
            @endphp
            @forelse($navColocs as $nc)
                <a href="{{ route('colocations.show', $nc) }}" class="sh-nav-link">
                    <span class="coloc-initial">{{ strtoupper(substr($nc->name, 0, 1)) }}</span>
                    <span style="overflow:hidden;text-overflow:ellipsis">{{ $nc->name }}</span>
                    @if($nc->status === 'active') <span class="active-dot"></span> @endif
                </a>
            @empty
                <p style="font-size:0.75rem;color:var(--muted);padding:6px 8px;font-style:italic">No active colocation</p>
            @endforelse
            @if(auth()->user()->memberships()->whereNull('left_at')->doesntExist())
                <a href="{{ route('colocations.create') }}" class="sh-nav-link dashed">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Create Colocation
                </a>
            @endif
        </div>

        <div class="sh-nav-section">
            <p class="sh-nav-label">Account</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sh-nav-link danger">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>

        <div class="sh-sidebar-footer">
            <div class="sh-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div style="min-width:0">
                <p class="sh-avatar-name" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ auth()->user()->name }}</p>
                <p class="sh-avatar-email" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="sh-main">

        @if(session('success'))
            <div class="sh-flash success fade-up">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="sh-flash error fade-up">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @php
            $user           = auth()->user();
            $allMemberships = $user->memberships()->with('colocation')->get();
            $totalColocs    = $allMemberships->count();
            $activeColoc    = $allMemberships->whereNull('left_at')->first()?->colocation;
            $ownedCount     = $allMemberships->where('role', 'owner')->count();
            $reputation     = $user->reputation_score ?? 0;
            $hasActive      = auth()->user()->memberships()->whereNull('left_at')->exists();
        @endphp

        {{-- Header --}}
        <div class="sh-page-header fade-up">
            <div>
                <h1 class="sh-page-greeting">Welcome back, {{ explode(' ', $user->name)[0] }} 👋</h1>
                <p class="sh-page-sub">Here's an overview of your colocation activity.</p>
            </div>
            @if(!$hasActive)
                <a href="{{ route('colocations.create') }}" class="btn-primary">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    New Colocation
                </a>
            @endif
        </div>

        {{-- Stats --}}
        <div class="sh-stats">
            <div class="sh-stat fade-up d1">
                <div class="sh-stat-top">
                    <span class="sh-stat-label">Total Colocations</span>
                    <div class="sh-stat-icon blue">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                </div>
                <p class="sh-stat-value">{{ $totalColocs }}</p>
                <p class="sh-stat-hint">colocations joined</p>
            </div>

            <div class="sh-stat fade-up d2">
                <div class="sh-stat-top">
                    <span class="sh-stat-label">Current Colocation</span>
                    <div class="sh-stat-icon green">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                @if($activeColoc)
                    <p style="font-family:'Playfair Display',serif;font-size:1.15rem;font-weight:900;color:var(--ink);letter-spacing:-0.02em;margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $activeColoc->name }}</p>
                    <span class="badge badge-green">● Active</span>
                @else
                    <p style="font-size:1rem;font-weight:600;color:var(--muted);margin-bottom:6px">None</p>
                    <span class="badge badge-gray">No active colocation</span>
                @endif
            </div>

            <div class="sh-stat fade-up d3">
                <div class="sh-stat-top">
                    <span class="sh-stat-label">Times as Owner</span>
                    <div class="sh-stat-icon amber">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>
                <p class="sh-stat-value">{{ $ownedCount }}</p>
                <p class="sh-stat-hint">colocations as owner</p>
            </div>

            <div class="sh-stat fade-up d4">
                <div class="sh-stat-top">
                    <span class="sh-stat-label">Reputation</span>
                    <div class="sh-stat-icon {{ $reputation >= 0 ? 'green' : 'red' }}">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                    </div>
                </div>
                <p class="sh-stat-value {{ $reputation >= 0 ? 'positive' : 'negative' }}">
                    {{ $reputation >= 0 ? '+' : '' }}{{ $reputation }}
                </p>
                <p class="sh-stat-hint">
                    @if($reputation >= 3) Excellent behavior
                    @elseif($reputation >= 1) Good standing
                    @elseif($reputation == 0) Neutral
                    @else Poor — pay your debts
                    @endif
                </p>
            </div>
        </div>

        {{-- History Table --}}
        <div class="sh-card fade-up d5">
            <div class="sh-card-header">
                <div>
                    <p class="sh-card-title">Colocation History</p>
                    <p class="sh-card-sub">All colocations you have been part of</p>
                </div>
                @if(!$hasActive)
                    <a href="{{ route('colocations.create') }}" class="btn-ghost">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Add Colocation
                    </a>
                @endif
            </div>
            <table class="sh-table">
                <thead>
                    <tr>
                        <th>Colocation</th><th>Role</th><th>Status</th><th>Joined</th><th>Left</th><th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allMemberships as $membership)
                        @php $coloc = $membership->colocation; @endphp
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:12px">
                                    <div class="coloc-avatar">{{ strtoupper(substr($coloc->name, 0, 1)) }}</div>
                                    <div>
                                        <p style="font-weight:700;color:var(--ink);font-size:0.875rem">{{ $coloc->name }}</p>
                                        <p style="font-size:0.72rem;color:var(--muted)">{{ $coloc->memberships()->count() }} member(s)</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $membership->role === 'owner' ? 'badge-amber' : 'badge-gray' }}">
                                    {{ $membership->role === 'owner' ? '⭐ Owner' : 'Member' }}
                                </span>
                            </td>
                            <td>
                                @if($coloc->status === 'active' && is_null($membership->left_at))
                                    <span class="badge badge-green">● Active</span>
                                @elseif($coloc->status === 'cancelled')
                                    <span class="badge badge-red">Cancelled</span>
                                @else
                                    <span class="badge badge-gray">Left</span>
                                @endif
                            </td>
                            <td style="font-size:0.78rem;color:var(--muted)">{{ $membership->created_at->format('d M Y') }}</td>
                            <td style="font-size:0.78rem;color:var(--muted)">{{ $membership->left_at ? \Carbon\Carbon::parse($membership->left_at)->format('d M Y') : '—' }}</td>
                            <td>
                                @if($coloc->status === 'active' && is_null($membership->left_at))
                                    <a href="{{ route('colocations.show', $coloc) }}" class="btn-ghost" style="padding:6px 12px;font-size:0.75rem">
                                        View
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="width:12px;height:12px"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @else
                                    <span style="color:var(--line);font-size:0.8rem">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="sh-empty">
                                    <div class="sh-empty-icon">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    </div>
                                    <p class="sh-empty-title">No colocations yet</p>
                                    <p class="sh-empty-sub">Create your first colocation to get started</p>
                                    <a href="{{ route('colocations.create') }}" class="btn-primary" style="margin:0 auto">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                        Create a Colocation
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>
</x-app-layout>