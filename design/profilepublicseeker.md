<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Profil Kandidat - Lumina Talent</title>
<!-- Google Fonts: Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .icon-fill {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #c7c4d7;
            border-radius: 4px;
        }
    </style>
<!-- Tailwind CSS with custom config -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary-fixed": "#0b1c30",
                        "tertiary-fixed": "#e9ddff",
                        "on-surface-variant": "#464554",
                        "on-secondary-container": "#54647a",
                        "tertiary": "#6b38d4",
                        "on-tertiary-container": "#fffbff",
                        "primary-gradient": "linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)",
                        "primary": "#4648d4",
                        "tertiary-container": "#8455ef",
                        "secondary-fixed-dim": "#b7c8e1",
                        "on-error-container": "#93000a",
                        "inverse-on-surface": "#edf1f5",
                        "surface-bright": "#f6fafe",
                        "on-primary-fixed-variant": "#2f2ebe",
                        "on-tertiary": "#ffffff",
                        "primary-fixed": "#e1e0ff",
                        "error-container": "#ffdad6",
                        "background": "#f6fafe",
                        "inverse-primary": "#c0c1ff",
                        "error": "#ba1a1a",
                        "surface-container": "#eaeef2",
                        "secondary": "#505f76",
                        "on-background": "#171c1f",
                        "surface-container-highest": "#dfe3e7",
                        "surface-glass": "rgba(255, 255, 255, 0.7)",
                        "secondary-container": "#d0e1fb",
                        "on-primary": "#ffffff",
                        "outline": "#767586",
                        "on-tertiary-fixed": "#23005c",
                        "inverse-surface": "#2c3134",
                        "surface-tint": "#494bd6",
                        "on-secondary": "#ffffff",
                        "surface-container-high": "#e4e9ed",
                        "success-emerald": "#10b981",
                        "on-primary-fixed": "#07006c",
                        "on-primary-container": "#fffbff",
                        "primary-fixed-dim": "#c0c1ff",
                        "outline-variant": "#c7c4d7",
                        "on-error": "#ffffff",
                        "primary-container": "#6063ee",
                        "tertiary-fixed-dim": "#d0bcff",
                        "on-surface": "#171c1f",
                        "surface-dim": "#d6dade",
                        "on-tertiary-fixed-variant": "#5516be",
                        "surface-container-low": "#f0f4f8",
                        "surface-container-lowest": "#ffffff",
                        "surface": "#f6fafe",
                        "bg-lavender": "#faf8ff",
                        "surface-variant": "#dfe3e7",
                        "secondary-fixed": "#d3e4fe",
                        "on-secondary-fixed-variant": "#38485d"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "stack-sm": "8px",
                        "stack-lg": "32px",
                        "margin-mobile": "16px",
                        "container-max": "1280px",
                        "stack-md": "16px",
                        "section-gap": "80px",
                        "gutter": "24px"
                    },
                    fontFamily: {
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "1.2", "fontWeight": "500" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "1.3", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "1.5", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bg-lavender text-on-background font-body-md text-body-md antialiased min-h-screen flex flex-col selection:bg-primary-container selection:text-on-primary-container">
<!-- TopNavBar (From JSON) -->
<header class="bg-surface-glass backdrop-blur-xl border-b border-white/20 shadow-sm fixed top-0 w-full z-50 flex justify-between items-center px-gutter h-20 max-w-container-max mx-auto left-0 right-0">
<div class="flex items-center gap-8">
<a class="font-headline-md text-headline-md font-extrabold text-primary flex items-center gap-2" href="#">
<span class="material-symbols-outlined icon-fill text-tertiary">diamond</span>
                Lumina Talent
            </a>
<nav class="hidden md:flex items-center gap-6">
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200 pb-1" href="#">Find Jobs</a>
<!-- Active State for Employer viewing Candidate Profile -->
<a class="font-label-md text-label-md text-primary font-bold border-b-2 border-primary pb-1 scale-95 transition-transform" href="#">For Employers</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200 pb-1" href="#">Salary Guide</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200 pb-1" href="#">Resources</a>
</nav>
</div>
<div class="flex items-center gap-4">
<button class="hidden md:block font-label-md text-label-md text-primary hover:text-primary-container transition-colors">Log In</button>
<button class="font-label-md text-label-md text-on-primary rounded-xl px-6 py-2.5 shadow-sm hover:shadow-md transition-all" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-top: 1px solid rgba(255,255,255,0.2);">
                Get Started
            </button>
</div>
</header>
<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter pt-[120px] pb-section-gap">
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-start">
<!-- Left Sidebar (1/3 width) -->
<aside class="col-span-1 md:col-span-4 flex flex-col gap-stack-md md:sticky md:top-[120px]">
<!-- Profile Card -->
<div class="bg-surface-container-lowest rounded-xl p-stack-lg shadow-[0_10px_20px_rgba(99,102,241,0.04)] border border-white relative overflow-hidden flex flex-col items-center text-center group">
<!-- Subtle background glow -->
<div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-32 bg-primary/5 blur-2xl rounded-full pointer-events-none"></div>
<div class="relative w-32 h-32 mb-6">
<img class="w-full h-full object-cover rounded-full border-4 border-surface-container-lowest shadow-sm z-10 relative group-hover:-translate-y-1 transition-transform duration-300" data-alt="A professional headshot of a confident young Indonesian tech professional, smiling softly. He is wearing a crisp smart-casual outfit, set against a bright, modern office background with subtle glassmorphic elements and a lavender tint. The lighting is soft, high-key, and premium, evoking a sophisticated SaaS corporate aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsQG9ChiO-TOqjEk6BF_gv_9fm6p3aWpBsJvPUJRTOLw2vzoTxXukz__q6h2kKxmH95VXaFN44jKqmqlwI1EOQM5i4G2xGFg1zE7rWUqrqRehABTpnv0C2mPPeXmt-9kzRM1ZkPLsnIT5p88B_lHjMrH6sLw8ohR-U2NyfxbDqRwRjigJxcFDuIl4gtnYGOfLxyEpJtMxk5-c0KGHkWdJgAUy6KtzyLzEeGiI6Oz3e98AEcZwl1hRcWBsv1ktEbkAFHh8_0Id3K_AF"/>
<div class="absolute bottom-1 right-1 w-6 h-6 bg-surface-container-lowest rounded-full flex items-center justify-center shadow-sm z-20">
<div class="w-4 h-4 rounded-full bg-success-emerald animate-pulse"></div>
</div>
</div>
<h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-1">Budi Santoso</h1>
<h2 class="font-headline-md text-headline-md text-on-surface-variant mb-4 font-normal">Desainer Produk Senior</h2>
<div class="flex flex-col gap-3 w-full border-t border-outline-variant/30 pt-6 mt-2">
<div class="flex items-center gap-3 text-on-surface-variant font-body-md text-body-md">
<span class="material-symbols-outlined text-outline">location_on</span>
<span>Jakarta, Indonesia</span>
</div>
<div class="flex items-center gap-3 text-on-surface-variant font-body-md text-body-md">
<span class="material-symbols-outlined text-outline">payments</span>
<span>Rp 25jt - Rp 35jt / bulan</span>
</div>
<div class="flex items-center gap-3 text-on-surface-variant font-body-md text-body-md">
<span class="material-symbols-outlined text-outline">work_history</span>
<span>Pengalaman 8 Tahun</span>
</div>
</div>
<div class="mt-8 w-full flex flex-col gap-4">
<div class="inline-flex items-center justify-center gap-2 bg-[#e6f8f0] text-success-emerald font-label-md text-label-md px-4 py-2 rounded-full w-max mx-auto">
<span class="material-symbols-outlined text-[18px]">check_circle</span>
                            Tersedia Sekarang
                        </div>
<button class="w-full font-label-md text-label-md text-on-primary rounded-xl px-6 py-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-top: 1px solid rgba(255,255,255,0.2);">
<span class="material-symbols-outlined">mail</span>
                            Hubungi Kandidat
                        </button>
<button class="w-full font-label-md text-label-md text-primary bg-surface-container-low hover:bg-surface-container rounded-xl px-6 py-3 transition-colors flex items-center justify-center gap-2">
<span class="material-symbols-outlined">download</span>
                            Unduh CV
                        </button>
</div>
</div>
</aside>
<!-- Right Main Content (2/3 width) -->
<div class="col-span-1 md:col-span-8 flex flex-col gap-stack-lg">
<!-- About Me -->
<section class="bg-surface-container-lowest rounded-xl p-stack-lg md:p-[40px] shadow-[0_10px_20px_rgba(99,102,241,0.04)] border border-white">
<h3 class="font-headline-md text-headline-md text-on-surface mb-4 flex items-center gap-2">
<span class="material-symbols-outlined text-primary">person</span>
                        Tentang Saya
                    </h3>
<p class="font-body-lg text-body-lg text-on-surface-variant text-justify">
                        Saya adalah seorang Desainer Produk yang bersemangat dalam memecahkan masalah kompleks melalui antarmuka yang intuitif dan estetis. Dengan latar belakang yang kuat dalam UX research dan UI design, saya telah membantu berbagai startup tahap awal maupun perusahaan enterprise untuk meningkatkan retensi pengguna dan metrik konversi. Fokus utama saya adalah menciptakan pengalaman digital yang tidak hanya terlihat premium tetapi juga berfungsi dengan mulus.
                    </p>
</section>
<!-- Skills -->
<section class="bg-surface-container-lowest rounded-xl p-stack-lg md:p-[40px] shadow-[0_10px_20px_rgba(99,102,241,0.04)] border border-white">
<h3 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
<span class="material-symbols-outlined text-primary">psychology</span>
                        Keahlian Utama
                    </h3>
<div class="flex flex-wrap gap-3">
<span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-5 py-2.5 rounded-full border border-outline-variant/20 hover:border-primary/50 hover:bg-primary/5 transition-colors cursor-default">UI/UX Design</span>
<span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-5 py-2.5 rounded-full border border-outline-variant/20 hover:border-primary/50 hover:bg-primary/5 transition-colors cursor-default">Figma Mastery</span>
<span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-5 py-2.5 rounded-full border border-outline-variant/20 hover:border-primary/50 hover:bg-primary/5 transition-colors cursor-default">Design Systems</span>
<span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-5 py-2.5 rounded-full border border-outline-variant/20 hover:border-primary/50 hover:bg-primary/5 transition-colors cursor-default">Prototyping</span>
<span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-5 py-2.5 rounded-full border border-outline-variant/20 hover:border-primary/50 hover:bg-primary/5 transition-colors cursor-default">User Research</span>
<span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-5 py-2.5 rounded-full border border-outline-variant/20 hover:border-primary/50 hover:bg-primary/5 transition-colors cursor-default">HTML/CSS/React (Basic)</span>
<span class="bg-surface-container-low text-on-surface font-label-md text-label-md px-5 py-2.5 rounded-full border border-outline-variant/20 hover:border-primary/50 hover:bg-primary/5 transition-colors cursor-default">Agile/Scrum</span>
</div>
</section>
<!-- Work Experience (Timeline) -->
<section class="bg-surface-container-lowest rounded-xl p-stack-lg md:p-[40px] shadow-[0_10px_20px_rgba(99,102,241,0.04)] border border-white">
<h3 class="font-headline-md text-headline-md text-on-surface mb-8 flex items-center gap-2">
<span class="material-symbols-outlined text-primary">work</span>
                        Pengalaman Kerja
                    </h3>
<div class="relative border-l-2 border-surface-container ml-4 md:ml-6 flex flex-col gap-10">
<!-- Experience 1 -->
<div class="relative pl-8 md:pl-12 group">
<!-- Timeline Dot -->
<div class="absolute w-4 h-4 bg-primary rounded-full -left-[9px] top-1 border-4 border-surface-container-lowest group-hover:scale-125 transition-transform"></div>
<div class="flex flex-col md:flex-row md:items-center justify-between mb-2 gap-2">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-surface-container overflow-hidden flex-shrink-0 border border-outline-variant/20 p-1">
<img class="w-full h-full object-contain rounded-lg" data-alt="A minimalist, abstract corporate logo suitable for a modern tech startup. The design uses geometric shapes in deep indigo and bright violet, set on a clean white background. High-resolution, crisp vectors, reflecting a premium B2B software brand." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRGYitnnkckP2D8VGhfkjdie7j-7tCoQvOXyH0Kv-tGlL-mL8XvmKQw1SFiRozQujpxUCRF8iZWD-Y9v9g_-Kyp1VlPQ36P6oRCyKp9cOloepnePGIxbKEMCEM7avGPhLDlZWO0oyLRjXV6f7Gm41Aefon3njsa0QpsSHK-hKc3QqVQ_b2A3k6Y1CNimWAJBx4idxjbTIjbzIUpDpz8PL0265nkVGjAubGHE6F8_iMmsW9PcIpkEjNSp2l5saA8jpvKu_Sk-fuQLtC"/>
</div>
<div>
<h4 class="font-label-md text-[18px] text-on-surface">TechNova Solutions</h4>
<div class="font-body-md text-body-md text-primary font-medium">Lead Product Designer</div>
</div>
</div>
<div class="font-label-sm text-label-sm text-on-surface-variant bg-surface-container-low px-3 py-1 rounded-full w-max mt-2 md:mt-0">
                                    Jan 2021 - Sekarang
                                </div>
</div>
<ul class="font-body-md text-body-md text-on-surface-variant list-none mt-4 space-y-2">
<li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2.5 before:w-1.5 before:h-1.5 before:bg-outline-variant before:rounded-full">Memimpin tim yang terdiri dari 4 desainer untuk merombak total platform SaaS B2B, meningkatkan skor SUS sebesar 35%.</li>
<li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2.5 before:w-1.5 before:h-1.5 before:bg-outline-variant before:rounded-full">Membangun dan memelihara sistem desain perusahaan ("Nova UI") dari awal menggunakan Figma.</li>
<li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2.5 before:w-1.5 before:h-1.5 before:bg-outline-variant before:rounded-full">Berkolaborasi erat dengan manajemen produk dan tim teknik untuk memastikan pengiriman fitur yang tepat waktu dan berkualitas.</li>
</ul>
</div>
<!-- Experience 2 -->
<div class="relative pl-8 md:pl-12 group">
<!-- Timeline Dot -->
<div class="absolute w-4 h-4 bg-outline-variant rounded-full -left-[9px] top-1 border-4 border-surface-container-lowest group-hover:bg-primary group-hover:scale-125 transition-all"></div>
<div class="flex flex-col md:flex-row md:items-center justify-between mb-2 gap-2">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-surface-container overflow-hidden flex-shrink-0 border border-outline-variant/20 p-1">
<img class="w-full h-full object-contain rounded-lg" data-alt="A clean, modern logo for a digital agency. The icon features stylized overlapping circles in cool shades of lavender and secondary gray, set against a white background. Professional, sleek, and high-fidelity vector art." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfb4VOoPiMDQqIty56NERBSU1LcQp551DZ4NbdH6UjRoLoaLNgRrBqGiKI2w7ce-rFKBaXXxt_GB8jsxprAublYqoqePWrCFvC2zkLA2yuRyjKs1g0myzmZRwgB7wvNDOUyEzdDxja2p-DBr4hVQUzPlBlb-PTAeCduf14Engsd6x7j59dqPEQjK9UUARHUYcvjxDkdhZt45Qp_OgLkkWZMMNIVJo7z_v4I9vd1MHsepei3xvQntLzR8Sy5A0QBaNIJ2yylRj4WnGg"/>
</div>
<div>
<h4 class="font-label-md text-[18px] text-on-surface">Creative Digital Agency</h4>
<div class="font-body-md text-body-md text-on-surface-variant font-medium">UI/UX Designer</div>
</div>
</div>
<div class="font-label-sm text-label-sm text-on-surface-variant bg-surface-container-low px-3 py-1 rounded-full w-max mt-2 md:mt-0">
                                    Mar 2018 - Des 2020
                                </div>
</div>
<ul class="font-body-md text-body-md text-on-surface-variant list-none mt-4 space-y-2">
<li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2.5 before:w-1.5 before:h-1.5 before:bg-outline-variant before:rounded-full">Mendesain aplikasi seluler e-commerce yang digunakan oleh lebih dari 500.000 pengguna aktif bulanan.</li>
<li class="relative pl-5 before:content-[''] before:absolute before:left-0 before:top-2.5 before:w-1.5 before:h-1.5 before:bg-outline-variant before:rounded-full">Melakukan wawancara pengguna dan pengujian kegunaan untuk mengidentifikasi titik permasalahan dalam alur checkout.</li>
</ul>
</div>
</div>
</section>
<!-- Education -->
<section class="bg-surface-container-lowest rounded-xl p-stack-lg md:p-[40px] shadow-[0_10px_20px_rgba(99,102,241,0.04)] border border-white">
<h3 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
<span class="material-symbols-outlined text-primary">school</span>
                        Pendidikan
                    </h3>
<div class="flex flex-col gap-6">
<div class="flex items-start gap-4 p-4 rounded-xl hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant/20">
<div class="w-14 h-14 rounded-full bg-tertiary-fixed-dim/20 text-tertiary flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined icon-fill">account_balance</span>
</div>
<div class="flex-grow">
<h4 class="font-label-md text-[18px] text-on-surface">Institut Teknologi Bandung (ITB)</h4>
<div class="font-body-md text-body-md text-on-surface-variant mt-1">Sarjana Desain Komunikasi Visual (DKV)</div>
<div class="font-label-sm text-label-sm text-outline mt-2">Agt 2014 - Jul 2018</div>
</div>
</div>
</div>
</section>
</div>
</div>
</main>
<!-- Footer (From JSON) -->
<footer class="bg-surface-container-highest w-full py-section-gap px-gutter flex flex-col items-center justify-center text-center border-t border-outline-variant mt-auto">
<div class="font-headline-md text-headline-md font-extrabold text-on-surface mb-6">
            Lumina Talent
        </div>
<div class="flex flex-wrap justify-center gap-6 mb-8">
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Cookie Policy</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Contact Us</a>
</div>
<p class="font-label-sm text-label-sm text-on-surface-variant">
            © 2024 Lumina Talent. Future-forward recruitment.
        </p>
</footer>
</body></html>