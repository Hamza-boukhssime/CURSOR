<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$lang = isset($_GET['lang']) && $_GET['lang'] === 'ar' ? 'ar' : 'en';
$dir = $lang === 'ar' ? 'rtl' : 'ltr';
$isRTL = $lang === 'ar';

// Translations
$translations = [
    'en' => [
        'contact_us' => 'Contact Us',
        'language' => 'عربية',
        'launching_soon' => 'Launching Soon',
        'hero_subtitle' => 'Your trusted global HVAC/R solutions provider is upgrading to serve you better',
        'notify_title' => 'Be the First to Know',
        'notify_subtitle' => 'Get exclusive updates when we launch our new platform',
        'name_placeholder' => 'Your Name',
        'email_placeholder' => 'Your Email',
        'notify_button' => 'Notify Me',
        'company_overview' => 'Leading HVAC/R Solutions Provider',
        'overview_text' => 'For over a decade, RefCo Supply has been the trusted partner for contractors, homeowners, and businesses seeking quality HVAC/R solutions. With headquarters in Knoxville, TN and branches in Tampa, FL and Doha, Qatar, we\'re expanding globally to serve you better.',
        'mission_title' => 'Our Mission',
        'mission_text' => 'To be the go-to resource for HVAC/R professionals and homeowners, delivering reliable, cost-effective, and timely solutions for residential, commercial, and industrial applications.',
        'global_presence' => 'Global Presence',
        'expanding_globally' => 'Expanding Globally',
        'saudi_soon' => 'Saudi Arabia - Coming Soon',
        'products_title' => 'Core Products & Services',
        'products' => [
            'HVAC Equipment & Parts' => 'Complete AC, heating, and refrigeration systems with all components',
            'Refrigerants & Additives' => 'Comprehensive inventory for various HVAC/R systems',
            'Tools & Hardware' => 'Professional HVAC tools, gauges, meters, and supplies',
            'Piping & Fittings' => 'Copper piping, ductwork, valves for all applications',
            'Filters & Accessories' => 'Air filters and performance-enhancing accessories',
            'Custom Solutions' => 'Tailored solutions for large commercial and industrial projects'
        ],
        'values_title' => 'Our Core Values',
        'values' => [
            'Customer-Centric' => 'Your needs always come first',
            'Integrity' => 'Transparency in every interaction',
            'Quality' => 'Only the best from trusted brands',
            'Innovation' => 'Staying ahead with new solutions',
            'Growth' => 'Expanding to serve you globally'
        ],
        'achievements_title' => 'Key Achievements',
        'achievements' => [
            '10+ Years of Excellence',
            'Fastest-Growing HVAC/R Supply House',
            'International Expansion to Middle East',
            'Trusted by Thousands of Contractors'
        ],
        'expansion_title' => 'Expansion Plans',
        'expansion_text' => 'RefCo Supply is actively pursuing growth opportunities in new geographic markets and through strategic product diversification. Our commitment to expansion ensures we remain your preferred choice for all HVAC/R needs.',
        'target_title' => 'Who We Serve',
        'targets' => [
            'HVAC/R Contractors' => 'Complete solutions for residential, commercial, and industrial projects',
            'Commercial & Industrial' => 'Large-scale equipment and technical support',
            'International Clients' => 'Global HVAC/R solutions with Middle East expertise'
        ],
        'locations_title' => 'Our Locations',
        'headquarters' => 'Headquarters',
        'branch' => 'Branch',
        'website' => 'Website',
        'all_rights' => 'All rights reserved',
        'privacy' => 'Privacy Policy',
        'terms' => 'Terms of Service',
        'success_message' => 'Thank you! We\'ll notify you when we launch.',
        'error_message' => 'Something went wrong. Please try again.',
        'rate_limit_message' => 'Too many requests. Please try again later.',
        'validation_error' => 'Please enter a valid email address.'
    ],
    'ar' => [
        'contact_us' => 'اتصل بنا',
        'language' => 'EN',
        'launching_soon' => 'قريباً',
        'hero_subtitle' => 'مزود حلول HVAC/R العالمي الموثوق به يقوم بالترقية لخدمتك بشكل أفضل',
        'notify_title' => 'كن أول من يعرف',
        'notify_subtitle' => 'احصل على تحديثات حصرية عند إطلاق منصتنا الجديدة',
        'name_placeholder' => 'اسمك',
        'email_placeholder' => 'بريدك الإلكتروني',
        'notify_button' => 'أبلغني',
        'company_overview' => 'مزود حلول HVAC/R رائد',
        'overview_text' => 'لأكثر من عقد من الزمان، كانت RefCo Supply الشريك الموثوق به للمقاولين وأصحاب المنازل والشركات التي تبحث عن حلول HVAC/R عالية الجودة. مع المقر الرئيسي في نوكسفيل، تينيسي وفروع في تامبا، فلوريدا والدوحة، قطر، نحن نتوسع عالميًا لخدمتك بشكل أفضل.',
        'mission_title' => 'مهمتنا',
        'mission_text' => 'أن نكون المورد المفضل لمحترفي HVAC/R وأصحاب المنازل، وتقديم حلول موثوقة وفعالة من حيث التكلفة وفي الوقت المناسب للتطبيقات السكنية والتجارية والصناعية.',
        'global_presence' => 'التواجد العالمي',
        'expanding_globally' => 'التوسع عالمياً',
        'saudi_soon' => 'المملكة العربية السعودية - قريباً',
        'products_title' => 'المنتجات والخدمات الأساسية',
        'products' => [
            'معدات وقطع غيار HVAC' => 'أنظمة تكييف وتدفئة وتبريد كاملة مع جميع المكونات',
            'المبردات والإضافات' => 'مخزون شامل لأنظمة HVAC/R المختلفة',
            'الأدوات والأجهزة' => 'أدوات HVAC احترافية، مقاييس، عدادات، ولوازم',
            'الأنابيب والتجهيزات' => 'أنابيب نحاسية، قنوات، صمامات لجميع التطبيقات',
            'المرشحات والملحقات' => 'مرشحات الهواء وملحقات تحسين الأداء',
            'حلول مخصصة' => 'حلول مصممة خصيصاً للمشاريع التجارية والصناعية الكبيرة'
        ],
        'values_title' => 'قيمنا الأساسية',
        'values' => [
            'محورها العميل' => 'احتياجاتك دائماً في المقام الأول',
            'النزاهة' => 'الشفافية في كل تعامل',
            'الجودة' => 'فقط الأفضل من العلامات التجارية الموثوقة',
            'الابتكار' => 'البقاء في المقدمة مع حلول جديدة',
            'النمو' => 'التوسع لخدمتك عالمياً'
        ],
        'achievements_title' => 'الإنجازات الرئيسية',
        'achievements' => [
            '10+ سنوات من التميز',
            'أسرع بيت توريد HVAC/R نمواً',
            'التوسع الدولي إلى الشرق الأوسط',
            'موثوق من آلاف المقاولين'
        ],
        'expansion_title' => 'خطط التوسع',
        'expansion_text' => 'تسعى RefCo Supply بنشاط لفرص النمو في أسواق جغرافية جديدة ومن خلال التنويع الاستراتيجي للمنتجات. التزامنا بالتوسع يضمن أن نبقى خيارك المفضل لجميع احتياجات HVAC/R.',
        'target_title' => 'من نخدم',
        'targets' => [
            'مقاولو HVAC/R' => 'حلول كاملة للمشاريع السكنية والتجارية والصناعية',
            'التجاري والصناعي' => 'معدات واسعة النطاق ودعم فني',
            'العملاء الدوليون' => 'حلول HVAC/R العالمية مع خبرة الشرق الأوسط'
        ],
        'locations_title' => 'مواقعنا',
        'headquarters' => 'المقر الرئيسي',
        'branch' => 'فرع',
        'website' => 'الموقع الإلكتروني',
        'all_rights' => 'جميع الحقوق محفوظة',
        'privacy' => 'سياسة الخصوصية',
        'terms' => 'شروط الخدمة',
        'success_message' => 'شكراً لك! سنبلغك عند الإطلاق.',
        'error_message' => 'حدث خطأ ما. يرجى المحاولة مرة أخرى.',
        'rate_limit_message' => 'طلبات كثيرة جداً. يرجى المحاولة لاحقاً.',
        'validation_error' => 'يرجى إدخال عنوان بريد إلكتروني صالح.'
    ]
];

