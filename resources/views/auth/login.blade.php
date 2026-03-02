<x-guest-layout>
<style>
    @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&family=playfair-display:700,900i&display=swap');
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --green:    #2D6A4F;
        --green-mid:#40916C;
        --green-lt: #52B788;
        --cream:    #F8FAF9;
        --ink:      #0D1F17;
        --muted:    #5A7A6A;
        --line:     #D8EDE3;
    }

    html, body {
        font-family: 'Figtree', sans-serif;
        background: var(--cream);
        min-height: 90vh; 
        width: 100%;
    }

    body::before {
        content: '';
        position: fixed; top: -150px; right: -150px;
        width: 600px; height: 600px; border-radius: 50%;
        background: radial-gradient(circle, rgba(149,213,178,0.22) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }
    body::after {
        content: '';
        position: fixed; bottom: -100px; left: -100px;
        width: 500px; height: 500px; border-radius: 50%;
        background: radial-gradient(circle, rgba(82,183,136,0.14) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }

    .page-center {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 24px;
        position: relative;
        z-index: 1;
    }

    .login-wrapper {
        display: flex;
        width: 100%; max-width: 960px;
        min-height: 560px;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 24px 80px rgba(45,106,79,0.14), 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--line);
        animation: fadeUp 0.4s ease both;
    }

    .form-panel {
        flex: 1;
        background: white;
        padding: 52px 48px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-logo {
        display: flex; align-items: center; gap: 8px;
        font-size: 1.1rem; font-weight: 800; color: var(--ink);
        text-decoration: none; letter-spacing: -0.03em;
        margin-bottom: 36px;
    }
    .form-logo-icon {
        width: 30px; height: 30px; border-radius: 8px;
        background: var(--green);
        display: flex; align-items: center; justify-content: center;
    }

    .form-heading {
        font-family: 'Playfair Display', serif;
        font-size: 2rem; font-weight: 900;
        color: var(--ink); line-height: 1.1;
        letter-spacing: -0.02em; margin-bottom: 8px;
    }
    .form-sub { font-size: 0.9rem; color: var(--muted); margin-bottom: 32px; line-height: 1.5; }

    .form-group { margin-bottom: 20px; }
    .form-label {
        display: block; font-size: 0.72rem; font-weight: 700;
        color: #374151; letter-spacing: 0.04em; margin-bottom: 6px; text-transform: uppercase;
    }
    .input-wrap { position: relative; }
    .input-icon {
        position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
        color: #9bb5a6; pointer-events: none; display: flex;
    }
    .input-icon svg { width: 16px; height: 16px; }

    .form-input {
        width: 100%; padding: 11px 14px 11px 40px;
        background: var(--cream); border: 1.5px solid var(--line);
        border-radius: 12px; font-family: 'Figtree', sans-serif;
        font-size: 0.875rem; color: var(--ink); outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .form-input:focus {
        border-color: var(--green-mid);
        box-shadow: 0 0 0 3px rgba(64,145,108,0.12);
        background: white;
    }
    .form-input::placeholder { color: #b0c9bc; }
    .input-error { margin-top: 6px; font-size: 0.75rem; color: #dc2626; }

    .form-row {
        display: flex; align-items: center;
        justify-content: space-between; margin-bottom: 24px;
    }
    .remember-label {
        display: flex; align-items: center; gap: 8px;
        font-size: 0.85rem; color: var(--muted); cursor: pointer;
    }
    .remember-label input[type="checkbox"] {
        width: 15px; height: 15px; accent-color: var(--green); cursor: pointer;
    }
    .forgot-link {
        font-size: 0.82rem; font-weight: 700; color: var(--green-mid);
        text-decoration: none; transition: color 0.15s;
    }
    .forgot-link:hover { color: var(--green); }

    .btn-submit {
        width: 100%; padding: 13px; background: var(--green); color: white;
        font-family: 'Figtree', sans-serif; font-size: 0.95rem; font-weight: 700;
        border: none; border-radius: 12px; cursor: pointer; transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(45,106,79,0.32);
        display: flex; align-items: center; justify-content: center; gap: 8px;
        margin-bottom: 20px;
    }
    .btn-submit:hover { background: #245740; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(45,106,79,0.38); }

    .form-footer { text-align: center; font-size: 0.875rem; color: var(--muted); }
    .form-footer a { color: var(--green-mid); font-weight: 700; text-decoration: none; }
    .form-footer a:hover { color: var(--green); }

    .session-status {
        margin-bottom: 16px; padding: 10px 14px; border-radius: 10px;
        background: #e8f7f0; border: 1px solid #b7e4cc;
        font-size: 0.82rem; font-weight: 600; color: var(--green-mid);
    }

    /* BRAND PANEL */
    .brand-panel {
        width: 400px;
        background: linear-gradient(160deg, var(--green) 0%, var(--green-mid) 55%, var(--green-lt) 100%);
        padding: 52px 44px;
        display: flex; flex-direction: column; justify-content: center;
        position: relative; overflow: hidden;
    }
    .brand-panel::before {
        content: ''; position: absolute; top: -80px; right: -80px;
        width: 260px; height: 260px; border-radius: 50%;
        background: rgba(255,255,255,0.07); pointer-events: none;
    }
    .brand-panel::after {
        content: ''; position: absolute; bottom: -60px; left: -40px;
        width: 200px; height: 200px; border-radius: 50%;
        background: rgba(255,255,255,0.05); pointer-events: none;
    }
    .brand-logo-mark {
        width: 50px; height: 50px; border-radius: 14px;
        background: rgba(255,255,255,0.18); margin-bottom: 24px;
        display: flex; align-items: center; justify-content: center;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .brand-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem; font-weight: 900; color: white;
        line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 10px;
    }
    .brand-title em { font-style: italic; color: rgba(255,255,255,0.72); }
    .brand-desc { font-size: 0.85rem; color: rgba(255,255,255,0.68); line-height: 1.65; margin-bottom: 32px; }

    .brand-features { display: flex; flex-direction: column; gap: 12px; }
    .brand-feature { display: flex; align-items: center; gap: 12px; }
    .brand-feature-icon {
        width: 34px; height: 34px; border-radius: 10px; flex-shrink: 0;
        background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.12);
        display: flex; align-items: center; justify-content: center;
    }
    .brand-feature-icon svg { width: 16px; height: 16px; color: white; }
    .brand-feature-text { font-size: 0.83rem; font-weight: 600; color: rgba(255,255,255,0.88); }
    .brand-feature-sub { font-size: 0.72rem; color: rgba(255,255,255,0.52); margin-top: 1px; }

    .brand-card {
        margin-top: 28px; background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.16); border-radius: 16px; padding: 16px 18px;
    }
    .brand-card-label {
        font-size: 0.62rem; font-weight: 700; color: rgba(255,255,255,0.5);
        text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 10px;
    }
    .brand-card-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
    .brand-card-row:last-child { margin-bottom: 0; }
    .brand-card-user { display: flex; align-items: center; gap: 7px; font-size: 0.76rem; font-weight: 600; color: rgba(255,255,255,0.82); }
    .brand-card-avatar {
        width: 20px; height: 20px; border-radius: 50%;
        background: rgba(255,255,255,0.22);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.55rem; font-weight: 800; color: white;
    }
    .brand-card-amount { font-size: 0.76rem; font-weight: 800; color: #95D5B2; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 720px) {
        .brand-panel { display: none; }
        .form-panel { padding: 36px 24px; }
        .page-center { padding: 20px 16px; align-items: flex-start; }
    }
</style>

<div class="page-center">
    <div class="login-wrapper">

        <!-- FORM -->
        <div class="form-panel">
            <a href="{{ url('/') }}" class="form-logo">
                <div class="form-logo-icon">
                    <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                        <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/>
                    </svg>
                </div>
                Sheetsy
            </a>

            <h1 class="form-heading">Welcome back.</h1>
            <p class="form-sub">Sign in to manage your shared expenses.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if (session('status'))
                    <div class="session-status">{{ session('status') }}</div>
                @endif

                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="form-input" placeholder="you@example.com"
                               required autofocus autocomplete="username" />
                    </div>
                    @error('email')<p class="input-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password"
                               class="form-input" placeholder="••••••••"
                               required autocomplete="current-password" />
                    </div>
                    @error('password')<p class="input-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" id="remember_me">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    Sign in
                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>

                @if (Route::has('register'))
                    <p class="form-footer">
                        Don't have an account? <a href="{{ route('register') }}">Register here</a>
                    </p>
                @endif
            </form>
        </div>

        <!-- BRAND PANEL -->
        <div class="brand-panel">
            <div class="brand-logo-mark">
                <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/>
                </svg>
            </div>

            <h2 class="brand-title">Split smarter,<br><em>live better.</em></h2>
            <p class="brand-desc">Track shared expenses, see who owes who, and settle up — all in one place.</p>

            <div class="brand-features">
                <div class="brand-feature">
                    <div class="brand-feature-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="brand-feature-text">Automatic cost splitting</div>
                        <div class="brand-feature-sub">Every dirham tracked, split fairly</div>
                    </div>
                </div>
                <div class="brand-feature">
                    <div class="brand-feature-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="brand-feature-text">Manage flatmates</div>
                        <div class="brand-feature-sub">Invite, remove, track reputation</div>
                    </div>
                </div>
                <div class="brand-feature">
                    <div class="brand-feature-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="brand-feature-text">One-click settle up</div>
                        <div class="brand-feature-sub">Mark payments as done instantly</div>
                    </div>
                </div>
            </div>

            <div class="brand-card">
                <div class="brand-card-label">💰 Recent payments</div>
                <div class="brand-card-row">
                    <div class="brand-card-user"><div class="brand-card-avatar">K</div>Karim → Youssef</div>
                    <div class="brand-card-amount">120 MAD</div>
                </div>
                <div class="brand-card-row">
                    <div class="brand-card-user"><div class="brand-card-avatar">L</div>Leila → Sara</div>
                    <div class="brand-card-amount">80 MAD</div>
                </div>
                <div class="brand-card-row">
                    <div class="brand-card-user"><div class="brand-card-avatar">A</div>Amine → Youssef</div>
                    <div class="brand-card-amount">95 MAD</div>
                </div>
            </div>
        </div>

    </div>
</div>
</x-guest-layout>