@extends('layouts.app')

@php
    /**
     * Riyada Ventures Blog Post Detail
     * Controller sketch (for reference only, not executed here):
     * Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
     * $post = Post::with(['category:id,name', 'tags:id,name'])->where('slug',$slug)->firstOrFail();
     * $relatedPosts = Post::query()->/* by category or overlapping tags, exclude current */limit(6)->get();
     * return view('blog.show', compact('post','relatedPosts'));
     */
    use Illuminate\Support\Str;

    // Build robust cover URL fallback
    $coverUrl = $post->cover_url
        ?? $post->image_url
        ?? ($post->image ? (Str::startsWith($post->image, ['http://', 'https://', '//']) ? $post->image : asset($post->image)) : null);

    // Description fallback for SEO and hero
    $desc = $post->excerpt
        ?? ($post->summary ?? Str::limit(strip_tags($post->content ?? ''), 160));

    // Render body HTML: prefer content_html; else markdown; if content already includes tags, treat as HTML
    if (!empty($post->content_html)) {
        $bodyHtml = $post->content_html;
    } else {
        $raw = (string) ($post->content ?? '');
        $bodyHtml = Str::contains($raw, '<') ? $raw : Str::markdown($raw);
    }

    // Compute approximate read time (words / 230 wpm)
    $plainText = trim(strip_tags($bodyHtml));
    $wordCount = str_word_count($plainText);
    $readTime = max(1, (int) ceil($wordCount / 230));

    $pageUrl = route('blog.show', $post->slug);
    $categoryName = optional($post->category)->name;
    $tagNames = $post->tags?->pluck('name')->filter()->values() ?? collect();

    // Organization assets and social (optional)
    $riyadaLogo = file_exists(public_path('images/riyada-mark.png')) ? asset('images/riyada-mark.png') : asset('favicon.ico');
    $orgTwitter = config('app.organization.twitter') ?? null;
    $orgLinkedIn = config('app.organization.linkedin') ?? null;
@endphp

