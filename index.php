<?php
session_start();

// Generate CSRF token if not present
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Get language preference
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$dir = $lang === 'ar' ? 'rtl' : 'ltr';

// Language content
$content = [
    'en' => [
        'title' => 'RefCo Supply - Launching Soon',
        'description' => 'RefCo Supply - Leading provider of HVAC/R solutions. Serving contractors, homeowners, and businesses globally with quality products and exceptional service.',
        'launching_soon' => 'Launching Soon',
        'maintenance_subtitle' => 'We\'re working on something amazing',
        'notify_title' => 'Be the first to know',
        'notify_subtitle' => 'Get notified when we launch our new website',
        'email_placeholder' => 'Enter your email address',
        'name_placeholder' => 'Enter your name',
        'notify_button' => 'Notify Me',
        'contact_us' => 'Contact Us',
        'about_title' => 'About RefCo Supply',
        'about_text' => 'Leading provider of HVAC/R solutions, serving contractors, homeowners, and businesses for over 10 years. Focused on quality products, exceptional service, and competitive pricing.',
        'mission_title' => 'Our Mission',
        'mission_text' => 'To be the go-to resource for HVAC/R professionals and homeowners, delivering reliable, cost-effective, and timely solutions for residential, commercial, and industrial applications.',
        'locations_title' => 'Global Locations',
        'products_title' => 'Core Products & Services',
        'products' => [
            'HVAC Equipment & Parts',
            'Refrigerants & Additives', 
            'Tools & Hardware',
            'Piping & Fittings',
            'Filters & Accessories',
            'Custom Solutions'
        ],
        'values_title' => 'Core Values',
        'values' => [
            'Customer-Centric',
            'Integrity',
            'Quality',
            'Innovation',
            'Growth & Expansion'
        ],
        'achievements_title' => 'Key Achievements',
        'achievements' => [
            '10+ years industry experience',
            'Rapid expansion across U.S. and internationally',
            'Fastest-growing HVAC/R supply houses',
            'Long-term client partnerships'
        ],
        'expansion_title' => 'Expansion Plans',
        'expansion_text' => 'Active growth into new geographies and product lines, building a unified global platform including Saudi Arabia.',
        'target_title' => 'Target Market',
        'target_markets' => [
            'HVAC/R Contractors',
            'Commercial & Industrial Clients',
            'International Clients'
        ],
        'contact_title' => 'Contact Information',
        'copyright' => '© 2024 RefCo Supply. All rights reserved.',
        'privacy' => 'Privacy Policy',
        'terms' => 'Terms of Service'
    ],
    'ar' => [
        'title' => 'ريفكو سبلاي - قريباً',
        'description' => 'ريفكو سبلاي - مورد رائد لحلول التدفئة والتهوية وتكييف الهواء والتبريد. نخدم المقاولين وأصحاب المنازل والشركات عالمياً.',
        'launching_soon' => 'قريباً',
        'maintenance_subtitle' => 'نعمل على شيء مذهل',
        'notify_title' => 'كن أول من يعلم',
        'notify_subtitle' => 'احصل على إشعار عند إطلاق موقعنا الجديد',
        'email_placeholder' => 'أدخل عنوان بريدك الإلكتروني',
        'name_placeholder' => 'أدخل اسمك',
        'notify_button' => 'أشعرني',
        'contact_us' => 'اتصل بنا',
        'about_title' => 'حول ريفكو سبلاي',
        'about_text' => 'مورد رائد لحلول التدفئة والتهوية وتكييف الهواء والتبريد، نخدم المقاولين وأصحاب المنازل والشركات لأكثر من 10 سنوات.',
        'mission_title' => 'مهمتنا',
        'mission_text' => 'أن نكون المورد المفضل لمحترفي التدفئة والتهوية وتكييف الهواء وأصحاب المنازل، ونقدم حلولاً موثوقة وفعالة.',
        'locations_title' => 'المواقع العالمية',
        'products_title' => 'المنتجات والخدمات الأساسية',
        'products' => [
            'معدات وقطع التدفئة والتهوية',
            'المبردات والمضافات',
            'الأدوات والمعدات',
            'الأنابيب والتجهيزات',
            'المرشحات والملحقات',
            'الحلول المخصصة'
        ],
        'values_title' => 'القيم الأساسية',
        'values' => [
            'محورية العميل',
            'النزاهة',
            'الجودة',
            'الابتكار',
            'النمو والتوسع'
        ],
        'achievements_title' => 'الإنجازات الرئيسية',
        'achievements' => [
            'أكثر من 10 سنوات خبرة',
            'توسع سريع دولياً',
            'أسرع بيوت التوريد نمواً',
            'شراكات طويلة الأمد'
        ],
        'expansion_title' => 'خطط التوسع',
        'expansion_text' => 'نمو نشط في مناطق جغرافية جديدة وخطوط إنتاج، بناء منصة عالمية موحدة تشمل المملكة العربية السعودية.',
        'target_title' => 'السوق المستهدف',
        'target_markets' => [
            'مقاولو التدفئة والتهوية',
            'العملاء التجاريون والصناعيون',
            'العملاء الدوليون'
        ],
        'contact_title' => 'معلومات الاتصال',
        'copyright' => '© 2024 ريفكو سبلاي. جميع الحقوق محفوظة.',
        'privacy' => 'سياسة الخصوصية',
        'terms' => 'شروط الخدمة'
    ]
];

