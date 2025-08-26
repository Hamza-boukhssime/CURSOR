<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefCo Supply - Coming Soon | Your HVAC/R Partner</title>
    <meta name="description" content="RefCo Supply - Your single-source partner for HVAC/R parts, equipment & expertise. Coming soon with faster search, smarter catalogues, and pro-grade tools.">
    <meta name="keywords" content="HVAC, refrigeration, air conditioning, heating, parts, equipment, RefCo Supply">
    
    <!-- OpenGraph -->
    <meta property="og:title" content="RefCo Supply - Coming Soon">
    <meta property="og:description" content="Your single-source partner for HVAC/R parts, equipment & expertise. Global operations in USA, Qatar, and Saudi Arabia.">
    <meta property="og:image" content="hero.jpg">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://refcosupply.com">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="RefCo Supply - Coming Soon">
    <meta name="twitter:description" content="Your single-source partner for HVAC/R parts, equipment & expertise.">
    <meta name="twitter:image" content="hero.jpg">
    
    <!-- Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS Variables */
        :root {
            --refco-red: #ED1C24;
            --refco-blue: #2D3F8F;
            --accent-orange: #FF6B35;
            --success-green: #00B894;
            --ink: #1E293B;
            --muted: #64748B;
            --surface: #FFFFFF;
            --surface-alt: #F8FAFC;
            --border: #E2E8F0;
            --shadow: rgba(0, 0, 0, 0.1);
            --gradient: linear-gradient(135deg, var(--refco-red) 0%, var(--accent-orange) 50%, var(--refco-blue) 100%);
            --font-en: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-ar: 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;
            --radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        [data-theme="dark"] {
            --ink: #F1F5F9;
            --muted: #94A3B8;
            --surface: #0F172A;
            --surface-alt: #1E293B;
            --border: #334155;
            --shadow: rgba(0, 0, 0, 0.3);
        }
        
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            font-size: 16px;
            scroll-behavior: smooth;
        }
        
        body {
            font-family: var(--font-en);
            color: var(--ink);
            background: var(--surface);
            line-height: 1.6;
            overflow-x: hidden;
            transition: var(--transition);
        }
        
        html[dir="rtl"] body {
            font-family: var(--font-ar);
        }
        
        /* Utility Classes */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        
        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: var(--surface);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            transition: var(--transition);
        }
        
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            min-height: 80px;
        }
        
        .logo {
            height: 50px;
            width: auto;
        }
        
        .header-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        /* Language Toggle */
        .lang-toggle {
            display: flex;
            background: var(--surface-alt);
            border-radius: 25px;
            padding: 4px;
            position: relative;
        }
        
        .lang-btn {
            padding: 8px 16px;
            border: none;
            background: transparent;
            color: var(--muted);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border-radius: 20px;
            transition: var(--transition);
            position: relative;
            z-index: 2;
        }
        
        .lang-btn.active {
            color: var(--surface);
        }
        
        .lang-indicator {
            position: absolute;
            top: 4px;
            width: calc(50% - 4px);
            height: calc(100% - 8px);
            background: var(--refco-blue);
            border-radius: 20px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        html[dir="rtl"] .lang-indicator {
            transform: translateX(-100%);
        }
        
        /* Theme Toggle */
        .theme-toggle {
            width: 48px;
            height: 48px;
            border: none;
            background: var(--surface-alt);
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .theme-toggle:hover {
            transform: scale(1.05);
        }
        
        .theme-icon {
            position: absolute;
            transition: var(--transition);
        }
        
        .sun-icon {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
        
        .moon-icon {
            opacity: 0;
            transform: rotate(-180deg) scale(0);
        }
        
        [data-theme="dark"] .sun-icon {
            opacity: 0;
            transform: rotate(180deg) scale(0);
        }
        
        [data-theme="dark"] .moon-icon {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
        
        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding-top: 100px;
        }
        
        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: -2;
        }
        
        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.15;
        }
        
        .hero-gradient {
            position: absolute;
            inset: 0;
            background: var(--gradient);
            opacity: 0.05;
            z-index: -1;
        }
        
        .hero-content {
            text-align: center;
            position: relative;
            z-index: 10;
        }
        
        .hero-badge {
            display: inline-block;
            padding: 8px 24px;
            background: var(--gradient);
            color: white;
            font-size: 14px;
            font-weight: 600;
            border-radius: 25px;
            margin-bottom: 2rem;
            letter-spacing: 0.5px;
        }
        
        h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .tagline {
            font-size: clamp(1.25rem, 3vw, 1.75rem);
            color: var(--muted);
            margin-bottom: 3rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Countdown */
        .countdown {
            display: flex;
            gap: 2rem;
            justify-content: center;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }
        
        .countdown-item {
            text-align: center;
            background: var(--surface-alt);
            padding: 1.5rem 2rem;
            border-radius: var(--radius);
            box-shadow: 0 4px 20px var(--shadow);
            min-width: 120px;
            position: relative;
            overflow: hidden;
        }
        
        .countdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient);
        }
        
        .countdown-value {
            font-size: 3rem;
            font-weight: 700;
            color: var(--refco-blue);
            display: block;
            line-height: 1;
        }
        
        .countdown-label {
            font-size: 14px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.5rem;
        }
        
        /* Notify Form */
        .notify-section {
            background: var(--surface-alt);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .notify-content {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .notify-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .notify-text {
            color: var(--muted);
            margin-bottom: 2rem;
        }
        
        .notify-form {
            display: flex;
            gap: 1rem;
            max-width: 500px;
            margin: 0 auto;
            flex-wrap: wrap;
        }
        
        .form-group {
            flex: 1;
            min-width: 200px;
        }
        
        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface);
            color: var(--ink);
            font-size: 16px;
            transition: var(--transition);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--refco-blue);
            box-shadow: 0 0 0 3px rgba(45, 63, 143, 0.1);
        }
        
        .form-submit {
            padding: 16px 32px;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }
        
        .form-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(237, 28, 36, 0.3);
        }
        
        .form-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        /* Info Section */
        .info-section {
            padding: 6rem 0;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-bottom: 4rem;
        }
        
        .info-card {
            background: var(--surface-alt);
            padding: 2rem;
            border-radius: var(--radius);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px var(--shadow);
        }
        
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient);
        }
        
        .info-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .info-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .info-text {
            color: var(--muted);
            line-height: 1.8;
        }
        
        /* Branches */
        .branches {
            background: var(--surface-alt);
            padding: 4rem 0;
        }
        
        .branches-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
        }
        
        .branches-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        
        .branch-card {
            background: var(--surface);
            padding: 2rem;
            border-radius: var(--radius);
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .branch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px var(--shadow);
        }
        
        .branch-card.coming-soon {
            opacity: 0.7;
        }
        
        .branch-flag {
            width: 60px;
            height: 60px;
            background: var(--gradient);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .branch-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .branch-details {
            color: var(--muted);
            line-height: 1.8;
        }
        
        .branch-details a {
            color: var(--refco-blue);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .branch-details a:hover {
            text-decoration: underline;
        }
        
        .coming-soon-badge {
            display: inline-block;
            padding: 6px 16px;
            background: var(--accent-orange);
            color: white;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            margin-top: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Footer */
        footer {
            background: var(--ink);
            color: var(--surface);
            padding: 3rem 0;
            text-align: center;
        }
        
        .footer-logo {
            height: 40px;
            margin-bottom: 1.5rem;
            filter: brightness(0) invert(1);
        }
        
        .footer-text {
            opacity: 0.8;
            margin-bottom: 1rem;
        }
        
        .footer-links {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: var(--surface);
            text-decoration: none;
            opacity: 0.8;
            transition: var(--transition);
        }
        
        .footer-links a:hover {
            opacity: 1;
        }
        
        /* Toast */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--surface);
            color: var(--ink);
            padding: 1rem 2rem;
            border-radius: var(--radius);
            box-shadow: 0 10px 30px var(--shadow);
            transform: translateY(100px);
            opacity: 0;
            transition: var(--transition);
            z-index: 1000;
            max-width: 400px;
        }
        
        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        
        .toast.success {
            border-left: 4px solid var(--success-green);
        }
        
        .toast.error {
            border-left: 4px solid var(--refco-red);
        }
        
        /* Loading */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-inner {
                padding: 0.75rem 0;
                min-height: 70px;
            }
            
            .logo {
                height: 40px;
            }
            
            .countdown {
                gap: 1rem;
            }
            
            .countdown-item {
                padding: 1rem 1.5rem;
                min-width: 100px;
            }
            
            .countdown-value {
                font-size: 2rem;
            }
            
            .notify-form {
                flex-direction: column;
            }
            
            .form-group {
                min-width: 100%;
            }
            
            .toast {
                left: 1rem;
                right: 1rem;
                bottom: 1rem;
            }
        }
        
        /* RTL Support */
        html[dir="rtl"] .info-card::before {
            left: auto;
            right: 0;
        }
        
        html[dir="rtl"] .toast {
            left: 2rem;
            right: auto;
        }
        
        html[dir="rtl"] .toast.success,
        html[dir="rtl"] .toast.error {
            border-left: none;
            border-right: 4px solid;
        }
        
        /* Print */
        @media print {
            header, .notify-section, .toast {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Skip to content -->
    <a href="#main" class="sr-only">Skip to main content</a>
    
    <!-- Header -->
    <header role="banner">
        <div class="container">
            <div class="header-inner">
                <img src="logo.png" alt="RefCo Supply" class="logo" loading="eager">
                
                <div class="header-controls">
                    <!-- Language Toggle -->
                    <div class="lang-toggle" role="group" aria-label="Language selection">
                        <span class="lang-indicator" aria-hidden="true"></span>
                        <button class="lang-btn active" data-lang="en" aria-pressed="true">EN</button>
                        <button class="lang-btn" data-lang="ar" aria-pressed="false">AR</button>
                    </div>
                    
                    <!-- Theme Toggle -->
                    <button class="theme-toggle" aria-label="Toggle dark mode">
                        <svg class="theme-icon sun-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                        <svg class="theme-icon moon-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main id="main" role="main">
        <!-- Hero Section -->
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-bg">
                <img src="hero.jpg" alt="RefCo Supply Store" loading="lazy">
            </div>
            <div class="hero-gradient"></div>
            
            <div class="container">
                <div class="hero-content">
                    <div class="hero-badge">Coming Soon</div>
                    
                    <h1 id="hero-title">RefCo Supply</h1>
                    <p class="tagline" data-en="Your single-source partner for HVAC/R parts, equipment & expertise." data-ar="شريكك الموثوق للقطع والمعدات وخبرة التكييف والتبريد.">
                        Your single-source partner for HVAC/R parts, equipment & expertise.
                    </p>
                    
                    <!-- Countdown -->
                    <div class="countdown" role="timer" aria-label="Launch countdown">
                        <div class="countdown-item">
                            <span class="countdown-value" id="days">00</span>
                            <span class="countdown-label" data-en="Days" data-ar="أيام">Days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-value" id="hours">00</span>
                            <span class="countdown-label" data-en="Hours" data-ar="ساعات">Hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-value" id="minutes">00</span>
                            <span class="countdown-label" data-en="Minutes" data-ar="دقائق">Minutes</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-value" id="seconds">00</span>
                            <span class="countdown-label" data-en="Seconds" data-ar="ثواني">Seconds</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Notify Section -->
        <section class="notify-section" aria-labelledby="notify-title">
            <div class="container">
                <div class="notify-content">
                    <h2 id="notify-title" class="notify-title" data-en="Get Notified" data-ar="احصل على إشعار">Get Notified</h2>
                    <p class="notify-text" data-en="Be the first to know when we launch. Get exclusive early access." data-ar="كن أول من يعرف عند إطلاقنا. احصل على وصول حصري مبكر.">
                        Be the first to know when we launch. Get exclusive early access.
                    </p>
                    
                    <form class="notify-form" id="notifyForm" action="notify.php" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div class="form-group">
                            <label for="email" class="sr-only">Email address</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="Your email" required aria-required="true">
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="sr-only">Name (optional)</label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="Name (optional)">
                        </div>
                        
                        <button type="submit" class="form-submit" data-en="Notify Me" data-ar="أبلغني">
                            <span class="btn-text">Notify Me</span>
                            <span class="loading" style="display: none;"></span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        
        <!-- Info Section -->
        <section class="info-section" aria-labelledby="info-title">
            <div class="container">
                <h2 id="info-title" class="sr-only">About RefCo Supply</h2>
                
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <h3 class="info-title" data-en="Global Presence" data-ar="تواجد عالمي">Global Presence</h3>
                        <p class="info-text" data-en="We're preparing something great. The new global RefCo Supply site will unite our USA, Qatar and Saudi operations—faster search, smarter catalogues, and pro-grade tools." data-ar="نحن نعد شيئًا رائعًا. موقع RefCo Supply العالمي الجديد سيوحد عملياتنا في الولايات المتحدة وقطر والسعودية—بحث أسرع وكتالوجات أذكى وأدوات احترافية.">
                            We're preparing something great. The new global RefCo Supply site will unite our USA, Qatar and Saudi operations—faster search, smarter catalogues, and pro-grade tools.
                        </p>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                        </div>
                        <h3 class="info-title" data-en="10+ Years Excellence" data-ar="أكثر من 10 سنوات من التميز">10+ Years Excellence</h3>
                        <p class="info-text" data-en="Over a decade of industry experience serving contractors, businesses, and homeowners with premium HVAC/R solutions." data-ar="أكثر من عقد من الخبرة في الصناعة لخدمة المقاولين والشركات وأصحاب المنازل بحلول التكييف والتبريد المتميزة.">
                            Over a decade of industry experience serving contractors, businesses, and homeowners with premium HVAC/R solutions.
                        </p>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <h3 class="info-title" data-en="Fast Growing" data-ar="نمو سريع">Fast Growing</h3>
                        <p class="info-text" data-en="One of the fastest-growing HVAC/R supply houses with rapid expansion across USA and international markets." data-ar="واحدة من أسرع بيوت توريد التكييف والتبريد نموًا مع التوسع السريع عبر الولايات المتحدة والأسواق الدولية.">
                            One of the fastest-growing HVAC/R supply houses with rapid expansion across USA and international markets.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Branches Section -->
        <section class="branches" aria-labelledby="branches-title">
            <div class="container">
                <h2 id="branches-title" class="branches-title" data-en="Our Locations" data-ar="مواقعنا">Our Locations</h2>
                
                <div class="branches-grid">
                    <div class="branch-card">
                        <div class="branch-flag">🇺🇸</div>
                        <h3 class="branch-name">USA (HQ - Knoxville, TN)</h3>
                        <div class="branch-details">
                            <p>2309 Mitchell St, Knoxville, TN 37917</p>
                            <p>
                                <a href="tel:865-249-7593">865-249-7593</a><br>
                                <a href="mailto:Knox@refcosupply.com">Knox@refcosupply.com</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="branch-card">
                        <div class="branch-flag">🇺🇸</div>
                        <h3 class="branch-name">USA (Tampa, FL)</h3>
                        <div class="branch-details">
                            <p>6015 N 56th St, Tampa, FL 33610</p>
                            <p>
                                <a href="tel:813-374-1011">(813) 374-1011</a><br>
                                <a href="mailto:Tampa@refcosupply.com">Tampa@refcosupply.com</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="branch-card">
                        <div class="branch-flag">🇶🇦</div>
                        <h3 class="branch-name">Qatar (Doha)</h3>
                        <div class="branch-details">
                            <p>Piazza Level, 0Q05A, Qanat Quartier<br>
                            Units 93–99, The Pearl<br>
                            P.O. Box 301588</p>
                        </div>
                    </div>
                    
                    <div class="branch-card coming-soon">
                        <div class="branch-flag">🇸🇦</div>
                        <h3 class="branch-name">Saudi Arabia</h3>
                        <div class="branch-details">
                            <span class="coming-soon-badge" data-en="Coming Soon" data-ar="قريباً">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <footer role="contentinfo">
        <div class="container">
            <img src="logo.png" alt="RefCo Supply" class="footer-logo" loading="lazy">
            <p class="footer-text">© 2025 RefCo Supply. All rights reserved.</p>
            <div class="footer-links">
                <a href="https://refcosupply.com" target="_blank" rel="noopener">RefCoSupply.com</a>
                <a href="tel:865-249-7593">865-249-7593</a>
                <a href="mailto:info@refcosupply.com">info@refcosupply.com</a>
            </div>
        </div>
    </footer>
    
    <!-- Toast Notification -->
    <div class="toast" role="alert" aria-live="polite" aria-atomic="true" id="toast"></div>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <script>
        // Content translations
        const translations = {
            en: {
                dir: 'ltr',
                placeholders: {
                    email: 'Your email',
                    name: 'Name (optional)'
                },
                messages: {
                    success: 'Thank you! We\'ll notify you when we launch.',
                    error: 'Something went wrong. Please try again.',
                    invalid: 'Please enter a valid email address.'
                }
            },
            ar: {
                dir: 'rtl',
                placeholders: {
                    email: 'بريدك الإلكتروني',
                    name: 'الاسم (اختياري)'
                },
                messages: {
                    success: 'شكراً لك! سنخطرك عند الإطلاق.',
                    error: 'حدث خطأ ما. يرجى المحاولة مرة أخرى.',
                    invalid: 'يرجى إدخال عنوان بريد إلكتروني صالح.'
                }
            }
        };
        
        // Current language
        let currentLang = 'en';
        
        // Theme management
        const themeToggle = document.querySelector('.theme-toggle');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
        
        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        }
        
        // Initialize theme
        const savedTheme = localStorage.getItem('theme') || (prefersDark.matches ? 'dark' : 'light');
        setTheme(savedTheme);
        
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            setTheme(currentTheme === 'dark' ? 'light' : 'dark');
        });
        
        // Language management
        const langBtns = document.querySelectorAll('.lang-btn');
        const langIndicator = document.querySelector('.lang-indicator');
        
        function setLanguage(lang) {
            currentLang = lang;
            document.documentElement.setAttribute('lang', lang);
            document.documentElement.setAttribute('dir', translations[lang].dir);
            
            // Update content
            document.querySelectorAll('[data-en]').forEach(el => {
                el.textContent = el.getAttribute(`data-${lang}`);
            });
            
            // Update placeholders
            document.getElementById('email').placeholder = translations[lang].placeholders.email;
            document.getElementById('name').placeholder = translations[lang].placeholders.name;
            
            // Update button states
            langBtns.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.lang === lang);
                btn.setAttribute('aria-pressed', btn.dataset.lang === lang);
            });
            
            // Update indicator position
            if (lang === 'ar') {
                langIndicator.style.transform = 'translateX(-100%)';
            } else {
                langIndicator.style.transform = 'translateX(0)';
            }
            
            localStorage.setItem('language', lang);
        }
        
        // Initialize language
        const savedLang = localStorage.getItem('language') || 'en';
        setLanguage(savedLang);
        
        langBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                setLanguage(btn.dataset.lang);
            });
        });
        
        // Countdown Timer
        const launchDate = new Date('2025-11-30T09:00:00-05:00').getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = launchDate - now;
            
            if (distance < 0) {
                document.querySelector('.countdown').innerHTML = '<p class="tagline">We are live!</p>';
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
        
        // Form handling
        const notifyForm = document.getElementById('notifyForm');
        const toast = document.getElementById('toast');
        
        function showToast(message, type = 'success') {
            toast.textContent = message;
            toast.className = `toast ${type}`;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }
        
        notifyForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const submitBtn = notifyForm.querySelector('.form-submit');
            const btnText = submitBtn.querySelector('.btn-text');
            const loading = submitBtn.querySelector('.loading');
            
            // Validate email
            const email = document.getElementById('email');
            if (!email.validity.valid) {
                showToast(translations[currentLang].messages.invalid, 'error');
                return;
            }
            
            // Show loading
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            loading.style.display = 'inline-block';
            
            try {
                const formData = new FormData(notifyForm);
                const response = await fetch('notify.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.ok) {
                    showToast(translations[currentLang].messages.success, 'success');
                    notifyForm.reset();
                } else {
                    showToast(result.error || translations[currentLang].messages.error, 'error');
                }
            } catch (error) {
                showToast(translations[currentLang].messages.error, 'error');
            } finally {
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                loading.style.display = 'none';
            }
        });
        
        // GSAP Animations
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            gsap.registerPlugin(ScrollTrigger);
            
            // Hero animation
            gsap.from('.hero-badge', {
                opacity: 0,
                y: 30,
                duration: 1,
                ease: 'power3.out'
            });
            
            gsap.from('h1', {
                opacity: 0,
                y: 50,
                duration: 1.2,
                delay: 0.2,
                ease: 'power3.out'
            });
            
            gsap.from('.tagline', {
                opacity: 0,
                y: 30,
                duration: 1,
                delay: 0.4,
                ease: 'power3.out'
            });
            
            gsap.from('.countdown-item', {
                opacity: 0,
                y: 30,
                duration: 0.8,
                delay: 0.6,
                stagger: 0.1,
                ease: 'power3.out'
            });
            
            // ScrollTrigger animations
            gsap.from('.info-card', {
                opacity: 0,
                y: 50,
                duration: 0.8,
                stagger: 0.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.info-grid',
                    start: 'top 80%'
                }
            });
            
            gsap.from('.branch-card', {
                opacity: 0,
                scale: 0.9,
                duration: 0.8,
                stagger: 0.15,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.branches-grid',
                    start: 'top 80%'
                }
            });
        }
        
        // Lazy loading for images
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.src;
            });
        } else {
            // Fallback for browsers that don't support lazy loading
            const script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
            document.body.appendChild(script);
        }
    </script>
</body>
</html>