@push('head')
    {{-- Open Graph & Twitter using DB-backed post --}}
    <meta property="og:title" content="{{ $post->title }}"> {{-- FIELD: $post->title  (Filament: TextInput "Title") --}}
    <meta property="og:description" content="{{ $desc }}"> {{-- FIELD: $post->excerpt / $post->summary (Filament: Textarea "Excerpt") --}}
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ $pageUrl }}">
    @if ($coverUrl)
        <meta property="og:image" content="{{ $coverUrl }}"> {{-- FIELD: $post->cover_url OR $post->image  (Filament: FileUpload/TextInput "Cover") --}}
    @endif
    <meta property="og:image:alt" content="{{ $post->title }} cover image"> {{-- FIELD: $post->title --}}
    @if ($post->published_at)
        <meta property="article:published_time" content="{{ optional($post->published_at)->toAtomString() }}"> {{-- FIELD: $post->published_at  (Filament: DateTimePicker "Published At") --}}
    @endif
    @if ($categoryName)
        <meta property="article:section" content="{{ $categoryName }}"> {{-- FIELD: $post->category->name  (Filament: BelongsTo "Category") --}}
    @endif
    @foreach ($tagNames->take(8) as $tag)
        <meta property="article:tag" content="{{ $tag }}"> {{-- FIELD: $post->tags (names)  (Filament: BelongsToMany "Tags") --}}
    @endforeach

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}"> {{-- FIELD: $post->title --}}
    <meta name="twitter:description" content="{{ $desc }}"> {{-- FIELD: $post->excerpt / $post->summary --}}
    @if ($coverUrl)
        <meta name="twitter:image" content="{{ $coverUrl }}"> {{-- FIELD: $post->cover_url OR $post->image --}}
    @endif

    {{-- JSON-LD Article Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": @json($post->title),
      "url": @json($pageUrl),
      "datePublished": @json(optional($post->published_at)->toAtomString()),
      "dateModified": @json(optional($post->updated_at ?? $post->published_at)->toAtomString()),
      "publisher": {
        "@type": "Organization",
        "name": "Riyada Ventures",
        "logo": { "@type": "ImageObject", "url": @json($riyadaLogo) }
      },
      "author": { "@type": "Organization", "name": "Riyada Ventures" },
      "image": @json($coverUrl ? [$coverUrl] : []),
      "articleSection": @json($categoryName),
      "keywords": @json($tagNames->implode(', ')),
      "mainEntityOfPage": @json($pageUrl),
      "description": @json($desc)
    }
    </script>
@endpush

@section('content')
    {{-- Reading progress bar (transform-only to avoid reflow) --}}
    <div class="fixed inset-x-0 top-0 z-40 h-1.5 bg-transparent" aria-hidden="true">
        <div data-progress class="h-full origin-left rtl:origin-right scale-x-0 bg-riy-gold transition-transform duration-150 will-change-transform"></div>
    </div>

    <main class="relative">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 sm:pt-24">
            {{-- Breadcrumb --}}
            <nav class="mb-6 sm:mb-8" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2 text-sm sm:text-base text-riyada-gray">
                    <li><a href="{{ url('/') }}" class="hover:text-riy-gold focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900 rounded px-1">Home</a></li>
                    <li class="text-riyada-gray/60" aria-hidden="true">/</li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-riy-gold focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900 rounded px-1">Blog</a></li>
                    <li class="text-riyada-gray/60" aria-hidden="true">/</li>
                    <li class="text-riyada-navy dark:text-neutral-200">{{ Str::limit($post->title, 40) }}</li> {{-- FIELD: $post->title --}}
                </ol>
            </nav>

            {{-- Hero --}}
            <header class="relative overflow-hidden rounded-2xl bg-white/70 dark:bg-neutral-900/60 shadow-sm ring-1 ring-black/5 dark:ring-white/5" data-reveal data-parallax>
                <div class="grid lg:grid-cols-2 gap-0">
                    <div class="p-6 sm:p-10 order-2 lg:order-1">
                        <div class="mb-4 flex flex-wrap items-center gap-2 text-xs sm:text-sm text-riyada-gray">
                            @if ($categoryName)
                                <span class="inline-flex items-center rounded-full bg-riyada-beige/40 px-2.5 py-1 text-riyada-navy dark:text-neutral-200">{{ $categoryName }}</span> {{-- FIELD: $post->category->name  (Filament: BelongsTo "Category") --}}
                            @endif
                            @if ($post->published_at)
                                <span aria-hidden="true" class="text-riyada-gray/50">•</span>
                                <time datetime="{{ optional($post->published_at)->toDateString() }}">{{ optional($post->published_at)->format('M j, Y') }}</time> {{-- FIELD: $post->published_at  (Filament: DateTimePicker "Published At") --}}
                            @endif
                            <span aria-hidden="true" class="text-riyada-gray/50">•</span>
                            <span>{{ $readTime }} min read</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-riyada-navy dark:text-neutral-50">
                            {{ $post->title }} {{-- FIELD: $post->title  (Filament: TextInput "Title") --}}
                        </h1>
                        @if ($post->excerpt || $post->summary || $desc)
                            <p class="mt-4 sm:mt-6 text-base sm:text-lg leading-relaxed text-riyada-gray dark:text-neutral-300">
                                {{ $post->excerpt ?? ($post->summary ?? $desc) }} {{-- FIELD: $post->excerpt / $post->summary (Filament: Textarea "Excerpt") --}}
                            </p>
                        @endif
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
                        @if ($coverUrl)
                            <picture>
                                {{-- Prefer client width; provide sizes to aid responsive selection --}}
                                <img
                                    class="h-full w-full object-cover aspect-[16/9] lg:aspect-auto"
                                    src="{{ $coverUrl }}" {{-- FIELD: $post->cover_url OR $post->image  (Filament: FileUpload/TextInput "Cover") --}}
                                    alt="{{ $post->title }} cover image" {{-- FIELD: $post->title --}}
                                    loading="eager" decoding="async">
                            </picture>
                        @else
                            {{-- Graceful fallback block when no image is provided in DB --}}
                            <div class="aspect-[16/9] lg:min-h-[320px] w-full bg-neutral-100 dark:bg-neutral-800"></div>
                        @endif
                    </div>
                </div>
            </header>

            {{-- Tags under hero --}}
            @if ($tagNames->isNotEmpty())
                <div class="mt-6 flex flex-wrap items-center gap-2" aria-label="Tags">
                    <span class="text-xs sm:text-sm text-riyada-gray">Tags:</span>
                    @foreach ($tagNames as $tag)
                        <span class="inline-flex items-center rounded-full border border-riyada-gray/30 text-riyada-gray px-2 py-0.5 text-xs sm:text-sm">{{ $tag }}</span> {{-- FIELD: $post->tags (names)  (Filament: BelongsToMany "Tags") --}}
                    @endforeach
                </div>
            @endif

            {{-- Layout grid: TOC aside + Article + Right rail --}}
            <div class="mt-10 grid lg:grid-cols-[minmax(0,260px)_minmax(0,1fr)_minmax(0,280px)] gap-8 lg:gap-10">
                {{-- Sticky TOC (desktop) / Collapsible (mobile) --}}
                <aside class="lg:sticky lg:top-28 self-start order-2 lg:order-1" aria-label="Table of contents">
                    <div class="rounded-xl bg-white dark:bg-neutral-900 shadow-sm ring-1 ring-black/5 dark:ring-white/5 p-4" data-reveal>
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-semibold text-riyada-navy dark:text-neutral-100">On this page</h2>
                            <button type="button" data-toc-toggle aria-expanded="false" class="lg:hidden inline-flex h-8 w-8 items-center justify-center rounded-md hover:bg-riyada-beige/40 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-controls="toc-mobile" aria-label="Toggle table of contents">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4 7h16v2H4V7Zm0 4h16v2H4v-2Zm0 4h16v2H4v-2Z"/></svg>
                            </button>
                        </div>
                        <nav class="mt-3 lg:mt-4 hidden lg:block" id="toc-desktop">
                            <ol class="space-y-2 text-sm" data-toc></ol>
                        </nav>
                        <nav id="toc-mobile" class="mt-3 lg:hidden hidden">
                            <ol class="space-y-2 text-sm" data-toc></ol>
                        </nav>
                    </div>
                </aside>

                {{-- Article --}}
                <article class="max-w-none" data-reveal>
                    <div id="article-body" class="prose prose-neutral dark:prose-invert max-w-none prose-h2:scroll-mt-28 prose-h3:scroll-mt-28 prose-img:rounded-xl">
                        {!! $bodyHtml !!} {{-- FIELD: $post->content OR $post->content_html  (Filament: MarkdownEditor "Content") --}}
                    </div>

                    {{-- Back to blog --}}
                    <div class="mt-12 pt-8 border-t border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-riyada-navy dark:text-neutral-100 hover:text-riy-gold focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900 rounded px-2 py-1">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.414 7.757 9 5.343 2.343 12 9 18.657l2.414-2.414L7.172 12l4.242-4.243ZM21 19v-2H12v2h9Zm0-6v-2H12v2h9Zm0-6V5H12v2h9Z"/></svg>
                            Back to all posts
                        </a>
                        <div class="text-xs text-riyada-gray">
                            {{-- FIELD: $post->published_at  (Filament: DateTimePicker "Published At") --}}
                            @if ($post->published_at)
                                <time datetime="{{ optional($post->published_at)->toDateString() }}">Updated {{ optional($post->updated_at ?? $post->published_at)->diffForHumans() }}</time>
                            @endif
                        </div>
                    </div>
                </article>

                {{-- Right rail: Riyada card + Newsletter + Related --}}
                <aside class="order-3 space-y-6 lg:space-y-8">
                    {{-- Riyada Ventures card --}}
                    <section aria-labelledby="riyada-card" class="rounded-xl bg-white dark:bg-neutral-900 shadow-sm ring-1 ring-black/5 dark:ring-white/5 p-5" data-reveal>
                        <div class="flex items-center gap-4">
                            <img src="{{ $riyadaLogo }}" alt="Riyada Ventures logo" class="h-14 w-14 rounded-lg object-cover bg-white dark:bg-neutral-800 ring-1 ring-black/5 dark:ring-white/5" width="56" height="56" loading="lazy" decoding="async">
                            <div>
                                <h3 id="riyada-card" class="text-base font-semibold text-riyada-navy dark:text-neutral-100">Riyada Ventures</h3>
                                <p class="text-sm text-riyada-gray">Venture. Build. Rise.</p>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-riyada-gray dark:text-neutral-300">Analyst research on MENA growth markets, industrials, and digital transformation.</p>
                        <div class="mt-3 flex items-center gap-3">
                            @if ($orgTwitter)
                                <a href="{{ $orgTwitter }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-riyada-beige/40 hover:bg-riyada-beige/60 text-riyada-navy dark:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="Twitter">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.633 7.997c.013.176.013.353.013.53 0 5.39-4.103 11.61-11.61 11.61-2.307 0-4.45-.676-6.253-1.84.325.039.637.052.975.052a8.21 8.21 0 0 0 5.087-1.75 4.106 4.106 0 0 1-3.833-2.845c.247.039.494.065.754.065.364 0 .729-.052 1.068-.14a4.1 4.1 0 0 1-3.289-4.03v-.052c.546.299 1.19.482 1.868.507a4.095 4.095 0 0 1-1.83-3.41c0-.754.202-1.45.559-2.059a11.66 11.66 0 0 0 8.462 4.29 4.623 4.623 0 0 1-.104-.939 4.096 4.096 0 0 1 7.09-2.802 8.084 8.084 0 0 0 2.598-.988 4.114 4.114 0 0 1-1.798 2.263 8.216 8.216 0 0 0 2.36-.637 8.834 8.834 0 0 1-2.057 2.134Z"/></svg>
                                </a>
                            @endif
                            @if ($orgLinkedIn)
                                <a href="{{ $orgLinkedIn }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-riyada-beige/40 hover:bg-riyada-beige/60 text-riyada-navy dark:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900" aria-label="LinkedIn">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C3.87 3.5 3 4.38 3 5.48c0 1.09.87 1.98 1.98 1.98C6.07 7.46 6.95 6.57 6.95 5.48 6.95 4.38 6.07 3.5 4.98 3.5zM3.5 8.71H6.5V20.5H3.5zM9.5 8.71H12.36V10.13h.04c.4-.76 1.38-1.56 2.84-1.56 3.04 0 3.6 2 3.6 4.6v7.33H16.64v-6.5c0-1.55-.03-3.54-2.16-3.54-2.16 0-2.49 1.68-2.49 3.42v6.62H9.5z"/></svg>
                                </a>
                            @endif
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
                            {{-- FIELD: $relatedPosts (controller-provided) --}}
                            @foreach ($relatedPosts as $rel)
                                @php
                                    $relCover = $rel->cover_url
                                        ?? $rel->image_url
                                        ?? ($rel->image ? (Str::startsWith($rel->image, ['http://','https://','//']) ? $rel->image : asset($rel->image)) : null);
                                @endphp
                                <li class="group overflow-hidden rounded-xl ring-1 ring-black/5 dark:ring-white/5 bg-neutral-50 dark:bg-neutral-800">
                                    <a href="{{ route('blog.show', $rel->slug) }}" class="flex gap-3">
                                        @if ($relCover)
                                            <img src="{{ $relCover }}" alt="Cover for {{ $rel->title }}" loading="lazy" decoding="async" class="h-20 w-28 sm:h-24 sm:w-32 object-cover flex-none transition-transform duration-300 group-hover:scale-[1.02]" width="128" height="96">
                                        @else
                                            <div class="h-20 w-28 sm:h-24 sm:w-32 bg-neutral-200 dark:bg-neutral-700 flex-none"></div>
                                        @endif
                                        <div class="py-3 pr-3 rtl:pr-0 rtl:pl-3">
                                            <h4 class="text-sm sm:text-base font-medium text-riyada-navy dark:text-neutral-100 group-hover:text-riy-gold">{{ $rel->title }}</h4>
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

        /* Callouts (opt-in via markdown HTML) */
        .c-callout { @apply rounded-xl p-4 ring-1; }
        .c-callout--info { @apply bg-riyada-beige/30 ring-riyada-beige/60 text-riyada-navy; }
        .c-callout--warning { @apply bg-amber-100/50 dark:bg-amber-900/20 ring-amber-200 dark:ring-amber-800 text-amber-900 dark:text-amber-200; }
        .c-callout--success { @apply bg-emerald-100/50 dark:bg-emerald-900/20 ring-emerald-200 dark:ring-emerald-800 text-emerald-900 dark:text-emerald-200; }

        /* Dynamic anchor button injected next to headings */
        .h-anchor { @apply opacity-0 group-hover:opacity-100 focus:opacity-100 transition inline-flex h-7 w-7 items-center justify-center rounded-md text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900; }

        /* Code */
        .prose pre { @apply rounded-xl bg-neutral-900 text-neutral-100 ring-1 ring-black/10; }
        .prose pre code { @apply text-sm; }

        /* TOC active link */
        .toc-link.is-active { @apply text-riy-gold font-medium; }
      }
    </style>

    {{-- Required module script (progress + reveal + optional GSAP). Additional logic follows. --}}
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

