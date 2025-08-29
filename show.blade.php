{{-- resources/views/blog/show.blade.php --}}
@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    $post->loadMissing(['categories:id,name,slug', 'tags:id,name,slug']);

    $pageUrl   = $post->url();
    $title     = $post->seoTitle();
    $desc      = $post->seoDescription();
    $coverUrl  = $post->ogImageUrl() ?: $post->thumbnailUrl();
    $readTime  = (int) ($post->read_time ?: 1);
    $dateIso   = optional($post->published_at)->toAtomString();
    $dateText  = $post->formattedDate('M j, Y');
    $category  = optional($post->categories->first())->name;
    $tags      = $post->tags->pluck('name')->filter()->values();

    /** @var \Illuminate\Support\Collection $relatedPosts */
    $relatedPosts = isset($related) ? $related : (isset($relatedPosts) ? $relatedPosts : collect());

    $riyadaLogo = file_exists(public_path('images/riyada-mark.png'))
        ? asset('images/riyada-mark.png')
        : asset('favicon.ico');
@endphp

@push('head')
    <title>{{ $title }} — Riyada Ventures</title>
    <meta name="description" content="{{ $desc }}">
    <link rel="canonical" href="{{ $pageUrl }}">

    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:url" content="{{ $pageUrl }}">
    @if($coverUrl)<meta property="og:image" content="{{ $coverUrl }}">@endif
    <meta property="og:image:alt" content="{{ $title }}">
    @if($dateIso)<meta property="article:published_time" content="{{ $dateIso }}">@endif
    @if($category)<meta property="article:section" content="{{ $category }}">@endif
    @foreach($tags->take(8) as $t)<meta property="article:tag" content="{{ $t }}">@endforeach

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $desc }}">
    @if($coverUrl)<meta name="twitter:image" content="{{ $coverUrl }}">@endif

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": @json($title),
      "url": @json($pageUrl),
      "datePublished": @json($dateIso),
      "dateModified": @json(optional($post->updated_at ?? $post->published_at)->toAtomString()),
      "publisher": { "@type": "Organization", "name": "Riyada Ventures",
        "logo": { "@type": "ImageObject", "url": @json($riyadaLogo) } },
      "author": { "@type": "Organization", "name": "Riyada Ventures" },
      "image": @json($coverUrl ? [$coverUrl] : []),
      "articleSection": @json($category),
      "keywords": @json($tags->implode(', ')),
      "description": @json($desc)
    }
    </script>
@endpush

