@extends('layouts.app')

@push('head')
    {{-- Open Graph & Twitter --}}
    <meta property="og:title" content="Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors">
    <meta property="og:description" content="Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position.">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url('/blog/saudi-investment-outlook-2025') }}">
    <meta property="og:image" content="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600">
    <meta property="og:image:alt" content="Riyadh skyline at dusk">
    <meta property="article:published_time" content="2025-05-14">
    <meta property="article:section" content="Markets">
    <meta property="article:tag" content="MENA">
    <meta property="article:tag" content="Venture">
    <meta property="article:tag" content="Energy transition">
    <meta property="article:tag" content="AI">
    <meta property="article:tag" content="Tourism">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors">
    <meta name="twitter:description" content="Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position.">
    <meta name="twitter:image" content="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600">

    {{-- JSON-LD Article Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors",
      "datePublished": "2025-05-14",
      "dateModified": "2025-05-14",
      "author": {
        "@type": "Person",
        "name": "Lina Al-Harbi",
        "jobTitle": "Head of Research",
        "image": "https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=256",
        "sameAs": [
          "https://twitter.com/example",
          "https://www.linkedin.com/in/example"
        ]
      },
      "publisher": {
        "@type": "Organization",
        "name": "Riyada",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ url('/favicon.ico') }}"
        }
      },
      "image": [
        "https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600",
        "https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1600"
      ],
      "articleSection": "Markets",
      "keywords": "MENA, Venture, Energy transition, AI, Tourism",
      "mainEntityOfPage": "{{ url('/blog/saudi-investment-outlook-2025') }}",
      "description": "Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position."
    }
    </script>
@endpush