// --- Additional interactions: dynamic TOC, scroll-spy, heading anchors, share ---
const articleEl = document.getElementById('article-body');
const desktopToc = document.querySelector('#toc-desktop [data-toc]');
const mobileToc = document.querySelector('#toc-mobile [data-toc]');

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

// Build TOC from h2/h3 and inject anchor buttons
const usedIds = new Set();
const slugify = (str) => str.toLowerCase()
  .normalize('NFD').replace(/\p{Diacritic}/gu, '')
  .replace(/[^a-z0-9\s-]/g, '')
  .trim().replace(/\s+/g, '-').replace(/-+/g, '-');

const headings = articleEl ? Array.from(articleEl.querySelectorAll('h2, h3')) : [];
let currentOlDesktop = desktopToc ? document.createElement('ol') : null;
let currentOlMobile = mobileToc ? document.createElement('ol') : null;
if (desktopToc && currentOlDesktop) { desktopToc.innerHTML = ''; desktopToc.appendChild(currentOlDesktop); }
if (mobileToc && currentOlMobile) { mobileToc.innerHTML = ''; mobileToc.appendChild(currentOlMobile); }

let lastH2Desktop, lastH2Mobile;

headings.forEach((h) => {
  // Ensure group class for hover visibility of anchor button
  h.classList.add('group');

  // Ensure IDs
  let id = h.getAttribute('id');
  if (!id) {
    id = slugify(h.textContent || 'section');
    let base = id, i = 2;
    while (usedIds.has(id)) { id = `${base}-${i++}`; }
    usedIds.add(id);
    h.setAttribute('id', id);
  }

  // Inject copy anchor button
  const btn = document.createElement('button');
  btn.type = 'button';
  btn.className = 'h-anchor ml-1';
  btn.setAttribute('data-anchor', id);
  btn.setAttribute('aria-label', `Copy link to ${h.textContent?.trim() || 'section'}`);
  btn.innerHTML = '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M10 3a2 2 0 0 0-2 2v3h2V5h3V3h-3Zm6 6V7h-2v2h2Zm-9 2H5v2h2v-2Zm0 4H5v2h2v-2Zm4 4h-3v-2H6v3a2 2 0 0 0 2 2h3v-3Zm2 0v3h3a2 2 0 0 0 2-2v-3h-2v2h-3Z"/></svg>';
  h.appendChild(btn);

  // Add to TOC (nest h3 under last h2)
  const makeItem = (isMobile) => {
    const li = document.createElement('li');
    const a = document.createElement('a');
    a.href = `#${id}`;
    a.className = 'toc-link block rounded px-2 py-1 text-riyada-gray hover:text-riyada-navy dark:hover:text-neutral-100 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900';
    a.textContent = h.textContent?.trim() || '';
    li.appendChild(a);
    return li;
  };

  if (h.tagName.toLowerCase() === 'h2') {
    lastH2Desktop = document.createElement('li');
    lastH2Desktop.appendChild(makeItem(false));
    const nestedOlD = document.createElement('ol');
    nestedOlD.className = 'mt-1 space-y-1';
    lastH2Desktop.appendChild(nestedOlD);
    currentOlDesktop?.appendChild(lastH2Desktop);

    lastH2Mobile = document.createElement('li');
    lastH2Mobile.appendChild(makeItem(true));
    const nestedOlM = document.createElement('ol');
    nestedOlM.className = 'mt-1 space-y-1';
    lastH2Mobile.appendChild(nestedOlM);
    currentOlMobile?.appendChild(lastH2Mobile);
  } else {
    const liD = makeItem(false);
    const liM = makeItem(true);
    const olD = lastH2Desktop?.querySelector('ol');
    const olM = lastH2Mobile?.querySelector('ol');
    (olD ?? currentOlDesktop)?.appendChild(liD);
    (olM ?? currentOlMobile)?.appendChild(liM);
  }
});

// Scroll-spy for headings
const links = Array.from(document.querySelectorAll('.toc-link'));
const linkMap = new Map(links.map(a => [decodeURIComponent(a.getAttribute('href') || '').replace('#',''), a]));
const spyObserver = 'IntersectionObserver' in window ? new IntersectionObserver((entries) => {
  entries.forEach(e => {
    const id = e.target.getAttribute('id');
    if (!id) return;
    const link = linkMap.get(id);
    if (!link) return;
    if (e.isIntersecting) {
      links.forEach(l => l.classList.remove('is-active'));
      link.classList.add('is-active');
    }
  });
}, { rootMargin: '0px 0px -70% 0px', threshold: 0.1 }) : null;
document.querySelectorAll('#article-body h2[id], #article-body h3[id]').forEach(h => spyObserver && spyObserver.observe(h));

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
      location.hash = id;
    }
  });
});

// Share button (Web Share API with fallbacks)
const shareBtn = document.querySelector('[data-share]');
if (shareBtn) {
  shareBtn.addEventListener('click', async () => {
    const shareData = {
      title: @json($post->title), // FIELD: $post->title
      text: @json($desc),         // FIELD: $post->excerpt / $post->summary
      url: @json($pageUrl)
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

