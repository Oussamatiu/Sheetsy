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
    .sh-breadcrumb a { color:var(--muted); text-decoration:none; transition:color 0.15s; }
    .sh-breadcrumb a:hover { color:var(--green-mid); }
    .sh-breadcrumb .sep { color:var(--line); }
    .sh-breadcrumb .cur { color:var(--ink); font-weight:700; }
    .sh-breadcrumb svg { width:13px; height:13px; }

    /* ── HERO ── */
    .profile-hero { background:var(--white); border:1px solid var(--line); border-radius:20px; padding:28px 32px; margin-bottom:24px; display:flex; align-items:center; gap:22px; box-shadow:0 2px 12px rgba(45,106,79,0.04); }
    .profile-hero-avatar { width:68px; height:68px; border-radius:20px; background:linear-gradient(135deg,var(--green-mid),var(--green)); display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:900; color:white; flex-shrink:0; box-shadow:0 6px 18px rgba(45,106,79,0.25); }
    .profile-hero-name { font-family:'Playfair Display',serif; font-size:1.3rem; font-weight:900; color:var(--ink); letter-spacing:-0.02em; margin-bottom:4px; }
    .profile-hero-meta { font-size:0.82rem; color:var(--muted); margin-bottom:10px; }
    .profile-hero-badges { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }

    /* ── CARDS ── */
    .sh-card { background:var(--white); border:1px solid var(--line); border-radius:20px; padding:28px 32px; margin-bottom:20px; box-shadow:0 2px 12px rgba(45,106,79,0.04); }
    .sh-card.is-danger { border-color:#fecaca; }
    .sh-card-header { display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:20px; border-bottom:1px solid var(--line); }
    .sh-card.is-danger .sh-card-header { border-color:#fef2f2; }
    .sh-card-icon { width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .sh-card-icon svg { width:18px; height:18px; }
    .sh-card-icon.green { background:#f0fdf4; } .sh-card-icon.green svg { color:var(--green-mid); }
    .sh-card-icon.blue  { background:#eff6ff; } .sh-card-icon.blue svg  { color:#3b82f6; }
    .sh-card-icon.red   { background:#fef2f2; } .sh-card-icon.red svg   { color:#ef4444; }
    .sh-card-title { font-size:0.95rem; font-weight:700; color:var(--ink); }
    .sh-card-sub { font-size:0.75rem; color:var(--muted); margin-top:2px; }

    /* ── FORM ── */
    .field { margin-bottom:20px; }
    .sh-label { display:block; font-size:0.72rem; font-weight:700; color:#374151; letter-spacing:0.04em; margin-bottom:6px; text-transform:uppercase; }
    .sh-input { width:100%; padding:11px 14px; background:var(--cream); border:1.5px solid var(--line); border-radius:12px; font-family:'Figtree',sans-serif; font-size:0.875rem; color:var(--ink); outline:none; transition:border-color 0.15s,box-shadow 0.15s; }
    .sh-input:focus { border-color:var(--green-mid); box-shadow:0 0 0 3px rgba(64,145,108,0.12); background:white; }
    .sh-input::placeholder { color:#b0c9bc; }
    .field-error { margin-top:5px; font-size:0.72rem; color:#dc2626; }

    /* ── BUTTONS ── */
    .btn-primary { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:12px; background:var(--green); color:white; font-size:0.875rem; font-weight:700; border:none; cursor:pointer; transition:all 0.2s; box-shadow:0 3px 10px rgba(45,106,79,0.28); }
    .btn-primary:hover { background:#245740; transform:translateY(-1px); }
    .btn-danger { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:12px; background:#fef2f2; color:#dc2626; border:1px solid #fecaca; font-size:0.875rem; font-weight:700; cursor:pointer; transition:all 0.15s; }
    .btn-danger:hover { background:#fee2e2; }
    .btn-secondary { display:inline-flex; align-items:center; gap:7px; padding:10px 20px; border-radius:12px; background:var(--cream); color:var(--muted); border:1px solid var(--line); font-size:0.875rem; font-weight:700; cursor:pointer; transition:all 0.15s; }
    .btn-secondary:hover { background:var(--line); }
    .btn-primary svg, .btn-danger svg, .btn-secondary svg { width:15px; height:15px; }

    /* ── BADGES ── */
    .badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:999px; font-size:0.7rem; font-weight:700; }
    .badge-green { background:#dcfce7; color:var(--green); }
    .badge-blue  { background:#dbeafe; color:#1d4ed8; }
    .badge-red   { background:#fee2e2; color:#dc2626; }

    /* ── VERIFY ALERT ── */
    .verify-alert { display:flex; align-items:center; gap:10px; margin-top:10px; padding:10px 14px; background:#fefce8; border:1px solid #fde68a; border-radius:10px; font-size:0.8rem; color:#92400e; }
    .verify-alert button { font-weight:700; text-decoration:underline; cursor:pointer; background:none; border:none; color:#92400e; padding:0; }

    /* ── MODAL ── */
    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); backdrop-filter:blur(2px); z-index:50; align-items:center; justify-content:center; }
    .modal-overlay.open { display:flex; }
    .modal-box { background:white; border-radius:24px; padding:36px; width:100%; max-width:440px; box-shadow:0 24px 60px rgba(0,0,0,0.15); animation:fadeUp 0.25s ease both; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);} }
    .fade-up { animation:fadeUp 0.3s ease both; }
    .d1{animation-delay:0.04s;} .d2{animation-delay:0.08s;} .d3{animation-delay:0.12s;}
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
            <a href="{{ route('profile.edit') }}" class="sh-nav-link active">
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
            <span class="cur">My Profile</span>
        </div>

        {{-- Hero --}}
        <div class="profile-hero fade-up d1">
            <div class="profile-hero-avatar">{{ strtoupper(substr($user->name,0,1)) }}</div>
            <div>
                <p class="profile-hero-name">{{ $user->name }}</p>
                <p class="profile-hero-meta">{{ $user->email }}</p>
                <div class="profile-hero-badges">
                    <span class="badge {{ ($user->reputation_score ?? 0) >= 0 ? 'badge-green' : 'badge-red' }}">
                        ❤️ Rep: {{ ($user->reputation_score ?? 0) >= 0 ? '+' : '' }}{{ $user->reputation_score ?? 0 }}
                    </span>
                    <span class="badge badge-blue">🏠 {{ $sidebarColocations->count() }} active colocation(s)</span>
                </div>
            </div>
        </div>

        {{-- Profile Info --}}
        <div class="sh-card fade-up d1">
            <div class="sh-card-header">
                <div class="sh-card-icon green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
                <div><p class="sh-card-title">Profile Information</p><p class="sh-card-sub">Update your name and email address.</p></div>
            </div>
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>
            <form method="post" action="{{ route('profile.update') }}">
                @csrf @method('patch')
                <div class="field">
                    <label for="name" class="sh-label">Full Name</label>
                    <input id="name" name="name" type="text" class="sh-input" value="{{ old('name',$user->name) }}" required autofocus autocomplete="name"/>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="email" class="sh-label">Email Address</label>
                    <input id="email" name="email" type="email" class="sh-input" value="{{ old('email',$user->email) }}" required autocomplete="username"/>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="verify-alert">
                            <svg fill="currentColor" viewBox="0 0 20 20" style="width:16px;height:16px;flex-shrink:0"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            Your email is unverified.
                            <button form="send-verification">Resend verification email</button>
                        </div>
                        @if (session('status') === 'verification-link-sent')
                            <p style="margin-top:8px;font-size:0.78rem;color:var(--green);font-weight:600">✅ Verification link sent.</p>
                        @endif
                    @endif
                </div>
                <div style="display:flex;align-items:center;gap:12px;margin-top:8px">
                    <button type="submit" class="btn-primary">Save Changes</button>
                    @if (session('status') === 'profile-updated')
                        <span style="font-size:0.82rem;color:var(--green);font-weight:600" x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)">✅ Saved</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Password --}}
        <div class="sh-card fade-up d2">
            <div class="sh-card-header">
                <div class="sh-card-icon blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>
                <div><p class="sh-card-title">Update Password</p><p class="sh-card-sub">Use a long, random password to stay secure.</p></div>
            </div>
            <form method="post" action="{{ route('password.update') }}">
                @csrf @method('put')
                <div class="field">
                    <label for="current_password" class="sh-label">Current Password</label>
                    <input id="current_password" name="current_password" type="password" class="sh-input" autocomplete="current-password" placeholder="••••••••"/>
                    @if($errors->updatePassword->get('current_password'))<p class="field-error">{{ $errors->updatePassword->first('current_password') }}</p>@endif
                </div>
                <div class="field">
                    <label for="new_password" class="sh-label">New Password</label>
                    <input id="new_password" name="password" type="password" class="sh-input" autocomplete="new-password" placeholder="••••••••"/>
                    @if($errors->updatePassword->get('password'))<p class="field-error">{{ $errors->updatePassword->first('password') }}</p>@endif
                </div>
                <div class="field">
                    <label for="password_confirmation" class="sh-label">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="sh-input" autocomplete="new-password" placeholder="••••••••"/>
                    @if($errors->updatePassword->get('password_confirmation'))<p class="field-error">{{ $errors->updatePassword->first('password_confirmation') }}</p>@endif
                </div>
                <div style="display:flex;align-items:center;gap:12px;margin-top:8px">
                    <button type="submit" class="btn-primary">Update Password</button>
                    @if (session('status') === 'password-updated')
                        <span style="font-size:0.82rem;color:var(--green);font-weight:600" x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)">✅ Updated</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Delete Account --}}
        <div class="sh-card is-danger fade-up d3">
            <div class="sh-card-header">
                <div class="sh-card-icon red"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></div>
                <div><p class="sh-card-title">Delete Account</p><p class="sh-card-sub">Permanently delete your account and all data.</p></div>
            </div>
            <p style="font-size:0.875rem;color:var(--muted);margin-bottom:20px;line-height:1.6">Once your account is deleted, all resources and data will be permanently removed. Please download any data you wish to keep before proceeding.</p>
            <button class="btn-danger" onclick="document.getElementById('deleteModal').classList.add('open')">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Delete My Account
            </button>
        </div>

    </main>
</div>

{{-- Delete Modal --}}
<div class="modal-overlay {{ $errors->userDeletion->isNotEmpty() ? 'open' : '' }}" id="deleteModal">
    <div class="modal-box">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px">
            <div style="width:48px;height:48px;border-radius:14px;background:#fee2e2;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:22px;height:22px;color:#dc2626"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p style="font-family:'Playfair Display',serif;font-size:1.15rem;font-weight:900;color:var(--ink)">Delete your account?</p>
                <p style="font-size:0.8rem;color:var(--muted);margin-top:2px">This action cannot be undone.</p>
            </div>
        </div>
        <p style="font-size:0.85rem;color:var(--muted);margin-bottom:20px;line-height:1.6">All your data including colocations, expenses, and memberships will be permanently deleted. Please enter your password to confirm.</p>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf @method('delete')
            <div class="field">
                <label class="sh-label">Password</label>
                <input name="password" type="password" class="sh-input" placeholder="Enter your password to confirm"/>
                @if($errors->userDeletion->get('password'))<p class="field-error">{{ $errors->userDeletion->first('password') }}</p>@endif
            </div>
            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px">
                <button type="button" class="btn-secondary" onclick="document.getElementById('deleteModal').classList.remove('open')">Cancel</button>
                <button type="submit" class="btn-danger">Yes, Delete My Account</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>