<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TalentFlow - Find Your Dream Job Faster</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary": "#006c49",
                        "inverse-on-surface": "#eef0ff",
                        "violet-accent": "#8b5cf6",
                        "surface-container-high": "#e2e7ff",
                        "on-surface-variant": "#464554",
                        "surface-container": "#eaedff",
                        "surface": "#faf8ff",
                        "surface-container-low": "#f2f3ff",
                        "on-background": "#131b2e",
                        "on-secondary": "#ffffff",
                        "on-tertiary-container": "#000703",
                        "error": "#ba1a1a",
                        "surface-tint": "#494bd6",
                        "tertiary-fixed-dim": "#4edea3",
                        "on-tertiary-fixed-variant": "#005236",
                        "on-secondary-fixed": "#0b1c30",
                        "on-primary-fixed": "#07006c",
                        "on-error": "#ffffff",
                        "surface-dim": "#d2d9f4",
                        "surface-container-highest": "#dae2fd",
                        "on-error-container": "#93000a",
                        "surface-bright": "#faf8ff",
                        "primary-container": "#6063ee",
                        "outline-variant": "#c7c4d7",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#e1e0ff",
                        "surface-glass": "rgba(255, 255, 255, 0.7)",
                        "tertiary-container": "#00885d",
                        "primary-fixed-dim": "#c0c1ff",
                        "on-secondary-fixed-variant": "#38485d",
                        "mesh-blob-2": "#ede9fe",
                        "secondary-container": "#d0e1fb",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "background": "#faf8ff",
                        "on-surface": "#131b2e",
                        "on-tertiary-fixed": "#002113",
                        "inverse-primary": "#c0c1ff",
                        "tertiary-fixed": "#6ffbbe",
                        "outline": "#767586",
                        "inverse-surface": "#283044",
                        "primary": "#4648d4",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed-variant": "#2f2ebe",
                        "surface-variant": "#dae2fd",
                        "mesh-blob-1": "#e0e7ff",
                        "secondary-fixed": "#d3e4fe",
                        "secondary-fixed-dim": "#b7c8e1",
                        "secondary": "#505f76",
                        "mesh-blob-3": "#d1fae5",
                        "on-primary-container": "#fffbff",
                        "on-secondary-container": "#54647a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px",
                        "2xl": "1.5rem"
                    },
                    "spacing": {
                        "margin-x-desktop": "40px",
                        "container-max-width": "1280px",
                        "section-gap": "80px",
                        "margin-x-mobile": "16px",
                        "base": "8px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "label-md": ["Plus Jakarta Sans"],
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600" }],
                        "display-lg-mobile": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "700" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "headline-lg": ["30px", { "lineHeight": "38px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
<style>
        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .glass-card:hover {
            box-shadow: 0 10px 15px -3px rgba(70, 72, 212, 0.08), 0 4px 6px -2px rgba(70, 72, 212, 0.04);
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.8);
        }
        .btn-gradient {
            background: linear-gradient(to right, #4648d4, #8b5cf6);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
        }
        .text-gradient {
            background: linear-gradient(to right, #4648d4, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md relative antialiased selection:bg-primary-container selection:text-on-primary-container">
<!-- TopNavBar from JSON -->
<header class="fixed top-0 w-full z-50 bg-surface-glass dark:bg-surface-glass/20 backdrop-blur-md shadow-sm border-b border-white/20 transition-all duration-300">
<div class="flex justify-between items-center px-margin-x-mobile md:px-margin-x-desktop h-20 max-w-container-max-width mx-auto">
<div class="text-headline-md font-headline-md font-extrabold text-primary dark:text-primary-fixed cursor-pointer flex items-center gap-2">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">work_history</span>
                TalentFlow
            </div>
<!-- Desktop Nav -->
<nav class="hidden md:flex gap-8">
<a class="text-primary dark:text-primary-fixed border-b-2 border-primary dark:border-primary-fixed pb-1 font-label-md text-label-md active:scale-95 transition-transform hover:text-primary dark:hover:text-primary-fixed transition-colors duration-200" href="#">Find Jobs</a>
<a class="text-on-surface-variant dark:text-outline-variant font-label-md text-label-md active:scale-95 transition-transform hover:text-primary dark:hover:text-primary-fixed transition-colors duration-200" href="#">Companies</a>
<a class="text-on-surface-variant dark:text-outline-variant font-label-md text-label-md active:scale-95 transition-transform hover:text-primary dark:hover:text-primary-fixed transition-colors duration-200" href="#">For Employers</a>
<a class="text-on-surface-variant dark:text-outline-variant font-label-md text-label-md active:scale-95 transition-transform hover:text-primary dark:hover:text-primary-fixed transition-colors duration-200" href="#">Dashboard</a>
</nav>
<div class="hidden md:flex items-center gap-4">
<button class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors">Sign In</button>
<button class="btn-gradient font-label-md text-label-md text-on-primary px-6 py-2 rounded-full hover:shadow-lg transition-all active:scale-95">Register</button>
</div>
<!-- Mobile Menu Button -->
<button class="md:hidden text-on-surface-variant p-2">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</header>
<main class="relative overflow-hidden pt-20">
<!-- Hero Section with Shader Background -->
<section class="relative min-h-[921px] flex flex-col justify-center px-margin-x-mobile md:px-margin-x-desktop pt-12 pb-24">

<div class="max-w-container-max-width mx-auto w-full relative z-10 flex flex-col items-center text-center">
<!-- Floating Category Chips -->
<div class="flex flex-wrap justify-center gap-3 mb-8 w-full max-w-3xl px-4 animate-[fadeIn_1s_ease-out]">
<span class="bg-surface/80 backdrop-blur-sm border border-outline-variant/30 text-on-surface font-label-sm text-label-sm px-4 py-1.5 rounded-full shadow-sm">Technology</span>
<span class="bg-surface/80 backdrop-blur-sm border border-outline-variant/30 text-on-surface font-label-sm text-label-sm px-4 py-1.5 rounded-full shadow-sm">Design</span>
<span class="bg-surface/80 backdrop-blur-sm border border-outline-variant/30 text-on-surface font-label-sm text-label-sm px-4 py-1.5 rounded-full shadow-sm">Sales</span>
<span class="bg-surface/80 backdrop-blur-sm border border-outline-variant/30 text-on-surface font-label-sm text-label-sm px-4 py-1.5 rounded-full shadow-sm hidden sm:inline-block">Marketing</span>
</div>
<h1 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-on-background mb-6 max-w-4xl tracking-tight leading-tight">
                    Find Your <span class="text-gradient">Dream Job</span> Faster
                </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-12 max-w-2xl text-balance">
                    The modern way to connect world-class talent with the world's most innovative companies. Your next career move is just a search away.
                </p>
<!-- Modern Search Bar Glassmorphism -->
<div class="w-full max-w-4xl bg-surface-glass backdrop-blur-xl border border-white/40 p-2 md:p-3 rounded-[2rem] shadow-xl flex flex-col md:flex-row gap-2 mb-16 relative before:absolute before:inset-0 before:-z-10 before:bg-white/20 before:rounded-[2rem]">
<div class="flex-1 flex items-center bg-surface/50 rounded-full px-4 py-3 md:py-0 border border-transparent focus-within:border-primary/30 transition-colors">
<span class="material-symbols-outlined text-outline mr-3">search</span>
<input class="w-full bg-transparent border-none focus:ring-0 text-on-surface font-body-md placeholder:text-outline-variant px-0" placeholder="Job title, keywords, or company" type="text"/>
</div>
<div class="w-px h-8 bg-outline-variant/30 hidden md:block self-center mx-2"></div>
<div class="flex-1 flex items-center bg-surface/50 rounded-full px-4 py-3 md:py-0 border border-transparent focus-within:border-primary/30 transition-colors">
<span class="material-symbols-outlined text-outline mr-3">location_on</span>
<input class="w-full bg-transparent border-none focus:ring-0 text-on-surface font-body-md placeholder:text-outline-variant px-0" placeholder="City, state, or remote" type="text"/>
</div>
<button class="btn-gradient text-on-primary font-label-md text-label-md px-8 py-4 rounded-full flex items-center justify-center gap-2 hover:shadow-lg transition-transform active:scale-95 w-full md:w-auto mt-2 md:mt-0">
                        Search Jobs
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">arrow_forward</span>
</button>
</div>
<!-- Animated Stats -->
<div class="grid grid-cols-3 gap-8 md:gap-16 pt-8 border-t border-outline-variant/20 w-full max-w-3xl">
<div class="flex flex-col items-center">
<span class="font-headline-lg text-headline-lg text-on-background">25k+</span>
<span class="font-label-md text-label-md text-on-surface-variant mt-1">Jobs</span>
</div>
<div class="flex flex-col items-center">
<span class="font-headline-lg text-headline-lg text-on-background">8k+</span>
<span class="font-label-md text-label-md text-on-surface-variant mt-1">Companies</span>
</div>
<div class="flex flex-col items-center">
<span class="font-headline-lg text-headline-lg text-on-background">150k+</span>
<span class="font-label-md text-label-md text-on-surface-variant mt-1">Candidates</span>
</div>
</div>
</div>
</section>
<!-- Featured Jobs Section -->
<section class="py-section-gap px-margin-x-mobile md:px-margin-x-desktop bg-surface">
<div class="max-w-container-max-width mx-auto">
<div class="flex justify-between items-end mb-12">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-background mb-2">Featured Jobs</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Hand-picked opportunities from top tech companies.</p>
</div>
<a class="hidden md:flex items-center gap-1 font-label-md text-label-md text-primary hover:text-primary-container transition-colors" href="#">
                        View all <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- Job Card 1 -->
<div class="glass-card rounded-2xl p-6 transition-all duration-300 group cursor-pointer">
<div class="flex justify-between items-start mb-4">
<div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center border border-outline-variant/20 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A clean, minimalist abstract logo design featuring a geometric blue and purple 'A' shape, highly stylized for a modern tech company. The background is pure white. High contrast, sharp edges, professional corporate identity style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOYUmoBKxiDs15AZOsGExNWGtc1svd_4u7SpG6kjVvBopqNs4MrAj-EKbK4hq5oSrmdBQAhR1k3AmQXHKealJtV6ffTvYnhEoLBtSN2_T2J6PkonH42sPoWclPQLRDpubEknyG3sm8F0wBnhk8MQQXtOd851scxTiJtnjVrA1nCumTlddktBBhZFIv414mbLH8KJScg39Mbf4b28aWCvVOhlD3NuidJIZvPpNcqqqvtMwjn7qCbV-OdBtNhqRdiVxWHP3k67tUPi5Z"/>
</div>
<button class="text-outline-variant hover:text-error transition-colors p-2 rounded-full hover:bg-error-container/20">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<h3 class="font-headline-md text-headline-md text-on-background mb-1 group-hover:text-primary transition-colors">Senior Product Designer</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-4">Acme Corp • San Francisco, CA</p>
<div class="flex flex-wrap gap-2 mb-6">
<span class="px-3 py-1 bg-tertiary-container/10 text-tertiary font-label-sm text-label-sm rounded-full flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Full-Time
                            </span>
<span class="px-3 py-1 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded-full border border-outline-variant/20">Remote</span>
<span class="px-3 py-1 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded-full border border-outline-variant/20">$120k - $150k</span>
</div>
<div class="flex justify-between items-center border-t border-outline-variant/20 pt-4">
<span class="font-label-sm text-label-sm text-outline">Posted 2 days ago</span>
<button class="font-label-md text-label-md text-primary opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0">Apply Now</button>
</div>
</div>
<!-- Job Card 2 -->
<div class="glass-card rounded-2xl p-6 transition-all duration-300 group cursor-pointer">
<div class="flex justify-between items-start mb-4">
<div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center border border-outline-variant/20 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A modern startup logo featuring a vibrant green leaf motif intertwined with a digital circuit pattern. The aesthetic is clean, flat vector style against a solid white background, representing eco-tech innovation." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsbU4wkY4bqDvngvNuLO3NPeLU2597pgb0GG0Z4m1RW-GhtXICwOLHCH0qDh84yWOP9NQz7RD06I5GiUeEZkt_9uxqCM8qEmFrKyDCmD2UV0SAIph7wfS2AUQmvbc0Ik5SNNn2s7xwUn_65igCmstPxOIWEdpwxFd0l3-tCVlgom4OckvrrOZeFHDC7DcDtLRRBhGf080UDIG4GhYo4usObzN6JQvSh0u9dB0XTqri5TxsPck5eItE6qqLAfwmTyndSiQXh8vGQSLU"/>
</div>
<button class="text-outline-variant hover:text-error transition-colors p-2 rounded-full hover:bg-error-container/20">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<h3 class="font-headline-md text-headline-md text-on-background mb-1 group-hover:text-primary transition-colors">Frontend Engineer</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-4">EcoTech • New York, NY</p>
<div class="flex flex-wrap gap-2 mb-6">
<span class="px-3 py-1 bg-tertiary-container/10 text-tertiary font-label-sm text-label-sm rounded-full flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Full-Time
                            </span>
<span class="px-3 py-1 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded-full border border-outline-variant/20">Hybrid</span>
<span class="px-3 py-1 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded-full border border-outline-variant/20">$140k - $170k</span>
</div>
<div class="flex justify-between items-center border-t border-outline-variant/20 pt-4">
<span class="font-label-sm text-label-sm text-outline">Posted 5 hours ago</span>
<button class="font-label-md text-label-md text-primary opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0">Apply Now</button>
</div>
</div>
<!-- Job Card 3 -->
<div class="glass-card rounded-2xl p-6 transition-all duration-300 group cursor-pointer hidden md:block">
<div class="flex justify-between items-start mb-4">
<div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center border border-outline-variant/20 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A sleek, minimalist logo of a stylized black panther head in profile, composed of sharp geometric lines on a crisp white background. High-end, premium tech brand identity style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCNtHZKFpHvlgAdIIzEhCTr_UgJlpPYxFv_1C_MT8P3WooH07s5OEkg0-SSefMBA9VlkhYYXkPM3a5Vdj_pzUfrgl4VBOzVoIWnSr7SakMHm8j8hp4pl3imKV1RzZXklNySNo6kid6dLY17oy6GVJRut9nydNpUo5iwPQ7j73Mfjhc2Yo_5Be4e-jdZOCfqevmaDklURg2DTQU1P872fIXfJjolKi1EUmhnBFmc1J96gdt7bjqNFBjZo62HYdesHC1-59NPVzSIvlT"/>
</div>
<button class="text-outline-variant hover:text-error transition-colors p-2 rounded-full hover:bg-error-container/20">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<h3 class="font-headline-md text-headline-md text-on-background mb-1 group-hover:text-primary transition-colors">Marketing Director</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-4">Nexus Brands • London, UK</p>
<div class="flex flex-wrap gap-2 mb-6">
<span class="px-3 py-1 bg-tertiary-container/10 text-tertiary font-label-sm text-label-sm rounded-full flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Contract
                            </span>
<span class="px-3 py-1 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded-full border border-outline-variant/20">On-site</span>
<span class="px-3 py-1 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded-full border border-outline-variant/20">$90k - $110k</span>
</div>
<div class="flex justify-between items-center border-t border-outline-variant/20 pt-4">
<span class="font-label-sm text-label-sm text-outline">Posted 1 day ago</span>
<button class="font-label-md text-label-md text-primary opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0">Apply Now</button>
</div>
</div>
</div>
<div class="mt-8 text-center md:hidden">
<a class="inline-flex items-center gap-1 font-label-md text-label-md text-primary hover:text-primary-container transition-colors py-2 px-4 rounded-full border border-primary/20" href="#">
                        View all jobs <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
</div>
</section>
<!-- CTA Section -->
<section class="py-section-gap px-margin-x-mobile md:px-margin-x-desktop">
<div class="max-w-container-max-width mx-auto">
<div class="relative rounded-[2rem] overflow-hidden bg-surface-container-low border border-primary-fixed-dim/30">
<!-- Soft Background Gradient -->
<div class="absolute inset-0 bg-gradient-to-br from-primary-container/20 via-surface to-violet-accent/10 opacity-50"></div>
<div class="relative z-10 py-16 px-8 md:px-16 md:py-24 flex flex-col md:flex-row items-center justify-between gap-12 text-center md:text-left">
<div class="max-w-xl">
<h2 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-on-background mb-4">Start Hiring Today</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-8">Join thousands of companies building their dream teams with TalentFlow. Post your first job for free.</p>
<div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
<button class="btn-gradient text-on-primary font-label-md text-label-md px-8 py-4 rounded-full hover:shadow-lg transition-transform active:scale-95 text-lg">
                                    Post a Job Free
                                </button>
<button class="bg-surface text-primary font-label-md text-label-md px-8 py-4 rounded-full border border-primary/20 hover:bg-surface-container transition-colors">
                                    Talk to Sales
                                </button>
</div>
</div>
<div class="w-full md:w-1/3 relative flex justify-center">
<!-- Abstract Illustration Placeholder -->
<div class="w-64 h-64 rounded-full bg-gradient-to-tr from-primary to-violet-accent opacity-20 blur-3xl absolute"></div>
<div class="w-48 h-48 bg-surface rounded-2xl shadow-xl border border-white/40 rotate-12 flex items-center justify-center relative z-10 glass-card">
<span class="material-symbols-outlined text-[80px] text-primary" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
</div>
<div class="w-32 h-32 bg-surface rounded-2xl shadow-lg border border-white/40 -rotate-12 flex items-center justify-center absolute bottom-0 left-0 z-20 glass-card">
<span class="material-symbols-outlined text-[48px] text-tertiary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer from JSON -->
<footer class="bg-surface dark:bg-background border-t border-outline-variant/20 relative w-full pt-16 pb-8 px-margin-x-mobile md:px-margin-x-desktop mt-auto">
<div class="max-w-container-max-width mx-auto">
<div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
<div class="col-span-1 md:col-span-1">
<div class="text-headline-md font-headline-md font-extrabold text-primary dark:text-primary-fixed mb-4 flex items-center gap-2">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">work_history</span>
                        TalentFlow
                    </div>
<p class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant">Connecting talent with opportunity seamlessly.</p>
</div>
<div class="col-span-1">
<h4 class="font-label-md text-label-md text-on-surface dark:text-on-background mb-4 font-bold">Product</h4>
<ul class="space-y-3">
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Features</a></li>
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Pricing</a></li>
</ul>
</div>
<div class="col-span-1">
<h4 class="font-label-md text-label-md text-on-surface dark:text-on-background mb-4 font-bold">Resources</h4>
<ul class="space-y-3">
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Blog</a></li>
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Help Center</a></li>
</ul>
</div>
<div class="col-span-1">
<h4 class="font-label-md text-label-md text-on-surface dark:text-on-background mb-4 font-bold">Company</h4>
<ul class="space-y-3">
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">About Us</a></li>
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Careers</a></li>
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Privacy</a></li>
<li><a class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors" href="#">Terms</a></li>
</ul>
</div>
</div>
<div class="border-t border-outline-variant/20 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
<p class="font-body-md text-body-md text-on-surface-variant dark:text-outline-variant">
                    © 2024 TalentFlow Recruitment. All rights reserved.
                </p>
<div class="flex gap-4">
<a class="text-on-surface-variant hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined">share</span>
</a>
</div>
</div>
</div>
</footer>
<script>
        // Simple scroll effect for top nav
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('shadow-md');
                header.classList.remove('shadow-sm');
            } else {
                header.classList.remove('shadow-md');
                header.classList.add('shadow-sm');
            }
        });
    </script>
</body></html>