<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sheetsy — Split smarter, live better</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&family=playfair-display:700,900i&display=swap" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:    #2D6A4F;
            --green-mid:#40916C;
            --green-lt: #52B788;
            --mint:     #95D5B2;
            --cream:    #F8FAF9;
            --ink:      #0D1F17;
            --muted:    #5A7A6A;
            --line:     #D8EDE3;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Figtree', sans-serif;
            background: var(--cream);
            color: var(--ink);
            overflow-x: hidden;
        }

        /* ─── NAV ─── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 48px;
            background: rgba(248,250,249,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
        }
        .nav-logo {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.25rem; font-weight: 800; color: var(--ink);
            text-decoration: none; letter-spacing: -0.03em;
        }
        .nav-logo-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: var(--green);
            display: flex; align-items: center; justify-content: center;
        }
        .nav-links { display: flex; align-items: center; gap: 8px; }
        .nav-link {
            padding: 8px 18px; border-radius: 8px;
            font-size: 0.875rem; font-weight: 600; color: var(--muted);
            text-decoration: none; transition: all 0.15s;
        }
        .nav-link:hover { color: var(--green); background: #edf7f2; }
        .nav-cta {
            padding: 8px 20px; border-radius: 10px;
            background: var(--green); color: white;
            font-size: 0.875rem; font-weight: 700;
            text-decoration: none; transition: all 0.15s;
            box-shadow: 0 2px 8px rgba(45,106,79,0.3);
        }
        .nav-cta:hover { background: #245740; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(45,106,79,0.35); }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
            position: relative; overflow: hidden;
        }

        /* Decorative blobs */
        .hero::before {
            content: '';
            position: absolute; top: -120px; right: -120px;
            width: 600px; height: 600px; border-radius: 50%;
            background: radial-gradient(circle, rgba(149,213,178,0.25) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute; bottom: -80px; left: -80px;
            width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(82,183,136,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #e8f7f0; border: 1px solid #b7e4cc;
            color: var(--green-mid); font-size: 0.78rem; font-weight: 700;
            padding: 6px 14px; border-radius: 999px; letter-spacing: 0.04em;
            text-transform: uppercase; margin-bottom: 28px;
            animation: fadeUp 0.5s ease both;
        }
        .hero-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green-lt); }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 7vw, 6rem);
            font-weight: 900; line-height: 1.05;
            letter-spacing: -0.03em; color: var(--ink);
            max-width: 900px; margin-bottom: 24px;
            animation: fadeUp 0.5s 0.1s ease both;
        }
        .hero-title em {
            font-style: italic; color: var(--green-mid);
        }

        .hero-sub {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: var(--muted); max-width: 560px;
            line-height: 1.7; margin-bottom: 44px;
            animation: fadeUp 0.5s 0.2s ease both;
        }

        .hero-actions {
            display: flex; gap: 14px; flex-wrap: wrap;
            justify-content: center;
            animation: fadeUp 0.5s 0.3s ease both;
        }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green); color: white;
            font-size: 1rem; font-weight: 700; padding: 14px 32px;
            border-radius: 14px; text-decoration: none; border: none;
            cursor: pointer; transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(45,106,79,0.35);
        }
        .btn-primary:hover { background: #245740; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(45,106,79,0.4); }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            background: white; color: var(--ink);
            font-size: 1rem; font-weight: 700; padding: 14px 32px;
            border-radius: 14px; text-decoration: none;
            border: 1.5px solid var(--line); transition: all 0.2s;
        }
        .btn-secondary:hover { border-color: var(--mint); background: #f0fbf5; transform: translateY(-2px); }

        /* ─── HERO CARD PREVIEW ─── */
        .hero-preview {
            margin-top: 72px; width: 100%; max-width: 860px;
            animation: fadeUp 0.6s 0.4s ease both;
        }
        .preview-card {
            background: white; border-radius: 24px;
            border: 1px solid var(--line);
            box-shadow: 0 20px 60px rgba(45,106,79,0.1), 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .preview-topbar {
            background: #f2f8f4; border-bottom: 1px solid var(--line);
            padding: 14px 20px; display: flex; align-items: center; gap: 8px;
        }
        .preview-dot { width: 10px; height: 10px; border-radius: 50%; }
        .preview-url {
            flex: 1; background: white; border-radius: 6px;
            padding: 5px 12px; font-size: 0.72rem; color: #999;
            border: 1px solid var(--line); margin: 0 12px;
        }
        .preview-body { padding: 28px; display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; }
        .preview-stat {
            background: var(--cream); border-radius: 14px;
            padding: 18px; border: 1px solid var(--line);
        }
        .preview-stat-label { font-size: 0.65rem; font-weight: 700; color: #9bb5a6; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px; }
        .preview-stat-value { font-size: 1.5rem; font-weight: 800; color: var(--ink); }
        .preview-stat-value.positive { color: var(--green-mid); }
        .preview-stat-value.negative { color: #e05252; }
        .preview-stat-unit { font-size: 0.75rem; font-weight: 600; color: #9bb5a6; margin-left: 2px; }
        .preview-row { grid-column: 1 / -1; display: flex; flex-direction: column; gap: 10px; }
        .preview-expense {
            display: flex; align-items: center; justify-content: space-between;
            background: white; border-radius: 12px; padding: 12px 16px;
            border: 1px solid var(--line);
        }
        .preview-expense-left { display: flex; align-items: center; gap: 12px; }
        .preview-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 700; color: white;
        }
        .preview-expense-info { }
        .preview-expense-title { font-size: 0.85rem; font-weight: 600; color: var(--ink); }
        .preview-expense-sub { font-size: 0.7rem; color: #9bb5a6; margin-top: 1px; }
        .preview-expense-amount { font-size: 0.9rem; font-weight: 800; color: var(--green-mid); }
        .preview-badge { font-size: 0.65rem; font-weight: 700; padding: 3px 8px; border-radius: 999px; }
        .badge-pending { background: #fff3e0; color: #e07b00; }
        .badge-paid { background: #e8f7f0; color: var(--green-mid); }

        /* ─── LOGOS / SOCIAL PROOF ─── */
        .social-proof {
            padding: 40px 24px;
            text-align: center; border-top: 1px solid var(--line);
        }
        .social-proof p { font-size: 0.78rem; font-weight: 700; color: #9bb5a6; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 20px; }
        .avatars-row { display: flex; align-items: center; justify-content: center; gap: 0; }
        .social-avatar {
            width: 38px; height: 38px; border-radius: 50%; border: 2px solid white;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 800; color: white; margin-left: -8px;
        }
        .social-text { margin-left: 16px; font-size: 0.875rem; font-weight: 600; color: var(--muted); }
        .social-text strong { color: var(--ink); }

        /* ─── HOW IT WORKS ─── */
        .section { padding: 100px 24px; max-width: 1100px; margin: 0 auto; }
        .section-label {
            display: inline-block; font-size: 0.75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.1em;
            color: var(--green-mid); margin-bottom: 16px;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem); font-weight: 900;
            line-height: 1.1; letter-spacing: -0.02em; color: var(--ink);
            margin-bottom: 16px;
        }
        .section-sub { font-size: 1rem; color: var(--muted); max-width: 480px; line-height: 1.7; }

        .steps {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 32px; margin-top: 64px;
        }
        .step {
            position: relative; padding: 36px 32px;
            background: white; border-radius: 20px;
            border: 1px solid var(--line);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .step:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(45,106,79,0.1); }
        .step-num {
            width: 44px; height: 44px; border-radius: 12px;
            background: linear-gradient(135deg, var(--green), var(--green-lt));
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; font-weight: 900; color: white;
            margin-bottom: 20px; box-shadow: 0 4px 12px rgba(45,106,79,0.3);
        }
        .step-title { font-size: 1.1rem; font-weight: 700; color: var(--ink); margin-bottom: 10px; }
        .step-desc { font-size: 0.9rem; color: var(--muted); line-height: 1.65; }
        .step-connector {
            position: absolute; top: 58px; right: -18px;
            width: 36px; height: 2px; background: var(--line);
            z-index: 1;
        }
        .step-connector::after {
            content: ''; position: absolute; right: 0; top: -3px;
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--mint);
        }

        /* ─── FEATURES ─── */
        .features-grid {
            display: grid; grid-template-columns: repeat(2, 1fr);
            gap: 24px; margin-top: 64px;
        }
        .feature-card {
            padding: 36px; background: white; border-radius: 20px;
            border: 1px solid var(--line); position: relative; overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 16px 48px rgba(45,106,79,0.1); }
        .feature-card.large { grid-column: 1 / -1; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
        .feature-icon {
            width: 48px; height: 48px; border-radius: 14px; margin-bottom: 20px;
            display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
        }
        .fi-green { background: #e8f7f0; }
        .fi-blue  { background: #e8f0ff; }
        .fi-amber { background: #fff8e0; }
        .fi-rose  { background: #ffe8ec; }
        .feature-title { font-size: 1.15rem; font-weight: 700; color: var(--ink); margin-bottom: 10px; }
        .feature-desc { font-size: 0.9rem; color: var(--muted); line-height: 1.65; }

        /* mini payments preview inside feature card */
        .mini-payments { margin-top: 20px; display: flex; flex-direction: column; gap: 8px; }
        .mini-pay-row {
            display: flex; align-items: center; justify-content: space-between;
            background: var(--cream); border-radius: 10px; padding: 10px 14px;
            border: 1px solid var(--line);
        }
        .mini-pay-left { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; font-weight: 600; color: var(--ink); }
        .mini-pay-amount { font-size: 0.8rem; font-weight: 800; color: var(--green-mid); }
        .mini-dot { width: 22px; height: 22px; border-radius: 50%; font-size: 0.6rem; font-weight: 700; color: white; display: flex; align-items: center; justify-content: center; }

        /* ─── TESTIMONIALS ─── */
        .testimonials-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 24px; margin-top: 64px;
        }
        .testimonial {
            padding: 32px; background: white; border-radius: 20px;
            border: 1px solid var(--line);
        }
        .testimonial-stars { color: #f59e0b; font-size: 0.85rem; letter-spacing: 1px; margin-bottom: 16px; }
        .testimonial-text { font-size: 0.9rem; color: var(--muted); line-height: 1.7; margin-bottom: 20px; font-style: italic; }
        .testimonial-author { display: flex; align-items: center; gap: 10px; }
        .testimonial-avatar { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; color: white; }
        .testimonial-name { font-size: 0.875rem; font-weight: 700; color: var(--ink); }
        .testimonial-role { font-size: 0.75rem; color: #9bb5a6; }

        /* ─── CTA BANNER ─── */
        .cta-banner {
            margin: 0 24px 100px;
            max-width: 1100px; margin-left: auto; margin-right: auto;
            background: linear-gradient(135deg, var(--green) 0%, var(--green-mid) 60%, var(--green-lt) 100%);
            border-radius: 28px; padding: 72px 64px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 40px; flex-wrap: wrap;
            position: relative; overflow: hidden;
        }
        .cta-banner::before {
            content: ''; position: absolute; top: -60px; right: -60px;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(255,255,255,0.06); pointer-events: none;
        }
        .cta-banner::after {
            content: ''; position: absolute; bottom: -40px; left: 40%;
            width: 200px; height: 200px; border-radius: 50%;
            background: rgba(255,255,255,0.04); pointer-events: none;
        }
        .cta-text h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 900;
            color: white; line-height: 1.15; margin-bottom: 12px;
        }
        .cta-text p { font-size: 1rem; color: rgba(255,255,255,0.75); line-height: 1.6; }
        .btn-white {
            display: inline-flex; align-items: center; gap: 8px;
            background: white; color: var(--green);
            font-size: 1rem; font-weight: 800; padding: 16px 36px;
            border-radius: 14px; text-decoration: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            transition: all 0.2s; white-space: nowrap;
        }
        .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,0.2); }

        /* ─── FOOTER ─── */
        footer {
            border-top: 1px solid var(--line); padding: 40px 48px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 16px;
        }
        .footer-logo { font-weight: 800; font-size: 1rem; color: var(--ink); letter-spacing: -0.02em; }
        .footer-copy { font-size: 0.8rem; color: #9bb5a6; }
        .footer-links { display: flex; gap: 24px; }
        .footer-links a { font-size: 0.8rem; color: #9bb5a6; text-decoration: none; transition: color 0.15s; }
        .footer-links a:hover { color: var(--green); }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            nav { padding: 14px 20px; }
            .steps { grid-template-columns: 1fr; }
            .step-connector { display: none; }
            .features-grid { grid-template-columns: 1fr; }
            .feature-card.large { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .cta-banner { padding: 48px 32px; }
            .preview-body { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

    <!-- NAV -->
    <nav>
        <a href="/" class="nav-logo">
            <div class="nav-logo-icon">
                <svg width="18" height="18" fill="white" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 5.9 16.17 3.82 21.34L5.71 22l1-2.3A4.49 4.49 0 008 20C19 20 22 3 22 3c-1 2-8 2-13 2a5 5 0 00-5 5c0 5 5 5 5 5s0-5 8-7z"/>
                </svg>
            </div>
            Sheetsy
        </a>
        <div class="nav-links">
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-cta">Get started free</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            No more awkward money talks
        </div>
        <h1 class="hero-title">
            Split bills with your<br><em>flatmates, effortlessly.</em>
        </h1>
        <p class="hero-sub">
            Sheetsy tracks shared expenses, calculates who owes who, and sends payment reminders — so you can focus on living together, not arguing about rent.
        </p>
        <div class="hero-actions">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">
                    Go to Dashboard
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">
                    Start for free
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn-secondary">
                    Sign in
                </a>
            @endauth
        </div>

        <!-- App Preview -->
        <div class="hero-preview">
            <div class="preview-card">
                <div class="preview-topbar">
                    <div class="preview-dot" style="background:#ff5f57"></div>
                    <div class="preview-dot" style="background:#ffbd2e"></div>
                    <div class="preview-dot" style="background:#28c840"></div>
                    <div class="preview-url">sheetsy.app/colocations/villa-verde</div>
                </div>
                <div class="preview-body">
                    <div class="preview-stat">
                        <div class="preview-stat-label">Total Expenses</div>
                        <div class="preview-stat-value">2,840<span class="preview-stat-unit">MAD</span></div>
                    </div>
                    <div class="preview-stat">
                        <div class="preview-stat-label">I Paid</div>
                        <div class="preview-stat-value">1,100<span class="preview-stat-unit">MAD</span></div>
                    </div>
                    <div class="preview-stat">
                        <div class="preview-stat-label">My Balance</div>
                        <div class="preview-stat-value positive">+140<span class="preview-stat-unit">MAD</span></div>
                    </div>
                    <div class="preview-stat">
                        <div class="preview-stat-label">Members</div>
                        <div class="preview-stat-value">4</div>
                    </div>
                    <div class="preview-row">
                        <div class="preview-expense">
                            <div class="preview-expense-left">
                                <div class="preview-avatar" style="background:#2D6A4F">Y</div>
                                <div class="preview-expense-info">
                                    <div class="preview-expense-title">Electricity — April</div>
                                    <div class="preview-expense-sub">Paid by Youssef · 3 Apr 2025</div>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:10px">
                                <span class="preview-badge badge-pending">⏳ Pending</span>
                                <div class="preview-expense-amount">480 MAD</div>
                            </div>
                        </div>
                        <div class="preview-expense">
                            <div class="preview-expense-left">
                                <div class="preview-avatar" style="background:#e07b00">S</div>
                                <div class="preview-expense-info">
                                    <div class="preview-expense-title">Groceries Week 14</div>
                                    <div class="preview-expense-sub">Paid by Sara · 5 Apr 2025</div>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:10px">
                                <span class="preview-badge badge-paid">✅ Paid</span>
                                <div class="preview-expense-amount">320 MAD</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SOCIAL PROOF -->
    <div class="social-proof">
        <p>Trusted by flatmates across Morocco</p>
        <div style="display:flex;align-items:center;justify-content:center;gap:0">
            <div class="avatars-row">
                <div class="social-avatar" style="background:#2D6A4F">A</div>
                <div class="social-avatar" style="background:#e07b00">B</div>
                <div class="social-avatar" style="background:#1d4ed8">C</div>
                <div class="social-avatar" style="background:#9333ea">D</div>
                <div class="social-avatar" style="background:#dc2626">E</div>
            </div>
            <span class="social-text"><strong>500+</strong> flatmates using Sheetsy</span>
        </div>
    </div>

    <!-- HOW IT WORKS -->
    <section class="section">
        <span class="section-label">How it works</span>
        <h2 class="section-title">From move-in to move-out,<br>every dirham tracked.</h2>
        <p class="section-sub">Three simple steps and your whole colocation is financially organized.</p>

        <div class="steps">
            <div class="step">
                <div class="step-connector"></div>
                <div class="step-num">1</div>
                <div class="step-title">Create your colocation</div>
                <div class="step-desc">Set up your shared flat in seconds. Invite your flatmates by email and they're in — no friction, no confusion.</div>
            </div>
            <div class="step">
                <div class="step-connector"></div>
                <div class="step-num">2</div>
                <div class="step-title">Log shared expenses</div>
                <div class="step-desc">Add rent, groceries, electricity, Netflix — anything shared. Tag who paid and let Sheetsy do the math automatically.</div>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <div class="step-title">Settle up fairly</div>
                <div class="step-desc">See at a glance who owes what. Mark payments as done and watch your balance go to zero — peacefully.</div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="section" style="padding-top: 0">
        <span class="section-label">Features</span>
        <h2 class="section-title">Everything a shared flat needs.</h2>
        <p class="section-sub">Built specifically for colocation life — not generic expense splitting.</p>

        <div class="features-grid">
            <div class="feature-card large">
                <div>
                    <div class="feature-icon fi-green">💸</div>
                    <div class="feature-title">Automatic payment tracking</div>
                    <div class="feature-desc">Every time you add an expense, Sheetsy instantly calculates exactly who owes who and how much — split evenly across all active members. No spreadsheets, no arguments.</div>
                    <div style="margin-top:20px">
                        <a href="{{ Route::has('register') ? route('register') : '#' }}" class="btn-primary" style="font-size:0.875rem;padding:11px 24px">Try it now →</a>
                    </div>
                </div>
                <div class="mini-payments">
                    <div style="font-size:0.7rem;font-weight:700;color:#9bb5a6;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:4px">💰 Payments — Villa Verde</div>
                    <div class="mini-pay-row">
                        <div class="mini-pay-left">
                            <div class="mini-dot" style="background:#dc2626">K</div>
                            Karim owes Youssef
                        </div>
                        <div class="mini-pay-amount">120 MAD</div>
                    </div>
                    <div class="mini-pay-row">
                        <div class="mini-pay-left">
                            <div class="mini-dot" style="background:#9333ea">L</div>
                            Leila owes Youssef
                        </div>
                        <div class="mini-pay-amount">120 MAD</div>
                    </div>
                    <div class="mini-pay-row">
                        <div class="mini-pay-left">
                            <div class="mini-dot" style="background:#1d4ed8">A</div>
                            Amine owes Sara
                        </div>
                        <div class="mini-pay-amount">80 MAD</div>
                    </div>
                    <div style="text-align:center;font-size:0.7rem;color:#b7d4c5;padding-top:4px">✅ 2 payments marked as paid this week</div>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-blue">✉️</div>
                <div class="feature-title">Email invitations</div>
                <div class="feature-desc">Invite flatmates with one click. They receive a beautiful email with a secure link to join your colocation instantly.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-amber">🏷️</div>
                <div class="feature-title">Expense categories</div>
                <div class="feature-desc">Organize expenses by type — Rent, Groceries, Utilities, Entertainment. Filter and understand where your shared money goes.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-rose">⭐</div>
                <div class="feature-title">Reputation system</div>
                <div class="feature-desc">Flatmates who pay on time build a positive reputation score. A gentle, fair incentive to stay on top of shared responsibilities.</div>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-green">📊</div>
                <div class="feature-title">Live balance dashboard</div>
                <div class="feature-desc">Your balance updates in real-time as expenses are added. Always know exactly where you stand — positive or negative — at a glance.</div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="section" style="padding-top:0">
        <span class="section-label">What flatmates say</span>
        <h2 class="section-title">Finally, no more awkward<br>money conversations.</h2>

        <div class="testimonials-grid">
            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <div class="testimonial-text">"Before Sheetsy we had a WhatsApp group just for expenses. It was chaos. Now everyone can see the balance and we've had zero arguments in 3 months."</div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar" style="background:#2D6A4F">Y</div>
                    <div>
                        <div class="testimonial-name">Youssef M.</div>
                        <div class="testimonial-role">Student, Casablanca</div>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <div class="testimonial-text">"I love that it shows exactly who owes who after each expense. My flatmate used to 'forget' — now the app remembers for him."</div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar" style="background:#9333ea">S</div>
                    <div>
                        <div class="testimonial-name">Sara K.</div>
                        <div class="testimonial-role">Working professional, Rabat</div>
                    </div>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-stars">★★★★★</div>
                <div class="testimonial-text">"The reputation score is genius. We're all adults but somehow seeing +15 next to my name makes me want to keep it up. Pay your debts, people."</div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar" style="background:#1d4ed8">A</div>
                    <div>
                        <div class="testimonial-name">Amine B.</div>
                        <div class="testimonial-role">Engineer, Marrakech</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <div style="max-width:1148px;margin:0 auto;padding:0 24px 100px">
        <div class="cta-banner">
            <div class="cta-text">
                <h2>Ready to live in peace?</h2>
                <p>Join hundreds of flatmates who stopped arguing about money.<br>Free to use, forever.</p>
            </div>
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-white">
                    Go to Dashboard →
                </a>
            @else
                <a href="{{ Route::has('register') ? route('register') : '#' }}" class="btn-white">
                    Create your colocation →
                </a>
            @endauth
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-logo">🌿 Sheetsy</div>
        <div class="footer-copy">© {{ date('Y') }} Sheetsy. Built for flatmates.</div>
        <div class="footer-links">
            <a href="{{ Route::has('login') ? route('login') : '#' }}">Sign in</a>
            <a href="{{ Route::has('register') ? route('register') : '#' }}">Register</a>
        </div>
    </footer>

</body>
</html>