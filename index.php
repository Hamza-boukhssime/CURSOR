<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefCo Supply - Coming Soon | Global HVAC/R Solutions</title>
    
    <!-- SEO & OpenGraph -->
    <meta name="description" content="RefCo Supply is preparing something great. The new global HVAC/R platform uniting USA, Qatar and Saudi operations. Coming November 2025.">
    <meta name="keywords" content="HVAC, refrigeration, air conditioning, heating, RefCo Supply, HVAC parts, equipment">
    <meta name="author" content="RefCo Supply">
    
    <meta property="og:title" content="RefCo Supply - Coming Soon | Global HVAC/R Solutions">
    <meta property="og:description" content="Your single-source partner for HVAC/R parts, equipment & expertise. Coming November 2025.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://refcosupply.com">
    <meta property="og:image" content="https://refcosupply.com/hero.jpg">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="RefCo Supply - Coming Soon">
    <meta name="twitter:description" content="Your single-source partner for HVAC/R parts, equipment & expertise.">
    
    <!-- Preconnects for performance -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="logo.png">
    
    <!-- GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        :root {
            /* Brand Colors */
            --refco-red: #ED1C24;
            --refco-blue: #2D3F8F;
            --accent-orange: #FF6B35;
            --support-green: #00B894;
            --ink: #1E293B;
            --muted-text: #64748B;
            --surface: #FFFFFF;
            --surface-secondary: #F8FAFC;
            --border: #E2E8F0;
            
            /* Dark mode colors */
            --dark-bg: #0F172A;
            --dark-surface: #1E293B;
            --dark-surface-secondary: #334155;
            --dark-text: #F1F5F9;
            --dark-muted: #94A3B8;
            --dark-border: #475569;
            
            /* Gradients */
            --gradient-primary: linear-gradient(135deg, var(--refco-red) 0%, var(--accent-orange) 50%, var(--refco-blue) 100%);
            --gradient-subtle: linear-gradient(135deg, rgba(237, 28, 36, 0.05) 0%, rgba(255, 107, 53, 0.05) 50%, rgba(45, 63, 143, 0.05) 100%);
            
            /* Typography */
            --font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --font-size-5xl: 3rem;
            --font-size-6xl: 3.75rem;
            
            /* Spacing */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-base: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            /* Transitions */
            --transition-fast: 0.15s ease-out;
            --transition-base: 0.3s ease-out;
            --transition-slow: 0.5s ease-out;
            
            /* Border radius */
            --radius-sm: 0.375rem;
            --radius-base: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;
        }

        /* Dark mode variables override */
        [data-theme="dark"] {
            --surface: var(--dark-surface);
            --surface-secondary: var(--dark-surface-secondary);
            --ink: var(--dark-text);
            --muted-text: var(--dark-muted);
            --border: var(--dark-border);
        }

        /* Reset and base styles */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        * {
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-family);
            line-height: 1.6;
            color: var(--ink);
            background: var(--surface);
            overflow-x: hidden;
            transition: background-color var(--transition-base), color var(--transition-base);
        }

        [data-theme="dark"] body {
            background: var(--dark-bg);
        }

        /* RTL Support */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .container {
            direction: rtl;
        }

        /* Accessibility */
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

        /* Focus styles */
        *:focus-visible {
            outline: 2px solid var(--refco-blue);
            outline-offset: 2px;
            border-radius: var(--radius-sm);
        }

        /* Motion preferences */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Typography */
        .text-xs { font-size: var(--font-size-xs); }
        .text-sm { font-size: var(--font-size-sm); }
        .text-base { font-size: var(--font-size-base); }
        .text-lg { font-size: var(--font-size-lg); }
        .text-xl { font-size: var(--font-size-xl); }
        .text-2xl { font-size: var(--font-size-2xl); }
        .text-3xl { font-size: var(--font-size-3xl); }
        .text-4xl { font-size: var(--font-size-4xl); }
        .text-5xl { font-size: var(--font-size-5xl); }
        .text-6xl { font-size: var(--font-size-6xl); }

        .font-light { font-weight: 300; }
        .font-normal { font-weight: 400; }
        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .font-bold { font-weight: 700; }
        .font-extrabold { font-weight: 800; }

        .leading-tight { line-height: 1.25; }
        .leading-snug { line-height: 1.375; }
        .leading-normal { line-height: 1.5; }
        .leading-relaxed { line-height: 1.625; }

        /* Layout utilities */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--space-4);
        }

        .flex { display: flex; }
        .grid { display: grid; }
        .block { display: block; }
        .inline-block { display: inline-block; }
        .hidden { display: none; }

        .items-center { align-items: center; }
        .items-start { align-items: flex-start; }
        .items-end { align-items: flex-end; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        .justify-start { justify-content: flex-start; }

        .flex-col { flex-direction: column; }
        .flex-wrap { flex-wrap: wrap; }
        .flex-1 { flex: 1; }

        .w-full { width: 100%; }
        .h-full { height: 100%; }
        .min-h-screen { min-height: 100vh; }

        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        /* Spacing utilities */
        .p-4 { padding: var(--space-4); }
        .p-6 { padding: var(--space-6); }
        .p-8 { padding: var(--space-8); }
        .px-4 { padding-left: var(--space-4); padding-right: var(--space-4); }
        .py-4 { padding-top: var(--space-4); padding-bottom: var(--space-4); }
        .py-6 { padding-top: var(--space-6); padding-bottom: var(--space-6); }
        .py-8 { padding-top: var(--space-8); padding-bottom: var(--space-8); }
        .py-12 { padding-top: var(--space-12); padding-bottom: var(--space-12); }
        .py-16 { padding-top: var(--space-16); padding-bottom: var(--space-16); }
        .py-20 { padding-top: var(--space-20); padding-bottom: var(--space-20); }
        .py-24 { padding-top: var(--space-24); padding-bottom: var(--space-24); }

        .mb-2 { margin-bottom: var(--space-2); }
        .mb-4 { margin-bottom: var(--space-4); }
        .mb-6 { margin-bottom: var(--space-6); }
        .mb-8 { margin-bottom: var(--space-8); }
        .mb-12 { margin-bottom: var(--space-12); }
        .mb-16 { margin-bottom: var(--space-16); }

        .mt-4 { margin-top: var(--space-4); }
        .mt-8 { margin-top: var(--space-8); }
        .mt-12 { margin-top: var(--space-12); }

        /* Colors */
        .text-primary { color: var(--refco-red); }
        .text-secondary { color: var(--refco-blue); }
        .text-accent { color: var(--accent-orange); }
        .text-muted { color: var(--muted-text); }
        .text-success { color: var(--support-green); }

        .bg-primary { background-color: var(--refco-red); }
        .bg-secondary { background-color: var(--refco-blue); }
        .bg-surface { background-color: var(--surface); }
        .bg-surface-secondary { background-color: var(--surface-secondary); }

        .bg-gradient { background: var(--gradient-primary); }
        .bg-gradient-subtle { background: var(--gradient-subtle); }

        /* Border radius */
        .rounded { border-radius: var(--radius-base); }
        .rounded-lg { border-radius: var(--radius-lg); }
        .rounded-xl { border-radius: var(--radius-xl); }
        .rounded-2xl { border-radius: var(--radius-2xl); }
        .rounded-full { border-radius: var(--radius-full); }

        /* Shadows */
        .shadow { box-shadow: var(--shadow-base); }
        .shadow-md { box-shadow: var(--shadow-md); }
        .shadow-lg { box-shadow: var(--shadow-lg); }
        .shadow-xl { box-shadow: var(--shadow-xl); }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            transition: all var(--transition-base);
        }

        [data-theme="dark"] .header {
            background: rgba(15, 23, 42, 0.95);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4) 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            text-decoration: none;
            color: var(--ink);
            font-weight: 700;
            font-size: var(--font-size-xl);
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .nav-controls {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        /* Toggle buttons */
        .toggle-group {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .toggle-btn {
            background: var(--surface-secondary);
            border: 1px solid var(--border);
            color: var(--muted-text);
            padding: var(--space-2) var(--space-3);
            border-radius: var(--radius-base);
            cursor: pointer;
            transition: all var(--transition-fast);
            font-size: var(--font-size-sm);
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
        }

        .toggle-btn:hover {
            background: var(--surface);
            border-color: var(--refco-blue);
            color: var(--refco-blue);
        }

        .toggle-btn.active {
            background: var(--refco-blue);
            border-color: var(--refco-blue);
            color: white;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--muted-text);
            cursor: pointer;
            padding: var(--space-2);
            border-radius: var(--radius-full);
            transition: all var(--transition-fast);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            background: var(--surface-secondary);
            color: var(--ink);
        }

        /* Hero section */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-subtle);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('hero.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            z-index: -1;
        }

        [data-theme="dark"] .hero::before {
            opacity: 0.05;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            z-index: 2;
        }

        .hero-title {
            font-size: clamp(var(--font-size-4xl), 5vw, var(--font-size-6xl));
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: var(--space-6);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: clamp(var(--font-size-lg), 2.5vw, var(--font-size-2xl));
            color: var(--muted-text);
            margin-bottom: var(--space-8);
            line-height: 1.4;
        }

        .hero-description {
            font-size: var(--font-size-lg);
            color: var(--muted-text);
            margin-bottom: var(--space-12);
            line-height: 1.6;
        }

        /* Countdown */
        .countdown {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            margin-bottom: var(--space-12);
            box-shadow: var(--shadow-xl);
        }

        .countdown-title {
            font-size: var(--font-size-2xl);
            font-weight: 700;
            margin-bottom: var(--space-6);
            color: var(--ink);
        }

        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: var(--space-4);
        }

        .countdown-item {
            text-align: center;
        }

        .countdown-number {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            color: var(--refco-red);
            display: block;
            line-height: 1;
        }

        .countdown-label {
            font-size: var(--font-size-sm);
            color: var(--muted-text);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Notify form */
        .notify-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
            box-shadow: var(--shadow-lg);
            max-width: 500px;
            margin: 0 auto;
        }

        .notify-title {
            font-size: var(--font-size-2xl);
            font-weight: 700;
            margin-bottom: var(--space-2);
            text-align: center;
            color: var(--ink);
        }

        .notify-description {
            color: var(--muted-text);
            text-align: center;
            margin-bottom: var(--space-6);
        }

        .form-group {
            margin-bottom: var(--space-4);
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: var(--space-2);
            color: var(--ink);
        }

        .form-input {
            width: 100%;
            padding: var(--space-3) var(--space-4);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            font-size: var(--font-size-base);
            background: var(--surface);
            color: var(--ink);
            transition: all var(--transition-fast);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--refco-blue);
            box-shadow: 0 0 0 3px rgba(45, 63, 143, 0.1);
        }

        .form-input::placeholder {
            color: var(--muted-text);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-6);
            border: none;
            border-radius: var(--radius-lg);
            font-size: var(--font-size-base);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all var(--transition-fast);
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-full {
            width: 100%;
        }

        /* Toast notifications */
        .toast {
            position: fixed;
            top: var(--space-6);
            right: var(--space-6);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: var(--space-4) var(--space-6);
            box-shadow: var(--shadow-xl);
            z-index: 100;
            transform: translateX(100%);
            transition: transform var(--transition-base);
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-color: var(--support-green);
            background: #F0FDF4;
            color: #166534;
        }

        .toast.error {
            border-color: var(--refco-red);
            background: #FEF2F2;
            color: #991B1B;
        }

        [data-theme="dark"] .toast.success {
            background: #064E3B;
            color: #6EE7B7;
        }

        [data-theme="dark"] .toast.error {
            background: #7F1D1D;
            color: #FCA5A5;
        }

        /* Features section */
        .features {
            padding: var(--space-24) 0;
            background: var(--surface-secondary);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-8);
            margin-top: var(--space-16);
        }

        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: var(--space-8);
            text-align: center;
            transition: all var(--transition-base);
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto var(--space-6);
            background: var(--gradient-primary);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-2xl);
        }

        .feature-title {
            font-size: var(--font-size-xl);
            font-weight: 700;
            margin-bottom: var(--space-4);
            color: var(--ink);
        }

        .feature-description {
            color: var(--muted-text);
            line-height: 1.6;
        }

        /* Locations section */
        .locations {
            padding: var(--space-24) 0;
        }

        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: var(--space-8);
            margin-top: var(--space-16);
        }

        .location-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: var(--space-8);
            transition: all var(--transition-base);
        }

        .location-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .location-card.coming-soon {
            border-color: var(--accent-orange);
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(255, 107, 53, 0.1) 100%);
        }

        .location-header {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            margin-bottom: var(--space-6);
        }

        .location-flag {
            width: 32px;
            height: 24px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-sm);
        }

        .location-title {
            font-size: var(--font-size-xl);
            font-weight: 700;
            color: var(--ink);
        }

        .location-subtitle {
            font-size: var(--font-size-sm);
            color: var(--muted-text);
        }

        .location-info {
            margin-bottom: var(--space-4);
        }

        .location-info:last-child {
            margin-bottom: 0;
        }

        .location-label {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: var(--space-1);
        }

        .location-value {
            color: var(--muted-text);
        }

        .coming-soon-badge {
            background: var(--accent-orange);
            color: white;
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: var(--font-size-xs);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Footer */
        .footer {
            background: var(--ink);
            color: white;
            padding: var(--space-16) 0;
            text-align: center;
        }

        [data-theme="dark"] .footer {
            background: var(--dark-surface);
        }

        .footer-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .footer-logo {
            margin-bottom: var(--space-8);
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: var(--space-6);
            line-height: 1.6;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color var(--transition-fast);
        }

        .footer-link:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: var(--space-6);
            color: rgba(255, 255, 255, 0.6);
            font-size: var(--font-size-sm);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 0 var(--space-3);
            }
            
            .nav-controls {
                gap: var(--space-2);
            }
            
            .toggle-group {
                gap: var(--space-1);
            }
            
            .toggle-btn {
                padding: var(--space-2);
                font-size: var(--font-size-xs);
            }
            
            .hero {
                padding: var(--space-20) 0;
            }
            
            .countdown {
                padding: var(--space-6);
            }
            
            .countdown-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--space-6);
            }
            
            .notify-section {
                padding: var(--space-6);
                margin: 0 var(--space-4);
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: var(--space-6);
            }
            
            .locations-grid {
                grid-template-columns: 1fr;
                gap: var(--space-6);
            }
            
            .footer-links {
                flex-wrap: wrap;
                gap: var(--space-4);
            }
        }

        @media (max-width: 480px) {
            .countdown-grid {
                grid-template-columns: 1fr;
                gap: var(--space-4);
            }
            
            .countdown-number {
                font-size: var(--font-size-3xl);
            }
        }

        /* Animation classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
        }

        .fade-in.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
        }

        .scale-in.animated {
            opacity: 1;
            transform: scale(1);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
        }

        .slide-in-left.animated {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
        }

        .slide-in-right.animated {
            opacity: 1;
            transform: translateX(0);
        }

        /* Loading state */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transform: translateX(-100%);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            100% {
                transform: translateX(100%);
            }
        }

        /* Pulse animation for countdown */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" role="banner">
        <nav class="nav container" role="navigation" aria-label="Main navigation">
            <a href="#" class="logo" aria-label="RefCo Supply Home">
                <img src="logo.png" alt="RefCo Supply Logo" loading="eager">
                <span>RefCo Supply</span>
            </a>
            
            <div class="nav-controls">
                <!-- Language Toggle -->
                <div class="toggle-group" role="group" aria-label="Language selection">
                    <button class="toggle-btn active" data-lang="en" aria-pressed="true">
                        <span>🇺🇸</span>
                        <span>EN</span>
                    </button>
                    <button class="toggle-btn" data-lang="ar" aria-pressed="false">
                        <span>🇸🇦</span>
                        <span>AR</span>
                    </button>
                </div>
                
                <!-- Theme Toggle -->
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode" title="Toggle theme">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path class="sun-icon" d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
                        <path class="moon-icon" style="display: none;" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main role="main">
        <!-- Hero Section -->
        <section class="hero" id="hero">
            <div class="container">
                <div class="hero-content fade-in">
                    <h1 class="hero-title" id="heroTitle">
                        <span data-en="We're Building Something Great">We're Building Something Great</span>
                        <span data-ar="نحن نبني شيئًا رائعًا" style="display: none;">نحن نبني شيئًا رائعًا</span>
                    </h1>
                    
                    <p class="hero-subtitle" id="heroSubtitle">
                        <span data-en="Your single-source partner for HVAC/R parts, equipment &amp; expertise.">Your single-source partner for HVAC/R parts, equipment &amp; expertise.</span>
                        <span data-ar="شريكك الموثوق للقطع والمعدات وخبرة التكييف والتبريد." style="display: none;">شريكك الموثوق للقطع والمعدات وخبرة التكييف والتبريد.</span>
                    </p>
                    
                    <p class="hero-description" id="heroDescription">
                        <span data-en="The new global RefCo Supply platform will unite our USA, Qatar and Saudi operations—faster search, smarter catalogues, and pro-grade tools.">The new global RefCo Supply platform will unite our USA, Qatar and Saudi operations—faster search, smarter catalogues, and pro-grade tools.</span>
                        <span data-ar="منصة RefCo Supply العالمية الجديدة ستوحد عملياتنا في الولايات المتحدة وقطر والسعودية—بحث أسرع وكتالوجات أذكى وأدوات احترافية." style="display: none;">منصة RefCo Supply العالمية الجديدة ستوحد عملياتنا في الولايات المتحدة وقطر والسعودية—بحث أسرع وكتالوجات أذكى وأدوات احترافية.</span>
                    </p>

                    <!-- Countdown -->
                    <div class="countdown scale-in" id="countdown">
                        <h2 class="countdown-title" id="countdownTitle">
                            <span data-en="Launching November 30, 2025">Launching November 30, 2025</span>
                            <span data-ar="الإطلاق في 30 نوفمبر 2025" style="display: none;">الإطلاق في 30 نوفمبر 2025</span>
                        </h2>
                        <div class="countdown-grid">
                            <div class="countdown-item">
                                <span class="countdown-number" id="days">--</span>
                                <span class="countdown-label" id="daysLabel">
                                    <span data-en="Days">Days</span>
                                    <span data-ar="أيام" style="display: none;">أيام</span>
                                </span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="hours">--</span>
                                <span class="countdown-label" id="hoursLabel">
                                    <span data-en="Hours">Hours</span>
                                    <span data-ar="ساعات" style="display: none;">ساعات</span>
                                </span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="minutes">--</span>
                                <span class="countdown-label" id="minutesLabel">
                                    <span data-en="Minutes">Minutes</span>
                                    <span data-ar="دقائق" style="display: none;">دقائق</span>
                                </span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="seconds">--</span>
                                <span class="countdown-label" id="secondsLabel">
                                    <span data-en="Seconds">Seconds</span>
                                    <span data-ar="ثوانٍ" style="display: none;">ثوانٍ</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Notify Form -->
                    <div class="notify-section fade-in" id="notifySection">
                        <h2 class="notify-title" id="notifyTitle">
                            <span data-en="Get Notified">Get Notified</span>
                            <span data-ar="احصل على إشعار" style="display: none;">احصل على إشعار</span>
                        </h2>
                        <p class="notify-description" id="notifyDescription">
                            <span data-en="Be the first to know when we launch. We'll send you exclusive updates and early access.">Be the first to know when we launch. We'll send you exclusive updates and early access.</span>
                            <span data-ar="كن أول من يعرف عند الإطلاق. سنرسل لك تحديثات حصرية ووصول مبكر." style="display: none;">كن أول من يعرف عند الإطلاق. سنرسل لك تحديثات حصرية ووصول مبكر.</span>
                        </p>
                        
                        <form id="notifyForm" novalidate>
                            <div class="form-group">
                                <label for="email" class="form-label" id="emailLabel">
                                    <span data-en="Email Address *">Email Address *</span>
                                    <span data-ar="عنوان البريد الإلكتروني *" style="display: none;">عنوان البريد الإلكتروني *</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-input" 
                                    required
                                    aria-describedby="emailError"
                                    placeholder="your@email.com"
                                >
                                <div id="emailError" class="sr-only" aria-live="polite"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="name" class="form-label" id="nameLabel">
                                    <span data-en="Name (Optional)">Name (Optional)</span>
                                    <span data-ar="الاسم (اختياري)" style="display: none;">الاسم (اختياري)</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-input"
                                    placeholder=""
                                >
                            </div>
                            
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            
                            <button type="submit" class="btn btn-primary btn-full" id="submitBtn">
                                <span data-en="Notify Me">Notify Me</span>
                                <span data-ar="أشعرني" style="display: none;">أشعرني</span>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 8px;">
                                    <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features" id="features">
            <div class="container">
                <div class="text-center">
                    <h2 class="text-4xl font-bold mb-6 fade-in" id="featuresTitle">
                        <span data-en="What's Coming">What's Coming</span>
                        <span data-ar="ما هو قادم" style="display: none;">ما هو قادم</span>
                    </h2>
                    <p class="text-xl text-muted mb-16 fade-in" id="featuresDescription">
                        <span data-en="Revolutionary features designed for HVAC/R professionals">Revolutionary features designed for HVAC/R professionals</span>
                        <span data-ar="ميزات ثورية مصممة لمحترفي التكييف والتبريد" style="display: none;">ميزات ثورية مصممة لمحترفي التكييف والتبريد</span>
                    </p>
                </div>
                
                <div class="features-grid">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            🔍
                        </div>
                        <h3 class="feature-title" id="feature1Title">
                            <span data-en="Smart Search">Smart Search</span>
                            <span data-ar="بحث ذكي" style="display: none;">بحث ذكي</span>
                        </h3>
                        <p class="feature-description" id="feature1Description">
                            <span data-en="Find exactly what you need with AI-powered search that understands HVAC/R terminology and part compatibility.">Find exactly what you need with AI-powered search that understands HVAC/R terminology and part compatibility.</span>
                            <span data-ar="اعثر على ما تحتاجه بالضبط مع البحث المدعوم بالذكاء الاصطناعي الذي يفهم مصطلحات التكييف والتبريد وتوافق القطع." style="display: none;">اعثر على ما تحتاجه بالضبط مع البحث المدعوم بالذكاء الاصطناعي الذي يفهم مصطلحات التكييف والتبريد وتوافق القطع.</span>
                        </p>
                    </div>
                    
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            📊
                        </div>
                        <h3 class="feature-title" id="feature2Title">
                            <span data-en="Professional Tools">Professional Tools</span>
                            <span data-ar="أدوات احترافية" style="display: none;">أدوات احترافية</span>
                        </h3>
                        <p class="feature-description" id="feature2Description">
                            <span data-en="Access advanced calculators, compatibility charts, and technical resources designed for professionals.">Access advanced calculators, compatibility charts, and technical resources designed for professionals.</span>
                            <span data-ar="الوصول إلى حاسبات متقدمة ومخططات التوافق والموارد التقنية المصممة للمحترفين." style="display: none;">الوصول إلى حاسبات متقدمة ومخططات التوافق والموارد التقنية المصممة للمحترفين.</span>
                        </p>
                    </div>
                    
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            🌍
                        </div>
                        <h3 class="feature-title" id="feature3Title">
                            <span data-en="Global Inventory">Global Inventory</span>
                            <span data-ar="مخزون عالمي" style="display: none;">مخزون عالمي</span>
                        </h3>
                        <p class="feature-description" id="feature3Description">
                            <span data-en="Unified inventory across USA, Qatar, and Saudi Arabia with real-time availability and cross-shipping options.">Unified inventory across USA, Qatar, and Saudi Arabia with real-time availability and cross-shipping options.</span>
                            <span data-ar="مخزون موحد عبر الولايات المتحدة وقطر والسعودية مع التوفر في الوقت الفعلي وخيارات الشحن المتبادل." style="display: none;">مخزون موحد عبر الولايات المتحدة وقطر والسعودية مع التوفر في الوقت الفعلي وخيارات الشحن المتبادل.</span>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Locations Section -->
        <section class="locations" id="locations">
            <div class="container">
                <div class="text-center">
                    <h2 class="text-4xl font-bold mb-6 fade-in" id="locationsTitle">
                        <span data-en="Our Global Presence">Our Global Presence</span>
                        <span data-ar="حضورنا العالمي" style="display: none;">حضورنا العالمي</span>
                    </h2>
                    <p class="text-xl text-muted mb-16 fade-in" id="locationsDescription">
                        <span data-en="Serving HVAC/R professionals across multiple continents">Serving HVAC/R professionals across multiple continents</span>
                        <span data-ar="خدمة محترفي التكييف والتبريد عبر قارات متعددة" style="display: none;">خدمة محترفي التكييف والتبريد عبر قارات متعددة</span>
                    </p>
                </div>
                
                <div class="locations-grid">
                    <div class="location-card slide-in-left">
                        <div class="location-header">
                            <div class="location-flag" style="background: #B22234; color: white;">🇺🇸</div>
                            <div>
                                <h3 class="location-title" id="usaHqTitle">
                                    <span data-en="USA Headquarters">USA Headquarters</span>
                                    <span data-ar="المقر الرئيسي في الولايات المتحدة" style="display: none;">المقر الرئيسي في الولايات المتحدة</span>
                                </h3>
                                <p class="location-subtitle">Knoxville, Tennessee</p>
                            </div>
                        </div>
                        <div class="location-info">
                            <div class="location-label" id="usaHqAddressLabel">
                                <span data-en="Address">Address</span>
                                <span data-ar="العنوان" style="display: none;">العنوان</span>
                            </div>
                            <div class="location-value">2309 Mitchell St, Knoxville, TN 37917</div>
                        </div>
                        <div class="location-info">
                            <div class="location-label" id="usaHqPhoneLabel">
                                <span data-en="Phone">Phone</span>
                                <span data-ar="الهاتف" style="display: none;">الهاتف</span>
                            </div>
                            <div class="location-value">865-249-7593</div>
                        </div>
                        <div class="location-info">
                            <div class="location-label" id="usaHqEmailLabel">
                                <span data-en="Email">Email</span>
                                <span data-ar="البريد الإلكتروني" style="display: none;">البريد الإلكتروني</span>
                            </div>
                            <div class="location-value">Knox@refcosupply.com</div>
                        </div>
                    </div>
                    
                    <div class="location-card slide-in-left">
                        <div class="location-header">
                            <div class="location-flag" style="background: #B22234; color: white;">🇺🇸</div>
                            <div>
                                <h3 class="location-title" id="usaTampaTitle">
                                    <span data-en="USA Branch">USA Branch</span>
                                    <span data-ar="فرع الولايات المتحدة" style="display: none;">فرع الولايات المتحدة</span>
                                </h3>
                                <p class="location-subtitle">Tampa, Florida</p>
                            </div>
                        </div>
                        <div class="location-info">
                            <div class="location-label" id="usaTampaAddressLabel">
                                <span data-en="Address">Address</span>
                                <span data-ar="العنوان" style="display: none;">العنوان</span>
                            </div>
                            <div class="location-value">6015 N 56th St, Tampa, FL 33610</div>
                        </div>
                        <div class="location-info">
                            <div class="location-label" id="usaTampaPhoneLabel">
                                <span data-en="Phone">Phone</span>
                                <span data-ar="الهاتف" style="display: none;">الهاتف</span>
                            </div>
                            <div class="location-value">(813) 374-1011</div>
                        </div>
                        <div class="location-info">
                            <div class="location-label" id="usaTampaEmailLabel">
                                <span data-en="Email">Email</span>
                                <span data-ar="البريد الإلكتروني" style="display: none;">البريد الإلكتروني</span>
                            </div>
                            <div class="location-value">Tampa@refcosupply.com</div>
                        </div>
                    </div>
                    
                    <div class="location-card slide-in-right">
                        <div class="location-header">
                            <div class="location-flag" style="background: #8D1538; color: white;">🇶🇦</div>
                            <div>
                                <h3 class="location-title" id="qatarTitle">
                                    <span data-en="Qatar Office">Qatar Office</span>
                                    <span data-ar="مكتب قطر" style="display: none;">مكتب قطر</span>
                                </h3>
                                <p class="location-subtitle">Doha, Qatar</p>
                            </div>
                        </div>
                        <div class="location-info">
                            <div class="location-label" id="qatarAddressLabel">
                                <span data-en="Address">Address</span>
                                <span data-ar="العنوان" style="display: none;">العنوان</span>
                            </div>
                            <div class="location-value">Piazza Level, 0Q05A, Qanat Quartier Units 93–99, The Pearl, P.O. Box 301588</div>
                        </div>
                    </div>
                    
                    <div class="location-card coming-soon slide-in-right">
                        <div class="location-header">
                            <div class="location-flag" style="background: #006C35; color: white;">🇸🇦</div>
                            <div>
                                <h3 class="location-title" id="saudiTitle">
                                    <span data-en="Saudi Arabia">Saudi Arabia</span>
                                    <span data-ar="المملكة العربية السعودية" style="display: none;">المملكة العربية السعودية</span>
                                </h3>
                                <span class="coming-soon-badge" id="comingSoonBadge">
                                    <span data-en="Coming Soon">Coming Soon</span>
                                    <span data-ar="قريباً" style="display: none;">قريباً</span>
                                </span>
                            </div>
                        </div>
                        <div class="location-info">
                            <div class="location-value text-muted" id="saudiDescription">
                                <span data-en="Expanding our Middle East operations to better serve the Saudi market with local expertise and faster delivery.">Expanding our Middle East operations to better serve the Saudi market with local expertise and faster delivery.</span>
                                <span data-ar="توسيع عملياتنا في الشرق الأوسط لخدمة السوق السعودي بشكل أفضل مع خبرة محلية وتسليم أسرع." style="display: none;">توسيع عملياتنا في الشرق الأوسط لخدمة السوق السعودي بشكل أفضل مع خبرة محلية وتسليم أسرع.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="logo.png" alt="RefCo Supply Logo" height="50" loading="lazy">
                </div>
                
                <p class="footer-text" id="footerText">
                    <span data-en="At RefCo Supply, we are committed to being the go-to resource for HVAC/R professionals and homeowners alike, offering a comprehensive range of high-quality products and unmatched customer service.">At RefCo Supply, we are committed to being the go-to resource for HVAC/R professionals and homeowners alike, offering a comprehensive range of high-quality products and unmatched customer service.</span>
                    <span data-ar="في RefCo Supply، نحن ملتزمون بأن نكون المرجع الأول لمحترفي وأصحاب المنازل في مجال التكييف والتبريد، حيث نقدم مجموعة شاملة من المنتجات عالية الجودة وخدمة عملاء لا مثيل لها." style="display: none;">في RefCo Supply، نحن ملتزمون بأن نكون المرجع الأول لمحترفي وأصحاب المنازل في مجال التكييف والتبريد، حيث نقدم مجموعة شاملة من المنتجات عالية الجودة وخدمة عملاء لا مثيل لها.</span>
                </p>
                
                <div class="footer-links">
                    <a href="mailto:Knox@refcosupply.com" class="footer-link">Knox@refcosupply.com</a>
                    <a href="tel:+18652497593" class="footer-link">865-249-7593</a>
                    <a href="#" class="footer-link">RefCoSupply.com</a>
                </div>
                
                <div class="footer-bottom">
                    <p id="footerCopyright">
                        <span data-en="© 2024 RefCo Supply. All rights reserved. Building the future of HVAC/R supply.">© 2024 RefCo Supply. All rights reserved. Building the future of HVAC/R supply.</span>
                        <span data-ar="© 2024 RefCo Supply. جميع الحقوق محفوظة. نبني مستقبل إمدادات التكييف والتبريد." style="display: none;">© 2024 RefCo Supply. جميع الحقوق محفوظة. نبني مستقبل إمدادات التكييف والتبريد.</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <span id="toastMessage"></span>
    </div>

    <script>
        // Initialize GSAP ScrollTrigger
        gsap.registerPlugin(ScrollTrigger);

        // Global state
        let currentLang = 'en';
        let currentTheme = localStorage.getItem('theme') || 'light';
        let countdownInterval;
        let lastSubmissionTime = 0;

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initializeTheme();
            initializeLanguage();
            initializeAnimations();
            initializeCountdown();
            initializeForm();
            updatePlaceholders();
        });

        // Theme Management
        function initializeTheme() {
            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = document.querySelector('.sun-icon');
            const moonIcon = document.querySelector('.moon-icon');
            
            // Set initial theme
            document.documentElement.setAttribute('data-theme', currentTheme);
            updateThemeIcon();
            
            themeToggle.addEventListener('click', function() {
                currentTheme = currentTheme === 'light' ? 'dark' : 'light';
                document.documentElement.setAttribute('data-theme', currentTheme);
                localStorage.setItem('theme', currentTheme);
                updateThemeIcon();
                
                // Announce theme change for screen readers
                const message = currentTheme === 'dark' ? 'Dark mode enabled' : 'Light mode enabled';
                announceToScreenReader(message);
            });
            
            function updateThemeIcon() {
                if (currentTheme === 'dark') {
                    sunIcon.style.display = 'none';
                    moonIcon.style.display = 'block';
                    themeToggle.setAttribute('aria-label', 'Switch to light mode');
                } else {
                    sunIcon.style.display = 'block';
                    moonIcon.style.display = 'none';
                    themeToggle.setAttribute('aria-label', 'Switch to dark mode');
                }
            }
        }

        // Language Management
        function initializeLanguage() {
            const langButtons = document.querySelectorAll('[data-lang]');
            
            langButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const lang = this.getAttribute('data-lang');
                    switchLanguage(lang);
                });
            });
        }

        function switchLanguage(lang) {
            if (lang === currentLang) return;
            
            currentLang = lang;
            
            // Update button states
            document.querySelectorAll('[data-lang]').forEach(btn => {
                const isActive = btn.getAttribute('data-lang') === lang;
                btn.classList.toggle('active', isActive);
                btn.setAttribute('aria-pressed', isActive);
            });
            
            // Update document attributes
            document.documentElement.lang = lang;
            document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            
            // Toggle content visibility
            document.querySelectorAll('[data-en]').forEach(element => {
                element.style.display = lang === 'en' ? '' : 'none';
            });
            
            document.querySelectorAll('[data-ar]').forEach(element => {
                element.style.display = lang === 'ar' ? '' : 'none';
            });
            
            // Update form placeholders
            updatePlaceholders();
            
            // Announce language change
            const message = lang === 'ar' ? 'تم التبديل إلى العربية' : 'Switched to English';
            announceToScreenReader(message);
        }

        function updatePlaceholders() {
            const emailInput = document.getElementById('email');
            const nameInput = document.getElementById('name');
            
            if (currentLang === 'ar') {
                emailInput.placeholder = 'your@email.com';
                nameInput.placeholder = 'اسمك الكريم';
            } else {
                emailInput.placeholder = 'your@email.com';
                nameInput.placeholder = 'Your name';
            }
        }

        // Animations
        function initializeAnimations() {
            // Respect reduced motion preference
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            
            if (prefersReducedMotion) {
                // Show all elements immediately
                document.querySelectorAll('.fade-in, .scale-in, .slide-in-left, .slide-in-right').forEach(el => {
                    el.classList.add('animated');
                });
                return;
            }
            
            // Hero animations
            gsap.timeline()
                .to('.hero .fade-in', {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power2.out'
                })
                .to('.hero .scale-in', {
                    opacity: 1,
                    scale: 1,
                    duration: 0.8,
                    ease: 'back.out(1.7)'
                }, '-=0.5');
            
            // Scroll-triggered animations
            gsap.utils.toArray('.fade-in:not(.hero .fade-in)').forEach(element => {
                gsap.fromTo(element, {
                    opacity: 0,
                    y: 50
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });
            
            gsap.utils.toArray('.slide-in-left').forEach(element => {
                gsap.fromTo(element, {
                    opacity: 0,
                    x: -50
                }, {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });
            
            gsap.utils.toArray('.slide-in-right').forEach(element => {
                gsap.fromTo(element, {
                    opacity: 0,
                    x: 50
                }, {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });
            
            // Header scroll effect
            let lastScrollY = window.scrollY;
            
            window.addEventListener('scroll', () => {
                const currentScrollY = window.scrollY;
                const header = document.querySelector('.header');
                
                if (currentScrollY > 100) {
                    header.style.background = currentTheme === 'dark' 
                        ? 'rgba(15, 23, 42, 0.98)' 
                        : 'rgba(255, 255, 255, 0.98)';
                } else {
                    header.style.background = currentTheme === 'dark' 
                        ? 'rgba(15, 23, 42, 0.95)' 
                        : 'rgba(255, 255, 255, 0.95)';
                }
                
                lastScrollY = currentScrollY;
            });
        }

        // Countdown Timer
        function initializeCountdown() {
            const targetDate = new Date('2025-11-30T09:00:00-05:00').getTime();
            
            function updateCountdown() {
                const now = new Date().getTime();
                const distance = targetDate - now;
                
                if (distance < 0) {
                    // Launch date has passed
                    clearInterval(countdownInterval);
                    document.getElementById('days').textContent = '00';
                    document.getElementById('hours').textContent = '00';
                    document.getElementById('minutes').textContent = '00';
                    document.getElementById('seconds').textContent = '00';
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
            countdownInterval = setInterval(updateCountdown, 1000);
        }

        // Form Management
        function initializeForm() {
            const form = document.getElementById('notifyForm');
            const emailInput = document.getElementById('email');
            const submitBtn = document.getElementById('submitBtn');
            
            form.addEventListener('submit', handleFormSubmit);
            
            // Real-time email validation
            emailInput.addEventListener('input', function() {
                validateEmail(this.value);
            });
            
            emailInput.addEventListener('blur', function() {
                validateEmail(this.value);
            });
        }

        function validateEmail(email) {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            
            if (email && !isValid) {
                emailInput.style.borderColor = 'var(--refco-red)';
                emailError.textContent = currentLang === 'ar' 
                    ? 'يرجى إدخال عنوان بريد إلكتروني صحيح'
                    : 'Please enter a valid email address';
                emailError.className = 'text-primary text-sm mt-1';
                emailInput.setAttribute('aria-invalid', 'true');
                return false;
            } else {
                emailInput.style.borderColor = '';
                emailError.textContent = '';
                emailError.className = 'sr-only';
                emailInput.setAttribute('aria-invalid', 'false');
                return true;
            }
        }

        async function handleFormSubmit(e) {
            e.preventDefault();
            
            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            const email = document.getElementById('email').value.trim();
            const name = document.getElementById('name').value.trim();
            
            // Validate email
            if (!validateEmail(email)) {
                document.getElementById('email').focus();
                return;
            }
            
            // Rate limiting
            const now = Date.now();
            if (now - lastSubmissionTime < 60000) { // 60 seconds
                showToast(
                    currentLang === 'ar' 
                        ? 'يرجى الانتظار قبل إرسال طلب آخر'
                        : 'Please wait before submitting another request',
                    'error'
                );
                return;
            }
            
            // Disable form
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
            
            try {
                const formData = new FormData(form);
                
                const response = await fetch('notify.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.ok) {
                    showToast(
                        currentLang === 'ar'
                            ? 'شكراً! تم تسجيلك بنجاح. سنبلغك عند الإطلاق.'
                            : 'Thank you! You\'ve been successfully subscribed. We\'ll notify you at launch.',
                        'success'
                    );
                    form.reset();
                    lastSubmissionTime = now;
                } else {
                    throw new Error(result.error || 'Submission failed');
                }
            } catch (error) {
                console.error('Form submission error:', error);
                showToast(
                    currentLang === 'ar'
                        ? 'حدث خطأ. يرجى المحاولة مرة أخرى.'
                        : 'Something went wrong. Please try again.',
                    'error'
                );
            } finally {
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
            }
        }

        // Toast Notifications
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            
            toastMessage.textContent = message;
            toast.className = `toast ${type}`;
            toast.classList.add('show');
            
            // Announce to screen readers
            announceToScreenReader(message);
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 5000);
        }

        // Screen Reader Announcements
        function announceToScreenReader(message) {
            const announcement = document.createElement('div');
            announcement.setAttribute('aria-live', 'polite');
            announcement.setAttribute('aria-atomic', 'true');
            announcement.className = 'sr-only';
            announcement.textContent = message;
            
            document.body.appendChild(announcement);
            
            setTimeout(() => {
                document.body.removeChild(announcement);
            }, 1000);
        }

        // Progressive Enhancement - Handle no-JS case
        if (typeof gsap === 'undefined') {
            // Show all animated elements immediately
            document.querySelectorAll('.fade-in, .scale-in, .slide-in-left, .slide-in-right').forEach(el => {
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
        }

        // Performance optimizations
        
        // Lazy load images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Preload critical resources
        function preloadCriticalResources() {
            const criticalImages = ['hero.jpg', 'logo.png'];
            
            criticalImages.forEach(src => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = src;
                document.head.appendChild(link);
            });
        }

        // Call preload function
        preloadCriticalResources();

        // Handle connection issues gracefully
        window.addEventListener('online', function() {
            showToast(
                currentLang === 'ar' 
                    ? 'تم استعادة الاتصال بالإنترنت'
                    : 'Connection restored',
                'success'
            );
        });

        window.addEventListener('offline', function() {
            showToast(
                currentLang === 'ar'
                    ? 'فقدان الاتصال بالإنترنت'
                    : 'Connection lost',
                'error'
            );
        });
    </script>
</body>
</html>