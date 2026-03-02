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
    .sh-nav-link.dashed { border:1.5px dashed var(--mint); color:var(--green-mid); margin-top:6px; }
    .sh-nav-link.dashed:hover { background:#f0fdf4; }
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

    /* ── PAGE HEADER ── */
    .sh-page-title { font-family:'Playfair Display',serif; font-size:1.75rem; font-weight:900; color:var(--ink); letter-spacing:-0.02em; margin-bottom:4px; }
    .sh-page-sub { font-size:0.875rem; color:var(--muted); }

    /* ── GRID ── */
    .form-grid { display:grid; grid-template-columns:1fr 320px; gap:24px; align-items:start; }
    @media(max-width:1000px){.form-grid{grid-template-columns:1fr;}}

    /* ── CARDS ── */
    .sh-card { background:var(--white); border:1px solid var(--line); border-radius:20px; padding:28px 32px; box-shadow:0 2px 12px rgba(45,106,79,0.04); }
    .sh-card.is-green { background:#f0fdf4; border-color:#bbf7d0; }
    .sh-card.is-blue  { background:#eff6ff; border-color:#bfdbfe; }

    /* ── FORM ── */
    .field { margin-bottom:20px; }
    .sh-label { display:block; font-size:0.72rem; font-weight:700; color:#374151; letter-spacing:0.04em; margin-bottom:6px; text-transform:uppercase; }
    .sh-label span.opt { font-weight:400; text-transform:none; color:var(--muted); font-size:0.72rem; }
    .sh-input { width:100%; padding:11px 14px; background:var(--cream); border:1.5px solid var(--line); border-radius:12px; font-family:'Figtree',sans-serif; font-size:0.875rem; color:var(--ink); outline:none; transition:border-color 0.15s,box-shadow 0.15s; }
    .sh-input:focus { border-color:var(--green-mid); box-shadow:0 0 0 3px rgba(64,145,108,0.12); background:white; }
    .sh-input::placeholder { color:#b0c9bc; }
    .sh-input.has-icon { padding-left:42px; }
    .input-wrap { position:relative; }
    .input-wrap .icon { position:absolute; left:13px; top:50%; transform:translateY(-50%); color:#b0c9bc; pointer-events:none; }
    .input-wrap .icon svg { width:16px; height:16px; }
    .field-error { margin-top:5px; font-size:0.72rem; color:#dc2626; }
    .field-hint { margin-top:5px; font-size:0.72rem; color:var(--muted); }

    /* ── MAX MEMBERS RADIO ── */
    .members-row { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .members-option { cursor:pointer; }
    .members-option input { display:none; }
    .members-option span {
        display:flex; align-items:center; justify-content:center;
        width:42px; height:42px; border-radius:12px;
        border:1.5px solid var(--line); background:var(--cream);
        font-size:0.875rem; font-weight:700; color:var(--muted);
        transition:all 0.15s;
    }
    .members-option input:checked + span { border-color:var(--green-mid); background:#f0fdf4; color:var(--green); }
    .members-option:hover span { border-color:var(--mint); color:var(--green-mid); }

    /* ── BUTTONS ── */
    .btn-primary { display:inline-flex; align-items:center; gap:7px; padding:11px 22px; border-radius:12px; background:var(--green); color:white; font-size:0.875rem; font-weight:700; border:none; cursor:pointer; transition:all 0.2s; box-shadow:0 3px 10px rgba(45,106,79,0.28); }
    .btn-primary:hover { background:#245740; transform:translateY(-1px); }
    .btn-ghost { display:inline-flex; align-items:center; gap:7px; padding:11px 22px; border-radius:12px; background:var(--cream); color:var(--muted); border:1px solid var(--line); font-size:0.875rem; font-weight:700; text-decoration:none; cursor:pointer; transition:all 0.15s; }
    .btn-ghost:hover { background:var(--line); }
    .btn-primary svg, .btn-ghost svg { width:15px; height:15px; }

    /* ── DIVIDER ── */
    .sh-divider { border:none; border-top:1px solid var(--line); margin:24px 0; }

    /* ── INFO BOX ── */
    .info-box { display:flex; align-items:flex-start; gap:12px; padding:14px 16px; background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; }
    .info-box svg { width:18px; height:18px; color:#3b82f6; flex-shrink:0; margin-top:1px; }
    .info-box-title { font-size:0.82rem; font-weight:700; color:#1e40af; margin-bottom:2px; }
    .info-box-body  { font-size:0.75rem; color:#3b82f6; }

    /* ── RIGHT COLUMN ── */
    .preview-card { background:var(--white); border:1px solid var(--line); border-radius:18px; padding:24px; margin-bottom:16px; box-shadow:0 2px 8px rgba(45,106,79,0.04); }
    .preview-label { font-size:0.62rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:0.07em; margin-bottom:16px; }
    .preview-avatar { width:56px; height:56px; border-radius:16px; background:linear-gradient(135deg,var(--green-mid),var(--green)); display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:1.5rem; font-weight:900; color:white; flex-shrink:0; box-shadow:0 4px 14px rgba(45,106,79,0.25); transition:all 0.2s; }
    .preview-name { font-family:'Playfair Display',serif; font-size:1.15rem; font-weight:900; color:var(--ink); letter-spacing:-0.02em; }
    .badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:999px; font-size:0.7rem; font-weight:700; }
    .badge-green { background:#dcfce7; color:var(--green); }

    .tips-card { background:#f0fdf4; border:1px solid #bbf7d0; border-radius:18px; padding:20px; margin-bottom:16px; }
    .tips-title { font-size:0.82rem; font-weight:700; color:var(--green); margin-bottom:12px; display:flex; align-items:center; gap:6px; }
    .tips-title svg { width:15px; height:15px; }
    .tip-item { display:flex; align-items:flex-start; gap:8px; font-size:0.75rem; color:var(--green); margin-bottom:10px; line-height:1.5; }
    .tip-item:last-child { margin-bottom:0; }
    .tip-item svg { width:13px; height:13px; flex-shrink:0; margin-top:2px; color:var(--green-mid); }

    .steps-card { background:var(--white); border:1px solid var(--line); border-radius:18px; padding:24px; box-shadow:0 2px 8px rgba(45,106,79,0.04); }
    .step-item { display:flex; align-items:flex-start; gap:12px; margin-bottom:16px; }
    .step-item:last-child { margin-bottom:0; }
    .step-icon { width:28px; height:28px; border-radius:8px; background:var(--cream); border:1px solid var(--line); display:flex; align-items:center; justify-content:center; font-size:0.875rem; flex-shrink:0; }
    .step-title { font-size:0.82rem; font-weight:700; color:var(--ink); }
    .step-desc  { font-size:0.72rem; color:var(--muted); margin-top:1px; }

    /* ── ERRORS ── */
    .error-box { background:#fef2f2; border:1px solid #fecaca; border-radius:14px; padding:16px 20px; margin-bottom:24px; }
    .error-box p { font-size:0.82rem; font-weight:700; color:#dc2626; margin-bottom:6px; }
    .error-box li { font-size:0.8rem; color:#dc2626; margin-left:16px; list-style:disc; }

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
            @php $sidebarColocations = auth()->user()->memberships()->with('colocation')->whereNull('left_at')->get()->pluck('colocation')->filter(); @endphp
            @forelse($sidebarColocations as $sc)
                <a href="{{ route('colocations.show', $sc) }}" class="sh-nav-link">
                    <span class="coloc-initial">{{ strtoupper(substr($sc->name,0,1)) }}</span>
                    <span style="overflow:hidden;text-overflow:ellipsis">{{ $sc->name }}</span>
                    @if($sc->status==='active')<span class="active-dot"></span>@endif
                </a>
            @empty
                <p style="font-size:0.75rem;color:var(--muted);padding:6px 8px;font-style:italic">No active colocation</p>
            @endforelse
            <a href="{{ route('colocations.create') }}" class="sh-nav-link dashed active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Create Colocation
            </a>
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
            <span class="cur">Create Colocation</span>
        </div>

        <div class="fade-up d1" style="margin-bottom:28px">
            <h1 class="sh-page-title">Create a new Colocation 🏠</h1>
            <p class="sh-page-sub">Set up your shared living space and start managing expenses together.</p>
        </div>

        @if($errors->any())
            <div class="error-box fade-up"><p>Please fix the following errors:</p><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <div class="form-grid">

            {{-- FORM --}}
            <div class="sh-card fade-up d2">
                <form method="POST" action="{{ route('colocations.store') }}">
                    @csrf

                    <div class="field">
                        <label for="name" class="sh-label">Colocation Name <span style="color:#ef4444">*</span></label>
                        <div class="input-wrap">
                            <span class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg></span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Sunset Apartment, The Green House…" maxlength="80" required oninput="updatePreview(this.value)" class="sh-input has-icon {{ $errors->has('name') ? 'border-red-400' : '' }}"/>
                        </div>
                        @error('name')<p class="field-error">{{ $message }}</p>@enderror
                        <p class="field-hint">Choose a name that represents your living space.</p>
                    </div>

                    <div class="field">
                        <label for="description" class="sh-label">Description <span class="opt">(optional)</span></label>
                        <textarea id="description" name="description" rows="3" placeholder="Describe your colocation, house rules, or anything relevant…" class="sh-input" style="resize:none">{{ old('description') }}</textarea>
                        @error('description')<p class="field-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="field">
                        <label class="sh-label">Max Members <span class="opt">(optional)</span></label>
                        <div class="members-row">
                            @foreach([2,3,4,5,6,8] as $n)
                                <label class="members-option">
                                    <input type="radio" name="max_members" value="{{ $n }}" {{ old('max_members',4)==$n ? 'checked' : '' }}>
                                    <span>{{ $n }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="field-hint">Maximum number of members including yourself.</p>
                    </div>

                    <hr class="sh-divider">

                    <div class="info-box" style="margin-bottom:24px">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <div>
                            <p class="info-box-title">You will become the Owner</p>
                            <p class="info-box-body">As the owner, you can invite members, manage expenses, and administer the colocation.</p>
                        </div>
                    </div>

                    <div style="display:flex;align-items:center;gap:12px">
                        <button type="submit" class="btn-primary">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Create Colocation
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="fade-up d3">

                {{-- Live Preview --}}
                <div class="preview-card">
                    <p class="preview-label">Live Preview</p>
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:14px">
                        <div class="preview-avatar" id="previewAvatar">🏠</div>
                        <div>
                            <p class="preview-name" id="previewName">Your Colocation</p>
                            <span class="badge badge-green" style="margin-top:5px;display:inline-flex">● Active</span>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:6px">
                        <div style="display:flex;align-items:center;gap:8px;font-size:0.8rem;color:var(--muted)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;color:var(--line)"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Owner: <strong style="color:var(--ink)">{{ auth()->user()->name }}</strong>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;font-size:0.8rem;color:var(--muted)">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;color:var(--line)"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            1 member (just you)
                        </div>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="tips-card">
                    <p class="tips-title">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                        Quick Tips
                    </p>
                    @foreach([
                        'You can only be in one active colocation at a time.',
                        'After creation, invite members via email link.',
                        'As owner, you can create categories and manage expenses.',
                        'Members can leave anytime, but owners must transfer ownership first.',
                        'Leaving or cancelling affects your reputation score.',
                    ] as $tip)
                    <div class="tip-item">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        {{ $tip }}
                    </div>
                    @endforeach
                </div>

                {{-- What happens next --}}
                <div class="steps-card">
                    <p class="preview-label">What happens next?</p>
                    @foreach([
                        ['✅','Colocation created','You become the owner automatically.'],
                        ['✉️','Invite members','Send email invitations with a unique link.'],
                        ['💸','Add expenses','Track shared costs and who paid.'],
                        ['⚖️','Settle up','View balances and mark payments done.'],
                    ] as $step)
                    <div class="step-item">
                        <div class="step-icon">{{ $step[0] }}</div>
                        <div><p class="step-title">{{ $step[1] }}</p><p class="step-desc">{{ $step[2] }}</p></div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </main>
</div>

<script>
function updatePreview(val) {
    const nameEl   = document.getElementById('previewName');
    const avatarEl = document.getElementById('previewAvatar');
    if (!val.trim()) {
        nameEl.textContent   = 'Your Colocation';
        avatarEl.textContent = '🏠';
        avatarEl.style.fontSize = '1.5rem';
    } else {
        nameEl.textContent   = val;
        avatarEl.textContent = val.charAt(0).toUpperCase();
        avatarEl.style.fontSize = '1.75rem';
    }
}
</script>
</x-app-layout>