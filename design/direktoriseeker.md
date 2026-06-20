<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Temukan Talenta Terbaik - Lumina Talent</title>
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-fixed": "#07006c",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#5516be",
                        "on-tertiary-fixed": "#23005c",
                        "primary-fixed-dim": "#c0c1ff",
                        "outline-variant": "#c7c4d7",
                        "on-background": "#171c1f",
                        "tertiary-container": "#8455ef",
                        "on-surface": "#171c1f",
                        "tertiary-fixed": "#e9ddff",
                        "surface-container-low": "#f0f4f8",
                        "bg-lavender": "#faf8ff",
                        "inverse-primary": "#c0c1ff",
                        "primary-fixed": "#e1e0ff",
                        "on-tertiary-container": "#fffbff",
                        "surface-container-highest": "#dfe3e7",
                        "surface-container-lowest": "#ffffff",
                        "primary-container": "#6063ee",
                        "tertiary": "#6b38d4",
                        "secondary-fixed-dim": "#b7c8e1",
                        "surface-bright": "#f6fafe",
                        "surface-variant": "#dfe3e7",
                        "surface": "#f6fafe",
                        "error": "#ba1a1a",
                        "on-surface-variant": "#464554",
                        "on-secondary-container": "#54647a",
                        "on-primary-container": "#fffbff",
                        "secondary-container": "#d0e1fb",
                        "on-tertiary": "#ffffff",
                        "secondary-fixed": "#d3e4fe",
                        "background": "#f6fafe",
                        "surface-dim": "#d6dade",
                        "on-error-container": "#93000a",
                        "primary": "#4648d4",
                        "inverse-on-surface": "#edf1f5",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed-variant": "#2f2ebe",
                        "surface-tint": "#494bd6",
                        "surface-container": "#eaeef2",
                        "success-emerald": "#10b981",
                        "tertiary-fixed-dim": "#d0bcff",
                        "primary-gradient": "linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)",
                        "inverse-surface": "#2c3134",
                        "surface-container-high": "#e4e9ed",
                        "secondary": "#505f76",
                        "on-secondary-fixed-variant": "#38485d",
                        "surface-glass": "rgba(255, 255, 255, 0.7)",
                        "outline": "#767586",
                        "on-secondary-fixed": "#0b1c30"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "section-gap": "80px",
                        "margin-mobile": "16px",
                        "container-max": "1280px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "gutter": "24px",
                        "stack-sm": "8px"
                    },
                    "fontFamily": {
                        "label-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "label-md": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "label-sm": ["12px", {"lineHeight": "1.2", "fontWeight": "500"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700"}]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-fill {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        /* Custom Shadow for Premium Glassmorphism Feel */
        .shadow-premium {
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.04);
        }
        
        /* Inner Glow for Buttons */
        .btn-glow {
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }
    </style>
</head>
<body class="bg-bg-lavender text-on-surface font-body-md min-h-screen flex selection:bg-primary-fixed selection:text-on-primary-fixed">
<!-- Shared Component: SideNavBar -->
<aside class="h-screen w-64 fixed left-0 top-0 border-r border-outline-variant bg-surface-container-lowest flex flex-col py-stack-lg z-40 hidden md:flex">
<!-- Header -->
<div class="px-gutter mb-stack-lg">
<div class="flex items-center gap-stack-sm mb-stack-sm">
<div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center text-on-primary-container">
<span class="material-symbols-outlined material-symbols-fill">work</span>
</div>
<div>
<h1 class="font-headline-md text-headline-md text-primary">Elite Recruitment</h1>
<p class="font-label-sm text-label-sm text-secondary">Enterprise Plan</p>
</div>
</div>
</div>
<!-- Navigation Links -->
<nav class="flex-1 px-stack-sm space-y-1">
<!-- Active Tab: Talent Pool (Maps to Candidates) -->
<a class="flex items-center gap-stack-sm px-4 py-3 rounded-lg text-primary border-l-4 border-primary bg-primary-fixed/30 font-label-md text-label-md hover:pl-5 transition-all duration-300 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined">group</span>
                Talent Pool
            </a>