@section('content')
    {{-- Reading progress bar (uses transform scaleX to avoid layout thrash) --}}
    <div class="fixed inset-x-0 top-0 z-40 h-1.5 bg-transparent" aria-hidden="true">
        <div data-progress class="h-full origin-left rtl:origin-right scale-x-0 bg-riy-gold transition-transform duration-150 will-change-transform"></div>
    </div>

    <main class="relative">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 sm:pt-24">
            {{-- Breadcrumb --}}
            <nav class="mb-6 sm:mb-8" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2 text-sm sm:text-base text-riyada-gray">
                    <li><a href="/" class="hover:text-riy-gold focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900 rounded px-1">Home</a></li>
                    <li class="text-riyada-gray/60" aria-hidden="true">/</li>
                    <li><a href="/blog" class="hover:text-riy-gold focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900 rounded px-1">Blog</a></li>
                    <li class="text-riyada-gray/60" aria-hidden="true">/</li>
                    <li class="text-riyada-navy dark:text-neutral-200">Saudi Investment Outlook 2025</li>
                </ol>
            </nav>

            {{-- Hero --}}
            <header class="relative overflow-hidden rounded-2xl bg-white/70 dark:bg-neutral-900/60 shadow-sm ring-1 ring-black/5 dark:ring-white/5" data-reveal data-parallax>
                <div class="grid lg:grid-cols-2 gap-0">
                    <div class="p-6 sm:p-10 order-2 lg:order-1">
                        <div class="mb-4 flex items-center gap-2 text-xs sm:text-sm text-riyada-gray">
                            <span class="inline-flex items-center rounded-full bg-riyada-beige/40 px-2.5 py-1 text-riyada-navy dark:text-neutral-200">Markets</span>
                            <span aria-hidden="true" class="text-riyada-gray/50">•</span>
                            <time datetime="2025-05-14">May 14, 2025</time>
                            <span aria-hidden="true" class="text-riyada-gray/50">•</span>
                            <span>8 min read</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-riyada-navy dark:text-neutral-50">
                            Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors
                        </h1>
                        <p class="mt-4 sm:mt-6 text-base sm:text-lg leading-relaxed text-riyada-gray dark:text-neutral-300">
                            Saudi Arabia is moving from a hydrocarbon-centric cycle to a multi-engine growth model. Here’s where capital is flowing in 2025—and how founders and investors can position.
                        </p>
                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <button type="button" data-share
                                class="inline-flex items-center gap-2 rounded-full bg-riy-gold/10 px-3 py-1.5 text-riyada-navy dark:text-neutral-100 hover:bg-riy-gold/20 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 8a3 3 0 1 0-2.83-4H15a3 3 0 0 0 0 6h.17A3 3 0 0 0 18 8ZM6 14a3 3 0 1 0-2.83 4H3a3 3 0 0 0 0-6h.17A3 3 0 0 0 6 14Zm9.17-6H9.83a3 3 0 0 0 0 6h5.34a3 3 0 0 0 0-6Z"/></svg>
                                <span class="text-sm">Share</span>
                            </button>
                            <a href="#newsletter" class="inline-flex items-center gap-2 rounded-full bg-riyada-navy text-white dark:bg-neutral-800 px-3 py-1.5 hover:translate-y-[-1px] transition will-change-transform focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M2 5h20v14H2V5Zm2 2v10h16V7l-8 5L4 7Zm1-.5 7 4.375L19 6.5H5Z"/></svg>
                                <span class="text-sm">Subscribe</span>
                            </a>
                        </div>
                    </div>
                    <div class="relative order-1 lg:order-2">
                        <picture>
                            <source media="(prefers-color-scheme: dark)" srcset="
                                https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=640 640w,
                                https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=960 960w,
                                https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1280 1280w,
                                https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d?q=80&w=1600 1600w" sizes="(min-width: 1024px) 50vw, 100vw">
                            <img
                                class="h-full w-full object-cover aspect-[16/9] lg:aspect-auto"
                                srcset="
                                    https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=640 640w,
                                    https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=960 960w,
                                    https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1280 1280w,
                                    https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600 1600w"
                                sizes="(min-width: 1024px) 50vw, 100vw"
                                src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600"
                                alt="Riyadh skyline at dusk" loading="eager" decoding="async">
                        </picture>
                    </div>
                </div>
            </header>

            {{-- Meta row under hero (tags) --}}
            <div class="mt-6 flex flex-wrap items-center gap-2" aria-label="Tags">
                <span class="text-xs sm:text-sm text-riyada-gray">Tags:</span>
                @foreach (["MENA","Venture","Energy transition","AI","Tourism"] as $tag)
                    <span class="inline-flex items-center rounded-full border border-riyada-gray/30 text-riyada-gray px-2 py-0.5 text-xs sm:text-sm">{{ $tag }}</span>
                @endforeach
            </div>

            {{-- Layout grid: TOC aside + Article + Spacer/rail --}}
            <div class="mt-10 grid lg:grid-cols-[minmax(0,260px)_minmax(0,1fr)_minmax(0,280px)] gap-8 lg:gap-10">
                {{-- Sticky TOC (desktop) / Collapsible (mobile) --}}
                <aside class="lg:sticky lg:top-28 self-start order-2 lg:order-1" aria-label="Table of contents">
                    <div class="rounded-xl bg-white dark:bg-neutral-900 shadow-sm ring-1 ring-black/5 dark:ring-white/5 p-4" data-reveal>
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-semibold text-riyada-navy dark:text-neutral-100">On this page</h2>
                            <button type="button" data-toc-toggle aria-expanded="false" class="lg:hidden inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-riyada-beige/40 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-controls="toc-list" aria-label="Toggle table of contents">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4 7h16v2H4V7Zm0 4h16v2H4v-2Zm0 4h16v2H4v-2Z"/></svg>
                            </button>
                        </div>
                        <nav id="toc-list" class="mt-3 lg:mt-4 hidden lg:block">
                            <ol class="space-y-2 text-sm">
                                <li><a href="#macro-snapshot" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">Macro snapshot: resilient growth, disciplined spending</a></li>
                                <li><a href="#five-sectors" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">5 sectors with outlier potential</a></li>
                                <li><a href="#playbook" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">Playbook: founders & investors</a></li>
                                <li><a href="#risks" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">Risks to track</a></li>
                                <li><a href="#media" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">Media</a></li>
                                <li><a href="#footnotes" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">Footnotes</a></li>
                            </ol>
                        </nav>
                    </div>
                </aside>

                {{-- Article --}}
                <article class="prose prose-neutral dark:prose-invert max-w-none prose-h2:scroll-mt-28 prose-h3:scroll-mt-28 prose-img:rounded-xl" data-reveal>
                    {{-- Mobile TOC --}}
                    <div class="mb-6 lg:hidden">
                        <button type="button" data-toc-toggle aria-expanded="false" aria-controls="toc-mobile" class="inline-flex items-center gap-2 rounded-lg bg-white dark:bg-neutral-900 shadow-sm ring-1 ring-black/5 dark:ring-white/5 px-3 py-2 text-sm text-riyada-navy dark:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4 7h16v2H4V7Zm0 4h16v2H4v-2Zm0 4h16v2H4v-2Z"/></svg>
                            On this page
                        </button>
                        <nav id="toc-mobile" class="mt-3 hidden">
                            <ol class="space-y-2 text-sm">
                                <li><a href="#macro-snapshot" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100">Macro snapshot: resilient growth, disciplined spending</a></li>
                                <li><a href="#five-sectors" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100">5 sectors with outlier potential</a></li>
                                <li><a href="#playbook" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100">Playbook: founders & investors</a></li>
                                <li><a href="#risks" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100">Risks to track</a></li>
                                <li><a href="#media" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100">Media</a></li>
                                <li><a href="#footnotes" class="toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100">Footnotes</a></li>
                            </ol>
                        </nav>
                    </div>

                    {{-- Sections --}}
                    <section id="macro-snapshot" class="scroll-mt-28">
                        <h2 class="group flex items-baseline gap-2 text-2xl sm:text-3xl font-semibold text-riyada-navy dark:text-neutral-100" data-anchored>
                            Macro snapshot: resilient growth, disciplined spending
                            <button type="button" data-anchor="macro-snapshot" class="opacity-0 group-hover:opacity-100 transition focus:opacity-100 ml-1 inline-flex h-7 w-7 items-center justify-center rounded-md text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="Copy link to Macro snapshot">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M10 3a2 2 0 0 0-2 2v3h2V5h3V3h-3Zm6 6V7h-2v2h2Zm-9 2H5v2h2v-2Zm0 4H5v2h2v-2Zm4 4h-3v-2H6v3a2 2 0 0 0 2 2h3v-3Zm2 0v3h3a2 2 0 0 0 2-2v-3h-2v2h-3Z"/></svg>
                            </button>
                        </h2>
                        <p class="mt-4 text-riyada-gray dark:text-neutral-300">
                            Real GDP growth is set to re-accelerate as non-oil sectors expand. Fiscal policy remains disciplined, with capex targeted
                            at logistics, tourism, and digital infrastructure. Liquidity conditions are healthy; however, dollar strength continues to shape funding costs.
                        </p>
                        <aside class="mt-4 c-callout c-callout--info" role="note">
                            <p>Non-oil activity and productivity gains are the core drivers; watch PMI, credit growth, and private capex.</p>
                        </aside>
                    </section>

                    <section id="five-sectors" class="scroll-mt-28 mt-12" data-reveal>
                        <h2 class="group flex items-baseline gap-2 text-2xl sm:text-3xl font-semibold text-riyada-navy dark:text-neutral-100" data-anchored>
                            5 sectors with outlier potential
                            <button type="button" data-anchor="five-sectors" class="opacity-0 group-hover:opacity-100 transition focus:opacity-100 ml-1 inline-flex h-7 w-7 items-center justify-center rounded-md text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="Copy link to 5 sectors">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M10 3a2 2 0 0 0-2 2v3h2V5h3V3h-3Zm6 6V7h-2v2h2Zm-9 2H5v2h2v-2Zm0 4H5v2h2v-2Zm4 4h-3v-2H6v3a2 2 0 0 0 2 2h3v-3Zm2 0v3h3a2 2 0 0 0 2-2v-3h-2v2h-3Z"/></svg>
                            </button>
                        </h2>
                        <p class="mt-4 text-riyada-gray dark:text-neutral-300">
                            <strong>AI &amp; Cloud</strong>: hyperscaler footprints deepening; talent pipelines improving.
                            <strong>Clean energy &amp; materials</strong>: green hydrogen pilots; aluminum and steel decarbonization.
                            <strong>Logistics</strong>: port/airport throughput capacity upgrades.
                            <strong>Tourism &amp; entertainment</strong>: destination projects converting; premium hospitality pipeline.
                            <strong>Sports &amp; wellness</strong>: growing event economy with downstream SMEs.
                        </p>
                        <figure class="mt-6">
                            <blockquote class="pull-quote">“Follow capacity—not headlines. Where infrastructure scales, company formation follows.”</blockquote>
                        </figure>
                    </section>

                    <section id="playbook" class="scroll-mt-28 mt-12" data-reveal>
                        <h2 class="group flex items-baseline gap-2 text-2xl sm:text-3xl font-semibold text-riyada-navy dark:text-neutral-100" data-anchored>
                            Playbook: founders &amp; investors
                            <button type="button" data-anchor="playbook" class="opacity-0 group-hover:opacity-100 transition focus:opacity-100 ml-1 inline-flex h-7 w-7 items-center justify-center rounded-md text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="Copy link to Playbook">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M10 3a2 2 0 0 0-2 2v3h2V5h3V3h-3Zm6 6V7h-2v2h2Zm-9 2H5v2h2v-2Zm0 4H5v2h2v-2Zm4 4h-3v-2H6v3a2 2 0 0 0 2 2h3v-3Zm2 0v3h3a2 2 0 0 0 2-2v-3h-2v2h-3Z"/></svg>
                            </button>
                        </h2>
                        <p class="mt-4 text-riyada-gray dark:text-neutral-300">
                            Validate with enterprise anchors; design for regional export by default; derisk with local partnerships.
                            For funds: smaller ownership but faster velocity; hands-on value creation (hiring, go-to-market, compliance).
                        </p>
                        <aside class="mt-4 c-callout c-callout--success" role="note">
                            <ul class="list-disc pl-5 rtl:pl-0 rtl:pr-5 space-y-2">
                                <li>B2B first; integrate with national platforms where possible.</li>
                                <li>Unit economics &gt; GMV; gross margin floors by segment.</li>
                                <li>Talent: apprentice model + senior boomerangs.</li>
                            </ul>
                        </aside>
                    </section>

                    <section id="risks" class="scroll-mt-28 mt-12" data-reveal>
                        <h2 class="group flex items-baseline gap-2 text-2xl sm:text-3xl font-semibold text-riyada-navy dark:text-neutral-100" data-anchored>
                            Risks to track
                            <button type="button" data-anchor="risks" class="opacity-0 group-hover:opacity-100 transition focus:opacity-100 ml-1 inline-flex h-7 w-7 items-center justify-center rounded-md text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="Copy link to Risks">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M10 3a2 2 0 0 0-2 2v3h2V5h3V3h-3Zm6 6V7h-2v2h2Zm-9 2H5v2h2v-2Zm0 4H5v2h2v-2Zm4 4h-3v-2H6v3a2 2 0 0 0 2 2h3v-3Zm2 0v3h3a2 2 0 0 0 2-2v-3h-2v2h-3Z"/></svg>
                            </button>
                        </h2>
                        <p class="mt-4 text-riyada-gray dark:text-neutral-300">
                            Rate path uncertainty, supply chain bottlenecks, and execution bandwidth on mega-projects.
                            Keep scenario plans for FX and import lead times.
                        </p>
                        <aside class="mt-4 c-callout c-callout--warning" role="note">
                            <p>Track sensitivity to global rate cycles and input costs; maintain liquidity runways.</p>
                        </aside>
                    </section>

                    {{-- Code sample --}}
                    <section class="scroll-mt-28 mt-12" data-reveal>
                        <h3 class="group flex items-baseline gap-2 text-xl sm:text-2xl font-semibold text-riyada-navy dark:text-neutral-100" id="deploy-script" data-anchored>
                            Example: quick content deploy script
                            <button type="button" data-anchor="deploy-script" class="opacity-0 group-hover:opacity-100 transition focus:opacity-100 ml-1 inline-flex h-7 w-7 items-center justify-center rounded-md text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="Copy link to code sample">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M10 3a2 2 0 0 0-2 2v3h2V5h3V3h-3Zm6 6V7h-2v2h2Zm-9 2H5v2h2v-2Zm0 4H5v2h2v-2Zm4 4h-3v-2H6v3a2 2 0 0 0 2 2h3v-3Zm2 0v3h3a2 2 0 0 0 2-2v-3h-2v2h-3Z"/></svg>
                            </button>
                        </h3>
                        <figure class="mt-4">
                            <pre class="c-code" data-lang="bash"><code>npm run build &amp;&amp; php artisan cache:clear &amp;&amp; php artisan view:clear</code></pre>
                        </figure>
                    </section>

                    {{-- Media grid --}}
                    <section id="media" class="scroll-mt-28 mt-12" data-reveal>
                        <h3 class="text-xl sm:text-2xl font-semibold text-riyada-navy dark:text-neutral-100">Media</h3>
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ([
                                'https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=800',
                                'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=800',
                                'https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?q=80&w=800',
                            ] as $img)
                                <a href="{{ $img }}" class="group block overflow-hidden rounded-xl bg-neutral-100 dark:bg-neutral-800 ring-1 ring-black/5 dark:ring-white/5">
                                    <img src="{{ $img }}" alt="Gallery image" loading="lazy" decoding="async" class="aspect-[4/3] w-full object-cover transition-transform duration-300 group-hover:scale-[1.02]" />
                                </a>
                            @endforeach
                        </div>
                    </section>

                    {{-- Footnotes --}}
                    <section id="footnotes" class="scroll-mt-28 mt-12" data-reveal>
                        <h3 class="text-xl sm:text-2xl font-semibold text-riyada-navy dark:text-neutral-100">Footnotes</h3>
                        <ol class="mt-4 space-y-2 text-sm text-riyada-gray dark:text-neutral-300 pl-5 rtl:pl-0 rtl:pr-5">
                            <li id="f1"><a href="#ref-f1" class="underline decoration-dotted underline-offset-4 hover:text-riy-gold">PMI = Purchasing Managers' Index; a diffusion index &gt;50 signals expansion.</a></li>
                        </ol>
                    </section>

                    {{-- Back to blog --}}
                    <div class="mt-12 pt-8 border-t border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                        <a href="/blog" class="inline-flex items-center gap-2 text-riyada-navy dark:text-neutral-100 hover:text-riy-gold focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900 rounded px-2 py-1">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.414 7.757 9 5.343 2.343 12 9 18.657l2.414-2.414L7.172 12l4.242-4.243ZM21 19v-2H12v2h9Zm0-6v-2H12v2h9Zm0-6V5H12v2h9Z"/></svg>
                            Back to all posts
                        </a>
                    </div>
                </article>

                {{-- Right rail: Author + Newsletter + Related --}}
                <aside class="order-3 space-y-6 lg:space-y-8">
                    {{-- Author card --}}
                    <section aria-labelledby="author-title" class="rounded-xl bg-white dark:bg-neutral-900 shadow-sm ring-1 ring-black/5 dark:ring-white/5 p-5" data-reveal>
                        <div class="flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=256" alt="Avatar of Lina Al-Harbi" class="h-14 w-14 rounded-full object-cover" width="56" height="56" loading="lazy" decoding="async">
                            <div>
                                <h3 id="author-title" class="text-base font-semibold text-riyada-navy dark:text-neutral-100">Lina Al-Harbi</h3>
                                <p class="text-sm text-riyada-gray">Head of Research</p>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-riyada-gray dark:text-neutral-300">Analyst focusing on MENA growth markets, industrials, and digital transformation.</p>
                        <div class="mt-3 flex items-center gap-3">
                            <a href="https://twitter.com/example" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-riyada-beige/40 hover:bg-riyada-beige/60 text-riyada-navy dark:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="Twitter">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.633 7.997c.013.176.013.353.013.53 0 5.39-4.103 11.61-11.61 11.61-2.307 0-4.45-.676-6.253-1.84.325.039.637.052.975.052a8.21 8.21 0 0 0 5.087-1.75 4.106 4.106 0 0 1-3.833-2.845c.247.039.494.065.754.065.364 0 .729-.052 1.068-.14a4.1 4.1 0 0 1-3.289-4.03v-.052c.546.299 1.19.482 1.868.507a4.095 4.095 0 0 1-1.83-3.41c0-.754.202-1.45.559-2.059a11.66 11.66 0 0 0 8.462 4.29 4.623 4.623 0 0 1-.104-.939 4.096 4.096 0 0 1 7.09-2.802 8.084 8.084 0 0 0 2.598-.988 4.114 4.114 0 0 1-1.798 2.263 8.216 8.216 0 0 0 2.36-.637 8.834 8.834 0 0 1-2.057 2.134Z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/in/example" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-riyada-beige/40 hover:bg-riyada-beige/60 text-riyada-navy dark:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="LinkedIn">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C3.87 3.5 3 4.38 3 5.48c0 1.09.87 1.98 1.98 1.98C6.07 7.46 6.95 6.57 6.95 5.48 6.95 4.38 6.07 3.5 4.98 3.5zM3.5 8.71H6.5V20.5H3.5zM9.5 8.71H12.36V10.13h.04c.4-.76 1.38-1.56 2.84-1.56 3.04 0 3.6 2 3.6 4.6v7.33H16.64v-6.5c0-1.55-.03-3.54-2.16-3.54-2.16 0-2.49 1.68-2.49 3.42v6.62H9.5z"/></svg>
                            </a>
                        </div>
                    </section>

                    {{-- Newsletter CTA --}}
                    @if (Route::has('newsletter.subscribe'))
                        <section id="newsletter" class="rounded-xl bg-gradient-to-br from-riyada-beige/60 to-transparent dark:from-neutral-800 shadow-sm ring-1 ring-black/5 dark:ring-white/5 p-5" data-reveal>
                            <h3 class="text-base font-semibold text-riyada-navy dark:text-neutral-100">Get insights in your inbox</h3>
                            <p class="mt-1 text-sm text-riyada-gray dark:text-neutral-300">Monthly research notes on MENA markets and technology.</p>
                            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-3 flex gap-2" novalidate>
                                @csrf
                                <label class="sr-only" for="email">Email</label>
                                <input id="email" name="email" type="email" required autocomplete="email" placeholder="you@company.com" class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 px-3 py-2 text-sm text-neutral-900 dark:text-neutral-100 placeholder-neutral-400 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">
                                <button type="submit" class="shrink-0 rounded-lg bg-riyada-navy text-white px-4 py-2 text-sm hover:translate-y-[-1px] transition will-change-transform focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">Subscribe</button>
                            </form>
                        </section>
                    @endif

                    {{-- Related posts --}}
                    <section aria-labelledby="related-title" class="rounded-xl bg-white dark:bg-neutral-900 shadow-sm ring-1 ring-black/5 dark:ring-white/5 p-5" data-reveal>
                        <h3 id="related-title" class="text-base font-semibold text-riyada-navy dark:text-neutral-100">Related posts</h3>
                        <ul role="list" class="mt-4 grid gap-4">
                            @foreach ([
                                ['title' => 'Vision 2030: Logistics as a Growth Engine', 'url' => '/blog/vision-2030-logistics', 'cover' => 'https://images.unsplash.com/photo-1554188248-986adbb73be0?q=80&w=640'],
                                ['title' => 'Tourism Playbook: Building Premium Experiences', 'url' => '/blog/tourism-playbook', 'cover' => 'https://images.unsplash.com/photo-1494475673543-6a6a27143b22?q=80&w=640'],
                                ['title' => 'AI in MENA: Talent, Cloud, and Enterprise Buying', 'url' => '/blog/ai-in-mena', 'cover' => 'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=640'],
                            ] as $post)
                                <li class="group overflow-hidden rounded-xl ring-1 ring-black/5 dark:ring-white/5 bg-neutral-50 dark:bg-neutral-800">
                                    <a href="{{ $post['url'] }}" class="flex gap-3">
                                        <img src="{{ $post['cover'] }}" alt="Cover for {{ $post['title'] }}" loading="lazy" decoding="async" class="h-20 w-28 sm:h-24 sm:w-32 object-cover flex-none transition-transform duration-300 group-hover:scale-[1.02]" width="128" height="96">
                                        <div class="py-3 pr-3 rtl:pr-0 rtl:pl-3">
                                            <h4 class="text-sm sm:text-base font-medium text-riyada-navy dark:text-neutral-100 group-hover:text-riy-gold">{{ $post['title'] }}</h4>
                                            <p class="mt-1 text-xs sm:text-sm text-riyada-gray">Read more</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </main>

    {{-- Page-specific components styles --}}
    <style>
      @layer components {
        /* Reveal motion */
        [data-reveal] { opacity: 0; transform: translateY(14px); transition: opacity .5s ease, transform .5s ease; }
        [data-reveal].is-in { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) {
          [data-reveal] { opacity: 1 !important; transform: none !important; transition: none !important; }
        }

        /* Callouts */
        .c-callout { @apply rounded-xl p-4 ring-1; }
        .c-callout--info { @apply bg-riyada-beige/30 ring-riyada-beige/60 text-riyada-navy; }
        .c-callout--warning { @apply bg-amber-100/50 dark:bg-amber-900/20 ring-amber-200 dark:ring-amber-800 text-amber-900 dark:text-amber-200; }
        .c-callout--success { @apply bg-emerald-100/50 dark:bg-emerald-900/20 ring-emerald-200 dark:ring-emerald-800 text-emerald-900 dark:text-emerald-200; }

        /* Pull quote */
        .pull-quote { @apply text-xl sm:text-2xl leading-relaxed text-riyada-navy dark:text-neutral-100 border-l-4 rtl:border-l-0 rtl:border-r-4 border-riy-gold pl-4 rtl:pl-0 rtl:pr-4; }

        /* Code */
        .c-code { @apply rounded-xl bg-neutral-900 text-neutral-100 p-4 overflow-x-auto ring-1 ring-black/10; }
        .c-code code { @apply text-sm; }

        /* TOC active link */
        .toc-link.is-active { @apply text-riy-gold font-medium; }
      }
    </style>

    {{-- Page behaviors --}}
    <script type="module">
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

    // --- Additional interactions: TOC, scroll-spy, copy anchor, share ---
    // TOC toggle (mobile and aside header button)
    const tocToggles = document.querySelectorAll('[data-toc-toggle]');
    tocToggles.forEach(btn => {
      btn.addEventListener('click', () => {
        const controls = btn.getAttribute('aria-controls');
        if (!controls) return;
        const target = document.getElementById(controls);
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!expanded));
        if (target) target.classList.toggle('hidden');
      });
    });

    // Scroll-spy for headings (h2/h3 with ids)
    const links = Array.from(document.querySelectorAll('.toc-link'));
    const map = new Map(links.map(a => [decodeURIComponent(a.getAttribute('href') || '').replace('#',''), a]));
    const spyObserver = 'IntersectionObserver' in window ? new IntersectionObserver((entries) => {
      entries.forEach(e => {
        const id = e.target.getAttribute('id');
        if (!id) return;
        const link = map.get(id);
        if (!link) return;
        if (e.isIntersecting) {
          links.forEach(l => l.classList.remove('is-active'));
          link.classList.add('is-active');
        }
      });
    }, { rootMargin: '0px 0px -70% 0px', threshold: 0.1 }) : null;
    document.querySelectorAll('h2[id], h3[id]').forEach(h => spyObserver && spyObserver.observe(h));

    // Copy anchor on heading buttons
    const anchorButtons = document.querySelectorAll('[data-anchor]');
    anchorButtons.forEach(btn => {
      btn.addEventListener('click', async () => {
        const id = btn.getAttribute('data-anchor');
        if (!id) return;
        const url = `${location.origin}${location.pathname}#${id}`;
        try {
          await navigator.clipboard.writeText(url);
          btn.classList.add('text-riy-gold');
          setTimeout(() => btn.classList.remove('text-riy-gold'), 900);
        } catch (_) {
          // Fallback: change hash
          location.hash = id;
        }
      });
    });

    // Share button (Web Share API with fallbacks)
    const shareBtn = document.querySelector('[data-share]');
    if (shareBtn) {
      shareBtn.addEventListener('click', async () => {
        const shareData = {
          title: 'Saudi Investment Outlook 2025: From Hydrocarbons to High-Growth Sectors',
          text: 'A 2025 outlook on Saudi investment across high-growth sectors',
          url: '{{ url('/blog/saudi-investment-outlook-2025') }}'
        };
        if (navigator.share) {
          try { await navigator.share(shareData); } catch (_) {}
          return;
        }
        // Fallback: open social windows
        const u = encodeURIComponent(shareData.url);
        const t = encodeURIComponent(shareData.title);
        const twitter = `https://twitter.com/intent/tweet?url=${u}&text=${t}`;
        const linkedin = `https://www.linkedin.com/sharing/share-offsite/?url=${u}`;
        window.open(twitter, '_blank', 'noopener,noreferrer,width=600,height=520');
        setTimeout(() => window.open(linkedin, '_blank', 'noopener,noreferrer,width=700,height=600'), 200);
      });
    }
    </script>
@endsection