$t = $content[$lang];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $dir ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['description']) ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://refcosupply.com/">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($t['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['description']) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://refcosupply.com/">
    <meta property="og:image" content="https://refcosupply.com/public/images/logo.png">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($t['title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($t['description']) ?>">
    <meta name="twitter:image" content="https://refcosupply.com/public/images/logo.png">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/public/images/logo.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'refco-blue': '#1e40af',
                        'refco-red': '#dc2626',
                        'refco-gray': '#6b7280',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    
    <!-- Custom Styles -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .hero-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* RTL Support */
        [dir="rtl"] .rtl\:text-right { text-align: right; }
        [dir="rtl"] .rtl\:text-left { text-align: left; }
        [dir="rtl"] .rtl\:mr-4 { margin-right: 1rem; }
        [dir="rtl"] .rtl\:ml-4 { margin-left: 1rem; }
        [dir="rtl"] .rtl\:pr-4 { padding-right: 1rem; }
        [dir="rtl"] .rtl\:pl-4 { padding-left: 1rem; }
    </style>
    
    <!-- JSON-LD Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "RefCo Supply",
        "url": "https://refcosupply.com",
        "logo": "https://refcosupply.com/public/images/logo.png",
        "description": "Leading provider of HVAC/R solutions, serving contractors, homeowners, and businesses globally",
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
            }
        ],
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+1-865-249-7593",
                "contactType": "customer service",
                "areaServed": "US"
            },
            {
                "@type": "ContactPoint",
                "telephone": "+1-813-374-1011",
                "contactType": "customer service",
                "areaServed": "US"
            }
        ]
    }
    </script>
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2" aria-live="polite"></div>
    
    <!-- Navbar + Hero Section -->
    <header class="hero-bg min-h-screen relative overflow-hidden">
        <!-- Navigation -->
        <nav class="relative z-10 px-4 sm:px-6 lg:px-8 py-4">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img src="/public/images/logo.png" alt="RefCo Supply Logo" class="h-12 w-auto" loading="eager">
                </div>
                
                <!-- Navigation Items -->
                <div class="flex items-center space-x-4">
                    <!-- Contact Info -->
                    <a href="mailto:info@refcosupply.com" 
                       class="hidden sm:inline-flex items-center text-white/90 hover:text-white transition-colors duration-200"
                       aria-label="Email us at info@refcosupply.com">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        info@refcosupply.com
                    </a>
                    
                    <!-- Language Toggle -->
                    <div class="flex items-center space-x-2 text-sm">
                        <a href="?lang=en" 
                           class="px-2 py-1 rounded <?= $lang === 'en' ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white' ?> transition-colors duration-200"
                           aria-label="Switch to English">
                            EN
                        </a>
                        <span class="text-white/50">|</span>
                        <a href="?lang=ar" 
                           class="px-2 py-1 rounded <?= $lang === 'ar' ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white' ?> transition-colors duration-200"
                           aria-label="Switch to Arabic">
                            عربية
                        </a>
                    </div>
                    
                    <!-- Dark/Light Toggle -->
                    <button id="theme-toggle" 
                            class="p-2 rounded-lg glass-effect text-white hover:bg-white/20 transition-colors duration-200"
                            aria-label="Toggle dark mode">
                        <svg id="sun-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                        </svg>
                        <svg id="moon-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>
                    
                    <!-- Contact Us Button -->
                    <a href="#contact" 
                       class="bg-white text-refco-blue px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white/50">
                        <?= htmlspecialchars($t['contact_us']) ?>
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- Hero Content -->
        <div class="relative z-10 px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    <?= htmlspecialchars($t['launching_soon']) ?>
                </h1>
                <p class="text-xl sm:text-2xl text-white/90 mb-12 max-w-2xl mx-auto">
                    <?= htmlspecialchars($t['maintenance_subtitle']) ?>
                </p>
                
                <!-- Notify Form -->
                <div class="max-w-md mx-auto">
                    <div class="glass-effect rounded-2xl p-6 sm:p-8">
                        <h2 class="text-2xl font-semibold text-white mb-2">
                            <?= htmlspecialchars($t['notify_title']) ?>
                        </h2>
                        <p class="text-white/80 mb-6">
                            <?= htmlspecialchars($t['notify_subtitle']) ?>
                        </p>
                        
                        <form id="notify-form" class="space-y-4">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            
                            <div>
                                <label for="name" class="sr-only"><?= htmlspecialchars($t['name_placeholder']) ?></label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       required
                                       placeholder="<?= htmlspecialchars($t['name_placeholder']) ?>"
                                       class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="email" class="sr-only"><?= htmlspecialchars($t['email_placeholder']) ?></label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       required
                                       placeholder="<?= htmlspecialchars($t['email_placeholder']) ?>"
                                       class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent">
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-white text-refco-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-white/50 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span class="submit-text"><?= htmlspecialchars($t['notify_button']) ?></span>
                                <span class="loading-text hidden">Loading...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-float" style="animation-delay: 1s;"></div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="bg-white dark:bg-gray-900 transition-colors duration-300">
        <!-- About Section -->
        <section class="py-16 lg:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="animate-element">
                        <h2 class="text-3xl lg:text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                            <?= htmlspecialchars($t['about_title']) ?>
                        </h2>
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                            <?= htmlspecialchars($t['about_text']) ?>
                        </p>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6">
                            <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">
                                <?= htmlspecialchars($t['mission_title']) ?>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                <?= htmlspecialchars($t['mission_text']) ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="animate-element">
                        <img src="/public/images/team.jpg" 
                             alt="RefCo Supply Team" 
                             class="rounded-2xl shadow-2xl w-full h-auto"
                             loading="lazy">
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Global Locations -->
        <section class="py-16 lg:py-24 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 animate-element">
                    <h2 class="text-3xl lg:text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                        <?= htmlspecialchars($t['locations_title']) ?>
                    </h2>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg animate-element">
                        <h3 class="text-xl font-semibold mb-4 text-refco-blue">Knoxville, TN (HQ)</h3>
                        <div class="space-y-2 text-gray-600 dark:text-gray-300">
                            <p>2309 Mitchell St</p>
                            <p>Knoxville, TN 37917</p>
                            <p class="font-medium">865-249-7593</p>
                            <p><a href="mailto:Knox@refcosupply.com" class="text-refco-blue hover:underline">Knox@refcosupply.com</a></p>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg animate-element">
                        <h3 class="text-xl font-semibold mb-4 text-refco-blue">Tampa, FL</h3>
                        <div class="space-y-2 text-gray-600 dark:text-gray-300">
                            <p>6015 N 56th St</p>
                            <p>Tampa, FL 33610</p>
                            <p class="font-medium">(813) 374-1011</p>
                            <p><a href="mailto:Tampa@refcosupply.com" class="text-refco-blue hover:underline">Tampa@refcosupply.com</a></p>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg animate-element">
                        <h3 class="text-xl font-semibold mb-4 text-refco-blue">Doha, Qatar</h3>
                        <div class="space-y-2 text-gray-600 dark:text-gray-300">
                            <p>Piazza Level, 0Q05A</p>
                            <p>Qanat Quartier Units 93-99</p>
                            <p>The Pearl, P.O. Box 301588</p>
                            <p>Doha, Qatar</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Products & Services -->
        <section class="py-16 lg:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 animate-element">
                    <h2 class="text-3xl lg:text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                        <?= htmlspecialchars($t['products_title']) ?>
                    </h2>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($t['products'] as $index => $product): ?>
                    <div class="bg-gradient-to-br from-refco-blue to-blue-600 text-white rounded-xl p-6 animate-element">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
                            <span class="text-xl font-bold"><?= $index + 1 ?></span>
                        </div>
                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($product) ?></h3>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        
        <!-- Values & Achievements -->
        <section class="py-16 lg:py-24 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16">
                    <!-- Core Values -->
                    <div class="animate-element">
                        <h2 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">
                            <?= htmlspecialchars($t['values_title']) ?>
                        </h2>
                        <div class="space-y-4">
                            <?php foreach ($t['values'] as $value): ?>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-refco-red rounded-full mr-4 flex-shrink-0"></div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium"><?= htmlspecialchars($value) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Key Achievements -->
                    <div class="animate-element">
                        <h2 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">
                            <?= htmlspecialchars($t['achievements_title']) ?>
                        </h2>
                        <div class="space-y-4">
                            <?php foreach ($t['achievements'] as $achievement): ?>
                            <div class="flex items-start">
                                <div class="w-3 h-3 bg-refco-blue rounded-full mr-4 mt-2 flex-shrink-0"></div>
                                <span class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($achievement) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Expansion & Target Market -->
        <section class="py-16 lg:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16">
                    <!-- Expansion Plans -->
                    <div class="animate-element">
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">
                            <?= htmlspecialchars($t['expansion_title']) ?>
                        </h2>
                        <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                            <?= htmlspecialchars($t['expansion_text']) ?>
                        </p>
                    </div>
                    
                    <!-- Target Market -->
                    <div class="animate-element">
                        <h2 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">
                            <?= htmlspecialchars($t['target_title']) ?>
                        </h2>
                        <div class="space-y-6">
                            <?php foreach ($t['target_markets'] as $market): ?>
                            <div class="bg-white dark:bg-gray-900 rounded-lg p-4 shadow-sm border border-gray-200 dark:border-gray-700">
                                <span class="text-gray-900 dark:text-white font-medium"><?= htmlspecialchars($market) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <img src="/public/images/logo.png" alt="RefCo Supply Logo" class="h-12 w-auto mb-6">
                    <p class="text-gray-300 mb-6 max-w-md">
                        Leading provider of HVAC/R solutions, serving contractors, homeowners, and businesses globally with quality products and exceptional service.
                    </p>
                    <div class="flex space-x-4">
                        <a href="mailto:info@refcosupply.com" class="text-gray-300 hover:text-white transition-colors duration-200">
                            <span class="sr-only">Email</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4"><?= htmlspecialchars($t['contact_title']) ?></h3>
                    <div class="space-y-3 text-sm text-gray-300">
                        <div>
                            <p class="font-medium text-white">Knoxville, TN</p>
                            <p>865-249-7593</p>
                        </div>
                        <div>
                            <p class="font-medium text-white">Tampa, FL</p>
                            <p>(813) 374-1011</p>
                        </div>
                        <div>
                            <p class="font-medium text-white">Doha, Qatar</p>
                            <p>International Office</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <div class="space-y-2 text-sm">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 block">
                            <?= htmlspecialchars($t['privacy']) ?>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 block">
                            <?= htmlspecialchars($t['terms']) ?>
                        </a>
                        <a href="mailto:info@refcosupply.com" class="text-gray-300 hover:text-white transition-colors duration-200 block">
                            <?= htmlspecialchars($t['contact_us']) ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p><?= htmlspecialchars($t['copyright']) ?></p>
                <p class="mt-2">RefCoSupply.com</p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script>
        // Theme Management
        const themeToggle = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');
        const html = document.documentElement;
        
        // Initialize theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            html.classList.add('dark');
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        }
        
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            
            sunIcon.classList.toggle('hidden', !isDark);
            moonIcon.classList.toggle('hidden', isDark);
            
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
        
        // Toast Notification System
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            
            toast.className = `${bgColor} text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 max-w-sm`;
            toast.innerHTML = `
                <div class="flex items-center justify-between">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white/80 hover:text-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }, 5000);
        }
        
        // Form Submission
        document.getElementById('notify-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const submitText = submitBtn.querySelector('.submit-text');
            const loadingText = submitBtn.querySelector('.loading-text');
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            
            try {
                const formData = new FormData(form);
                const data = {
                    email: formData.get('email'),
                    name: formData.get('name'),
                    csrf_token: formData.get('csrf_token')
                };
                
                const response = await fetch('notify.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    showToast('Thank you! You\'ll be notified when we launch.', 'success');
                    form.reset();
                } else {
                    throw new Error(result.message || 'Something went wrong');
                }
                
            } catch (error) {
                console.error('Error:', error);
                let message = 'Something went wrong. Please try again.';
                
                if (error.message.includes('429')) {
                    message = 'Too many requests. Please try again later.';
                } else if (error.message.includes('validation')) {
                    message = 'Please check your input and try again.';
                }
                
                showToast(message, 'error');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            }
        });
        
        // GSAP Animations (with reduced motion support)
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        
        if (!prefersReducedMotion) {
            // Initialize GSAP
            gsap.registerPlugin();
            
            // Animate elements on scroll
            const animateElements = document.querySelectorAll('.animate-element');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        gsap.fromTo(entry.target, 
                            { y: 50, opacity: 0 },
                            { y: 0, opacity: 1, duration: 0.8, ease: "power2.out" }
                        );
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            animateElements.forEach(el => observer.observe(el));
            
            // Hero animations
            gsap.fromTo('.hero-bg h1', 
                { y: 30, opacity: 0 },
                { y: 0, opacity: 1, duration: 1, ease: "power2.out", delay: 0.2 }
            );
            
            gsap.fromTo('.hero-bg p', 
                { y: 30, opacity: 0 },
                { y: 0, opacity: 1, duration: 1, ease: "power2.out", delay: 0.4 }
            );
            
            gsap.fromTo('.glass-effect', 
                { y: 30, opacity: 0 },
                { y: 0, opacity: 1, duration: 1, ease: "power2.out", delay: 0.6 }
            );
        }
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.remove('opacity-0');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                img.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                imageObserver.observe(img);
            });
        }
    </script>
</body>
</html>