<a class="flex items-center gap-stack-sm px-4 py-3 rounded-lg text-secondary hover:bg-surface-container font-label-md text-label-md hover:pl-5 transition-all duration-300 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined">search_check</span>
                Saved Searches
            </a>
<a class="flex items-center gap-stack-sm px-4 py-3 rounded-lg text-secondary hover:bg-surface-container font-label-md text-label-md hover:pl-5 transition-all duration-300 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined">chat_bubble</span>
                Message Center
            </a>
<a class="flex items-center gap-stack-sm px-4 py-3 rounded-lg text-secondary hover:bg-surface-container font-label-md text-label-md hover:pl-5 transition-all duration-300 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined">calendar_today</span>
                Interview Schedule
            </a>
<a class="flex items-center gap-stack-sm px-4 py-3 rounded-lg text-secondary hover:bg-surface-container font-label-md text-label-md hover:pl-5 transition-all duration-300 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined">badge</span>
                Recruitment Team
            </a>
</nav>
<!-- CTA -->
<div class="px-gutter mt-auto mb-stack-md">
<button class="w-full py-3 px-4 rounded-xl font-label-md text-label-md text-on-primary btn-glow transition-transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
<span class="material-symbols-outlined">add</span>
                Post New Job
            </button>
</div>
<!-- Footer Links -->
<div class="px-stack-sm space-y-1">
<a class="flex items-center gap-stack-sm px-4 py-2 rounded-lg text-secondary hover:bg-surface-container font-label-sm text-label-sm transition-colors cursor-pointer" href="#">
<span class="material-symbols-outlined text-[18px]">help</span>
                Help Center
            </a>
<a class="flex items-center gap-stack-sm px-4 py-2 rounded-lg text-secondary hover:bg-surface-container font-label-sm text-label-sm transition-colors cursor-pointer" href="#">
<span class="material-symbols-outlined text-[18px]">logout</span>
                Logout
            </a>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 md:ml-64 w-full min-h-screen pb-section-gap">
