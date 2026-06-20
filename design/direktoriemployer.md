<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Cari Perusahaan - Lumina Talent</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "bg-lavender": "#faf8ff",
                        "on-primary-fixed-variant": "#2f2ebe",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#e9ddff",
                        "on-tertiary": "#ffffff",
                        "surface-container": "#eaeef2",
                        "secondary": "#505f76",
                        "surface-container-highest": "#dfe3e7",
                        "error-container": "#ffdad6",
                        "primary-container": "#6063ee",
                        "outline": "#767586",
                        "background": "#f6fafe",
                        "secondary-fixed": "#d3e4fe",
                        "error": "#ba1a1a",
                        "surface": "#f6fafe",
                        "on-primary-container": "#fffbff",
                        "primary-fixed": "#e1e0ff",
                        "secondary-fixed-dim": "#b7c8e1",
                        "on-error": "#ffffff",
                        "inverse-on-surface": "#edf1f5",
                        "surface-variant": "#dfe3e7",
                        "primary-fixed-dim": "#c0c1ff",
                        "inverse-surface": "#2c3134",
                        "tertiary-fixed-dim": "#d0bcff",
                        "surface-glass": "rgba(255, 255, 255, 0.7)",
                        "outline-variant": "#c7c4d7",
                        "on-secondary-container": "#54647a",
                        "on-surface-variant": "#464554",
                        "surface-dim": "#d6dade",
                        "on-tertiary-container": "#fffbff",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed-variant": "#38485d",
                        "surface-bright": "#f6fafe",
                        "on-tertiary-fixed": "#23005c",
                        "surface-tint": "#494bd6",
                        "secondary-container": "#d0e1fb",
                        "on-secondary": "#ffffff",
                        "surface-container-low": "#f0f4f8",
                        "on-secondary-fixed": "#0b1c30",
                        "on-primary": "#ffffff",
                        "inverse-primary": "#c0c1ff",
                        "tertiary": "#6b38d4",
                        "on-tertiary-fixed-variant": "#5516be",
                        "success-emerald": "#10b981",
                        "on-surface": "#171c1f",
                        "on-primary-fixed": "#07006c",
                        "surface-container-high": "#e4e9ed",
                        "primary": "#4648d4",
                        "tertiary-container": "#8455ef",
                        "primary-gradient": "linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)",
                        "on-background": "#171c1f"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "stack-sm": "8px",
                        "stack-lg": "32px",
                        "section-gap": "80px",
                        "margin-mobile": "16px",
                        "container-max": "1280px",
                        "stack-md": "16px"
                    },
                    "fontFamily": {
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "label-sm": ["12px", { "lineHeight": "1.2", "fontWeight": "500" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "1.5", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "1.3", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
<style>
        body { background-color: theme('colors.bg-lavender'); color: theme('colors.on-background'); font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-panel { background: theme('colors.surface-glass'); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.4); }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 10px 20px -10px rgba(99, 102, 241, 0.04); transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease; }
        .glass-card:hover { transform: translateY(-4px); box-shadow: 0 15px 30px -10px rgba(99, 102, 241, 0.1); border-color: theme('colors.primary-fixed-dim'); }
        .btn-primary { background: theme('colors.primary-gradient'); color: theme('colors.on-primary'); position: relative; overflow: hidden; }
        .btn-primary::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(to right, rgba(255,255,255,0), rgba(255,255,255,0.4), rgba(255,255,255,0)); }
        .btn-outline { border: 1px solid theme('colors.outline-variant'); color: theme('colors.primary'); transition: all 0.2s; }
        .btn-outline:hover { background: theme('colors.primary-fixed'); border-color: theme('colors.primary'); }
        .filter-select { background: theme('colors.surface-container-lowest'); border: 1px solid theme('colors.outline-variant'); transition: all 0.2s; }
        .filter-select:focus { border-color: theme('colors.primary'); box-shadow: 0 0 0 2px theme('colors.primary-fixed'); outline: none; }
        
        /* Shared Nav Hover Effects */
        .nav-link { position: relative; transition: color 0.2s ease; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: theme('colors.primary'); transition: width 0.2s ease; }
        .nav-link:hover::after { width: 100%; }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">
<!-- TopNavBar -->
<nav class="bg-surface-glass dark:bg-inverse-surface/80 text-primary dark:text-primary-fixed-dim font-body-md text-body-md docked full-width top-0 sticky backdrop-blur-xl border-b border-white/20 shadow-sm z-50">
<div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-20">
<div class="font-headline-md text-headline-md font-extrabold text-primary dark:text-primary-fixed flex items-center gap-2">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">work</span>
                HireFlow
            </div>
<!-- Desktop Nav -->
<div class="hidden md:flex items-center gap-8">
<a class="nav-link text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors" href="#">Find Jobs</a>
<a class="nav-link text-primary dark:text-primary-fixed font-bold border-b-2 border-primary pb-1" href="#">Companies</a>
<a class="nav-link text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors" href="#">Salaries</a>
<a class="nav-link text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors" href="#">Resources</a>
</div>
<div class="hidden md:flex items-center gap-4">
<button class="font-label-md text-label-md text-secondary hover:text-primary transition-colors px-4 py-2 scale-95 active:scale-100 transition-transform">Sign In</button>
<button class="btn-primary font-label-md text-label-md px-5 py-2.5 rounded-full scale-95 active:scale-100 transition-transform shadow-sm hover:shadow-md">Post a Job</button>
</div>
<!-- Mobile Menu Toggle -->
<button class="md:hidden p-2 text-primary">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</nav>
<main class="flex-grow pb-section-gap">
<!-- Hero Search Section -->
<section class="pt-section-gap pb-12 px-margin-mobile md:px-gutter max-w-container-max mx-auto relative z-10">
<div class="text-center mb-10">
<h1 class="font-display-lg text-display-lg text-on-surface mb-4">Temukan Perusahaan Impian</h1>
<p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto">Eksplorasi perusahaan teknologi terkemuka, startup inovatif, dan korporasi global yang sesuai dengan nilai dan aspirasi karir Anda.</p>
</div>
<!-- Glassmorphic Search & Filter Bar -->
<div class="glass-panel rounded-[24px] p-2 md:p-4 shadow-sm mx-auto max-w-4xl">
<div class="flex flex-col md:flex-row gap-3">
<div class="flex-grow relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-secondary">search</span>
<input class="w-full pl-12 pr-4 py-3 rounded-xl filter-select font-body-md text-body-md bg-white" placeholder="Cari nama perusahaan..." type="text"/>
</div>
<div class="flex flex-row gap-2 overflow-x-auto pb-2 md:pb-0 no-scrollbar">
<select class="filter-select rounded-xl px-4 py-3 font-label-md text-label-md text-on-surface min-w-[140px] flex-shrink-0 appearance-none bg-white">
<option value="">Industri</option>
<option value="tech">Teknologi</option>
<option value="finance">Keuangan</option>
<option value="health">Kesehatan</option>
</select>
<select class="filter-select rounded-xl px-4 py-3 font-label-md text-label-md text-on-surface min-w-[140px] flex-shrink-0 appearance-none bg-white">
<option value="">Lokasi</option>
<option value="remote">Remote</option>
<option value="jkt">Jakarta</option>
<option value="sf">San Francisco</option>
</select>
<select class="filter-select rounded-xl px-4 py-3 font-label-md text-label-md text-on-surface min-w-[160px] flex-shrink-0 appearance-none bg-white">
<option value="">Ukuran Perusahaan</option>
<option value="small">1-50</option>
<option value="medium">51-200</option>
<option value="large">201+</option>
</select>
<button class="btn-primary rounded-xl px-6 py-3 font-label-md text-label-md flex items-center justify-center gap-2 flex-shrink-0 whitespace-nowrap shadow-sm">
                            Cari
                        </button>
</div>
</div>
</div>
</section>
<!-- Company Grid Section -->
<section class="px-margin-mobile md:px-gutter max-w-container-max mx-auto">
<div class="flex justify-between items-center mb-8">
<h2 class="font-headline-md text-headline-md text-on-surface">Perusahaan Populer</h2>
<div class="font-label-md text-label-md text-secondary hidden md:block">Menampilkan 4 dari 150+ perusahaan</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
<!-- Card 1 -->
<article class="glass-card rounded-[24px] p-6 flex flex-col h-full">
<div class="flex justify-between items-start mb-4">
<div class="flex gap-4 items-center">
<div class="w-16 h-16 rounded-xl bg-white border border-outline-variant flex items-center justify-center overflow-hidden flex-shrink-0 shadow-sm">
<img class="w-full h-full object-cover" data-alt="A modern, abstract geometric logo for a tech company named TechNova. The logo features sharp angles and a vibrant indigo to cyan gradient. High-quality corporate branding, clean white background, professional aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmOcbBOS6Z-59_LuKJbcW0AcpItwOFDWzqPf-AO4PK0SxgXkUIQr4a2X-F2gRqVhWlE8oPfsKD0B64ML2dEDZrvcZ9-RgaQj2Z_ecMx49o8Z8RNOV8SCf7-p6GJG0REwN8M8db1ZhO9cuTZp_1trnvC5c0shf2YfdserbvQKYFwIC0iihhqXKZPFItYqZ15A3tUG6vrjBfHMK3g3P3WVPTexuheq1O_jPUz2GrXo4n7PK1TUVJ2AquIbGNPwAQvCZ2j36xe16ttynK"/>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-1">TechNova Solutions</h3>
<div class="flex items-center gap-2 font-label-md text-label-md text-secondary">
<span class="material-symbols-outlined text-[16px]">domain</span> SaaS &amp; Fintech
                                </div>
</div>
</div>
<button class="btn-outline rounded-full px-4 py-1.5 font-label-sm text-label-sm">Follow</button>
</div>
<div class="flex flex-wrap gap-2 mb-6 mt-2">
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">location_on</span> San Francisco / Remote
                        </span>
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">groups</span> 150+ Employees
                        </span>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/30 flex items-center justify-between">
<div class="font-label-md text-label-md text-success-emerald flex items-center gap-1">
<span class="w-2 h-2 rounded-full bg-success-emerald animate-pulse"></span> 12 Lowongan
                        </div>
<a class="font-label-md text-label-md text-primary hover:text-tertiary transition-colors flex items-center gap-1" href="#">
                            Kunjungi Profil <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</a>
</div>
</article>
<!-- Card 2 -->
<article class="glass-card rounded-[24px] p-6 flex flex-col h-full">
<div class="flex justify-between items-start mb-4">
<div class="flex gap-4 items-center">
<div class="w-16 h-16 rounded-xl bg-white border border-outline-variant flex items-center justify-center overflow-hidden flex-shrink-0 shadow-sm">
<img class="w-full h-full object-cover" data-alt="A futuristic, sleek logo for an AI and Robotics company called Lumina Labs. The logo should incorporate a stylized robotic eye or glowing neural network pattern in deep purple and silver tones. Clean corporate branding." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsO6I_a2jHI41QVW0kO0PdbwOg_vKNgOYXzpRJ3TULusMwZCNWU1jydERAmbAPZhluP-gYIV_atMtfhbgFoOP5XhH-pSgCvPrV_wS84xvHoFIAtdZJkGcvxrgi73RLawmJDSXAl23r-11oaX6BJBdzM3ohSgtjdzi4A4rLT_t-exhlxIvWjarffF0dR5yJBs2s2j9MjN-RXsZnUwj-HV0NkzmUqOCeUzFPt2J0otZ_0K-nuTiqgSMn0PaQnDF7yHVgip4VY6CVtBus"/>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-1">Lumina Labs</h3>
<div class="flex items-center gap-2 font-label-md text-label-md text-secondary">
<span class="material-symbols-outlined text-[16px]">smart_toy</span> AI &amp; Robotics
                                </div>
</div>
</div>
<button class="btn-outline rounded-full px-4 py-1.5 font-label-sm text-label-sm">Follow</button>
</div>
<div class="flex flex-wrap gap-2 mb-6 mt-2">
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">location_on</span> Jakarta, Indonesia
                        </span>
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">groups</span> 200+ Employees
                        </span>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/30 flex items-center justify-between">
<div class="font-label-md text-label-md text-success-emerald flex items-center gap-1">
<span class="w-2 h-2 rounded-full bg-success-emerald animate-pulse"></span> 8 Lowongan
                        </div>
<a class="font-label-md text-label-md text-primary hover:text-tertiary transition-colors flex items-center gap-1" href="#">
                            Kunjungi Profil <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</a>
</div>
</article>
<!-- Card 3 -->
<article class="glass-card rounded-[24px] p-6 flex flex-col h-full">
<div class="flex justify-between items-start mb-4">
<div class="flex gap-4 items-center">
<div class="w-16 h-16 rounded-xl bg-white border border-outline-variant flex items-center justify-center overflow-hidden flex-shrink-0 shadow-sm p-1">
<img class="w-full h-full object-contain" data-alt="A minimalist, highly creative logo for a design agency named Creative Digital Agency. Features overlapping translucent color shapes in vibrant neon hues against a white background. Modern, trendy aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCGg7XVUWeafTI9g_jFqyxzNDEmJHVq8cksoi6dub1p2e7npIglEamAhL2cO945SvvId0w4Lf_NrXdxyuc85h_b2Hq1gsMbrAVhh7keurZw6E9aguFSuLBXkj2h60lcx9n77bFXf0B_p5NOFJXEilmYz1S_lCRXJQEiMXuTuPokjMkia-SJ6emgn_xZev9hXTog73BeI5iQ2WyHb-FJm6OeIBJZ9mQn6PnudXeEnOk9PM5xPiXH34KOcIByHPgoTYWmFFqOHBiffGa"/>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-1">Creative Digital Agency</h3>
<div class="flex items-center gap-2 font-label-md text-label-md text-secondary">
<span class="material-symbols-outlined text-[16px]">palette</span> Design
                                </div>
</div>
</div>
<button class="btn-outline rounded-full px-4 py-1.5 font-label-sm text-label-sm">Follow</button>
</div>
<div class="flex flex-wrap gap-2 mb-6 mt-2">
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">location_on</span> New York
                        </span>
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">groups</span> 50-100 Employees
                        </span>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/30 flex items-center justify-between">
<div class="font-label-md text-label-md text-success-emerald flex items-center gap-1">
<span class="w-2 h-2 rounded-full bg-success-emerald animate-pulse"></span> 5 Lowongan
                        </div>
<a class="font-label-md text-label-md text-primary hover:text-tertiary transition-colors flex items-center gap-1" href="#">
                            Kunjungi Profil <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</a>
</div>
</article>
<!-- Card 4 -->
<article class="glass-card rounded-[24px] p-6 flex flex-col h-full">
<div class="flex justify-between items-start mb-4">
<div class="flex gap-4 items-center">
<div class="w-16 h-16 rounded-xl bg-white border border-outline-variant flex items-center justify-center overflow-hidden flex-shrink-0 shadow-sm p-1">
<img class="w-full h-full object-contain" data-alt="A clean, trustworthy logo for Global Health Systems. The logo incorporates a stylized medical cross blending into a globe icon. Colors are calming medical blues and greens. Professional, enterprise healthcare aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYg-QAji37bNXuopyFBg0djHFCuYoflH09etmKhrqBTJEBPSuFoOL-fDGOoYpcL7-e8b7WRG99LqWcmA7xh-7ETgd9OJvU729FIC5a4ZBYtQDTcncLzx38tZ75aAdPvxHLpPIA4wrvaqPVxyLl8avMAJNVQv8MJyGK37nXwzSEav3ShLYYh9RqC8mySIjrjwcSfEQX4jkak9CDdtzGGBdy_qSmxE9KEmuBj_87dGwjBHp29xOjkSTy9qDSexUUAcIhweJ0Bu2hCTWI"/>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-1">Global Health Systems</h3>
<div class="flex items-center gap-2 font-label-md text-label-md text-secondary">
<span class="material-symbols-outlined text-[16px]">monitor_heart</span> Healthcare
                                </div>
</div>
</div>
<button class="btn-outline rounded-full px-4 py-1.5 font-label-sm text-label-sm">Follow</button>
</div>
<div class="flex flex-wrap gap-2 mb-6 mt-2">
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">location_on</span> London
                        </span>
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px]">groups</span> 1000+ Employees
                        </span>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/30 flex items-center justify-between">
