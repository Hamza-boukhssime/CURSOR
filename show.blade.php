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
        <h2 class="text-xl sm:text-2xl font-semibold text-slate-900 dark:text-slate-100">Related posts</h2>
        @if($relatedPosts->isEmpty())
          <p class="mt-3 text-slate-600 dark:text-slate-300">No related posts yet.</p>
        @else
          <ul class="mt-5 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($relatedPosts as $rel)
              @php $relCover = method_exists($rel, 'ogImageUrl') ? ($rel->ogImageUrl() ?: $rel->thumbnailUrl()) : null; @endphp
              <li>
                <a href="{{ route('blog.show', $rel->slug) }}" class="block rounded-xl overflow-hidden bg-white dark:bg-neutral-900 ring-1 ring-black/5 dark:ring-white/5 hover:ring-riy-gold/40 transition">
                  @if ($relCover)
                    <img src="{{ $relCover }}" alt="Cover for {{ $rel->title }}" loading="lazy" decoding="async" class="h-40 w-full object-cover">
                  @endif
                  <div class="p-4">
                    <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">{{ $rel->title }}</h3>
                    <div class="mt-1 text-xs text-slate-500">{{ $rel->formattedDate('M j, Y') }}</div>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        @endif
      </section>

    </div>
  </main>

  {{-- PREMIUM BLOG STYLES — Modern, Clean, Premium UX --}}
  <style>
    /* ===== PREMIUM BLOG ARTICLE STYLES — scoped to #article-body ===== */

    /* Base typography with perfect readability */
    #article-body.prose-blog {
      font-size: 18px;
      line-height: 1.7;
      color: #1e293b;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      letter-spacing: -0.011em;
    }
    .dark #article-body.prose-blog {
      color: #e2e8f0;
    }

    /* Premium paragraph styling with perfect spacing */
    #article-body.prose-blog p {
      margin: 1.5rem 0;
      text-align: justify;
      text-justify: inter-word;
      font-weight: 400;
    }

    #article-body.prose-blog p:first-child {
      margin-top: 0;
    }

    #article-body.prose-blog p:last-child {
      margin-bottom: 0;
    }

    /* Premium headings with sophisticated hierarchy */
    #article-body.prose-blog h2 {
      font-weight: 700;
      color: #0f172a;
      font-size: clamp(1.5rem, 3vw, 2rem);
      margin: 3rem 0 1.25rem;
      scroll-margin-top: 100px;
      position: relative;
      letter-spacing: -0.025em;
      line-height: 1.2;
    }

    #article-body.prose-blog h2::before {
      content: '';
      position: absolute;
      left: -1.5rem;
      top: 0.5rem;
      width: 4px;
      height: 1.5rem;
      background: linear-gradient(135deg, #f97316, #ea580c);
      border-radius: 2px;
      opacity: 0.8;
    }

    #article-body.prose-blog h3 {
      font-weight: 600;
      color: #1e293b;
      font-size: clamp(1.25rem, 2.5vw, 1.5rem);
      margin: 2.5rem 0 1rem;
      scroll-margin-top: 100px;
      letter-spacing: -0.02em;
      line-height: 1.3;
    }

    .dark #article-body.prose-blog h2,
    .dark #article-body.prose-blog h3 {
      color: #f1f5f9;
    }

    /* Smooth spacing after headings */
    #article-body.prose-blog h2 + *,
    #article-body.prose-blog h3 + * {
      margin-top: 0.75rem !important;
    }

    /* Premium list styling */
    #article-body.prose-blog ul,
    #article-body.prose-blog ol {
      margin: 1.5rem 0;
      padding-left: 1.75rem;
    }

    #article-body.prose-blog li {
      margin: 0.75rem 0;
      line-height: 1.7;
      position: relative;
    }

    #article-body.prose-blog ul > li::marker {
      color: #f97316;
      font-size: 1.2em;
    }

    #article-body.prose-blog ol > li::marker {
      color: #f97316;
      font-weight: 600;
    }

    /* Enhanced nested list styling */
    #article-body.prose-blog li > ul,
    #article-body.prose-blog li > ol {
      margin: 0.5rem 0;
    }

    /* Remove paragraph margins inside list items for cleaner look */
    #article-body.prose-blog li > p {
      margin: 0 !important;
    }

    #article-body.prose-blog li > p + p {
      margin-top: 0.75rem !important;
    }

    /* Premium link styling with subtle hover effects */
    #article-body.prose-blog a {
      color: #f97316;
      text-decoration: none;
      font-weight: 500;
      border-bottom: 1px solid transparent;
      transition: all 0.2s ease;
      position: relative;
    }

    #article-body.prose-blog a:hover {
      color: #ea580c;
      border-bottom-color: #f97316;
    }

    .dark #article-body.prose-blog a {
      color: #fb923c;
    }

    .dark #article-body.prose-blog a:hover {
      color: #f97316;
      border-bottom-color: #fb923c;
    }

    /* Premium blockquotes with sophisticated design */
    #article-body.prose-blog blockquote {
      margin: 2.5rem 0;
      padding: 2rem 2rem 2rem 3rem;
      background: linear-gradient(135deg, rgba(249, 115, 22, 0.05), rgba(251, 146, 60, 0.02));
      border-left: 4px solid #f97316;
      border-radius: 12px;
      position: relative;
      font-style: italic;
      font-size: 1.1em;
      line-height: 1.6;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    #article-body.prose-blog blockquote::before {
      content: '"';
      position: absolute;
      left: 1rem;
      top: 1rem;
      font-size: 3rem;
      color: #f97316;
      opacity: 0.3;
      font-family: Georgia, serif;
      line-height: 1;
    }

    #article-body.prose-blog blockquote > p {
      margin: 0;
      color: #374151;
      font-weight: 500;
    }

    .dark #article-body.prose-blog blockquote {
      background: linear-gradient(135deg, rgba(249, 115, 22, 0.08), rgba(251, 146, 60, 0.03));
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
    }

    .dark #article-body.prose-blog blockquote > p {
      color: #d1d5db;
    }

    /* Premium table styling */
    #article-body.prose-blog table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      margin: 2rem 0;
      font-size: 0.95rem;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .dark #article-body.prose-blog table {
      background: #1e293b;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
    }

    #article-body.prose-blog thead {
      background: linear-gradient(135deg, #f97316, #ea580c);
    }

    #article-body.prose-blog th {
      padding: 1rem 1.25rem;
      font-weight: 600;
      text-align: left;
      color: white;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border: none;
    }

    #article-body.prose-blog td {
      padding: 1rem 1.25rem;
      border-bottom: 1px solid #e5e7eb;
      vertical-align: top;
      line-height: 1.5;
    }

    .dark #article-body.prose-blog td {
      border-bottom-color: #374151;
    }

    #article-body.prose-blog tbody tr:last-child td {
      border-bottom: none;
    }

    #article-body.prose-blog tbody tr:hover {
      background: rgba(249, 115, 22, 0.02);
    }

    .dark #article-body.prose-blog tbody tr:hover {
      background: rgba(249, 115, 22, 0.05);
    }

    /* Premium media styling */
    #article-body.prose-blog img,
    #article-body.prose-blog video {
      display: block;
      max-width: 100%;
      height: auto;
      border-radius: 16px;
      margin: 2.5rem auto;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #article-body.prose-blog img:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Inline code styling */
    #article-body.prose-blog code {
      background: rgba(249, 115, 22, 0.1);
      color: #ea580c;
      padding: 0.2em 0.4em;
      border-radius: 4px;
      font-size: 0.9em;
      font-weight: 500;
      border: 1px solid rgba(249, 115, 22, 0.2);
    }

    .dark #article-body.prose-blog code {
      background: rgba(249, 115, 22, 0.15);
      color: #fb923c;
      border-color: rgba(249, 115, 22, 0.3);
    }

    /* Strong text enhancement */
    #article-body.prose-blog strong {
      color: #0f172a;
      font-weight: 600;
    }

    .dark #article-body.prose-blog strong {
      color: #f1f5f9;
    }

    /* Em text enhancement */
    #article-body.prose-blog em {
      color: #475569;
      font-style: italic;
    }

    .dark #article-body.prose-blog em {
      color: #cbd5e1;
    }

    /* Hide scrollbars in TOC rails */
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }

    /* Reveal effect (cards/sections) */
    .reveal {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .reveal.reveal-in {
      opacity: 1;
      transform: translateY(0);
    }

    /* Enhanced TOC active link with orange progression */
    .toc-link {
      transition: all 0.3s ease;
      border-radius: 6px;
    }

    .toc-link.is-active {
      color: #f97316;
      font-weight: 600;
      background: rgba(249, 115, 22, 0.08);
      transform: translateX(4px);
      border-left: 3px solid #f97316;
      padding-left: 1rem;
    }

    .dark .toc-link.is-active {
      background: rgba(249, 115, 22, 0.12);
      color: #fb923c;
      border-left-color: #fb923c;
    }

    /* Mobile responsiveness */
    @media (max-width: 640px) {
      #article-body.prose-blog {
        font-size: 16px;
        line-height: 1.65;
      }

      #article-body.prose-blog h2::before {
        left: -1rem;
      }

      #article-body.prose-blog blockquote {
        padding: 1.5rem 1.5rem 1.5rem 2.5rem;
        margin: 2rem 0;
      }

      #article-body.prose-blog table {
        font-size: 0.875rem;
      }

      #article-body.prose-blog th,
      #article-body.prose-blog td {
        padding: 0.75rem 1rem;
      }
    }
  </style>


  {{-- TOC + reveal + share --}}
  <script>
    (function(){
      if (!('IntersectionObserver' in window)) return;
      const io = new IntersectionObserver((entries)=>{
        entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('reveal-in'); io.unobserve(e.target);} });
      }, {rootMargin:'0px 0px -10% 0px', threshold:0.05});
      document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
    })();

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
  </script>
@endsection