<!-- Top App Bar / Mobile Nav (Simplified for focus) -->
<header class="md:hidden sticky top-0 z-30 bg-surface-glass backdrop-blur-md border-b border-outline-variant px-margin-mobile h-16 flex items-center justify-between">
<h1 class="font-headline-md text-headline-md text-primary font-bold">Elite Recruitment</h1>
<button class="text-on-surface-variant">
<span class="material-symbols-outlined">menu</span>
</button>
</header>
<div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter pt-stack-lg md:pt-section-gap">
<!-- Page Header -->
<div class="mb-stack-lg flex flex-col md:flex-row md:items-end justify-between gap-stack-md">
<div>
<h2 class="font-display-lg text-headline-lg-mobile md:text-display-lg text-on-background mb-2 tracking-tight">Temukan Talenta Terbaik</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">Jelajahi kandidat unggulan yang siap bergabung dengan tim Anda.</p>
</div>
</div>
<!-- Filter Bar (Glassmorphic) -->
<div class="bg-surface-glass backdrop-blur-xl border border-white/40 shadow-premium rounded-xl p-4 mb-stack-lg flex flex-col md:flex-row gap-4 relative z-20">
<!-- Search Input -->
<div class="flex-1 relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-secondary">search</span>
<input class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg focus:border-primary focus:ring-2 focus:ring-primary-fixed/50 font-body-md text-body-md text-on-surface placeholder:text-secondary transition-all outline-none" placeholder="Cari posisi, nama, atau keahlian..." type="text"/>
</div>
<!-- Dropdowns -->
<div class="flex flex-col sm:flex-row gap-4 md:w-auto">
<select class="py-3 px-4 bg-surface-container-lowest border border-outline-variant rounded-lg focus:border-primary font-body-md text-body-md text-on-surface outline-none appearance-none cursor-pointer min-w-[140px]">
<option value="">Semua Keahlian</option>
<option value="uiux">UI/UX Design</option>
<option value="frontend">Frontend Dev</option>
<option value="backend">Backend Dev</option>
</select>
<select class="py-3 px-4 bg-surface-container-lowest border border-outline-variant rounded-lg focus:border-primary font-body-md text-body-md text-on-surface outline-none appearance-none cursor-pointer min-w-[140px]">
<option value="">Semua Lokasi</option>
<option value="remote">Remote</option>
<option value="jkt">Jakarta</option>
<option value="sf">San Francisco</option>
</select>
<select class="py-3 px-4 bg-surface-container-lowest border border-outline-variant rounded-lg focus:border-primary font-body-md text-body-md text-on-surface outline-none appearance-none cursor-pointer min-w-[140px]">
<option value="">Status</option>
<option value="open">Open to Work</option>
<option value="passive">Passive</option>
</select>
</div>
</div>
<!-- Candidate Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
<!-- Card 1 -->
<div class="bg-surface-container-lowest rounded-xl p-6 shadow-premium border border-transparent hover:border-primary-fixed hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full cursor-pointer relative overflow-hidden">
<!-- Subtle top highlight -->
<div class="absolute top-0 left-0 w-full h-1 bg-primary-fixed-dim opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="flex items-start gap-4 mb-4">
<div class="relative">
<img class="w-16 h-16 rounded-full object-cover border-2 border-surface-container-lowest shadow-sm" data-alt="A professional headshot of a confident young Asian man with short dark hair, wearing a stylish minimalist navy blazer over a white t-shirt. He is smiling warmly. The background is a bright, softly blurred modern office interior with natural sunlight. High-quality corporate portrait photography, bright light-mode aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjN_znNf2ZMWLw4M8yy5mIXGHSfM2SI4KvK5qkIX5mmElx3sjQ9r6zQ5wyS_lM-qVUZN0MBjfSmoFLnsK07-rTqQ1CeQfIF_ir9P903Tsf6adS0T4TuycxNXVunorFOfpeFHFoh5TfiriVPrIOKFwRT9Vydy0fYBTqRy_544WzwJt1URFm6asPzvYhA0CRa7nx_vZlPdBzqc9pGw6Ugmi32TM8FdzyAJNxaL0FcaaYH4CYGyICtIWUj5dJFBZmP9XmtWUeM5ctvtvy"/>
<div class="absolute bottom-0 right-0 w-4 h-4 bg-success-emerald rounded-full border-2 border-surface-container-lowest" title="Open to Work"></div>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">Alex Mercer</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Senior Product Designer</p>
</div>
</div>
<div class="flex items-center gap-4 mb-stack-md text-secondary font-label-sm text-label-sm">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">location_on</span>
<span>San Francisco</span>
</div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">work_history</span>
<span>8 Tahun</span>
</div>
</div>
<div class="flex flex-wrap gap-2 mb-stack-lg">
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">UI/UX</span>
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">Figma</span>
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">Design Systems</span>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/30 flex justify-between items-center">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-success-emerald/10 text-success-emerald font-label-sm text-label-sm font-semibold">
                            Tersedia Segera
                        </span>