<div class="font-label-md text-label-md text-success-emerald flex items-center gap-1">
<span class="w-2 h-2 rounded-full bg-success-emerald animate-pulse"></span> 24 Lowongan
                        </div>
<a class="font-label-md text-label-md text-primary hover:text-tertiary transition-colors flex items-center gap-1" href="#">
                            Kunjungi Profil <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</a>
</div>
</article>
</div>
<div class="mt-12 flex justify-center">
<button class="btn-outline px-6 py-3 rounded-full font-label-md text-label-md bg-white">Muat Lebih Banyak Perusahaan</button>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-surface-container-low dark:bg-surface-dim text-primary dark:text-primary-fixed-dim font-label-md text-label-md full-width border-t border-outline-variant flat mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center py-stack-lg px-gutter max-w-container-max mx-auto gap-4">
<div class="font-headline-md text-headline-md font-bold text-on-surface dark:text-surface-bright flex items-center gap-2">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">work</span>
                HireFlow
            </div>
<div class="flex flex-wrap justify-center gap-6">
<a class="text-on-surface-variant hover:text-primary underline-offset-4 hover:underline opacity-80 hover:opacity-100 transition-opacity" href="#">About Us</a>
<a class="text-on-surface-variant hover:text-primary underline-offset-4 hover:underline opacity-80 hover:opacity-100 transition-opacity" href="#">Careers</a>
<a class="text-on-surface-variant hover:text-primary underline-offset-4 hover:underline opacity-80 hover:opacity-100 transition-opacity" href="#">Privacy Policy</a>
<a class="text-on-surface-variant hover:text-primary underline-offset-4 hover:underline opacity-80 hover:opacity-100 transition-opacity" href="#">Terms of Service</a>
<a class="text-on-surface-variant hover:text-primary underline-offset-4 hover:underline opacity-80 hover:opacity-100 transition-opacity" href="#">Contact</a>
</div>
<div class="text-on-surface-variant opacity-80 text-sm">
                © 2024 HireFlow. All rights reserved.
            </div>
</div>
</footer>
</body></html>