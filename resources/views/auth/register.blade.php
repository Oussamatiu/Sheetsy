<x-guest-layout>
<style>
    @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&family=playfair-display:700,900i&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --green:    #2D6A4F;
        --green-mid:#40916C;
        --green-lt: #52B788;
        --cream:    #F8FAF9;
        --ink:      #0D1F17;
        --muted:    #5A7A6A;
        --line:     #D8EDE3;
    }

    body {
        font-family: 'Figtree', sans-serif;
        background: var(--cream);
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 24px; position: relative; overflow: hidden;
    }
    body::before {
        content: ''; position: fixed; top: -150px; right: -150px;
        width: 600px; height: 600px; border-radius: 50%;
        background: radial-gradient(circle, rgba(149,213,178,0.22) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }
    body::after {
        content: ''; position: fixed; bottom: -100px; left: -100px;
        width: 500px; height: 500px; border-radius: 50%;
        background: radial-gradient(circle, rgba(82,183,136,0.14) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }

    .register-wrapper {
        position: relative; z-index: 1;
        display: flex; width: 100%; max-width: 980px;
        border-radius: 28px; overflow: hidden;
        box-shadow: 0 24px 80px rgba(45,106,79,0.14), 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--line);
        animation: fadeUp 0.4s ease both;
    }

    /* FORM PANEL */
    .form-panel {
        flex: 1; background: white;
        padding: 48px 48px;
        display: flex; flex-direction: column; justify-content: center;
    }
    .form-logo {
        display: flex; align-items: center; gap: 8px;
        font-size: 1.1rem; font-weight: 800; color: var(--ink);
        text-decoration: none; letter-spacing: -0.03em; margin-bottom: 28px;
    }
    .form-logo-icon {
        width: 30px; height: 30px; border-radius: 8px; background: var(--green);
        display: flex; align-items: center; justify-content: center;
    }
    .form-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.85rem; font-weight: 900; color: var(--ink);
        line-height: 1.1; letter-spacing: -0.02em; margin-bottom: 6px;
    }
    .form-sub { font-size: 0.875rem; color: var(--muted); margin-bottom: 24px; line-height: 1.5; }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-grid .full { grid-column: 1 / -1; }

    .form-label {
        display: block; font-size: 0.72rem; font-weight: 700;
        color: #374151; letter-spacing: 0.04em; margin-bottom: 6px; text-transform: uppercase;
    }
    .input-wrap { position: relative; }
    .input-icon {
        position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
        color: #9bb5a6; pointer-events: none; display: flex;
    }
    .input-icon svg { width: 15px; height: 15px; }
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
    .input-error { margin-top: 5px; font-size: 0.72rem; color: #dc2626; }

    .btn-submit {
        width: 100%; padding: 13px; background: var(--green); color: white;
        font-family: 'Figtree', sans-serif; font-size: 0.95rem; font-weight: 700;
        border: none; border-radius: 12px; cursor: pointer; transition: all 0.2s;
        box-shadow: 0 4px 14px rgba(45,106,79,0.32);
        display: flex; align-items: center; justify-content: center; gap: 8px;
        margin-top: 18px; margin-bottom: 16px;
    }
    .btn-submit:hover { background: #245740; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(45,106,79,0.38); }
    .form-footer { text-align: center; font-size: 0.875rem; color: var(--muted); }
    .form-footer a { color: var(--green-mid); font-weight: 700; text-decoration: none; transition: color 0.15s; }
    .form-footer a:hover { color: var(--green); }

    /* BRAND PANEL */
    .brand-panel {
        width: 390px;
        background: linear-gradient(160deg, var(--green) 0%, var(--green-mid) 55%, var(--green-lt) 100%);
        padding: 52px 44px; display: flex; flex-direction: column; justify-content: center;
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

    .brand-steps { display: flex; flex-direction: column; gap: 16px; }
    .brand-step { display: flex; align-items: flex-start; gap: 14px; }
    .brand-step-num {
        width: 28px; height: 28px; border-radius: 8px; flex-shrink: 0;
        background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem; font-weight: 800; color: white;
    }
    .brand-step-text { font-size: 0.83rem; font-weight: 600; color: rgba(255,255,255,0.88); padding-top: 4px; }
    .brand-step-sub { font-size: 0.72rem; color: rgba(255,255,255,0.52); margin-top: 2px; }

    .brand-trust {
        margin-top: 28px; background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.16);
        border-radius: 14px; padding: 14px 16px;
        display: flex; align-items: center; gap: 12px;
    }
    .brand-trust-avatars { display: flex; }
    .brand-trust-avatar {
        width: 26px; height: 26px; border-radius: 50%;
        background: rgba(255,255,255,0.22); border: 2px solid rgba(255,255,255,0.3);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.55rem; font-weight: 800; color: white; margin-left: -5px;
    }
    .brand-trust-avatar:first-child { margin-left: 0; }
    .brand-trust-text { font-size: 0.78rem; color: rgba(255,255,255,0.8); font-weight: 500; }
    .brand-trust-text strong { color: white; font-weight: 700; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 760px) {
        .brand-panel { display: none; }
        .form-panel { padding: 36px 24px; }
        .form-grid { grid-template-columns: 1fr; }
        body { padding: 16px; align-items: flex-start; padding-top: 32px; }
    }
</style>

<div class="register-wrapper">

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

        <h1 class="form-heading">Create your account.</h1>
        <p class="form-sub">Join hundreds of flatmates managing shared expenses effortlessly.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-grid">

                <!-- Name -->
                <div class="full">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="form-input" placeholder="Youssef Amrani"
                               required autofocus autocomplete="name" />
                    </div>
                    @error('name')<p class="input-error">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div class="full">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="form-input" placeholder="you@example.com"
                               required autocomplete="username" />
                    </div>
                    @error('email')<p class="input-error">{{ $message }}</p>@enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password"
                               class="form-input" placeholder="••••••••"
                               required autocomplete="new-password" />
                    </div>
                    @error('password')<p class="input-error">{{ $message }}</p>@enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="form-label">Confirm</label>
                    <div class="input-wrap">
                        <span class="input-icon">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="form-input" placeholder="••••••••"
                               required autocomplete="new-password" />
                    </div>
                    @error('password_confirmation')<p class="input-error">{{ $message }}</p>@enderror
                </div>

            </div>

            <button type="submit" class="btn-submit">
                Create my account
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>

            <p class="form-footer">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </p>
        </form>
    </div>

    <!-- BRAND PANEL -->
    <div class="brand-panel">
        <div class="brand-logo-mark">
            <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/>
            </svg>
        </div>

        <h2 class="brand-title">Start in<br><em>3 simple steps.</em></h2>
        <p class="brand-desc">Everything you need to manage your shared flat — set up in under 2 minutes.</p>

        <div class="brand-steps">
            <div class="brand-step">
                <div class="brand-step-num">1</div>
                <div>
                    <div class="brand-step-text">Create your colocation</div>
                    <div class="brand-step-sub">Name your flat and set it up instantly</div>
                </div>
            </div>
            <div class="brand-step">
                <div class="brand-step-num">2</div>
                <div>
                    <div class="brand-step-text">Invite your flatmates</div>
                    <div class="brand-step-sub">Send email invites with one click</div>
                </div>
            </div>
            <div class="brand-step">
                <div class="brand-step-num">3</div>
                <div>
                    <div class="brand-step-text">Track & settle expenses</div>
                    <div class="brand-step-sub">Add costs, see balances, mark as paid</div>
                </div>
            </div>
        </div>

        <div class="brand-trust">
            <div class="brand-trust-avatars">
                <div class="brand-trust-avatar">Y</div>
                <div class="brand-trust-avatar">S</div>
                <div class="brand-trust-avatar">A</div>
                <div class="brand-trust-avatar">K</div>
                <div class="brand-trust-avatar">+</div>
            </div>
            <div class="brand-trust-text">
                <strong>500+ flatmates</strong> already on Sheetsy
            </div>
        </div>
    </div>

</div>
</x-guest-layout>