<button class="w-8 h-8 rounded-full flex items-center justify-center text-secondary hover:text-primary hover:bg-primary-fixed/30 transition-colors">
<span class="material-symbols-outlined">bookmark_border</span>
</button>
</div>
</div>
<!-- Card 2 -->
<div class="bg-surface-container-lowest rounded-xl p-6 shadow-premium border border-transparent hover:border-primary-fixed hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full cursor-pointer relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-1 bg-primary-fixed-dim opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="flex items-start gap-4 mb-4">
<div class="relative">
<img class="w-16 h-16 rounded-full object-cover border-2 border-surface-container-lowest shadow-sm" data-alt="A professional headshot of an elegant woman with curly brown hair, wearing a sleek pale lavender blouse. She has a relaxed, confident expression. The background is a bright, out-of-focus tech office setting with glass walls. Modern, clean corporate aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBUSPhY22R6-bKzyRNX_gafd0HP0vfSy4tn9CCTDXs_9EowyUPhWh5GK27E_IXHNoXRaJzMOGQTv3B0_KYznzm_d36EriQpFxUdCgkwUa2uQwmUdtw7LBd4NGdBDC-eCyzuStr6YFXmdZ4Wzfk7OKJ3EXtG3QnRQOsYrbMMi7ckiGdEQqOYwfTSlS2UB358rAe5eYXxeVPUfoCw1C9-gjQa_swX-msYDugZPLlkwQA1EWKZy1myPT3hKv-qxjyIbqP-J9vNvQJt0DhS"/>
<div class="absolute bottom-0 right-0 w-4 h-4 bg-success-emerald rounded-full border-2 border-surface-container-lowest" title="Open to Work"></div>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">Sarah Jenkins</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Lead Frontend Engineer</p>
</div>
</div>
<div class="flex items-center gap-4 mb-stack-md text-secondary font-label-sm text-label-sm">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">location_on</span>
<span>Remote (EST)</span>
</div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">work_history</span>
<span>6 Tahun</span>
</div>
</div>
<div class="flex flex-wrap gap-2 mb-stack-lg">
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">React</span>
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">TypeScript</span>
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">Tailwind</span>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/30 flex justify-between items-center">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-success-emerald/10 text-success-emerald font-label-sm text-label-sm font-semibold">
                            Tersedia Segera
                        </span>
<button class="w-8 h-8 rounded-full flex items-center justify-center text-secondary hover:text-primary hover:bg-primary-fixed/30 transition-colors">
<span class="material-symbols-outlined">bookmark_border</span>
</button>
</div>
</div>
<!-- Card 3 -->
<div class="bg-surface-container-lowest rounded-xl p-6 shadow-premium border border-transparent hover:border-primary-fixed hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full cursor-pointer relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-1 bg-primary-fixed-dim opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="flex items-start gap-4 mb-4">
<div class="relative">
<img class="w-16 h-16 rounded-full object-cover border-2 border-surface-container-lowest shadow-sm" data-alt="A professional headshot of a mature man with a neat beard, wearing a crisp light blue button-down shirt. He looks approachable and intelligent. The background features subtle indoor plants and bright, soft lighting characteristic of a modern high-end workspace." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmkqACygS5eQpYcc0mqic5PBNNgVLopqGOMAr_Woiusy_cryg_mQ8O5myS_jhXgXFh-U3uV53nn8AC_gh1CHk-ZAKXtVOncsvUF-mjI-1Fu1QZ5_jjsRsw5e2hvVjB0Ty2mSOyazjLywWxa1azBVqtU_2kfbXrJIA76Rt57Acz4Aa4oCXVJK34-jti1QGWdgSeeORQnaTnf6ajzQozyOpuMtVlCKxVBAcKrfdg0xkMZSSSldi3Au3Nm-mkpL9G_xdoBMnRjjRVTEPM"/>
<div class="absolute bottom-0 right-0 w-4 h-4 bg-surface-variant rounded-full border-2 border-surface-container-lowest" title="Passive"></div>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">David Chen</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Engineering Manager</p>
</div>
</div>
<div class="flex items-center gap-4 mb-stack-md text-secondary font-label-sm text-label-sm">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">location_on</span>
<span>Jakarta</span>
</div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">work_history</span>
<span>10+ Tahun</span>
</div>
</div>
<div class="flex flex-wrap gap-2 mb-stack-lg">
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">Leadership</span>
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">Node.js</span>
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm border border-outline-variant/30">AWS</span>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/30 flex justify-between items-center">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-secondary-container text-on-secondary-container font-label-sm text-label-sm font-semibold">
                            Terbuka untuk Peluang
                        </span>
<button class="w-8 h-8 rounded-full flex items-center justify-center text-secondary hover:text-primary hover:bg-primary-fixed/30 transition-colors">
<span class="material-symbols-outlined">bookmark_border</span>
</button>
</div>
</div>
</div>
<!-- Load More -->
<div class="mt-stack-lg flex justify-center">
<button class="px-6 py-2.5 rounded-lg border border-outline-variant text-primary font-label-md text-label-md hover:bg-primary-fixed/20 transition-colors">
                    Muat Lebih Banyak
                </button>
</div>
</div>
</main>
</body></html>