@section('content')
  {{-- Same top band you liked --}}
  <x-page-hero
    :crumbs="[
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Blog',  'url' => route('blog.index')],
        ['label' => Str::limit($title, 72)]
    ]"
    compact="true"
  />

  <main class="relative overflow-x-clip">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-0">

      {{-- Hero --}}
      <header class="reveal rounded-2xl bg-white/70 dark:bg-neutral-900/70 shadow-sm ring-1 ring-black/5 dark:ring-white/5 overflow-hidden mt-3 sm:mt-6">
        <div class="grid lg:grid-cols-2">
          <div class="p-6 sm:p-10">
            <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-slate-500">
              @if($category)
                <span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-white/10 px-2.5 py-1 text-slate-700 dark:text-slate-200">{{ $category }}</span>
              @endif
              @if($dateText)
                <span aria-hidden="true">•</span>
                <time datetime="{{ $post->published_at?->toDateString() }}">{{ $dateText }}</time>
              @endif
              <span aria-hidden="true">•</span>
              <span>{{ max(1,$readTime) }} min read</span>
            </div>

            <h1 class="mt-3 sm:mt-4 text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-slate-900 dark:text-neutral-50">
              {{ $title }}
            </h1>

            @if($desc)
              <p class="mt-4 text-base sm:text-lg leading-7 text-slate-600 dark:text-neutral-300">
                {{ $desc }}
              </p>
            @endif

            <div class="mt-5 flex flex-wrap items-center gap-3">
              <button type="button" data-share
                class="inline-flex items-center gap-2 rounded-full bg-riy-gold/10 px-3 py-1.5 text-slate-900 dark:text-neutral-100 hover:bg-riy-gold/20 focus:outline-none focus-visible:ring-2 ring-riy-gold ring-offset-2 ring-offset-white dark:ring-offset-neutral-900">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 8a3 3 0 1 0-2.83-4H15a3 3 0 0 0 0 6h.17A3 3 0 0 0 18 8ZM6 14a3 3 0 1 0-2.83 4H3a3 3 0 0 0 0-6h.17A3 3 0 0 0 6 14Zm9.17-6H9.83a3 3 0 0 0 0 6h5.34a3 3 0 0 0 0-6Z"/></svg>
                <span class="text-sm">Share</span>
              </button>
            </div>
          </div>

          <div class="relative">
            @if($coverUrl)
              <img class="h-full w-full object-cover aspect-[16/9] lg:aspect-auto" src="{{ $coverUrl }}" alt="{{ $title }}" loading="eager" decoding="async">
            @else
              <div class="aspect-[16/9] w-full bg-neutral-100 dark:bg-neutral-800"></div>
            @endif
          </div>
        </div>
      </header>

      {{-- Tags --}}
      @if($tags->isNotEmpty())
        <div class="mt-6 flex flex-wrap items-center gap-2" aria-label="Tags">
          <span class="text-xs sm:text-sm text-slate-500">Tags:</span>
          @foreach ($tags as $tag)
            <span class="inline-flex items-center rounded-full border border-slate-300/60 dark:border-white/15 text-slate-600 dark:text-slate-300 px-2 py-0.5 text-xs sm:text-sm">
              {{ $tag }}
            </span>
          @endforeach
        </div>
      @endif

      {{-- MOBILE TOC --}}
      <section class="mt-7 lg:hidden reveal">
        <details class="rounded-xl bg-white dark:bg-neutral-900 ring-1 ring-black/5 dark:ring-white/5">
          <summary class="cursor-pointer list-none px-4 py-3 text-sm font-semibold text-slate-900 dark:text-slate-100">
            On this page
          </summary>
          <nav class="px-4 pb-3">
            <ol class="text-sm space-y-1.5" data-toc-mobile></ol>
          </nav>
        </details>
      </section>

      {{-- L / Article / R --}}
      <div class="mt-8 grid lg:grid-cols-[260px_minmax(700px,1fr)] gap-6 lg:gap-8 pb-20">

        <aside class="hidden lg:block">
          <div class="sticky top-28 space-y-6">
            <section class="reveal rounded-xl bg-white dark:bg-neutral-900 ring-1 ring-black/5 dark:ring-white/5">
              <div class="px-4 py-3 border-b border-black/5 dark:border-white/5">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-slate-100">On this page</h2>
              </div>
              <nav class="max-h-[calc(100vh-14rem)] overflow-y-auto no-scrollbar px-3 py-3">
                <ol class="text-sm space-y-1.5" data-toc></ol>
              </nav>
            </section>

            <section class="reveal rounded-xl bg-white dark:bg-neutral-900 ring-1 ring-black/5 dark:ring-white/5">
              <div class="p-5">
                <div class="flex items-center gap-4">
                  <img src="{{ $riyadaLogo }}" alt="Riyada Ventures" class="h-12 w-12 rounded-lg object-cover bg-white dark:bg-neutral-800 ring-1 ring-black/5 dark:ring-white/5" width="48" height="48" loading="lazy" decoding="async">
                  <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">Riyada Ventures</h3>
                    <p class="text-sm text-slate-500">Venture. Build. Rise.</p>
                  </div>
                </div>
                <p class="mt-3 text-sm text-slate-600 dark:text-neutral-300">
                  Analyst research on MENA growth markets, industrials, and digital transformation.
                </p>
              </div>
            </section>
          </div>
        </aside>

        <article class="reveal">
          {{-- Keep the typography classes; our CSS below will tighten them --}}
          <div id="article-body" class="prose-blog prose prose-neutral dark:prose-invert max-w-none">
            {!! $post->content_html !!}
          </div>

          <div class="mt-10 pt-8 border-t border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-slate-900 dark:text-slate-100 hover:text-riy-gold focus:outline-none focus-visible:ring-2 ring-riy-gold rounded px-2 py-1">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.414 7.757 9 5.343 2.343 12 9 18.657l2.414-2.414L7.172 12l4.242-4.243ZM21 19v-2H12v2h9Zm0-6v-2H12v2h9Zm0-6V5H12v2h9Z"/></svg>
              Back to all posts
            </a>
            @if($post->published_at)
              <time class="text-xs text-slate-500" datetime="{{ $post->published_at->toDateString() }}">
                Updated {{ optional($post->updated_at ?? $post->published_at)->diffForHumans() }}
              </time>
            @endif
          </div>
        </article>
      </div>

      {{-- Related --}}
      <section class="pb-16 reveal">
        <div class="flex items-center gap-3 mb-6">
          <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-slate-100">Related posts</h2>
          <div class="h-[2px] flex-1 bg-gradient-to-r from-orange-500/20 to-transparent"></div>
        </div>
        @if($relatedPosts->isEmpty())
          <p class="text-slate-600 dark:text-slate-300">No related posts yet.</p>
        @else
          <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($relatedPosts as $rel)
              @php $relCover = method_exists($rel, 'ogImageUrl') ? ($rel->ogImageUrl() ?: $rel->thumbnailUrl()) : null; @endphp
              <article class="group relative">
                <a href="{{ route('blog.show', $rel->slug) }}" class="block h-full">
                  <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-neutral-900 shadow-lg ring-1 ring-black/5 dark:ring-white/5 transition-all duration-300 hover:shadow-2xl hover:ring-orange-500/20 hover:-translate-y-1">
                    @if ($relCover)
                      <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ $relCover }}" alt="Cover for {{ $rel->title }}" loading="lazy" decoding="async" 
                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                      </div>
                    @else
                      <div class="aspect-[16/10] bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 flex items-center justify-center">
                        <svg class="w-16 h-16 text-orange-200 dark:text-orange-800" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                      </div>
                    @endif
                    
                    <div class="p-5">
                      <div class="flex items-center gap-2 mb-3">
                        <span class="inline-flex items-center rounded-full bg-orange-100 dark:bg-orange-900/30 px-2.5 py-0.5 text-xs font-medium text-orange-800 dark:text-orange-200">
                          {{ optional($rel->categories->first())->name ?: 'Blog' }}
                        </span>
                        <time class="text-xs text-slate-500 dark:text-slate-400">{{ $rel->formattedDate('M j, Y') }}</time>
                      </div>
                      
                      <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 line-clamp-2 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                        {{ $rel->title }}
                      </h3>
                      
                      @if($rel->excerpt)
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300 line-clamp-2">
                          {{ Str::limit($rel->excerpt, 100) }}
                        </p>
                      @endif
                      
                      <div class="mt-4 flex items-center text-sm font-medium text-orange-600 dark:text-orange-400">
                        <span>Read more</span>
                        <svg class="ml-1 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                      </div>
                    </div>
                  </div>
                </a>
              </article>
            @endforeach
          </div>
        @endif
      </section>

    </div>
  </main>

  {{-- PREMIUM BLOG ARTICLE STYLES — Modern, Trending UI/UX --}}
  <style>
    /* ===== PREMIUM BLOG TYPOGRAPHY SYSTEM ===== */
    
    /* Import Inter for premium feel */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    /* Base typography - premium, modern feel */
    #article-body.prose-blog {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      font-size: 17px;
      line-height: 1.6;
      color: #1a1a1a;
      font-weight: 400;
      letter-spacing: -0.01em;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    
    .dark #article-body.prose-blog {
      color: #e5e5e5;
    }

    /* Paragraphs - normal spacing for readability */
    #article-body.prose-blog p {
      margin: 1rem 0;
      font-size: 1rem;
      line-height: 1.65;
    }
    
    #article-body.prose-blog p:first-child {
      margin-top: 0;
    }

    /* Headings - modern, clean hierarchy */
    #article-body.prose-blog h2 {
      font-size: 1.75rem;
      font-weight: 700;
      color: #0a0a0a;
      margin: 2rem 0 0.75rem;
      letter-spacing: -0.03em;
      line-height: 1.3;
      scroll-margin-top: 100px;
      position: relative;
    }
    
    #article-body.prose-blog h3 {
      font-size: 1.375rem;
      font-weight: 600;
      color: #1a1a1a;
      margin: 1.75rem 0 0.75rem;
      letter-spacing: -0.02em;
      line-height: 1.4;
      scroll-margin-top: 100px;
    }
    
    .dark #article-body.prose-blog h2 {
      color: #fafafa;
    }
    
    .dark #article-body.prose-blog h3 {
      color: #f0f0f0;
    }

    /* Add subtle accent line to h2 */
    #article-body.prose-blog h2::before {
      content: '';
      position: absolute;
      left: -2rem;
      top: 50%;
      transform: translateY(-50%);
      width: 4px;
      height: 60%;
      background: linear-gradient(to bottom, #ff6b35, #f7931e);
      border-radius: 2px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    @media (min-width: 768px) {
      #article-body.prose-blog h2:hover::before {
        opacity: 1;
      }
    }

    /* Links - premium styling */
    #article-body.prose-blog a {
      color: #ff6b35;
      text-decoration: none;
      font-weight: 500;
      position: relative;
      transition: color 0.2s ease;
    }
    
    #article-body.prose-blog a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(to right, #ff6b35, #f7931e);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease;
    }
    
    #article-body.prose-blog a:hover {
      color: #f7931e;
    }
    
    #article-body.prose-blog a:hover::after {
      transform: scaleX(1);
    }
    
    .dark #article-body.prose-blog a {
      color: #ffa057;
    }
    
    .dark #article-body.prose-blog a:hover {
      color: #ffc085;
    }

    /* Lists - clean and modern */
    #article-body.prose-blog ul,
    #article-body.prose-blog ol {
      margin: 1rem 0;
      padding-left: 0;
    }
    
    #article-body.prose-blog li {
      margin: 0.5rem 0;
      padding-left: 2rem;
      position: relative;
      line-height: 1.6;
    }
    
    /* Custom bullet points */
    #article-body.prose-blog ul li::before {
      content: '';
      position: absolute;
      left: 0.5rem;
      top: 0.6rem;
      width: 6px;
      height: 6px;
      background: #ff6b35;
      border-radius: 50%;
    }
    
    #article-body.prose-blog ol {
      counter-reset: list-counter;
    }
    
    #article-body.prose-blog ol li {
      counter-increment: list-counter;
    }
    
    #article-body.prose-blog ol li::before {
      content: counter(list-counter);
      position: absolute;
      left: 0;
      top: 0.1rem;
      width: 1.5rem;
      height: 1.5rem;
      background: linear-gradient(135deg, #ff6b35, #f7931e);
      color: white;
      font-size: 0.85rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }

    /* Strong text */
    #article-body.prose-blog strong {
      font-weight: 600;
      color: #0a0a0a;
    }
    
    .dark #article-body.prose-blog strong {
      color: #fafafa;
    }

    /* Blockquotes - premium card style */
    #article-body.prose-blog blockquote {
      margin: 1.25rem 0;
      padding: 1.25rem 1.5rem;
      background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(247, 147, 30, 0.05) 100%);
      border-left: 4px solid;
      border-image: linear-gradient(to bottom, #ff6b35, #f7931e) 1;
      border-radius: 0 12px 12px 0;
      font-style: italic;
      font-size: 1.05rem;
      position: relative;
      overflow: hidden;
    }
    
    #article-body.prose-blog blockquote::before {
      content: '"';
      position: absolute;
      top: -10px;
      left: 10px;
      font-size: 4rem;
      color: rgba(255, 107, 53, 0.15);
      font-family: Georgia, serif;
    }
    
    .dark #article-body.prose-blog blockquote {
      background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(247, 147, 30, 0.1) 100%);
    }
    
    #article-body.prose-blog blockquote p {
      margin: 0;
      position: relative;
    }

    /* Tables - modern design */
    #article-body.prose-blog table {
      width: 100%;
      margin: 1.25rem 0;
      border-collapse: separate;
      border-spacing: 0;
      font-size: 0.95rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07);
      border-radius: 12px;
      overflow: hidden;
    }
    
    #article-body.prose-blog thead {
      background: linear-gradient(135deg, #ff6b35, #f7931e);
    }
    
    #article-body.prose-blog thead th {
      padding: 1rem 1.25rem;
      text-align: left;
      font-weight: 600;
      color: white;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    
    #article-body.prose-blog tbody tr {
      background: white;
      transition: background-color 0.15s ease;
    }
    
    #article-body.prose-blog tbody tr:nth-child(even) {
      background: #fafafa;
    }
    
    #article-body.prose-blog tbody tr:hover {
      background: rgba(255, 107, 53, 0.05);
    }
    
    #article-body.prose-blog td {
      padding: 1rem 1.25rem;
      border-top: 1px solid #e5e5e5;
    }
    
    #article-body.prose-blog tbody tr:first-child td {
      border-top: none;
    }
    
    .dark #article-body.prose-blog tbody tr {
      background: #1a1a1a;
    }
    
    .dark #article-body.prose-blog tbody tr:nth-child(even) {
      background: #222;
    }
    
    .dark #article-body.prose-blog tbody tr:hover {
      background: rgba(255, 107, 53, 0.1);
    }
    
    .dark #article-body.prose-blog td {
      border-color: #333;
    }

    /* Code - inline */
    #article-body.prose-blog code {
      background: rgba(255, 107, 53, 0.1);
      padding: 0.2rem 0.4rem;
      border-radius: 4px;
      font-size: 0.9em;
      font-family: 'Fira Code', 'Consolas', monospace;
      color: #ff6b35;
    }
    
    .dark #article-body.prose-blog code {
      background: rgba(255, 107, 53, 0.2);
      color: #ffa057;
    }

    /* Images */
    #article-body.prose-blog img {
      width: 100%;
      height: auto;
      border-radius: 12px;
      margin: 2rem 0;
      box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    #article-body.prose-blog img:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.2);
    }

    /* HR separator */
    #article-body.prose-blog hr {
      margin: 3rem 0;
      border: none;
      height: 1px;
      background: linear-gradient(to right, transparent, #e5e5e5 20%, #e5e5e5 80%, transparent);
    }
    
    .dark #article-body.prose-blog hr {
      background: linear-gradient(to right, transparent, #333 20%, #333 80%, transparent);
    }

    /* Remove excessive spacing after headings */
    #article-body.prose-blog h2 + *,
    #article-body.prose-blog h3 + * {
      margin-top: 0.75rem !important;
    }
    
    /* Fix spacing between headings and tables specifically */
    #article-body.prose-blog h2 + table,
    #article-body.prose-blog h3 + table {
      margin-top: 1rem !important;
    }

    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }

    /* Hide scrollbars in TOC */
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }

    /* Reveal animation */
    .reveal {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .reveal.reveal-in {
      opacity: 1;
      transform: translateY(0);
    }

    /* TOC link styling with orange active indicator */
    .toc-link {
      position: relative;
      transition: all 0.2s ease;
    }
    
    .toc-link.is-active {
      color: #ff6b35 !important;
      font-weight: 600;
      padding-left: 12px;
    }
    
    .toc-link.is-active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 3px;
      height: 70%;
      background: linear-gradient(to bottom, #ff6b35, #f7931e);
      border-radius: 2px;
    }

    /* Add reading progress indicator at top */
    .reading-progress {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: rgba(0, 0, 0, 0.05);
      z-index: 1000;
    }
    
    .reading-progress-bar {
      height: 100%;
      background: linear-gradient(to right, #ff6b35, #f7931e);
      width: 0%;
      transition: width 0.1s ease;
    }
  </style>

  {{-- Reading progress bar --}}
  <div class="reading-progress">
    <div class="reading-progress-bar" id="reading-progress-bar"></div>
  </div>

  {{-- TOC + reveal + share + reading progress --}}
  <script>
    // Reveal animations
    (function(){
      if (!('IntersectionObserver' in window)) return;
      const io = new IntersectionObserver((entries)=>{
        entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('reveal-in'); io.unobserve(e.target);} });
      }, {rootMargin:'0px 0px -10% 0px', threshold:0.05});
      document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
    })();

    // Table of Contents generation and scroll spy with orange indicator
    (function(){
      const article=document.getElementById('article-body'); if(!article) return;
      const desktopRoot=document.querySelector('[data-toc]');
      const mobileRoot=document.querySelector('[data-toc-mobile]');
      const candidates=[...article.querySelectorAll('h2, h3, p.toc-h2, p.toc-h3, p[data-toc="2"], p[data-toc="3"]')];
      const used=new Set();
      const slug=s=>(s||'').toLowerCase().normalize('NFD').replace(/\p{Diacritic}/gu,'').replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-');

      function addItem(root, el, id, level){
        if(!root) return;
        const li=document.createElement('li'); const a=document.createElement('a');
        a.href=`#${id}`; a.className='toc-link block rounded px-2 py-1 text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-slate-100';
        a.textContent=(el.textContent||'').trim();
        if(level===2){ const wrap=document.createElement('li'), head=a.cloneNode(true), ol=document.createElement('ol');
          ol.className='mt-1 space-y-1 pl-3 border-l border-black/5 dark:border-white/5'; wrap.appendChild(head); wrap.appendChild(ol); root.appendChild(wrap); return ol;
        } else { li.appendChild(a); root.appendChild(li); return null; }
      }

      const dWrap=desktopRoot?(function(){ const ol=document.createElement('ol'); desktopRoot.appendChild(ol); return ol; })():null;
      const mWrap=mobileRoot?(function(){ const ol=document.createElement('ol'); mobileRoot.appendChild(ol); return ol; })():null;

      let lastD=null, lastM=null;
      candidates.forEach(el=>{
        const isH2=el.matches('h2, p.toc-h2, p[data-toc="2"]'); const level=isH2?2:3;
        let id=el.getAttribute('id');
        if(!id){ id=slug(el.textContent); let base=id,i=2; while(used.has(id)){ id=`${base}-${i++}` } el.setAttribute('id', id); used.add(id); }
        if(dWrap) lastD = (level===2) ? addItem(dWrap, el, id, 2) : addItem(lastD||dWrap, el, id, 3) || lastD;
        if(mWrap) lastM = (level===2) ? addItem(mWrap, el, id, 2) : addItem(lastM||mWrap, el, id, 3) || lastM;
      });

      const links=[...document.querySelectorAll('.toc-link')];
      const map=new Map(links.map(a=>[decodeURIComponent((a.getAttribute('href')||'').replace('#','')), a]));
      if('IntersectionObserver' in window){
        const spy=new IntersectionObserver((entries)=>{
          entries.forEach(e=>{ const id=e.target.getAttribute('id'); if(!id) return; const a=map.get(id); if(!a) return;
            if(e.isIntersecting){ links.forEach(x=>x.classList.remove('is-active')); a.classList.add('is-active'); }
          });
        }, {rootMargin:'0px 0px -70% 0px', threshold:0.1});
        document.querySelectorAll('#article-body h2[id], #article-body h3[id], #article-body p.toc-h2[id], #article-body p.toc-h3[id], #article-body p[data-toc="2"][id], #article-body p[data-toc="3"][id]')
          .forEach(h=>spy.observe(h));
      }
    })();

    // Share functionality
    (function(){
      const btn=document.querySelector('[data-share]'); if(!btn) return;
      btn.addEventListener('click', async ()=>{
        const data={ title:@json($title), text:@json($desc), url:@json($pageUrl) };
        if(navigator.share){ try{ await navigator.share(data); }catch(_){} return; }
        const u=encodeURIComponent(data.url), t=encodeURIComponent(data.title);
        window.open(`https://twitter.com/intent/tweet?url=${u}&text=${t}`,'_blank','noopener,noreferrer,width=600,height=520');
        setTimeout(()=>window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${u}`, '_blank','noopener,noreferrer,width=700,height=600'),200);
      });
    })();

    // Reading progress bar
    (function(){
      const progressBar = document.getElementById('reading-progress-bar');
      const article = document.getElementById('article-body');
      if (!progressBar || !article) return;
      
      window.addEventListener('scroll', () => {
        const articleRect = article.getBoundingClientRect();
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrolled = window.scrollY - article.offsetTop + windowHeight;
        const progress = Math.min(Math.max((scrolled / articleHeight) * 100, 0), 100);
        progressBar.style.width = progress + '%';
      });
    })();
  </script>
@endsection