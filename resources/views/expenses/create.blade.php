<x-app-layout>
<style>
    @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&family=playfair-display:700,900i&display=swap');
    *, *::before, *::after { box-sizing: border-box; }
    :root {
        --green:#2D6A4F; --green-mid:#40916C; --green-lt:#52B788;
        --mint:#95D5B2; --cream:#F8FAF9; --ink:#0D1F17;
        --muted:#5A7A6A; --line:#D8EDE3; --white:#FFFFFF;
    }
    body, * { font-family: 'Figtree', sans-serif; }
    .sh-layout { display:flex; min-height:100vh; background:var(--cream); }

    /* ── SIDEBAR ── */
    .sh-sidebar { width:252px; flex-shrink:0; background:var(--white); border-right:1px solid var(--line); display:flex; flex-direction:column; padding:24px 16px; position:sticky; top:0; height:100vh; overflow-y:auto; }
    @media(max-width:768px){.sh-sidebar{display:none;}}
    .sh-logo { display:flex; align-items:center; gap:9px; padding:0 6px; margin-bottom:32px; text-decoration:none; }
    .sh-logo-icon { width:32px; height:32px; border-radius:9px; background:var(--green); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .sh-logo-text { font-size:1.1rem; font-weight:800; color:var(--ink); letter-spacing:-0.03em; }
    .sh-nav-label { font-size:0.62rem; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.08em; padding:0 8px; margin:0 0 6px; }
    .sh-nav-section { margin-bottom:20px; }
    .sh-nav-link { display:flex; align-items:center; gap:10px; padding:9px 10px; border-radius:10px; font-size:0.85rem; font-weight:500; color:var(--muted); text-decoration:none; transition:all 0.15s; white-space:nowrap; background:none; border:none; cursor:pointer; width:100%; text-align:left; }
    .sh-nav-link svg { width:17px; height:17px; flex-shrink:0; }
    .sh-nav-link:hover { background:#f0fdf4; color:var(--green-mid); }
    .sh-nav-link.active { background:#dcfce7; color:var(--green); font-weight:700; }
    .sh-nav-link.danger { color:#ef4444; }
    .sh-nav-link.danger:hover { background:#fef2f2; color:#dc2626; }
    .coloc-initial { width:22px; height:22px; border-radius:6px; background:#dcfce7; color:var(--green); font-size:0.7rem; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .active-dot { width:7px; height:7px; border-radius:50%; background:var(--mint); margin-left:auto; flex-shrink:0; }
    .sh-sidebar-footer { margin-top:auto; padding-top:16px; border-top:1px solid var(--line); display:flex; align-items:center; gap:10px; padding-left:4px; }
    .sh-avatar { width:34px; height:34px; border-radius:50%; background:var(--green); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:0.8rem; color:white; flex-shrink:0; }

    /* ── MAIN ── */
    .sh-main { flex:1; padding:40px 48px; overflow:auto; min-width:0; }
    @media(max-width:1024px){.sh-main{padding:28px 24px;}}

    /* ── BREADCRUMB ── */
    .sh-breadcrumb { display:flex; align-items:center; gap:6px; font-size:0.8rem; color:var(--muted); margin-bottom:28px; }
    .sh-breadcrumb a { color:var(--muted); text-decoration:none; }
    .sh-breadcrumb a:hover { color:var(--green-mid); }
    .sh-breadcrumb .cur { color:var(--ink); font-weight:700; }
    .sh-breadcrumb svg { width:13px; height:13px; }

    .sh-page-title { font-family:'Playfair Display',serif; font-size:1.75rem; font-weight:900; color:var(--ink); letter-spacing:-0.02em; margin-bottom:4px; }
    .sh-page-sub { font-size:0.875rem; color:var(--muted); }

    /* ── GRID ── */
    .form-grid { display:grid; grid-template-columns:1fr 300px; gap:24px; align-items:start; }
    @media(max-width:1000px){.form-grid{grid-template-columns:1fr;}}

    /* ── CARD ── */
    .sh-card { background:var(--white); border:1px solid var(--line); border-radius:20px; padding:28px 32px; box-shadow:0 2px 12px rgba(45,106,79,0.04); }

    /* ── FORM ── */
    .field { margin-bottom:20px; }
    .sh-label { display:block; font-size:0.72rem; font-weight:700; color:#374151; letter-spacing:0.04em; margin-bottom:6px; text-transform:uppercase; }
    .sh-input { width:100%; padding:11px 14px; background:var(--cream); border:1.5px solid var(--line); border-radius:12px; font-family:'Figtree',sans-serif; font-size:0.875rem; color:var(--ink); outline:none; transition:border-color 0.15s,box-shadow 0.15s; appearance:none; }
    .sh-input:focus { border-color:var(--green-mid); box-shadow:0 0 0 3px rgba(64,145,108,0.12); background:white; }
    .sh-input::placeholder { color:#b0c9bc; }
    .sh-input.has-icon { padding-left:44px; }
    .sh-input.has-prefix { padding-left:52px; }
    .input-wrap { position:relative; }
    .input-wrap .icon { position:absolute; left:13px; top:50%; transform:translateY(-50%); color:#b0c9bc; pointer-events:none; }
    .input-wrap .icon svg { width:16px; height:16px; }
    .input-wrap .prefix { position:absolute; left:14px; top:50%; transform:translateY(-50%); font-size:0.75rem; font-weight:700; color:var(--muted); pointer-events:none; }
    .field-error { margin-top:5px; font-size:0.72rem; color:#dc2626; }

    /* ── TWO COL ROW ── */
    .two-col { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    @media(max-width:600px){.two-col{grid-template-columns:1fr;}}

    /* ── PAID BY ── */
    .member-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
    @media(max-width:600px){.member-grid{grid-template-columns:1fr;}}
    .member-option { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:12px; border:1.5px solid var(--line); background:var(--cream); cursor:pointer; transition:all 0.15s; }
    .member-option:hover { border-color:var(--mint); background:#f0fdf4; }
    .member-option.selected { border-color:var(--green-mid); background:#f0fdf4; }
    .member-option input { display:none; }
    .member-avatar { width:30px; height:30px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:0.7rem; color:white; flex-shrink:0; }
    .member-avatar.is-me { background:var(--green); }
    .member-avatar.is-other { background:#9ca3af; }
    .member-name { font-size:0.82rem; font-weight:700; color:var(--ink); }
    .member-email { font-size:0.68rem; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:130px; }
    .member-check { margin-left:auto; flex-shrink:0; }
    .member-check svg { width:16px; height:16px; color:var(--green); }

    /* ── BUTTONS ── */
    .btn-primary { display:inline-flex; align-items:center; gap:7px; padding:11px 22px; border-radius:12px; background:var(--green); color:white; font-size:0.875rem; font-weight:700; border:none; cursor:pointer; transition:all 0.2s; box-shadow:0 3px 10px rgba(45,106,79,0.28); }
    .btn-primary:hover { background:#245740; transform:translateY(-1px); }
    .btn-ghost { display:inline-flex; align-items:center; gap:7px; padding:11px 22px; border-radius:12px; background:var(--cream); color:var(--muted); border:1px solid var(--line); font-size:0.875rem; font-weight:700; text-decoration:none; transition:all 0.15s; }
    .btn-ghost:hover { background:var(--line); }
    .btn-primary svg, .btn-ghost svg { width:15px; height:15px; }

    .sh-divider { border:none; border-top:1px solid var(--line); margin:24px 0; }

    /* ── ERROR BOX ── */
    .error-box { background:#fef2f2; border:1px solid #fecaca; border-radius:14px; padding:16px 20px; margin-bottom:24px; }
    .error-box p { font-size:0.82rem; font-weight:700; color:#dc2626; margin-bottom:6px; }
    .error-box li { font-size:0.8rem; color:#dc2626; margin-left:16px; list-style:disc; }

    /* ── RIGHT CARDS ── */
    .right-card { background:var(--white); border:1px solid var(--line); border-radius:18px; padding:22px; margin-bottom:16px; box-shadow:0 2px 8px rgba(45,106,79,0.04); }
    .right-card-label { font-size:0.62rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:0.07em; margin-bottom:14px; }
    .split-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
    .split-row:last-child { margin-bottom:0; }
    .split-row-meta { display:flex; align-items:center; gap:8px; }
    .split-mini-avatar { width:24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:0.62rem; color:white; flex-shrink:0; }
    .split-mini-name { font-size:0.8rem; color:var(--ink); }
    .split-amount-val { font-size:0.85rem; font-weight:700; color:var(--ink); }
    .split-divider { border-top:1px solid var(--line); margin:12px 0; }

    .tips-card { background:#f0fdf4; border:1px solid #bbf7d0; border-radius:18px; padding:20px; margin-bottom:16px; }
    .tips-title { font-size:0.82rem; font-weight:700; color:var(--green); margin-bottom:12px; display:flex; align-items:center; gap:6px; }
    .tips-title svg { width:15px; height:15px; }
    .tip-item { display:flex; align-items:flex-start; gap:8px; font-size:0.75rem; color:var(--green); margin-bottom:10px; line-height:1.5; }
    .tip-item:last-child { margin-bottom:0; }
    .tip-item svg { width:13px; height:13px; flex-shrink:0; margin-top:2px; color:var(--green-mid); }

    .recent-row { display:flex; align-items:center; justify-content:space-between; padding:8px 0; border-bottom:1px solid var(--line); }
    .recent-row:last-child { border-bottom:none; }
    .recent-title { font-size:0.82rem; font-weight:600; color:var(--ink); }
    .recent-meta  { font-size:0.68rem; color:var(--muted); margin-top:1px; }
    .recent-amount { font-size:0.82rem; font-weight:700; color:var(--green); flex-shrink:0; margin-left:8px; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);} }
    .fade-up { animation:fadeUp 0.3s ease both; }
    .d1{animation-delay:0.04s;} .d2{animation-delay:0.08s;} .d3{animation-delay:0.13s;}
</style>

<div class="sh-layout">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="sh-sidebar">
        <a href="{{ route('dashboard') }}" class="sh-logo">
            <div class="sh-logo-icon"><svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/></svg></div>
            <span class="sh-logo-text">Sheetsy</span>
        </a>
        <div class="sh-nav-section">
            <p class="sh-nav-label">General</p>
            <a href="{{ route('dashboard') }}" class="sh-nav-link">
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
            @forelse($sidebarColocations as $sc)
                <a href="{{ route('colocations.show', $sc) }}" class="sh-nav-link {{ $sc->id === $colocation->id ? 'active' : '' }}">
                    <span class="coloc-initial">{{ strtoupper(substr($sc->name,0,1)) }}</span>
                    <span style="overflow:hidden;text-overflow:ellipsis">{{ $sc->name }}</span>
                    @if($sc->status==='active')<span class="active-dot"></span>@endif
                </a>
            @empty
                <p style="font-size:0.75rem;color:var(--muted);padding:6px 8px;font-style:italic">No active colocation</p>
            @endforelse
        </div>
        <div class="sh-nav-section">
            <p class="sh-nav-label">Account</p>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="sh-nav-link danger">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
        <div class="sh-sidebar-footer">
            <div class="sh-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
            <div style="min-width:0">
                <p style="font-size:0.82rem;font-weight:700;color:var(--ink);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ auth()->user()->name }}</p>
                <p style="font-size:0.7rem;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </aside>

    {{-- ══ MAIN ══ --}}
    <main class="sh-main">

        <div class="sh-breadcrumb fade-up">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('colocations.show', $colocation) }}">{{ $colocation->name }}</a>
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="cur">Add Expense</span>
        </div>

        <div class="fade-up d1" style="margin-bottom:28px">
            <h1 class="sh-page-title">Add a new Expense 💸</h1>
            <p class="sh-page-sub">Adding to <strong style="color:var(--ink)">{{ $colocation->name }}</strong> — split equally between {{ $activeMembers->count() }} member(s).</p>
        </div>

        @if($errors->any())
            <div class="error-box fade-up"><p>Please fix the following errors:</p><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <div class="form-grid">

            {{-- FORM --}}
            <div class="sh-card fade-up d2">
                <form method="POST" action="{{ route('expenses.store', $colocation) }}">
                    @csrf

                    {{-- Title --}}
                    <div class="field">
                        <label for="title" class="sh-label">Title <span style="color:#ef4444">*</span></label>
                        <div class="input-wrap">
                            <span class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg></span>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Groceries, Electricity bill, Netflix…" required class="sh-input has-icon {{ $errors->has('title') ? 'border-red-400' : '' }}"/>
                        </div>
                        @error('title')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    {{-- Amount + Date --}}
                    <div class="two-col">
                        <div class="field">
                            <label for="amount" class="sh-label">Amount (MAD) <span style="color:#ef4444">*</span></label>
                            <div class="input-wrap">
                                <span class="prefix">MAD</span>
                                <input type="number" id="amount" name="amount" value="{{ old('amount') }}" placeholder="0.00" min="0.01" step="0.01" required oninput="updateSplitPreview()" class="sh-input has-prefix {{ $errors->has('amount') ? 'border-red-400' : '' }}"/>
                            </div>
                            @error('amount')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="date" class="sh-label">Date <span style="color:#ef4444">*</span></label>
                            <div class="input-wrap">
                                <span class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
                                <input type="date" id="date" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" required class="sh-input has-icon {{ $errors->has('expense_date') ? 'border-red-400' : '' }}"/>
                            </div>
                            @error('expense_date')<p class="field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="field">
                        <label for="category_id" class="sh-label">Category</label>
                        <div class="input-wrap">
                            <span class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg></span>
                            <select id="category_id" name="category_id" class="sh-input has-icon">
                                <option value="">— No category —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    {{-- Paid By --}}
                    <div class="field">
                        <label class="sh-label">Paid By <span style="color:#ef4444">*</span></label>
                        <p style="font-size:0.75rem;color:var(--muted);margin-bottom:10px">Who paid for this expense?</p>
                        <div class="member-grid">
                            @foreach($activeMembers as $membership)
                                <label class="member-option {{ old('paid_by', auth()->id()) == $membership->user->id ? 'selected' : '' }}" onclick="selectMember(this)">
                                    <input type="radio" name="paid_by" value="{{ $membership->user->id }}" {{ old('paid_by', auth()->id()) == $membership->user->id ? 'checked' : '' }}/>
                                    <div class="member-avatar {{ $membership->user->id === auth()->id() ? 'is-me' : 'is-other' }}">
                                        {{ strtoupper(substr($membership->user->name,0,1)) }}
                                    </div>
                                    <div style="min-width:0;flex:1">
                                        <p class="member-name">
                                            {{ $membership->user->name }}
                                            @if($membership->user->id === auth()->id())<span style="font-size:0.68rem;color:var(--green-mid);font-weight:500"> (you)</span>@endif
                                        </p>
                                        <p class="member-email">{{ $membership->user->email }}</p>
                                    </div>
                                    <span class="member-check {{ old('paid_by', auth()->id()) == $membership->user->id ? '' : 'hidden' }}">
                                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('paid_by')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <hr class="sh-divider">

                    <div style="display:flex;align-items:center;gap:12px">
                        <button type="submit" class="btn-primary">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Save Expense
                        </button>
                        <a href="{{ route('colocations.show', $colocation) }}" class="btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="fade-up d3">

                {{-- Split Preview --}}
                <div class="right-card">
                    <p class="right-card-label">Split Preview</p>
                    <div class="split-row" style="margin-bottom:6px">
                        <span style="font-size:0.8rem;color:var(--muted)">Total</span>
                        <span style="font-size:0.9rem;font-weight:700;color:var(--ink)" id="previewTotal">0.00 MAD</span>
                    </div>
                    <div class="split-row" style="margin-bottom:0">
                        <span style="font-size:0.8rem;color:var(--muted)">Split between</span>
                        <span style="font-size:0.8rem;font-weight:700;color:var(--ink)">{{ $activeMembers->count() }} member(s)</span>
                    </div>
                    <div class="split-divider"></div>
                    <p style="font-size:0.65rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px">Each person owes</p>
                    @foreach($activeMembers as $membership)
                    <div class="split-row">
                        <div class="split-row-meta">
                            <div class="split-mini-avatar {{ $membership->user->id === auth()->id() ? 'is-me' : 'is-other' }}" style="{{ $membership->user->id === auth()->id() ? 'background:var(--green)' : 'background:#9ca3af' }}">
                                {{ strtoupper(substr($membership->user->name,0,1)) }}
                            </div>
                            <span class="split-mini-name">{{ explode(' ', $membership->user->name)[0] }}</span>
                        </div>
                        <span class="split-amount-val split-amount">0.00 MAD</span>
                    </div>
                    @endforeach
                </div>

                {{-- Tips --}}
                <div class="tips-card">
                    <p class="tips-title">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                        How it works
                    </p>
                    @foreach([
                        'Expenses are split equally among all active members.',
                        'The payer gets credited automatically.',
                        'Balances update instantly after saving.',
                        'Filter expenses by month on the colocation page.',
                    ] as $tip)
                    <div class="tip-item">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        {{ $tip }}
                    </div>
                    @endforeach
                </div>

                {{-- Recent Expenses --}}
                @if($recentExpenses->count() > 0)
                <div class="right-card">
                    <p class="right-card-label">Recent Expenses</p>
                    @foreach($recentExpenses as $recent)
                    <div class="recent-row">
                        <div>
                            <p class="recent-title">{{ $recent->title }}</p>
                            <p class="recent-meta">{{ \Carbon\Carbon::parse($recent->date)->format('d M') }} · {{ $recent->payer->name }}</p>
                        </div>
                        <span class="recent-amount">{{ number_format($recent->amount, 2) }} MAD</span>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </main>
</div>

<script>
const memberCount = {{ $activeMembers->count() }};

function updateSplitPreview() {
    const amount    = parseFloat(document.getElementById('amount').value) || 0;
    const perPerson = memberCount > 0 ? amount / memberCount : 0;
    document.getElementById('previewTotal').textContent = amount.toFixed(2) + ' MAD';
    document.querySelectorAll('.split-amount').forEach(el => { el.textContent = perPerson.toFixed(2) + ' MAD'; });
}

function selectMember(label) {
    document.querySelectorAll('.member-option').forEach(el => {
        el.classList.remove('selected');
        el.querySelector('.member-check').classList.add('hidden');
    });
    label.classList.add('selected');
    label.querySelector('input[type="radio"]').checked = true;
    label.querySelector('.member-check').classList.remove('hidden');
}
</script>
</x-app-layout>