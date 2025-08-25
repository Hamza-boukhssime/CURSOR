@extends('layouts.app')

@push('head')
    <!-- Open Graph / Twitter Meta -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors">
    <meta property="og:description" content="Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600">
    <meta property="og:image:alt" content="Riyadh skyline at dusk">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors">
    <meta name="twitter:description" content="Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position.">
    <meta name="twitter:image" content="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600">

    <!-- Article JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors",
      "description": "Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position.",
      "datePublished": "2025-05-14",
      "dateModified": "2025-05-14",
      "author": {
        "@type": "Person",
        "name": "Lina Al-Harbi"
      },
      "image": [
        "https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600",
        "https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1600"
      ],
      "inLanguage": "en",
      "articleSection": "Markets",
      "keywords": ["MENA","Venture","Energy transition","AI","Tourism"],
      "url": "{{ url()->current() }}"
    }
    </script>
@endpush

@section('content')
<style>
@layer components {
  /* Reading progress bar */
  .progress-bar { transform-origin: 0 0; will-change: transform; }

  /* Reveal baseline */
  .reveal-up { opacity: 0; transform: translateY(14px); transition: opacity .5s ease, transform .5s ease; }
  .is-in { opacity: 1; transform: translateY(0); }
  @media (prefers-reduced-motion: reduce) {
    .reveal-up { opacity: 1; transform: none; }
    .is-in { opacity: 1; transform: none; }
  }

  /* Anchor link button for headings */
  .anchor-btn { opacity: 0; transition: opacity .2s ease; }
  h2:hover .anchor-btn, h3:hover .anchor-btn, h2:focus-within .anchor-btn, h3:focus-within .anchor-btn { opacity: 1; }

  /* Prose adjustments */
  .prose-article :where(h2,h3) { scroll-margin-top: 7rem; }
  .prose-article :where(p,li) { color: rgb(17 24 39 / 0.86); }
  .dark .prose-article :where(p,li) { color: rgb(229 231 235 / 0.84); }

  /* Callouts */
  .callout { @apply rounded-2xl p-4 md:p-5 border shadow-sm; }
  .callout-info { @apply bg-riu/5 border-riu/20; }
  .callout-warn { @apply bg-yellow-50 border-yellow-200 text-yellow-900 dark:bg-yellow-950/30 dark:border-yellow-800/50 dark:text-yellow-100; }
  .callout-success { @apply bg-emerald-50 border-emerald-200 text-emerald-900 dark:bg-emerald-950/30 dark:border-emerald-800/50 dark:text-emerald-100; }

  /* Pull quote */
  .pull-quote { @apply relative my-8 md:my-10 px-6 py-6 md:py-8 rounded-2xl bg-riyada-beige/30 dark:bg-riu-ink/30 text-riu-navy dark:text-riu-beige shadow-sm; }
  .pull-quote:before { content: "\201C"; @apply absolute -top-4 ltr:left-4 rtl:right-4 text-5xl font-serif text-riy-gold/70; }

  /* Code */
  .code-block { @apply rounded-2xl bg-slate-900 text-slate-100 p-4 md:p-5 overflow-auto shadow-sm; }
  .code-caption { @apply mt-2 text-sm text-riu-gray; }
  .kbd { @apply inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-1.5 py-0.5 text-xs font-medium text-slate-700 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200; }

  /* Utility color aliases for tokens */
  .text-riu-navy { color: #081D2F; }
  .text-riu-gray { color: #898A8D; }
  .text-riu-beige { color: #CFCECB; }
  .bg-riu-navy { background-color: #081D2F; }
  .bg-riu-beige { background-color: #CFCECB; }
  .border-riu { border-color: #081D2F; }
  .border-riu/20 { border-color: rgb(8 29 47 / 0.2); }
  .bg-riu/5 { background-color: rgb(8 29 47 / 0.05); }
  .text-riy-gold { color: #C8A968; }

  /* TOC */
  .toc-link { @apply block py-1.5 text-sm leading-6 text-slate-600 hover:text-riu-navy dark:text-slate-300 dark:hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold rounded-md; }
  .toc-link[aria-current="true"] { @apply text-riu-navy dark:text-white font-semibold; }
}
</style>

<!-- Reading progress bar -->
<div aria-hidden="true" class="progress-bar fixed top-0 inset-x-0 z-50 h-1.5 bg-transparent">
  <div data-progress class="h-full bg-riy-gold dark:bg-amber-400" style="transform:scaleX(0);"></div>
  <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-black/5 dark:bg-white/5"></div>
</div>

<main id="main" class="min-h-screen bg-white text-slate-900 dark:bg-[#0A0B0D] dark:text-slate-100">
  <!-- Breadcrumbs -->
  <nav class="container mx-auto px-4 sm:px-6 lg:px-8 pt-8" aria-label="Breadcrumb">
    <ol class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300 rtl:space-x-reverse" role="list">
      <li><a href="/" class="hover:text-riu-navy dark:hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold rounded">Home</a></li>
      <li aria-hidden="true" class="text-slate-400">/</li>
      <li><a href="/blog" class="hover:text-riu-navy dark:hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold rounded">Blog</a></li>
      <li aria-hidden="true" class="text-slate-400">/</li>
      <li class="text-slate-800 dark:text-slate-100">Markets</li>
    </ol>
  </nav>

  <!-- Hero -->
  <header class="container mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-10">
    <div class="grid lg:grid-cols-12 gap-6 md:gap-8 items-start">
      <div class="lg:col-span-9">
        <a href="/blog" class="inline-flex items-center gap-2 text-sm text-riu-navy dark:text-riu-beige hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold rounded">
          <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5A1 1 0 018.707 4.293L5.414 7.586H18a1 1 0 110 2H5.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
          Back to blog
        </a>
        <h1 class="mt-4 md:mt-6 text-3xl md:text-5xl/[1.1] font-semibold tracking-tight text-riu-navy dark:text-white">
          Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors
        </h1>
        <p class="mt-4 text-lg md:text-xl text-slate-700 dark:text-slate-300 max-w-3xl">
          Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position.
        </p>

        <div class="mt-4 md:mt-6 flex flex-wrap items-center gap-3 text-sm text-slate-600 dark:text-slate-300">
          <time datetime="2025-05-14" class="inline-flex items-center gap-1"><span class="sr-only">Published</span>May 14, 2025</time>
          <span aria-hidden="true">•</span>
          <span>8 min read</span>
          <span aria-hidden="true">•</span>
          <a href="/blog?category=markets" class="px-2 py-1 rounded-full bg-riu-beige/40 text-riu-navy dark:bg-white/10 dark:text-white">Markets</a>
          <span class="ml-2 inline-flex flex-wrap gap-2" aria-label="Tags">
            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">MENA</span>
            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">Venture</span>
            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">Energy transition</span>
            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">AI</span>
            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">Tourism</span>
          </span>
        </div>

        <!-- Share -->
        <div class="mt-4 flex items-center gap-3" x-data="{}">
          <button type="button" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:shadow-sm hover:-translate-y-0.5 transition will-change-transform focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" data-share>
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 8a3 3 0 10-2.83-2H9a1 1 0 000 2h6.17A3.001 3.001 0 0018 8zM6 12a3 3 0 012.83-2H15a1 1 0 010 2H8.83A3.001 3.001 0 016 12zm12 4a3 3 0 10-2.83 2H9a1 1 0 110-2h6.17A3.001 3.001 0 0018 16z"/></svg>
            Share
          </button>
          <button type="button" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:shadow-sm hover:-translate-y-0.5 transition will-change-transform focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" data-copy-url>
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 1H4a2 2 0 00-2 2v12h2V3h12V1z"/><path d="M20 5H8a2 2 0 00-2 2v16h14a2 2 0 002-2V7a2 2 0 00-2-2zm0 16H8V7h12v14z"/></svg>
            Copy link
          </button>
          <a class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:shadow-sm hover:-translate-y-0.5 transition will-change-transform focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" href="https://twitter.com/intent/tweet?text={{ urlencode('Saudi Investment Outlook 2025') }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener">Twitter</a>
          <a class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:shadow-sm hover:-translate-y-0.5 transition will-change-transform focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener">LinkedIn</a>
        </div>
      </div>

      <!-- Sticky TOC (desktop) -->
      <aside class="hidden lg:block lg:col-span-3">
        <div class="lg:sticky top-24 rounded-2xl bg-slate-50/60 dark:bg-white/5 border border-slate-200 dark:border-slate-800 p-4">
          <h2 class="text-sm font-semibold text-riu-navy dark:text-white mb-2">On this page</h2>
          <nav aria-label="Table of contents">
            <ul class="space-y-1">
              <li><a class="toc-link" href="#macro-snapshot-resilient-growth-disciplined-spending">Macro snapshot: resilient growth, disciplined spending</a></li>
              <li><a class="toc-link" href="#5-sectors-with-outlier-potential">5 sectors with outlier potential</a></li>
              <li><a class="toc-link" href="#playbook-founders-investors">Playbook: founders &amp; investors</a></li>
              <li><a class="toc-link" href="#risks-to-track">Risks to track</a></li>
            </ul>
          </nav>
        </div>
      </aside>
    </div>

    <!-- Hero media -->
    <div class="mt-6 md:mt-10 rounded-2xl overflow-hidden shadow ring-1 ring-black/5 dark:ring-white/5" data-reveal>
      <!-- Light -->
      <img
        src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200"
        srcset="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=800 800w, https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200 1200w, https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600 1600w"
        sizes="(min-width: 1024px) 1024px, 100vw"
        width="1600" height="900"
        alt="Riyadh skyline at dusk"
        class="block dark:hidden w-full h-auto object-cover aspect-[16/9] will-change-transform" loading="eager" decoding="async" data-parallax>
      <!-- Dark -->
      <img
        src="https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1200"
        srcset="https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=800 800w, https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1200 1200w, https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1600 1600w"
        sizes="(min-width: 1024px) 1024px, 100vw"
        width="1600" height="900"
        alt="Riyadh skyline at dusk"
        class="hidden dark:block w-full h-auto object-cover aspect-[16/9] will-change-transform" loading="eager" decoding="async" data-parallax>
    </div>

    <!-- Mobile TOC -->
    <div class="lg:hidden mt-6" data-reveal>
      <details class="rounded-xl bg-slate-50/60 dark:bg-white/5 border border-slate-200 dark:border-slate-800">
        <summary class="cursor-pointer p-4 font-medium text-riu-navy dark:text-white">On this page</summary>
        <nav class="px-4 pb-4" aria-label="Table of contents">
          <ul class="space-y-1">
            <li><a class="toc-link" href="#macro-snapshot-resilient-growth-disciplined-spending">Macro snapshot: resilient growth, disciplined spending</a></li>
            <li><a class="toc-link" href="#5-sectors-with-outlier-potential">5 sectors with outlier potential</a></li>
            <li><a class="toc-link" href="#playbook-founders-investors">Playbook: founders &amp; investors</a></li>
            <li><a class="toc-link" href="#risks-to-track">Risks to track</a></li>
          </ul>
        </nav>
      </details>
    </div>
  </header>

  <div class="container mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-12 gap-6 md:gap-8 mt-8 md:mt-12">
    <article class="prose-article lg:col-span-9 max-w-none text-base leading-8">
      <!-- Section 1 -->
      <section id="macro-snapshot-resilient-growth-disciplined-spending" class="reveal-up" data-reveal>
        <h2 class="group text-2xl md:text-3xl font-semibold text-riu-navy dark:text-white flex items-baseline gap-2">
          Macro snapshot: resilient growth, disciplined spending
          <button class="anchor-btn inline-flex items-center p-1 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" data-anchor="macro-snapshot-resilient-growth-disciplined-spending" aria-label="Copy link to section">
            <svg class="h-4 w-4 text-riu-gray" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.9 12a5 5 0 017.78-3.9l.92.7a1 1 0 101.2-1.6l-.92-.7a7 7 0 10-8.68 10.8l.92.7a1 1 0 001.2-1.6l-.92-.7A4.98 4.98 0 013.9 12z"/><path d="M20.1 12a5 5 0 01-7.78 3.9l-.92-.7a1 1 0 10-1.2 1.6l.92.7A7 7 0 1020.8 5.7l-.92-.7a1 1 0 10-1.2 1.6l.92.7A4.98 4.98 0 0120.1 12z"/></svg>
          </button>
        </h2>
        <p class="mt-3 text-slate-700 dark:text-slate-300">
          Real GDP growth is set to re-accelerate as non-oil sectors expand. Fiscal policy remains disciplined, with capex targeted
          at logistics, tourism, and digital infrastructure. Liquidity conditions are healthy; however, dollar strength continues to shape funding costs.
        </p>
        <div class="callout callout-info mt-4">
          <p class="text-sm">Non-oil activity and productivity gains are the core drivers; watch PMI, credit growth, and private capex.</p>
        </div>
      </section>

      <!-- Section 2 -->
      <section id="5-sectors-with-outlier-potential" class="reveal-up mt-10 md:mt-12" data-reveal>
        <h2 class="group text-2xl md:text-3xl font-semibold text-riu-navy dark:text-white flex items-baseline gap-2">
          5 sectors with outlier potential
          <button class="anchor-btn inline-flex items-center p-1 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" data-anchor="5-sectors-with-outlier-potential" aria-label="Copy link to section">
            <svg class="h-4 w-4 text-riu-gray" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.9 12a5 5 0 017.78-3.9l.92.7a1 1 0 101.2-1.6l-.92-.7a7 7 0 10-8.68 10.8l.92.7a1 1 0 001.2-1.6l-.92-.7A4.98 4.98 0 013.9 12z"/><path d="M20.1 12a5 5 0 01-7.78 3.9l-.92-.7a1 1 0 10-1.2 1.6l.92.7A7 7 0 1020.8 5.7l-.92-.7a1 1 0 10-1.2 1.6l.92.7A4.98 4.98 0 0120.1 12z"/></svg>
          </button>
        </h2>
        <p class="mt-3 text-slate-700 dark:text-slate-300">
          <strong>AI &amp; Cloud</strong>: hyperscaler footprints deepening; talent pipelines improving.
          <strong>Clean energy &amp; materials</strong>: green hydrogen pilots; aluminum and steel decarbonization.
          <strong>Logistics</strong>: port/airport throughput capacity upgrades.
          <strong>Tourism &amp; entertainment</strong>: destination projects converting; premium hospitality pipeline.
          <strong>Sports &amp; wellness</strong>: growing event economy with downstream SMEs.
        </p>
        <figure class="pull-quote" data-reveal>
          <blockquote class="text-xl md:text-2xl font-medium">Follow capacity—not headlines. Where infrastructure scales, company formation follows.</blockquote>
        </figure>
      </section>

      <!-- Media grid -->
      <section class="mt-10 md:mt-12" aria-label="Image gallery" data-reveal>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <li>
            <img class="w-full h-auto rounded-2xl shadow-sm hover:scale-[1.01] transition will-change-transform" src="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=800" srcset="https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=480 480w, https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=800 800w" sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw" width="800" height="600" alt="Workspace and laptop" loading="lazy" decoding="async">
          </li>
          <li>
            <img class="w-full h-auto rounded-2xl shadow-sm hover:scale-[1.01] transition will-change-transform" src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=800" srcset="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=480 480w, https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=800 800w" sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw" width="800" height="600" alt="Team collaboration" loading="lazy" decoding="async">
          </li>
          <li>
            <img class="w-full h-auto rounded-2xl shadow-sm hover:scale-[1.01] transition will-change-transform" src="https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?q=80&w=800" srcset="https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?q=80&w=480 480w, https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?q=80&w=800 800w" sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw" width="800" height="600" alt="Code and coffee" loading="lazy" decoding="async">
          </li>
        </ul>
      </section>

      <!-- Section 3 -->
      <section id="playbook-founders-investors" class="reveal-up mt-10 md:mt-12" data-reveal>
        <h2 class="group text-2xl md:text-3xl font-semibold text-riu-navy dark:text-white flex items-baseline gap-2">
          Playbook: founders &amp; investors
          <button class="anchor-btn inline-flex items-center p-1 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" data-anchor="playbook-founders-investors" aria-label="Copy link to section">
            <svg class="h-4 w-4 text-riu-gray" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.9 12a5 5 0 017.78-3.9l.92.7a1 1 0 101.2-1.6l-.92-.7a7 7 0 10-8.68 10.8l.92.7a1 1 0 001.2-1.6l-.92-.7A4.98 4.98 0 013.9 12z"/><path d="M20.1 12a5 5 0 01-7.78 3.9l-.92-.7a1 1 0 10-1.2 1.6l.92.7A7 7 0 1020.8 5.7l-.92-.7a1 1 0 10-1.2 1.6l.92.7A4.98 4.98 0 0120.1 12z"/></svg>
          </button>
        </h2>
        <p class="mt-3 text-slate-700 dark:text-slate-300">
          Validate with enterprise anchors; design for regional export by default; derisk with local partnerships.
          For funds: smaller ownership but faster velocity; hands-on value creation (hiring, go-to-market, compliance).
        </p>
        <ul class="mt-4 list-disc ps-6 marker:text-riy-gold">
          <li>B2B first; integrate with national platforms where possible.</li>
          <li>Unit economics &gt; GMV; gross margin floors by segment.</li>
          <li>Talent: apprentice model + senior boomerangs.</li>
        </ul>
      </section>

      <!-- Code sample -->
      <section class="mt-10 md:mt-12" data-reveal>
        <div class="code-block" role="region" aria-label="Code sample: bash">
<pre><code class="language-bash">npm run build &amp;&amp; php artisan cache:clear &amp;&amp; php artisan view:clear</code></pre>
        </div>
        <p class="code-caption">Example: quick content deploy script</p>
      </section>

      <!-- Section 4 -->
      <section id="risks-to-track" class="reveal-up mt-10 md:mt-12" data-reveal>
        <h2 class="group text-2xl md:text-3xl font-semibold text-riu-navy dark:text-white flex items-baseline gap-2">
          Risks to track
          <button class="anchor-btn inline-flex items-center p-1 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold" data-anchor="risks-to-track" aria-label="Copy link to section">
            <svg class="h-4 w-4 text-riu-gray" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.9 12a5 5 0 017.78-3.9l.92.7a1 1 0 101.2-1.6l-.92-.7a7 7 0 10-8.68 10.8l.92.7a1 1 0 001.2-1.6l-.92-.7A4.98 4.98 0 013.9 12z"/><path d="M20.1 12a5 5 0 01-7.78 3.9l-.92-.7a1 1 0 10-1.2 1.6l.92.7A7 7 0 1020.8 5.7l-.92-.7a1 1 0 10-1.2 1.6l.92.7A4.98 4.98 0 0120.1 12z"/></svg>
          </button>
        </h2>
        <p class="mt-3 text-slate-700 dark:text-slate-300">
          Rate path uncertainty, supply chain bottlenecks, and execution bandwidth on mega-projects.
          Keep scenario plans for FX and import lead times.
          <sup id="ref-f1"><a class="underline decoration-dotted" href="#f1">[1]</a></sup>
        </p>
      </section>

      <!-- Footnotes -->
      <section aria-label="Footnotes" class="mt-10 md:mt-12 border-t border-slate-200 dark:border-slate-800 pt-6">
        <ol class="list-decimal ps-6 space-y-2 text-sm text-slate-600 dark:text-slate-300">
          <li id="f1">PMI = Purchasing Managers' Index; a diffusion index &gt;50 signals expansion. <a href="#ref-f1" class="text-riu-navy dark:text-white underline decoration-dotted">↩︎</a></li>
        </ol>
      </section>
    </article>

    <!-- Right rail spacing on large screens -->
    <div class="hidden lg:block lg:col-span-3"></div>
  </div>

  <!-- Author card -->
  <section class="container mx-auto px-4 sm:px-6 lg:px-8 mt-12 md:mt-16" data-reveal>
    <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/60 dark:bg-white/5 p-4 md:p-6 flex gap-4 md:gap-6 items-center">
      <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=256" width="96" height="96" alt="Portrait of Lina Al-Harbi" class="h-16 w-16 md:h-24 md:w-24 rounded-2xl object-cover shadow-sm" loading="lazy" decoding="async">
      <div class="min-w-0">
        <h3 class="text-xl font-semibold text-riu-navy dark:text-white">Lina Al-Harbi</h3>
        <p class="text-sm text-riu-gray">Head of Research</p>
        <p class="mt-2 text-slate-700 dark:text-slate-300 text-sm">Analyst focusing on MENA growth markets, industrials, and digital transformation.</p>
        <div class="mt-3 flex flex-wrap gap-2">
          <a href="https://twitter.com/example" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:shadow-sm hover:-translate-y-0.5 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold">Twitter</a>
          <a href="https://www.linkedin.com/in/example" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 hover:shadow-sm hover:-translate-y-0.5 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold">LinkedIn</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter CTA (guarded) -->
  @if (Route::has('newsletter.subscribe'))
  <section class="container mx-auto px-4 sm:px-6 lg:px-8 mt-12 md:mt-16" data-reveal>
    <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0C0E11] p-6 md:p-8 shadow-sm">
      <div class="md:flex md:items-center md:justify-between gap-6">
        <div class="md:max-w-2xl">
          <h3 class="text-2xl font-semibold text-riu-navy dark:text-white">Get the Research Briefing</h3>
          <p class="mt-2 text-slate-700 dark:text-slate-300">Actionable insight on MENA growth sectors. No noise—just signals.</p>
        </div>
        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="mt-4 md:mt-0 w-full md:w-auto">
          @csrf
          <div class="flex items-center gap-2">
            <label for="email" class="sr-only">Email</label>
            <input id="email" name="email" type="email" required autocomplete="email" placeholder="you@company.com" class="flex-1 md:w-80 rounded-xl border border-slate-300 dark:border-slate-700 bg-white/80 dark:bg-slate-900/60 px-3 py-2 text-base placeholder-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold">
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-riy-gold text-[#081D2F] font-semibold shadow hover:shadow-md hover:-translate-y-0.5 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-riy-gold">Subscribe</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  @endif

  <!-- Related posts -->
  <section class="container mx-auto px-4 sm:px-6 lg:px-8 mt-12 md:mt-16 mb-16" aria-label="Related posts" data-reveal>
    <h2 class="text-2xl font-semibold text-riu-navy dark:text-white">Related posts</h2>
    <ul class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <li class="group rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-white dark:bg-[#0C0E11] hover:shadow-md transition">
        <a href="/blog/vision-2030-logistics" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold">
          <img src="https://images.unsplash.com/photo-1554188248-986adbb73be0?q=80&w=640" width="640" height="400" alt="Vision 2030 logistics cover" class="w-full h-auto object-cover aspect-[16/10] group-hover:scale-[1.02] transition will-change-transform" loading="lazy" decoding="async">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-riu-navy dark:text-white">Vision 2030: Logistics as a Growth Engine</h3>
          </div>
        </a>
      </li>
      <li class="group rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-white dark:bg-[#0C0E11] hover:shadow-md transition">
        <a href="/blog/tourism-playbook" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold">
          <img src="https://images.unsplash.com/photo-1494475673543-6a6a27143b22?q=80&w=640" width="640" height="400" alt="Tourism playbook cover" class="w-full h-auto object-cover aspect-[16/10] group-hover:scale-[1.02] transition will-change-transform" loading="lazy" decoding="async">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-riu-navy dark:text-white">Tourism Playbook: Building Premium Experiences</h3>
          </div>
        </a>
      </li>
      <li class="group rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-white dark:bg-[#0C0E11] hover:shadow-md transition">
        <a href="/blog/ai-in-mena" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold">
          <img src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=640" width="640" height="400" alt="AI in MENA cover" class="w-full h-auto object-cover aspect-[16/10] group-hover:scale-[1.02] transition will-change-transform" loading="lazy" decoding="async">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-riu-navy dark:text-white">AI in MENA: Talent, Cloud, and Enterprise Buying</h3>
          </div>
        </a>
      </li>
    </ul>
  </section>

  <footer class="container mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <a href="/blog" class="inline-flex items-center gap-2 text-riu-navy dark:text-riu-beige hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-riy-gold rounded">
      <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5A1 1 0 018.707 4.293L5.414 7.586H18a1 1 0 110 2H5.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
      Back to blog
    </a>
  </footer>
</main>

<!-- JS: baseline reveal/progress + TOC spy + copy/share -->
<script type="module">
// Exact provided module (selectors already match our markup)
(() => {
  const canAnimate =
    matchMedia('(prefers-reduced-motion: no-preference)').matches &&
    matchMedia('(pointer:fine)').matches &&
    innerWidth >= 1024;

  // Vanilla IO reveal (baseline) — used when GSAP isn't loaded or for mobile
  const io = 'IntersectionObserver' in window
    ? new IntersectionObserver((entries) => {
        entries.forEach(e => {
          if (e.isIntersecting) {
            e.target.classList.add('is-in');
            io.unobserve(e.target);
          }
        });
      }, { rootMargin: '0px 0px -10% 0px', threshold: 0.05 })
    : null;
  document.querySelectorAll('[data-reveal]').forEach(el => io && io.observe(el));

  // Reading progress (vanilla)
  const bar = document.querySelector('[data-progress]');
  if (bar) {
    const update = () => {
      const max = document.documentElement.scrollHeight - innerHeight;
      const p = max > 0 ? scrollY / max : 0;
      bar.style.transform = `scaleX(${Math.min(1, Math.max(0, p))})`;
    };
    addEventListener('scroll', update, { passive: true });
    addEventListener('resize', update);
    update();
  }

  // Optional GSAP upgrade (lazy, gated)
  if (!canAnimate) return;

  (async () => {
    try {
      // Prefer local bundle (Vite). If not available, fall back to ESM CDN.
      let gsap, ScrollTrigger;
      try {
        ({ gsap } = await import('gsap'));
        ({ default: ScrollTrigger } = await import('gsap/ScrollTrigger'));
      } catch (e) {
        ({ gsap } = await import('https://esm.sh/gsap@3'));
        ({ default: ScrollTrigger } = await import('https://esm.sh/gsap@3/ScrollTrigger'));
      }
      gsap.registerPlugin(ScrollTrigger);

      // Upgrade reveals with nicer easing (transform/opacity only)
      document.querySelectorAll('[data-reveal]').forEach((el) => {
        gsap.fromTo(el, { y: 16, opacity: 0 }, {
          y: 0, opacity: 1, duration: 0.6, ease: 'power2.out',
          scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none reverse' }
        });
      });

      // Optional parallax for hero media (keep subtle)
      const hero = document.querySelector('[data-parallax]');
      if (hero) {
        gsap.to(hero, {
          yPercent: 6, ease: 'none',
          scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: 0.25 }
        });
      }
    } catch (_) {
      // If GSAP fails to load, baseline IO reveal already handles UX.
    }
  })();
})();

// TOC scroll-spy
(() => {
  const tocLinks = Array.from(document.querySelectorAll('.toc-link'));
  if (!('IntersectionObserver' in window) || tocLinks.length === 0) return;
  const headings = Array.from(document.querySelectorAll('article section[id]'));
  const byId = new Map(tocLinks.map(a => [decodeURIComponent(a.hash.slice(1)), a]));
  const setActive = (id) => {
    tocLinks.forEach(a => a.setAttribute('aria-current', a.hash.slice(1) === id ? 'true' : 'false'));
  };
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) setActive(e.target.id);
    });
  }, { rootMargin: '-20% 0px -70% 0px', threshold: 0.01 });
  headings.forEach(h => io.observe(h));
})();

// Copy heading deep-link + page share
(() => {
  // Copy specific heading
  const toasts = new Map();
  const showToast = (el, msg) => {
    let t = toasts.get(el);
    if (!t) {
      t = document.createElement('div');
      t.className = 'pointer-events-none fixed z-50 inset-x-0 top-16 mx-auto w-fit px-3 py-1 rounded-lg bg-black/80 text-white text-sm';
      document.body.appendChild(t);
      toasts.set(el, t);
    }
    t.textContent = msg; t.style.opacity = '1';
    clearTimeout(t._timer);
    t._timer = setTimeout(() => { t.style.opacity = '0'; }, 1200);
  };
  document.querySelectorAll('[data-anchor]').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.getAttribute('data-anchor');
      const url = `${location.origin}${location.pathname}#${id}`;
      try {
        await navigator.clipboard.writeText(url);
        showToast(btn, 'Link copied');
      } catch (_) {
        // Fallback
        const input = document.createElement('input');
        input.value = url; document.body.appendChild(input); input.select();
        document.execCommand('copy'); document.body.removeChild(input);
        showToast(btn, 'Link copied');
      }
    });
  });

  // Share current page
  const shareBtn = document.querySelector('[data-share]');
  const copyBtn = document.querySelector('[data-copy-url]');
  const shareData = {
    title: 'Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors',
    text: 'Read the latest research briefing.',
    url: location.href
  };
  if (shareBtn) {
    shareBtn.addEventListener('click', async () => {
      if (navigator.share) {
        try { await navigator.share(shareData); } catch (_) {}
      } else if (copyBtn) {
        copyBtn.click();
      }
    });
  }
  if (copyBtn) {
    copyBtn.addEventListener('click', async () => {
      try { await navigator.clipboard.writeText(location.href); } catch (_) {}
    });
  }
})();
</script>

@endsection

