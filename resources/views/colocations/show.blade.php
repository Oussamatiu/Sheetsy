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

    /* ── LAYOUT ── */
    .sh-layout { display: flex; min-height: 100vh; background: var(--cream); }

    /* ── SIDEBAR ── */
    .sh-sidebar {
        width: 252px; flex-shrink: 0;
        background: var(--white);
        border-right: 1px solid var(--line);
        display: flex; flex-direction: column;
        padding: 24px 16px;
        position: sticky; top: 0; height: 100vh;
        overflow-y: auto;
    }
    @media (max-width: 768px) { .sh-sidebar { display: none; } }

    .sh-logo {
        display: flex; align-items: center; gap: 9px;
        padding: 0 6px; margin-bottom: 32px;
        text-decoration: none;
    }
    .sh-logo-icon {
        width: 32px; height: 32px; border-radius: 9px;
        background: var(--green);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sh-logo-text {
        font-size: 1.1rem; font-weight: 800;
        color: var(--ink); letter-spacing: -0.03em;
    }

    .sh-nav-label {
        font-size: 0.62rem; font-weight: 700;
        color: #9ca3af; text-transform: uppercase;
        letter-spacing: 0.08em; padding: 0 8px;
        margin: 0 0 6px;
    }
    .sh-nav-section { margin-bottom: 20px; }

    .sh-nav-link {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 10px; border-radius: 10px;
        font-size: 0.85rem; font-weight: 500; color: var(--muted);
        text-decoration: none; transition: all 0.15s;
        white-space: nowrap;
    }
    .sh-nav-link svg { width: 17px; height: 17px; flex-shrink: 0; }
    .sh-nav-link:hover { background: #f0fdf4; color: var(--green-mid); }
    .sh-nav-link.active {
        background: #dcfce7; color: var(--green);
        font-weight: 700;
    }
    .sh-nav-link .coloc-initial {
        width: 22px; height: 22px; border-radius: 6px;
        background: #dcfce7; color: var(--green);
        font-size: 0.7rem; font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sh-nav-link .active-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: var(--mint); margin-left: auto; flex-shrink: 0;
    }
    .sh-nav-link.danger { color: #ef4444; }
    .sh-nav-link.danger:hover { background: #fef2f2; color: #dc2626; }

    .sh-sidebar-footer {
        margin-top: auto; padding-top: 16px;
        border-top: 1px solid var(--line);
        display: flex; align-items: center; gap: 10px; padding-left: 4px;
    }
    .sh-avatar {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--green);
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 0.8rem; color: white; flex-shrink: 0;
    }
    .sh-avatar-name { font-size: 0.82rem; font-weight: 700; color: var(--ink); }
    .sh-avatar-email { font-size: 0.7rem; color: var(--muted); }

    /* ── MAIN ── */
    .sh-main { flex: 1; padding: 40px 48px; overflow: auto; min-width: 0; }
    @media (max-width: 1024px) { .sh-main { padding: 28px 24px; } }

    /* ── FLASH ── */
    .sh-flash {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; border-radius: 14px;
        font-size: 0.85rem; font-weight: 600; margin-bottom: 24px;
    }
    .sh-flash.success { background: #f0fdf4; border: 1px solid #bbf7d0; color: var(--green); }
    .sh-flash.error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }
    .sh-flash svg { width: 18px; height: 18px; flex-shrink: 0; }

    /* ── BREADCRUMB ── */
    .sh-breadcrumb {
        display: flex; align-items: center; gap: 6px;
        font-size: 0.8rem; color: var(--muted); margin-bottom: 24px;
    }
    .sh-breadcrumb a { color: var(--muted); text-decoration: none; transition: color 0.15s; }
    .sh-breadcrumb a:hover { color: var(--green-mid); }
    .sh-breadcrumb .current { color: var(--ink); font-weight: 600; }
    .sh-breadcrumb svg { width: 14px; height: 14px; color: var(--line); }

    /* ── HERO CARD ── */
    .sh-hero {
        background: var(--white); border: 1px solid var(--line);
        border-radius: 20px; padding: 28px 32px; margin-bottom: 24px;
        box-shadow: 0 2px 12px rgba(45,106,79,0.05);
    }
    .sh-hero-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
    .sh-hero-left { display: flex; align-items: center; gap: 18px; }
    .sh-hero-icon {
        width: 56px; height: 56px; border-radius: 18px; flex-shrink: 0;
        background: linear-gradient(135deg, var(--green-mid), var(--green));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem; font-weight: 900; color: white;
        box-shadow: 0 6px 16px rgba(45,106,79,0.25);
    }
    .sh-hero-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem; font-weight: 900;
        color: var(--ink); letter-spacing: -0.02em; margin-bottom: 6px;
    }
    .sh-hero-meta { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .sh-hero-meta-item { display: flex; align-items: center; gap: 5px; font-size: 0.75rem; color: var(--muted); }
    .sh-hero-meta-item svg { width: 12px; height: 12px; }
    .sh-hero-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .sh-hero-desc { margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--line); font-size: 0.875rem; color: var(--muted); line-height: 1.65; }

    /* ── BADGES ── */
    .badge {
        display: inline-flex; align-items: center;
        padding: 3px 10px; border-radius: 999px;
        font-size: 0.7rem; font-weight: 700; letter-spacing: 0.02em;
    }
    .badge-green  { background: #dcfce7; color: var(--green); }
    .badge-red    { background: #fee2e2; color: #dc2626; }
    .badge-amber  { background: #fef9c3; color: #92400e; }
    .badge-blue   { background: #dbeafe; color: #1d4ed8; }
    .badge-gray   { background: #f3f4f6; color: #6b7280; }

    /* ── BUTTONS ── */
    .btn-primary {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 18px; border-radius: 12px;
        background: var(--green); color: white;
        font-size: 0.85rem; font-weight: 700;
        text-decoration: none; border: none; cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 3px 10px rgba(45,106,79,0.28);
    }
    .btn-primary:hover { background: #245740; transform: translateY(-1px); box-shadow: 0 5px 16px rgba(45,106,79,0.34); }
    .btn-primary svg { width: 15px; height: 15px; }

    .btn-danger {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 16px; border-radius: 12px;
        background: #fff0f0; color: #dc2626;
        border: 1px solid #fecaca;
        font-size: 0.82rem; font-weight: 700; cursor: pointer;
        transition: all 0.15s;
    }
    .btn-danger:hover { background: #fee2e2; }
    .btn-danger svg { width: 14px; height: 14px; }

    .btn-ghost {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 16px; border-radius: 12px;
        background: #f0fdf4; color: var(--green-mid);
        border: 1px solid #bbf7d0;
        font-size: 0.82rem; font-weight: 700; cursor: pointer;
        text-decoration: none; transition: all 0.15s;
    }
    .btn-ghost:hover { background: #dcfce7; }
    .btn-ghost svg { width: 14px; height: 14px; }

    /* ── STAT CARDS ── */
    .sh-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
    @media (max-width: 1024px) { .sh-stats { grid-template-columns: repeat(2, 1fr); } }

    .sh-stat {
        background: var(--white); border: 1px solid var(--line);
        border-radius: 16px; padding: 20px 22px;
        box-shadow: 0 1px 6px rgba(45,106,79,0.04);
    }
    .sh-stat-label {
        font-size: 0.65rem; font-weight: 700;
        color: var(--muted); text-transform: uppercase;
        letter-spacing: 0.06em; margin-bottom: 8px;
    }
    .sh-stat-value {
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem; font-weight: 900; color: var(--ink);
        letter-spacing: -0.02em; line-height: 1;
    }
    .sh-stat-value.positive { color: var(--green); }
    .sh-stat-value.negative { color: #dc2626; }
    .sh-stat-unit { font-size: 0.78rem; font-weight: 500; color: var(--muted); margin-left: 4px; }

    /* ── TABS ── */
    .sh-tabs {
        display: flex; gap: 4px;
        background: var(--line); border-radius: 14px; padding: 4px;
        width: fit-content; margin-bottom: 24px;
    }
    .sh-tab {
        padding: 8px 18px; border-radius: 10px;
        font-size: 0.8rem; font-weight: 600; color: var(--muted);
        cursor: pointer; border: none; background: transparent;
        transition: all 0.15s; white-space: nowrap;
    }
    .sh-tab:hover:not(.active) { color: var(--ink); }
    .sh-tab.active {
        background: var(--white); color: var(--green);
        box-shadow: 0 1px 6px rgba(45,106,79,0.1);
    }

    .sh-panel { display: none; }
    .sh-panel.active { display: block; }

    /* ── CARD ── */
    .sh-card {
        background: var(--white); border: 1px solid var(--line);
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 2px 12px rgba(45,106,79,0.04);
    }
    .sh-card-header {
        padding: 20px 28px; border-bottom: 1px solid var(--line);
        display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;
    }
    .sh-card-title { font-size: 0.95rem; font-weight: 700; color: var(--ink); }
    .sh-card-sub { font-size: 0.75rem; color: var(--muted); margin-top: 2px; }

    /* ── TABLE ── */
    .sh-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .sh-table thead tr { border-bottom: 1px solid var(--line); }
    .sh-table th {
        padding: 10px 20px; text-align: left;
        font-size: 0.67rem; font-weight: 700;
        color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;
    }
    .sh-table tbody tr { border-bottom: 1px solid #f3f8f5; transition: background 0.12s; }
    .sh-table tbody tr:last-child { border-bottom: none; }
    .sh-table tbody tr:hover { background: #fafcfa; }
    .sh-table td { padding: 14px 20px; color: var(--ink); vertical-align: middle; }

    /* ── USER CELL ── */
    .user-cell { display: flex; align-items: center; gap: 10px; }
    .user-avatar {
        width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 0.75rem; color: white;
    }
    .user-avatar.self  { background: var(--green); }
    .user-avatar.other { background: #c4d9cd; color: var(--muted); }
    .user-avatar.red   { background: #ef4444; }
    .user-name { font-weight: 600; font-size: 0.85rem; color: var(--ink); }
    .user-email { font-size: 0.72rem; color: var(--muted); }
    .user-you { font-size: 0.72rem; color: var(--green-mid); font-weight: 500; }

    /* ── EMPTY STATE ── */
    .sh-empty { padding: 64px 24px; text-align: center; }
    .sh-empty-icon {
        width: 56px; height: 56px; border-radius: 18px;
        background: var(--cream); border: 1px solid var(--line);
        font-size: 1.5rem; display: flex; align-items: center;
        justify-content: center; margin: 0 auto 16px;
    }
    .sh-empty-title { font-size: 0.95rem; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
    .sh-empty-sub { font-size: 0.8rem; color: var(--muted); }

    /* ── FORM INPUT ── */
    .sh-input {
        width: 100%; padding: 10px 14px 10px 38px;
        background: var(--cream); border: 1.5px solid var(--line);
        border-radius: 11px; font-family: 'Figtree', sans-serif;
        font-size: 0.875rem; color: var(--ink); outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .sh-input:focus { border-color: var(--green-mid); box-shadow: 0 0 0 3px rgba(64,145,108,0.1); background: white; }
    .sh-input::placeholder { color: #b0c9bc; }
    .sh-input-wrap { position: relative; }
    .sh-input-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9bb5a6; display: flex; }
    .sh-input-icon svg { width: 15px; height: 15px; }

    /* ── PAYMENT FILTER BTNS ── */
    .pay-filter {
        padding: 6px 14px; border-radius: 9px;
        font-size: 0.75rem; font-weight: 600;
        border: 1.5px solid var(--line);
        background: var(--white); color: var(--muted);
        cursor: pointer; transition: all 0.15s;
    }
    .pay-filter:hover { border-color: var(--mint); color: var(--green-mid); }
    .pay-filter.active { background: #f0fdf4; border-color: #86efac; color: var(--green); }

    /* ── PAYMENT OWED BADGE ── */
    .owe-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; border-radius: 9px;
        font-size: 0.75rem; font-weight: 700;
    }
    .owe-badge.you-owe   { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .owe-badge.owed-you  { background: #f0fdf4; color: var(--green); border: 1px solid #bbf7d0; }

    /* ── MARK PAID BTN ── */
    .mark-paid-btn {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; border-radius: 9px;
        font-size: 0.75rem; font-weight: 700;
        background: #f0fdf4; color: var(--green);
        border: 1px solid #bbf7d0; cursor: pointer;
        transition: all 0.15s;
    }
    .mark-paid-btn:hover { background: #dcfce7; }
    .mark-paid-btn svg { width: 13px; height: 13px; }

    /* ── ARROW ── */
    .arrow-icon { display: flex; align-items: center; color: var(--line); }
    .arrow-icon svg { width: 16px; height: 16px; }

    /* ── SELECT ── */
    .sh-select {
        padding: 8px 12px; border: 1.5px solid var(--line);
        border-radius: 10px; font-family: 'Figtree', sans-serif;
        font-size: 0.8rem; color: var(--muted); background: var(--white);
        outline: none; cursor: pointer;
        transition: border-color 0.15s;
    }
    .sh-select:focus { border-color: var(--green-mid); }

    /* ── CATEGORY ITEM ── */
    .cat-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 0; border-bottom: 1px solid var(--line);
    }
    .cat-item:last-child { border-bottom: none; }
    .cat-icon {
        width: 32px; height: 32px; border-radius: 9px;
        background: #eff6ff; border: 1px solid #dbeafe;
        display: flex; align-items: center; justify-content: center;
    }
    .cat-icon svg { width: 15px; height: 15px; color: #3b82f6; }
    .del-btn { background: none; border: none; cursor: pointer; color: var(--line); transition: color 0.15s; padding: 4px; }
    .del-btn:hover { color: #ef4444; }

    /* ── INVITATION ROW ── */
    .inv-row { display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--line); }
    .inv-row:last-child { border-bottom: none; }
    .inv-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        background: var(--cream); border: 1px solid var(--line);
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 0.72rem; color: var(--muted);
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.3s ease both; }
    .d1 { animation-delay: 0.05s; }
    .d2 { animation-delay: 0.10s; }
    .d3 { animation-delay: 0.15s; }

    /* inline delete form */
    .inline-form { display: inline; }
</style>

<div class="sh-layout">

    {{-- ══════════ SIDEBAR ══════════ --}}
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
            <a href="{{ route('dashboard') }}" class="sh-nav-link">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="sh-nav-link">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                My Profile
            </a>
        </div>

        <div class="sh-nav-section">
            <p class="sh-nav-label">My Colocations</p>
            @forelse($sidebarColocations as $sc)
                <a href="{{ route('colocations.show', $sc) }}"
                   class="sh-nav-link {{ $sc->id === $colocation->id ? 'active' : '' }}">
                    <span class="coloc-initial">{{ strtoupper(substr($sc->name, 0, 1)) }}</span>
                    <span style="overflow:hidden;text-overflow:ellipsis">{{ $sc->name }}</span>
                    @if($sc->status === 'active')
                        <span class="active-dot"></span>
                    @endif
                </a>
            @empty
                <p style="font-size:0.75rem;color:var(--muted);padding:6px 8px;font-style:italic">No colocations</p>
            @endforelse
        </div>

        <div class="sh-nav-section">
            <p class="sh-nav-label">Account</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sh-nav-link danger" style="width:100%;text-align:left;cursor:pointer;background:none;border:none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        <div class="sh-sidebar-footer">
            <div class="sh-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div style="min-width:0">
                <p class="sh-avatar-name" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ auth()->user()->name }}</p>
                <p class="sh-avatar-email" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </aside>

    {{-- ══════════ MAIN ══════════ --}}
    <main class="sh-main">

        {{-- Flash --}}
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

        {{-- Breadcrumb --}}
        <div class="sh-breadcrumb fade-up">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="current">{{ $colocation->name }}</span>
        </div>

        {{-- ── HERO ── --}}
        <div class="sh-hero fade-up d1">
            <div class="sh-hero-top">
                <div class="sh-hero-left">
                    <div class="sh-hero-icon">{{ strtoupper(substr($colocation->name, 0, 1)) }}</div>
                    <div>
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:8px;">
                            <h1 class="sh-hero-name">{{ $colocation->name }}</h1>
                            @if($colocation->status === 'active')
                                <span class="badge badge-green">● Active</span>
                            @else
                                <span class="badge badge-red">Cancelled</span>
                            @endif
                            @if($isOwner)
                                <span class="badge badge-amber">⭐ Owner</span>
                            @endif
                        </div>
                        <div class="sh-hero-meta">
                            @if($colocation->address)
                                <span class="sh-hero-meta-item">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    {{ $colocation->address }}
                                </span>
                            @endif
                            <span class="sh-hero-meta-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $activeMembers->count() }} member(s)
                            </span>
                            <span class="sh-hero-meta-item">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Created {{ $colocation->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                @if($colocation->status === 'active')
                    <div class="sh-hero-actions">
                        <a href="{{ route('expenses.create', $colocation) }}" class="btn-primary">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Add Expense
                        </a>
                        @if($isOwner)
                            <form method="POST" action="{{ route('colocations.destroy', $colocation) }}"
                                  onsubmit="return confirm('Cancel this colocation? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    Cancel Colocation
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('colocations.leave', $colocation) }}"
                                  onsubmit="return confirm('Leave this colocation?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-danger">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                                    Leave
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>

            @if($colocation->description)
                <div class="sh-hero-desc">{{ $colocation->description }}</div>
            @endif
        </div>

        {{-- ── STATS ── --}}
        <div class="sh-stats fade-up d2">
            <div class="sh-stat">
                <p class="sh-stat-label">Total Expenses</p>
                <p class="sh-stat-value">{{ number_format($totalExpenses, 2) }}<span class="sh-stat-unit">MAD</span></p>
            </div>
            <div class="sh-stat">
                <p class="sh-stat-label">I Paid</p>
                <p class="sh-stat-value">{{ number_format($myPaid, 2) }}<span class="sh-stat-unit">MAD</span></p>
            </div>
            <div class="sh-stat">
                <p class="sh-stat-label">My Balance</p>
                <p class="sh-stat-value {{ $myBalance >= 0 ? 'positive' : 'negative' }}">
                    {{ $myBalance >= 0 ? '+' : '' }}{{ number_format($myBalance, 2) }}<span class="sh-stat-unit" style="{{ $myBalance >= 0 ? 'color:var(--mint)' : 'color:#fca5a5' }}">MAD</span>
                </p>
            </div>
            <div class="sh-stat">
                <p class="sh-stat-label">Members</p>
                <p class="sh-stat-value">{{ $activeMembers->count() }}</p>
            </div>
        </div>

        {{-- ── TABS ── --}}
        <div class="fade-up d3">
            <div class="sh-tabs">
                <button class="sh-tab active" onclick="switchTab('members', this)">👥 Members</button>
                <button class="sh-tab" onclick="switchTab('expenses', this)">💸 Expenses</button>
                <button class="sh-tab" onclick="switchTab('payments', this)">💰 Payments</button>
                @if($isOwner)
                    <button class="sh-tab" onclick="switchTab('invitations', this)">✉️ Invitations</button>
                    <button class="sh-tab" onclick="switchTab('categories', this)">🏷️ Categories</button>
                @endif
            </div>

            {{-- ── TAB: MEMBERS ── --}}
            <div id="tab-members" class="sh-panel active">
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div>
                            <p class="sh-card-title">Members</p>
                            <p class="sh-card-sub">{{ $activeMembers->count() }} active member(s)</p>
                        </div>
                    </div>
                    <table class="sh-table">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Role</th>
                                <th>Reputation</th>
                                <th>Joined</th>
                                @if($isOwner)<th>Action</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activeMembers as $m)
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar {{ $m->user->id === auth()->id() ? 'self' : 'other' }}">
                                                {{ strtoupper(substr($m->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="user-name">{{ $m->user->name }} @if($m->user->id === auth()->id())<span class="user-you">(you)</span>@endif</p>
                                                <p class="user-email">{{ $m->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $m->role === 'owner' ? 'badge-amber' : 'badge-gray' }}">
                                            {{ $m->role === 'owner' ? '⭐ Owner' : 'Member' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-weight:700;color:{{ ($m->user->reputation_score ?? 0) >= 0 ? 'var(--green)' : '#dc2626' }}">
                                            {{ ($m->user->reputation_score ?? 0) >= 0 ? '+' : '' }}{{ $m->user->reputation_score ?? 0 }}
                                        </span>
                                    </td>
                                    <td style="font-size:0.78rem;color:var(--muted)">{{ $m->created_at->format('d M Y') }}</td>
                                    @if($isOwner)
                                        <td>
                                            @if($m->role !== 'owner')
                                                <form method="POST" action=""
                                                      onsubmit="return confirm('Remove {{ $m->user->name }}?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-danger" style="padding:6px 12px;font-size:0.75rem;">
                                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"/></svg>
                                                        Remove
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color:var(--line);font-size:0.8rem">—</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr><td colspan="5"><div class="sh-empty"><div class="sh-empty-icon">👥</div><p class="sh-empty-title">No members</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── TAB: EXPENSES ── --}}
            <div id="tab-expenses" class="sh-panel">
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div>
                            <p class="sh-card-title">Expenses</p>
                            <p class="sh-card-sub">All shared expenses for this colocation</p>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                            <form method="GET" action="{{ route('colocations.show', $colocation) }}">
                                <select name="month" onchange="this.form.submit()" class="sh-select">
                                    <option value="">All months</option>
                                    @foreach(range(1, 12) as $mo)
                                        <option value="{{ $mo }}" {{ request('month') == $mo ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($mo)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            @if($colocation->status === 'active')
                                <a href="{{ route('expenses.create', $colocation) }}" class="btn-ghost">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                    Add
                                </a>
                            @endif
                        </div>
                    </div>
                    <table class="sh-table">
                        <thead>
                            <tr>
                                <th>Title</th><th>Category</th><th>Amount</th><th>Paid By</th><th>Date</th>
                                @if($isOwner)<th>Action</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expenses as $expense)
                                <tr>
                                    <td style="font-weight:600">{{ $expense->title }}</td>
                                    <td>
                                        @if($expense->category)
                                            <span class="badge badge-blue">{{ $expense->category->name }}</span>
                                        @else
                                            <span style="color:var(--line);font-size:0.8rem">—</span>
                                        @endif
                                    </td>
                                    <td><span style="font-weight:700;color:var(--green)">{{ number_format($expense->amount, 2) }}</span> <span style="font-size:0.75rem;color:var(--muted)">MAD</span></td>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar other" style="width:26px;height:26px;font-size:0.65rem">{{ strtoupper(substr($expense->payer->name, 0, 1)) }}</div>
                                            <span style="font-size:0.8rem;color:var(--muted)">{{ $expense->payer->name }}</span>
                                        </div>
                                    </td>
                                    <td style="font-size:0.78rem;color:var(--muted)">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                                    @if($isOwner)
                                        <td>
                                            <form method="POST" action="{{ route('expenses.destroy', $expense) }}"
                                                  onsubmit="return confirm('Delete this expense?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="del-btn">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr><td colspan="6"><div class="sh-empty"><div class="sh-empty-icon">💸</div><p class="sh-empty-title">No expenses yet</p><p class="sh-empty-sub">Add the first expense for this colocation</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── TAB: PAYMENTS ── --}}
            <div id="tab-payments" class="sh-panel">
                <div class="sh-card">
                    <div class="sh-card-header">
                        <div>
                            <p class="sh-card-title">Payments</p>
                            <p class="sh-card-sub">Who owes who — based on all expenses</p>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                            @php
                                $myOwed   = $payments->where('status','pending')->filter(fn($p) => $p->from_user_id === auth()->id())->sum('amount');
                                $owedToMe = $payments->where('status','pending')->filter(fn($p) => $p->to_user_id === auth()->id())->sum('amount');
                            @endphp
                            @if($myOwed > 0)
                                <span class="owe-badge you-owe">↑ You owe {{ number_format($myOwed, 2) }} MAD</span>
                            @endif
                            @if($owedToMe > 0)
                                <span class="owe-badge owed-you">↓ Owed to you {{ number_format($owedToMe, 2) }} MAD</span>
                            @endif
                        </div>
                    </div>

                    @if($payments->isEmpty())
                        <div class="sh-empty">
                            <div class="sh-empty-icon">💰</div>
                            <p class="sh-empty-title">No payments yet</p>
                            <p class="sh-empty-sub">Add expenses first — payments will appear here automatically</p>
                        </div>
                    @else
                        <div style="padding:16px 20px 4px;display:flex;gap:8px;flex-wrap:wrap;">
                            <button onclick="filterPayments('all',this)" class="pay-filter active">All ({{ $payments->count() }})</button>
                            <button onclick="filterPayments('pending',this)" class="pay-filter">⏳ Pending ({{ $payments->where('status','pending')->count() }})</button>
                            <button onclick="filterPayments('paid',this)" class="pay-filter">✅ Paid ({{ $payments->where('status','paid')->count() }})</button>
                        </div>
                        <table class="sh-table">
                            <thead>
                                <tr><th>From</th><th>To</th><th>Amount</th><th>Expense</th><th>Status</th><th>Action</th></tr>
                            </thead>
                            <tbody id="payments-tbody">
                                @foreach($payments as $payment)
                                    <tr class="payment-row" data-status="{{ $payment->status }}">
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar {{ $payment->payer->id === auth()->id() ? 'red' : 'other' }}">
                                                    {{ strtoupper(substr($payment->payer->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="user-name">{{ $payment->payer->name }}</p>
                                                    @if($payment->payer->id === auth()->id())<p style="font-size:0.7rem;color:#ef4444">(you)</p>@endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="user-cell">
                                                <div class="arrow-icon">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                                </div>
                                                <div class="user-avatar {{ $payment->receiver->id === auth()->id() ? 'self' : 'other' }}">
                                                    {{ strtoupper(substr($payment->receiver->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="user-name">{{ $payment->receiver->name }}</p>
                                                    @if($payment->receiver->id === auth()->id())<p style="font-size:0.7rem;color:var(--green)">(you)</p>@endif
                                                </div>
                                            </div>
                                        </td>
                                        <td><span style="font-weight:700">{{ number_format($payment->amount, 2) }}</span> <span style="font-size:0.75rem;color:var(--muted)">MAD</span></td>
                                        <td><span style="font-size:0.78rem;background:var(--cream);color:var(--muted);padding:4px 10px;border-radius:8px;border:1px solid var(--line)">{{ $payment->expense->title ?? '—' }}</span></td>
                                        <td>
                                            @if($payment->status === 'paid')
                                                <span class="badge badge-green">✅ Paid</span>
                                                @if($payment->paid_at)<p style="font-size:0.68rem;color:var(--muted);margin-top:2px">{{ $payment->paid_at->format('d M Y') }}</p>@endif
                                            @else
                                                <span class="badge badge-red">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($payment->status === 'pending' && $payment->receiver->id === auth()->id())
                                                <form method="POST" action="{{ route('payments.mark-paid', [$colocation, $payment]) }}"
                                                      onsubmit="return confirm('Confirm you received this payment?')">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="mark-paid-btn">
                                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                        Mark as Paid
                                                    </button>
                                                </form>
                                            @elseif($payment->status === 'pending' && $payment->payer->id === auth()->id())
                                                <span class="owe-badge you-owe" style="font-size:0.72rem">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:12px;height:12px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    You owe this
                                                </span>
                                            @else
                                                <span style="color:var(--line);font-size:0.8rem">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            {{-- ── TAB: INVITATIONS (owner only) ── --}}
            @if($isOwner)
                <div id="tab-invitations" class="sh-panel">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                        <div class="sh-card" style="overflow:visible">
                            <div class="sh-card-header">
                                <div>
                                    <p class="sh-card-title">Invite a Member</p>
                                    <p class="sh-card-sub">Send an invitation to someone's email</p>
                                </div>
                            </div>
                            <div style="padding:24px 28px;">
                                @if($errors->has('email'))
                                    <div style="margin-bottom:16px;padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;color:#dc2626;border-radius:10px;font-size:0.82rem">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('invitations.send', $colocation->id) }}">
                                    @csrf
                                    <p class="sh-card-sub" style="margin-bottom:8px;font-weight:700;color:var(--muted)">Email Address</p>
                                    <div style="display:flex;gap:10px;">
                                        <div class="sh-input-wrap" style="flex:1">
                                            <span class="sh-input-icon">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            </span>
                                            <input type="email" name="email" placeholder="friend@example.com" value="{{ old('email') }}" class="sh-input" required />
                                        </div>
                                        <button type="submit" class="btn-primary" style="flex-shrink:0">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="sh-card" style="overflow:visible">
                            <div class="sh-card-header">
                                <div>
                                    <p class="sh-card-title">Pending Invitations</p>
                                    <p class="sh-card-sub">Not yet accepted</p>
                                </div>
                            </div>
                            <div style="padding:8px 28px 20px">
                                @forelse($pendingInvitations as $inv)
                                    <div class="inv-row">
                                        <div style="display:flex;align-items:center;gap:10px">
                                            <div class="inv-avatar">{{ strtoupper(substr($inv->email, 0, 1)) }}</div>
                                            <div>
                                                <p style="font-size:0.85rem;font-weight:600;color:var(--ink)">{{ $inv->email }}</p>
                                                <p style="font-size:0.72rem;color:var(--muted)">Sent {{ $inv->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <span class="badge badge-gray">Pending</span>
                                    </div>
                                @empty
                                    <div class="sh-empty" style="padding:32px 0">
                                        <p class="sh-empty-title">No pending invitations</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── TAB: CATEGORIES ── --}}
                <div id="tab-categories" class="sh-panel">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                        <div class="sh-card" style="overflow:visible">
                            <div class="sh-card-header">
                                <div>
                                    <p class="sh-card-title">Add a Category</p>
                                    <p class="sh-card-sub">Organize your expenses with categories</p>
                                </div>
                            </div>
                            <div style="padding:24px 28px">
                                @if($errors->has('name'))
                                    <div style="margin-bottom:16px;padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;color:#dc2626;border-radius:10px;font-size:0.82rem">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('categories.store') }}">
                                    @csrf
                                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                                    <p class="sh-card-sub" style="margin-bottom:8px;font-weight:700;color:var(--muted)">Category Name</p>
                                    <div style="display:flex;gap:10px;">
                                        <div class="sh-input-wrap" style="flex:1">
                                            <span class="sh-input-icon">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                            </span>
                                            <input type="text" name="name" placeholder="e.g. Groceries, Netflix…" value="{{ old('name') }}" class="sh-input" required />
                                        </div>
                                        <button type="submit" class="btn-primary" style="flex-shrink:0">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="sh-card" style="overflow:visible">
                            <div class="sh-card-header">
                                <div>
                                    <p class="sh-card-title">Existing Categories</p>
                                    <p class="sh-card-sub">Available for this colocation</p>
                                </div>
                            </div>
                            <div style="padding:4px 28px 20px">
                                @forelse($categories as $cat)
                                    <div class="cat-item">
                                        <div style="display:flex;align-items:center;gap:10px">
                                            <div class="cat-icon">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                            </div>
                                            <span style="font-size:0.875rem;font-weight:600;color:var(--ink)">{{ $cat->name }}</span>
                                        </div>
                                        <form method="POST" action="{{ route('categories.destroy', $cat) }}"
                                              onsubmit="return confirm('Delete this category?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="del-btn">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="sh-empty" style="padding:32px 0">
                                        <div class="sh-empty-icon">🏷️</div>
                                        <p class="sh-empty-title">No categories yet</p>
                                        <p class="sh-empty-sub">Add your first category on the left</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </main>
</div>

<script>
    function switchTab(tab, btn) {
        document.querySelectorAll('.sh-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.sh-tab').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        btn.classList.add('active');
    }

    function filterPayments(status, btn) {
        document.querySelectorAll('.pay-filter').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.payment-row').forEach(row => {
            row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
        });
    }

    @if(request('month'))
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.querySelectorAll('.sh-tab')[1];
            switchTab('expenses', btn);
        });
    @endif
</script>
</x-app-layout>