$t = $translations[$lang];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefCo Supply - <?php echo $t['launching_soon']; ?></title>
    <meta name="description" content="RefCo Supply - Leading global provider of HVAC/R solutions. Serving contractors, homeowners, and businesses with quality products and exceptional service.">
    <link rel="canonical" href="https://refcosupply.com">
    
    <!-- Open Graph -->
    <meta property="og:title" content="RefCo Supply - Launching Soon">
    <meta property="og:description" content="Your trusted global HVAC/R solutions provider is upgrading to serve you better.">
    <meta property="og:image" content="/public/images/logo.png">
    <meta property="og:url" content="https://refcosupply.com">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="RefCo Supply - Launching Soon">
    <meta name="twitter:description" content="Your trusted global HVAC/R solutions provider is upgrading to serve you better.">
    <meta name="twitter:image" content="/public/images/logo.png">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    
    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #dc2626 100%);
        }
        
        .dark .hero-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #991b1b 100%);
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .loading-spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 2px solid white;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        .rtl {
            direction: rtl;
        }
        
        .toast {
            transform: translateX(-50%) translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .toast.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 <?php echo $isRTL ? 'rtl' : ''; ?>">
    <!-- Hero Section with Navbar -->
    <div class="hero-gradient min-h-screen relative overflow-hidden">
        <!-- Navbar -->
        <nav class="relative z-20 p-4 md:p-6">
            <div class="container mx-auto flex items-center justify-between">
                <img src="/public/images/logo.png" alt="RefCo Supply" class="h-10 md:h-12 w-auto" loading="eager">
                
                <div class="flex items-center gap-2 md:gap-4">
                    <!-- Contact Button -->
                    <a href="mailto:info@refcosupply.com" class="glass px-3 md:px-4 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm md:text-base">
                        <?php echo $t['contact_us']; ?>
                    </a>
                    
                    <!-- Language Toggle -->
                    <a href="?lang=<?php echo $lang === 'en' ? 'ar' : 'en'; ?>" class="glass px-3 md:px-4 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm md:text-base">
                        <?php echo $t['language']; ?>
                    </a>
                    
                    <!-- Dark Mode Toggle -->
                    <button id="darkModeToggle" class="glass p-2 rounded-lg text-white hover:bg-white/20 transition-colors" aria-label="Toggle dark mode">
                        <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                        </svg>
                        <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        
        <!-- Hero Content -->
        <div class="relative z-10 container mx-auto px-4 py-12 md:py-20 text-center text-white">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 animate-fade-in">
                <?php echo $t['launching_soon']; ?>
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl mb-12 opacity-90 max-w-3xl mx-auto">
                <?php echo $t['hero_subtitle']; ?>
            </p>
            
            <!-- Notify Form -->
            <div class="glass max-w-lg mx-auto p-6 md:p-8 rounded-2xl">
                <h2 class="text-2xl md:text-3xl font-semibold mb-2"><?php echo $t['notify_title']; ?></h2>
                <p class="text-sm md:text-base opacity-90 mb-6"><?php echo $t['notify_subtitle']; ?></p>
                
                <form id="notifyForm" class="space-y-4">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="text" name="name" placeholder="<?php echo $t['name_placeholder']; ?>" 
                           class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/70 focus:outline-none focus:border-white/40 transition-colors"
                           required>
                    <input type="email" name="email" placeholder="<?php echo $t['email_placeholder']; ?>" 
                           class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/70 focus:outline-none focus:border-white/40 transition-colors"
                           required>
                    <button type="submit" class="w-full bg-white text-blue-900 dark:bg-gray-200 dark:text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-300 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                        <span class="button-text"><?php echo $t['notify_button']; ?></span>
                        <div class="loading-spinner mx-auto hidden"></div>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    </div>
    
    <!-- Company Overview Section -->
    <section class="py-16 md:py-24 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    <?php echo $t['company_overview']; ?>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-8">
                    <?php echo $t['overview_text']; ?>
                </p>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 md:p-8 rounded-2xl">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white"><?php echo $t['mission_title']; ?></h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        <?php echo $t['mission_text']; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Global Locations -->
    <section class="py-16 md:py-24 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">
                <?php echo $t['global_presence']; ?>
            </h2>
            <div class="grid md:grid-cols-3 gap-6 md:gap-8 max-w-5xl mx-auto">
                <!-- Knoxville -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Knoxville, TN (<?php echo $t['headquarters']; ?>)</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">2309 Mitchell St, Knoxville, TN 37917</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">865-249-7593</p>
                </div>
                
                <!-- Tampa -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Tampa, FL</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">6015 N 56th St, Tampa, FL 33610</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">(813) 374-1011</p>
                </div>
                
                <!-- Doha -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Doha, Qatar</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">The Pearl, P.O. Box 301588</p>
                </div>
            </div>
            
            <!-- Expanding Soon -->
            <div class="mt-12 text-center">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4"><?php echo $t['expanding_globally']; ?></p>
                <div class="inline-flex items-center gap-2 bg-red-50 dark:bg-red-900/20 px-6 py-3 rounded-full">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"></path>
                    </svg>
                    <span class="text-red-600 dark:text-red-400 font-medium"><?php echo $t['saudi_soon']; ?></span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Products & Services -->
    <section class="py-16 md:py-24 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">
                <?php echo $t['products_title']; ?>
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                <?php 
                $icons = [
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>'
                ];
                $i = 0;
                foreach ($t['products'] as $title => $desc): 
                ?>
                <div class="group bg-gray-50 dark:bg-gray-700 p-6 rounded-xl hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 dark:group-hover:bg-blue-500 transition-colors">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <?php echo $icons[$i % count($icons)]; ?>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white"><?php echo $title; ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm"><?php echo $desc; ?></p>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Core Values -->
    <section class="py-16 md:py-24 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">
                <?php echo $t['values_title']; ?>
            </h2>
            <div class="flex flex-wrap justify-center gap-4 max-w-4xl mx-auto">
                <?php foreach ($t['values'] as $value => $desc): ?>
                <div class="bg-white dark:bg-gray-800 px-6 py-4 rounded-full shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="font-semibold text-gray-900 dark:text-white"><?php echo $value; ?></h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo $desc; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Achievements -->
    <section class="py-16 md:py-24 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">
                <?php echo $t['achievements_title']; ?>
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
                <?php foreach ($t['achievements'] as $achievement): ?>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900 dark:text-white"><?php echo $achievement; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Expansion Plans -->
    <section class="py-16 md:py-24 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    <?php echo $t['expansion_title']; ?>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                    <?php echo $t['expansion_text']; ?>
                </p>
            </div>
        </div>
    </section>
    
    <!-- Target Market -->
    <section class="py-16 md:py-24 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">
                <?php echo $t['target_title']; ?>
            </h2>
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <?php 
                $targetIcons = [
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>',
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                ];
                $i = 0;
                foreach ($t['targets'] as $target => $desc): 
                ?>
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <?php echo $targetIcons[$i]; ?>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white"><?php echo $target; ?></h3>
                    <p class="text-gray-600 dark:text-gray-300"><?php echo $desc; ?></p>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-black text-white py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Logo and Description -->
                <div class="md:col-span-2">
                    <img src="/public/images/logo.png" alt="RefCo Supply" class="h-10 mb-4" loading="lazy">
                    <p class="text-gray-400 text-sm">
                        Leading global provider of HVAC/R solutions, serving contractors, homeowners, and businesses with quality products and exceptional service.
                    </p>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="font-semibold mb-4"><?php echo $t['locations_title']; ?></h3>
                    <div class="space-y-3 text-sm text-gray-400">
                        <a href="mailto:info@refcosupply.com" class="block hover:text-white transition-colors">
                            info@refcosupply.com
                        </a>
                        <a href="tel:865-249-7593" class="block hover:text-white transition-colors">
                            865-249-7593
                        </a>
                        <a href="https://refcosupply.com" class="block hover:text-white transition-colors">
                            RefCoSupply.com
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <div class="space-y-2 text-sm text-gray-400">
                        <a href="#" class="block hover:text-white transition-colors"><?php echo $t['privacy']; ?></a>
                        <a href="#" class="block hover:text-white transition-colors"><?php echo $t['terms']; ?></a>
                        <a href="mailto:info@refcosupply.com" class="block hover:text-white transition-colors"><?php echo $t['contact_us']; ?></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> RefCo Supply. <?php echo $t['all_rights']; ?>.</p>
            </div>
        </div>
    </footer>
    
    <!-- Toast Notification -->
    <div id="toast" class="toast fixed bottom-8 left-1/2 bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-3 rounded-lg shadow-lg z-50">
        <span id="toastMessage"></span>
    </div>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        
        // Check for saved preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            html.classList.add('dark');
        }
        
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const theme = html.classList.contains('dark') ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
        });
        
        // Notify Form Handler
        const notifyForm = document.getElementById('notifyForm');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        
        function showToast(message, isError = false) {
            toastMessage.textContent = message;
            toast.classList.toggle('bg-red-600', isError);
            toast.classList.toggle('bg-gray-900', !isError);
            toast.classList.toggle('dark:bg-red-600', isError);
            toast.classList.toggle('dark:bg-white', !isError);
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
        
        notifyForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const submitButton = notifyForm.querySelector('button[type="submit"]');
            const buttonText = submitButton.querySelector('.button-text');
            const spinner = submitButton.querySelector('.loading-spinner');
            
            // Disable button and show spinner
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            spinner.classList.remove('hidden');
            
            const formData = new FormData(notifyForm);
            const data = {
                email: formData.get('email'),
                name: formData.get('name'),
                csrf_token: formData.get('csrf_token')
            };
            
            try {
                const response = await fetch('notify.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (response.ok && result.success) {
                    showToast('<?php echo $t['success_message']; ?>');
                    notifyForm.reset();
                } else if (response.status === 429) {
                    showToast('<?php echo $t['rate_limit_message']; ?>', true);
                } else if (result.error === 'validation_failed') {
                    showToast('<?php echo $t['validation_error']; ?>', true);
                } else {
                    showToast('<?php echo $t['error_message']; ?>', true);
                }
            } catch (error) {
                showToast('<?php echo $t['error_message']; ?>', true);
            } finally {
                // Re-enable button and hide spinner
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                spinner.classList.add('hidden');
            }
        });
        
        // GSAP Animations
        if (window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
            gsap.registerPlugin(ScrollTrigger);
            
            // Hero animations
            gsap.from('.hero-gradient h1', { opacity: 0, y: 30, duration: 1, delay: 0.2 });
            gsap.from('.hero-gradient p', { opacity: 0, y: 30, duration: 1, delay: 0.4 });
            gsap.from('.glass', { opacity: 0, y: 30, duration: 1, delay: 0.6 });
            
            // Scroll animations
            gsap.utils.toArray('section').forEach(section => {
                gsap.from(section.children, {
                    opacity: 0,
                    y: 30,
                    duration: 1,
                    stagger: 0.1,
                    scrollTrigger: {
                        trigger: section,
                        start: 'top 80%',
                        once: true
                    }
                });
            });
        }
    </script>
    
    <!-- JSON-LD Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "RefCo Supply",
        "description": "Leading global provider of HVAC/R solutions",
        "url": "https://refcosupply.com",
        "logo": "https://refcosupply.com/public/images/logo.png",
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+1-865-249-7593",
                "contactType": "customer service",
                "areaServed": "US",
                "availableLanguage": ["en", "ar"]
            }
        ],
        "address": [
            {
                "@type": "PostalAddress",
                "streetAddress": "2309 Mitchell St",
                "addressLocality": "Knoxville",
                "addressRegion": "TN",
                "postalCode": "37917",
                "addressCountry": "US"
            },
            {
                "@type": "PostalAddress",
                "streetAddress": "6015 N 56th St",
                "addressLocality": "Tampa",
                "addressRegion": "FL",
                "postalCode": "33610",
                "addressCountry": "US"
            },
            {
                "@type": "PostalAddress",
                "streetAddress": "The Pearl P.O. Box 301588",
                "addressLocality": "Doha",
                "addressCountry": "QA"
            }
        ]
    }
    </script>
</body>
</html>