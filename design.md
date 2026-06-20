<!-- Design System -->
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width,initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      background: #000;
    }
  </style>
</head>
<body>
<!-- STITCH_SHADER_START:ANIMATION_3 class="fixed inset-0 w-full h-full" -->
<div class="fixed inset-0 w-full h-full" style="display:block;">
<canvas id="shader-canvas-ANIMATION_3" style="display:block;width:100%;height:100%"></canvas>
<script>
(function() {
  const canvas = document.getElementById('shader-canvas-ANIMATION_3');

  // Sync the WebGL drawing-buffer size with the CSS-driven layout size.
  // This fires on initial layout and whenever the element is resized.
  function syncSize() {
    const w = canvas.clientWidth  || 1280;
    const h = canvas.clientHeight || 720;
    if (canvas.width !== w || canvas.height !== h) {
      canvas.width  = w;
      canvas.height = h;
    }
  }
  if (typeof ResizeObserver !== 'undefined') {
    new ResizeObserver(syncSize).observe(canvas);
  }
  syncSize();

  const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
  if (!gl) return;
  const vs = `attribute vec2 a_position;
varying vec2 v_texCoord;
void main() {
  v_texCoord = a_position * 0.5 + 0.5;
  gl_Position = vec4(a_position, 0.0, 1.0);
}`;
  const fs = `precision highp float;
varying vec2 v_texCoord;
uniform float u_time;
uniform vec2 u_resolution;

void main() {
    vec2 uv = v_texCoord;
    
    // Create soft, moving blobs using sine/cosine and time
    float noise = sin(uv.x * 3.0 + u_time * 0.5) * cos(uv.y * 2.0 - u_time * 0.3);
    float noise2 = cos(uv.x * 2.0 - u_time * 0.4) * sin(uv.y * 3.0 + u_time * 0.6);
    
    // Indigo to Violet palette
    vec3 color1 = vec3(0.388, 0.4, 0.945); // #6366f1 (Indigo)
    vec3 color2 = vec3(0.545, 0.361, 0.965); // #8b5cf6 (Violet)
    vec3 color3 = vec3(0.98, 0.97, 1.0);     // Very soft background tint
    
    vec3 finalColor = mix(color1, color2, uv.x + noise * 0.2);
    finalColor = mix(finalColor, color3, 0.85 + noise2 * 0.1);
    
    gl_FragColor = vec4(finalColor, 1.0);
}`;
  function cs(type, src) {
    const s = gl.createShader(type);
    gl.shaderSource(s, src);
    gl.compileShader(s);
    return s;
  }
  const prog = gl.createProgram();
  gl.attachShader(prog, cs(gl.VERTEX_SHADER, vs));
  gl.attachShader(prog, cs(gl.FRAGMENT_SHADER, fs));
  gl.linkProgram(prog);
  gl.useProgram(prog);
  const buf = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, buf);
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 1,-1, -1,1, 1,1]), gl.STATIC_DRAW);
  const pos = gl.getAttribLocation(prog, 'a_position');
  gl.enableVertexAttribArray(pos);
  gl.vertexAttribPointer(pos, 2, gl.FLOAT, false, 0, 0);
  const uTime = gl.getUniformLocation(prog, 'u_time');
  const uRes = gl.getUniformLocation(prog, 'u_resolution');
  const uMouse = gl.getUniformLocation(prog, 'u_mouse');

  // u_mouse is in pixel coordinates matching u_resolution (ShaderToy convention).
  // Shaders that need normalized coords should use: u_mouse / u_resolution.
  let mouse = { x: canvas.width / 2, y: canvas.height / 2 };
  window.addEventListener('mousemove', (event) => {
    const rect = canvas.getBoundingClientRect();
    if (rect.width && rect.height) {
      const nx = (event.clientX - rect.left) / rect.width;
      const ny = 1.0 - (event.clientY - rect.top) / rect.height;
      mouse.x = nx * canvas.width;
      mouse.y = ny * canvas.height;
    }
  });

  function render(t) {
    if (typeof ResizeObserver === 'undefined') syncSize();
    gl.viewport(0, 0, canvas.width, canvas.height);
    if (uTime) gl.uniform1f(uTime, t * 0.001);
    if (uRes) gl.uniform2f(uRes, canvas.width, canvas.height);
    if (uMouse) gl.uniform2f(uMouse, mouse.x, mouse.y);
    gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
    requestAnimationFrame(render);
  }
  render(0);
})();
</script>
</div>
<!-- STITCH_SHADER_END:ANIMATION_3 -->
</body>
</html>


<!-- Shader -->
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

<!-- TalentFlow | Modern Job Board Landing Page -->
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TalentFlow - Modern Recruitment</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                        "full": "9999px"
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
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .glass-panel {
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden selection:bg-primary-container selection:text-on-primary-container">
<!-- STITCH_SHADER_START:ANIMATION_3 class="fixed inset-0 w-full h-full -z-10 pointer-events-none" -->
<div class="fixed inset-0 w-full h-full -z-10 pointer-events-none" style="display:block;">
<canvas id="shader-canvas-ANIMATION_3" style="display:block;width:100%;height:100%"></canvas>
<script>
(function() {
  const canvas = document.getElementById('shader-canvas-ANIMATION_3');

  // Sync the WebGL drawing-buffer size with the CSS-driven layout size.
  // This fires on initial layout and whenever the element is resized.
  function syncSize() {
    const w = canvas.clientWidth  || 1280;
    const h = canvas.clientHeight || 720;
    if (canvas.width !== w || canvas.height !== h) {
      canvas.width  = w;
      canvas.height = h;
    }
  }
  if (typeof ResizeObserver !== 'undefined') {
    new ResizeObserver(syncSize).observe(canvas);
  }
  syncSize();

  const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
  if (!gl) return;
  const vs = `attribute vec2 a_position;
varying vec2 v_texCoord;
void main() {
  v_texCoord = a_position * 0.5 + 0.5;
  gl_Position = vec4(a_position, 0.0, 1.0);
}`;
  const fs = `precision highp float;
varying vec2 v_texCoord;
uniform float u_time;
uniform vec2 u_resolution;

void main() {
    vec2 uv = v_texCoord;
    
    // Create soft, moving blobs using sine/cosine and time
    float noise = sin(uv.x * 3.0 + u_time * 0.5) * cos(uv.y * 2.0 - u_time * 0.3);
    float noise2 = cos(uv.x * 2.0 - u_time * 0.4) * sin(uv.y * 3.0 + u_time * 0.6);
    
    // Indigo to Violet palette
    vec3 color1 = vec3(0.388, 0.4, 0.945); // #6366f1 (Indigo)
    vec3 color2 = vec3(0.545, 0.361, 0.965); // #8b5cf6 (Violet)
    vec3 color3 = vec3(0.98, 0.97, 1.0);     // Very soft background tint
    
    vec3 finalColor = mix(color1, color2, uv.x + noise * 0.2);
    finalColor = mix(finalColor, color3, 0.85 + noise2 * 0.1);
    
    gl_FragColor = vec4(finalColor, 1.0);
}`;
  function cs(type, src) {
    const s = gl.createShader(type);
    gl.shaderSource(s, src);
    gl.compileShader(s);
    return s;
  }
  const prog = gl.createProgram();
  gl.attachShader(prog, cs(gl.VERTEX_SHADER, vs));
  gl.attachShader(prog, cs(gl.FRAGMENT_SHADER, fs));
  gl.linkProgram(prog);
  gl.useProgram(prog);
  const buf = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, buf);
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 1,-1, -1,1, 1,1]), gl.STATIC_DRAW);
  const pos = gl.getAttribLocation(prog, 'a_position');
  gl.enableVertexAttribArray(pos);
  gl.vertexAttribPointer(pos, 2, gl.FLOAT, false, 0, 0);
  const uTime = gl.getUniformLocation(prog, 'u_time');
  const uRes = gl.getUniformLocation(prog, 'u_resolution');
  const uMouse = gl.getUniformLocation(prog, 'u_mouse');

  // u_mouse is in pixel coordinates matching u_resolution (ShaderToy convention).
  // Shaders that need normalized coords should use: u_mouse / u_resolution.
  let mouse = { x: canvas.width / 2, y: canvas.height / 2 };
  window.addEventListener('mousemove', (event) => {
    const rect = canvas.getBoundingClientRect();
    if (rect.width && rect.height) {
      const nx = (event.clientX - rect.left) / rect.width;
      const ny = 1.0 - (event.clientY - rect.top) / rect.height;
      mouse.x = nx * canvas.width;
      mouse.y = ny * canvas.height;
    }
  });

  function render(t) {
    if (typeof ResizeObserver === 'undefined') syncSize();
    gl.viewport(0, 0, canvas.width, canvas.height);
    if (uTime) gl.uniform1f(uTime, t * 0.001);
    if (uRes) gl.uniform2f(uRes, canvas.width, canvas.height);
    if (uMouse) gl.uniform2f(uMouse, mouse.x, mouse.y);
    gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
    requestAnimationFrame(render);
  }
  render(0);
})();
</script>
</div>
<!-- STITCH_SHADER_END:ANIMATION_3 -->
<header class="bg-surface-glass backdrop-blur-md fixed top-0 w-full z-50 shadow-sm border-b border-white/20">
<div class="flex justify-between items-center px-margin-x-mobile md:px-margin-x-desktop h-20 max-w-container-max-width mx-auto">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">work_history</span>
<span class="text-headline-md font-headline-md font-extrabold text-primary">TalentFlow</span>
</div>
<nav class="hidden md:flex gap-8">
<a class="text-primary font-label-md text-label-md border-b-2 border-primary pb-1" href="#">Find Jobs</a>
<a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200" href="#">Companies</a>
<a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200" href="#">For Employers</a>
</nav>
<div class="flex items-center gap-4">
<a class="hidden md:block text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200" href="#">Sign In</a>
<button class="bg-gradient-to-r from-primary to-violet-accent text-on-primary font-label-md text-label-md px-5 py-2.5 rounded-full shadow-md shadow-primary/20 hover:shadow-lg hover:shadow-primary/30 active:scale-95 transition-all duration-200 border-t border-white/20">
                    Register
                </button>
<button class="md:hidden text-on-surface-variant p-2 active:scale-95 transition-transform">
<span class="material-symbols-outlined text-2xl">menu</span>
</button>
</div>
</div>
</header>
<main class="pt-28 pb-20 flex flex-col gap-12">
<section class="px-margin-x-mobile flex flex-col items-center text-center mt-8">
<div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-container-high/50 border border-white/40 shadow-sm mb-6">
<span class="material-symbols-outlined text-primary text-sm" style="font-variation-settings: 'FILL' 1;">stars</span>
<span class="font-label-sm text-label-sm text-primary uppercase tracking-wider">Over 10k remote jobs</span>
</div>
<h1 class="font-display-lg-mobile text-display-lg-mobile text-on-background mb-4">
                Find your next <br/>
<span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-violet-accent">breakthrough</span> role.
            </h1>
<p class="font-body-md text-body-md text-on-surface-variant mb-8 max-w-[280px]">
                The premier platform connecting elite talent with forward-thinking tech companies globally.
            </p>
<div class="w-full max-w-md flex flex-col gap-3 glass-panel rounded-xl p-3 shadow-lg shadow-primary/5">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="w-full bg-surface-container-lowest/50 border border-outline-variant/30 rounded-lg py-3.5 pl-11 pr-4 font-body-md text-body-md text-on-background placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary/50 focus:bg-surface-container-lowest transition-all" placeholder="Job title, keyword, or company" type="text"/>
</div>
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">location_on</span>
<input class="w-full bg-surface-container-lowest/50 border border-outline-variant/30 rounded-lg py-3.5 pl-11 pr-4 font-body-md text-body-md text-on-background placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary/50 focus:bg-surface-container-lowest transition-all" placeholder="City, state, or Remote" type="text"/>
</div>
<button class="w-full bg-gradient-to-r from-primary to-violet-accent text-on-primary font-label-md text-label-md py-3.5 rounded-lg shadow-md shadow-primary/20 active:scale-[0.98] transition-transform flex items-center justify-center gap-2 border-t border-white/20">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">search</span>
                    Search Jobs
                </button>
</div>
</section>
<section class="w-full pl-margin-x-mobile">
<h2 class="font-headline-md text-headline-md text-on-background mb-4 px-1">Popular Categories</h2>
<div class="flex overflow-x-auto snap-x snap-mandatory gap-3 pb-4 pr-margin-x-mobile no-scrollbar">
<button class="snap-start shrink-0 glass-panel rounded-full px-5 py-3 flex items-center gap-2 active:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-primary">code</span>
<span class="font-label-md text-label-md text-on-surface">Engineering</span>
</button>
<button class="snap-start shrink-0 glass-panel rounded-full px-5 py-3 flex items-center gap-2 active:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-violet-accent">design_services</span>
<span class="font-label-md text-label-md text-on-surface">Design</span>
</button>
<button class="snap-start shrink-0 glass-panel rounded-full px-5 py-3 flex items-center gap-2 active:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-tertiary">trending_up</span>
<span class="font-label-md text-label-md text-on-surface">Product</span>
</button>
<button class="snap-start shrink-0 glass-panel rounded-full px-5 py-3 flex items-center gap-2 active:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-secondary">campaign</span>
<span class="font-label-md text-label-md text-on-surface">Marketing</span>
</button>
</div>
</section>
<section class="w-full pl-margin-x-mobile">
<div class="flex justify-between items-end pr-margin-x-mobile mb-4 px-1">
<h2 class="font-headline-md text-headline-md text-on-background">Featured Jobs</h2>
<a class="font-label-sm text-label-sm text-primary flex items-center gap-1 active:opacity-70" href="#">
                    View all <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</a>
</div>
<div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-6 pr-margin-x-mobile no-scrollbar">
<div class="snap-start shrink-0 w-[280px] glass-panel rounded-xl p-5 flex flex-col gap-4 shadow-lg shadow-primary/5 hover:shadow-primary/10 transition-shadow">
<div class="flex justify-between items-start">
<div class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center border border-outline-variant/20 shadow-sm overflow-hidden">
<img class="w-8 h-8 object-contain" data-alt="A stylized geometric, modern tech company logo in high contrast black and vibrant violet on a pristine white background. The logo suggests connectivity and data flow in a professional, minimalist style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAXMJ86rNATzwyyitnz0JQfWYLmbSxOs_rz_XUPgH-8HpkSzM5KCUywXs4RE_UiVlSq4fDk72-8WKR_X26EjQINUFIcITiWbonVQwIBXWcsu2A8gJDal3otPHJcT-fmzZXaY2LKl42PR9CAAg2mr31FqIX7SfemhuG9JZdKis8y8KMFd0tMLi8oaLpNlMmG_xL6_GuHlCCHD32qWYuksiyfVsx1d_b1z8-GHFHahvvGIVgdOgcx4Qm7tV7EsZZiBpvfWgsFbaLUsFQN"/>
</div>
<button class="text-outline hover:text-primary transition-colors">
<span class="material-symbols-outlined">bookmark_border</span>
</button>
</div>
<div>
<h3 class="font-label-md text-label-md text-on-background mb-1">Senior Frontend Engineer</h3>
<p class="font-body-md text-[14px] text-on-surface-variant">Nexus Dynamics</p>
</div>
<div class="flex flex-wrap gap-2 mt-auto pt-2">
<span class="px-2.5 py-1 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-[10px] uppercase">Remote</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-[10px] uppercase">Full-Time</span>
<span class="px-2.5 py-1 rounded-md bg-primary-container/20 text-primary font-label-sm text-[10px] uppercase">$120k - $150k</span>
</div>
</div>
<div class="snap-start shrink-0 w-[280px] glass-panel rounded-xl p-5 flex flex-col gap-4 shadow-lg shadow-primary/5 hover:shadow-primary/10 transition-shadow">
<div class="flex justify-between items-start">
<div class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center border border-outline-variant/20 shadow-sm overflow-hidden">
<img class="w-8 h-8 object-contain" data-alt="A sleek, minimalist startup logo featuring abstract continuous line art forming a subtle 'S' shape. The color palette is deep indigo and pure white, radiating a premium, trustworthy corporate identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBYCzLvEOkDCa5JplHsxOO94IT3kL853c9dKrgP-tK6Yh_qi-Fl9vUaDDrtfioJnxkmDeHwp0Vmhpl5qtbefIGtb9TYXIL-EjXZcGmzwhCrKucEVF7ddGbh4Y6_kiKMoKN4jsqs-Zs9kEheqCaT-4JlT-Vqf2TtgXiz84ON0mLEa8uRwQYB7rzG2cHoUeVVTQJ20H-oJtfR-CHSLsKXR2sNbEBCYaQbnHCDnHzjbS6aZ7lI24DHAFQfLKDdkynVlfZM3YweryOAOy7f"/>
</div>
<button class="text-outline hover:text-primary transition-colors">
<span class="material-symbols-outlined">bookmark_border</span>
</button>
</div>
<div>
<h3 class="font-label-md text-label-md text-on-background mb-1">Product Designer</h3>
<p class="font-body-md text-[14px] text-on-surface-variant">Synergy Labs</p>
</div>
<div class="flex flex-wrap gap-2 mt-auto pt-2">
<span class="px-2.5 py-1 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-[10px] uppercase">New York, NY</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-[10px] uppercase">Hybrid</span>
<span class="px-2.5 py-1 rounded-md bg-primary-container/20 text-primary font-label-sm text-[10px] uppercase">$110k - $140k</span>
</div>
</div>
<div class="snap-start shrink-0 w-[280px] glass-panel rounded-xl p-5 flex flex-col gap-4 shadow-lg shadow-primary/5 hover:shadow-primary/10 transition-shadow">
<div class="flex justify-between items-start">
<div class="w-12 h-12 rounded-lg bg-surface-container-lowest flex items-center justify-center border border-outline-variant/20 shadow-sm overflow-hidden">
<img class="w-8 h-8 object-contain" data-alt="An energetic, modern brand mark for a data analytics firm. It uses dynamic overlapping transparent shapes in shades of green and blue on a bright white background, conveying speed and precision." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXZ4yblPYK9qIVhZ5sQhvV7bbF1BL5r8jeWOSYswWSpvPQRyTaiSOaGPm9-qGZXhoG29whCved1rHS0t76ySrtwsf23au9MyTmlY05aRtp-CdHFZrhBWwgcDsF4V0VrynI6t8rajTC7xl_ucSjpKp9vXMgmZkSyBmw9nJiGYF857qo8AMHqHApUBhSHl-3mdLNrxLHsmxCVXhWj4FBdTh2SaZKrUKfoiZoWyugm6lUsQ6fOIGIxwQaQpFGdtD6hVOCedka2vZlArAd"/>
</div>
<button class="text-outline hover:text-primary transition-colors">
<span class="material-symbols-outlined">bookmark_border</span>
</button>
</div>
<div>
<h3 class="font-label-md text-label-md text-on-background mb-1">Data Scientist</h3>
<p class="font-body-md text-[14px] text-on-surface-variant">Quantum Analytics</p>
</div>
<div class="flex flex-wrap gap-2 mt-auto pt-2">
<span class="px-2.5 py-1 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-[10px] uppercase">San Francisco, CA</span>
<span class="px-2.5 py-1 rounded-md bg-surface-container text-on-surface-variant font-label-sm text-[10px] uppercase">On-site</span>
</div>
</div>
</div>
</section>
<section class="px-margin-x-mobile">
<div class="grid grid-cols-2 gap-3">
<div class="glass-panel rounded-xl p-4 flex flex-col items-center justify-center text-center gap-1 shadow-sm relative overflow-hidden">
<div class="absolute -top-4 -right-4 w-16 h-16 bg-primary/10 rounded-full blur-xl"></div>
<span class="font-display-lg-mobile text-display-lg-mobile text-primary">45k+</span>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Active Jobs</span>
</div>
<div class="glass-panel rounded-xl p-4 flex flex-col items-center justify-center text-center gap-1 shadow-sm relative overflow-hidden">
<div class="absolute -bottom-4 -left-4 w-16 h-16 bg-violet-accent/10 rounded-full blur-xl"></div>
<span class="font-display-lg-mobile text-display-lg-mobile text-violet-accent">12k+</span>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Companies</span>
</div>
<div class="col-span-2 glass-panel rounded-xl p-5 flex items-center justify-between shadow-sm border-l-4 border-l-primary">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-background">Get Job Alerts</span>
<span class="font-body-md text-[14px] text-on-surface-variant">Never miss a new opportunity.</span>
</div>
<button class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors active:scale-95 shadow-sm">
<span class="material-symbols-outlined text-xl">notifications_active</span>
</button>
</div>
</div>
</section>
</main>
<footer class="bg-surface relative w-full border-t border-outline-variant/20 pt-10 pb-8 px-margin-x-mobile">
<div class="max-w-container-max-width mx-auto flex flex-col gap-8">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">work_history</span>
<span class="text-headline-md font-headline-md font-extrabold text-primary">TalentFlow</span>
</div>
<div class="grid grid-cols-2 gap-y-6 gap-x-4">
<div class="flex flex-col gap-3">
<h4 class="font-label-sm text-label-sm text-on-surface uppercase tracking-wider">Company</h4>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">About Us</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Careers</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Contact</a>
</div>
<div class="flex flex-col gap-3">
<h4 class="font-label-sm text-label-sm text-on-surface uppercase tracking-wider">Resources</h4>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Blog</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Help Center</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Guidelines</a>
</div>
<div class="flex flex-col gap-3 col-span-2 mt-2">
<h4 class="font-label-sm text-label-sm text-on-surface uppercase tracking-wider">Legal</h4>
<div class="flex gap-4">
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
</div>
</div>
</div>
<div class="pt-6 border-t border-outline-variant/10">
<p class="font-body-md text-[14px] text-on-surface-variant text-center">
                    © 2024 TalentFlow Recruitment. All rights reserved.
                </p>
</div>
</div>
</footer>
</body></html>

<!-- TalentFlow | Landing Page Mobile -->
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TalentFlow - Employer Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        "full": "9999px"
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
        .glass-panel {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.05), 0 2px 4px -1px rgba(99, 102, 241, 0.03);
        }
        .mesh-bg {
            background-image: 
                radial-gradient(at 0% 0%, rgba(224, 231, 255, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(237, 233, 254, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(209, 250, 229, 0.3) 0px, transparent 50%);
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md text-body-md antialiased overflow-x-hidden min-h-screen flex mesh-bg">
<!-- SideNavBar (Shared Component) -->
<nav class="hidden md:flex fixed left-0 h-full w-[280px] bg-surface-container-low border-r border-outline-variant/30 shadow-md flex-col py-8 gap-2 z-40">
<div class="px-6 mb-8 flex flex-col gap-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full overflow-hidden bg-primary-container flex items-center justify-center shrink-0">
<img class="w-full h-full object-cover" data-alt="A professional headshot of a female recruiter in her early 30s, smiling warmly. She is wearing a modern tailored blazer in soft navy blue over a crisp white blouse. The lighting is bright and even, typical of a high-end corporate headshot, with a slightly blurred light grey background that keeps the focus on her face. The overall aesthetic is confident, approachable, and polished, fitting a premium SaaS platform environment." src="https://lh3.googleusercontent.com/aida-public/AB6AXuABn80FJNao9S_NznOHbid631XI0dzrDkdeywlNYIeZ5vkPTW_LHzfmAe5aKSi1GmomNzYjEvQznD4N-fbHdOMxY-mwoG27FOUxEu36ktQBim9O9D5dJ6czMPBvZx_xJkfKhnevbPUiHqWL5qlJ4E_Xv9qLwSozzpJf90_EgudWpj-flVZ2Z4lFJHA-wCHOcEIIj0bpW6EMdSAMYbwtN3dyutzLFqTMqmu64V_UH-_8OyoComQ7I2HQ26zIPQOQx6p9fm68dfiwEz0I"/>
</div>
<div>
<h2 class="text-headline-md font-headline-md text-primary truncate leading-tight">Recruiter Portal</h2>
<p class="font-label-sm text-label-sm text-on-surface-variant">Premium Access</p>
</div>
</div>
<button class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-primary to-violet-accent text-on-primary font-label-md text-label-md shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group flex items-center justify-center gap-2">
<div class="absolute inset-x-0 top-0 h-px bg-white/20"></div>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
                Post a Job
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
</button>
</div>
<div class="flex flex-col gap-1 px-2 w-full">
<!-- Active Tab: Overview -->
<a class="relative flex items-center gap-3 px-4 py-3 text-primary font-label-md text-label-md font-bold before:content-[''] before:absolute before:left-0 before:w-1.5 before:h-8 before:bg-gradient-to-b before:from-primary before:to-violet-accent before:rounded-r-full hover:bg-surface-container-high transition-all duration-300 ease-in-out mx-2 rounded-xl" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                Overview
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high transition-all duration-300 ease-in-out rounded-xl mx-2" href="#">
<span class="material-symbols-outlined">work</span>
                Jobs
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high transition-all duration-300 ease-in-out rounded-xl mx-2" href="#">
<span class="material-symbols-outlined">group</span>
                Applicants
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high transition-all duration-300 ease-in-out rounded-xl mx-2" href="#">
<span class="material-symbols-outlined">analytics</span>
                Analytics
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-high transition-all duration-300 ease-in-out rounded-xl mx-2 mt-auto" href="#">
<span class="material-symbols-outlined">settings</span>
                Settings
            </a>
</div>
</nav>
<!-- Main Content Area -->
<main class="flex-1 w-full md:ml-[280px] p-margin-x-mobile md:p-margin-x-desktop flex flex-col gap-8">
<!-- Top Bar Header -->
<header class="flex justify-between items-center pb-4 border-b border-outline-variant/20">
<div>
<h1 class="text-display-lg-mobile md:text-display-lg font-display-lg-mobile md:font-display-lg text-on-background">Welcome back, Sarah</h1>
<p class="text-body-md font-body-md text-secondary mt-1">Here's what's happening with your recruitment pipeline today.</p>
</div>
<div class="hidden md:flex gap-3">
<div class="relative w-64 glass-panel rounded-xl flex items-center px-4 py-2">
<span class="material-symbols-outlined text-outline mr-2">search</span>
<input class="bg-transparent border-none focus:ring-0 w-full text-body-md font-body-md text-on-surface placeholder:text-outline p-0" placeholder="Search candidates..." type="text"/>
</div>
</div>
</header>
<!-- Stats Grid (Bento Style) -->
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Stat Card 1 -->
<div class="glass-panel rounded-2xl p-6 flex flex-col gap-4 relative overflow-hidden group">
<div class="absolute -right-6 -top-6 w-24 h-24 bg-primary/5 rounded-full blur-xl group-hover:bg-primary/10 transition-colors"></div>
<div class="flex justify-between items-start">
<div class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-primary">
<span class="material-symbols-outlined">work_history</span>
</div>
<span class="bg-surface-container-high text-primary px-2 py-1 rounded-full font-label-sm text-label-sm">+2 this week</span>
</div>
<div>
<h3 class="text-headline-lg font-headline-lg text-on-background">12</h3>
<p class="text-label-md font-label-md text-secondary">Active Jobs</p>
</div>
</div>
<!-- Stat Card 2 -->
<div class="glass-panel rounded-2xl p-6 flex flex-col gap-4 relative overflow-hidden group">
<div class="absolute -right-6 -top-6 w-24 h-24 bg-tertiary/5 rounded-full blur-xl group-hover:bg-tertiary/10 transition-colors"></div>
<div class="flex justify-between items-start">
<div class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-tertiary">
<span class="material-symbols-outlined">group_add</span>
</div>
<span class="bg-surface-container-high text-tertiary px-2 py-1 rounded-full font-label-sm text-label-sm">+48 today</span>
</div>
<div>
<h3 class="text-headline-lg font-headline-lg text-on-background">342</h3>
<p class="text-label-md font-label-md text-secondary">New Applications</p>
</div>
</div>
<!-- Stat Card 3 -->
<div class="glass-panel rounded-2xl p-6 flex flex-col gap-4 relative overflow-hidden group">
<div class="absolute -right-6 -top-6 w-24 h-24 bg-violet-accent/5 rounded-full blur-xl group-hover:bg-violet-accent/10 transition-colors"></div>
<div class="flex justify-between items-start">
<div class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-violet-accent">
<span class="material-symbols-outlined">event_available</span>
</div>
</div>
<div>
<h3 class="text-headline-lg font-headline-lg text-on-background">28</h3>
<p class="text-label-md font-label-md text-secondary">Interviewing</p>
</div>
</div>
<!-- Stat Card 4 -->
<div class="glass-panel rounded-2xl p-6 flex flex-col gap-4 relative overflow-hidden group">
<div class="absolute -right-6 -top-6 w-24 h-24 bg-tertiary-container/5 rounded-full blur-xl group-hover:bg-tertiary-container/10 transition-colors"></div>
<div class="flex justify-between items-start">
<div class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-tertiary-container">
<span class="material-symbols-outlined">handshake</span>
</div>
</div>
<div>
<h3 class="text-headline-lg font-headline-lg text-on-background">5</h3>
<p class="text-label-md font-label-md text-secondary">Hired this month</p>
</div>
</div>
</section>
<!-- Main Content Area: Recent Applications & Analytics -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-8">
<!-- Recent Applications Table (Span 2 cols on lg) -->
<div class="lg:col-span-2 glass-panel rounded-3xl p-6 md:p-8 flex flex-col gap-6">
<div class="flex justify-between items-center">
<h2 class="text-headline-md font-headline-md text-on-background">Recent Applications</h2>
<button class="text-primary font-label-md text-label-md hover:underline">View All</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="border-b border-outline-variant/30 text-secondary font-label-md text-label-md">
<th class="pb-3 font-semibold w-1/3">Candidate</th>
<th class="pb-3 font-semibold">Role</th>
<th class="pb-3 font-semibold">Status</th>
<th class="pb-3 font-semibold text-right">Date</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/10">
<!-- Row 1 -->
<tr class="group hover:bg-surface/50 transition-colors">
<td class="py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full overflow-hidden shrink-0">
<img class="w-full h-full object-cover" data-alt="A portrait of a young male software engineer in his 20s. He has short dark hair and is wearing a casual, high-quality charcoal grey t-shirt. The background is a vibrant but out-of-focus modern office setting with subtle hints of indoor plants. Bright, airy lighting highlights his relaxed but professional demeanor, fitting for a tech startup environment." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpg0fz7UWVrR_LImHFOgJuCeGq3miy25Nh6gDutlcpNN2z9wVs0eJZX80s9MjonClb5ekwUDvIJq3XbNOGjwtQpCgokwxfFK6Ed1-34xYRb2-4-iPHqkxiZcb4fcOtr8n9Aeure_JZ-vElzPDs5JdpUNGHT5qN_mFMiR-oXeWpBmO93Qre6S6BtmUFcVR7iHbCA_nIKML74DIfoEOretluqX2aQZJ3Ldrf9sTZmclowgEeL93K54pEmmXqW5jFxS9CnmbJYGpXm9IZ"/>
</div>
<div>
<p class="font-label-md text-label-md text-on-background group-hover:text-primary transition-colors">David Chen</p>
<p class="text-label-sm font-label-sm text-secondary">david.c@example.com</p>
</div>
</div>
</td>
<td class="py-4 text-body-md font-body-md text-on-surface">Senior Frontend Dev</td>
<td class="py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        In Review
                                    </span>
</td>
<td class="py-4 text-right text-label-md font-label-md text-secondary">Today</td>
</tr>
<!-- Row 2 -->
<tr class="group hover:bg-surface/50 transition-colors">
<td class="py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full overflow-hidden shrink-0">
<img class="w-full h-full object-cover" data-alt="A professional portrait of a confident middle-aged female marketing director. She has styled shoulder-length brown hair and is wearing a chic, minimalist olive green blouse. The lighting is soft studio lighting creating a gentle glow, against a seamless light beige background. Her expression is focused and capable, conveying extensive experience and leadership qualities." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZDujF37wW6_0ITm476qrbuz-j0gSLq86PUSoBPI2BZrFTS1osm3dD3CPgzfP6-QoOEOkzppagIM9rSa9p1SFDu-YaIvlZKdfS2ExnrLoUWmT4EwHqWQupXQfaygVlccmNKavlfTOySDIrtkA1eSVnQR-QwiPM4o1V_g6VVB21YmvpciU6WBcYDuctcjuvvZ_XbdyUgVgJeB2bmbWgJCYt7oaYs3BXh7DFHDgcYEGMY05eu8WaRTeq5ZESJYUqeZNH7Aw0MCAyDSQB"/>
</div>
<div>
<p class="font-label-md text-label-md text-on-background group-hover:text-primary transition-colors">Elena Rodriguez</p>
<p class="text-label-sm font-label-sm text-secondary">elena.r@example.com</p>
</div>
</div>
</td>
<td class="py-4 text-body-md font-body-md text-on-surface">Product Marketing Mgr</td>
<td class="py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-tertiary/10 text-tertiary font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
                                        Hired
                                    </span>
</td>
<td class="py-4 text-right text-label-md font-label-md text-secondary">Yesterday</td>
</tr>
<!-- Row 3 -->
<tr class="group hover:bg-surface/50 transition-colors">
<td class="py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full overflow-hidden shrink-0 bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-label-md">
                                            MJ
                                        </div>
<div>
<p class="font-label-md text-label-md text-on-background group-hover:text-primary transition-colors">Marcus Johnson</p>
<p class="text-label-sm font-label-sm text-secondary">mjohnson@example.com</p>
</div>
</div>
</td>
<td class="py-4 text-body-md font-body-md text-on-surface">UX Designer</td>
<td class="py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-violet-accent/10 text-violet-accent font-label-sm text-label-sm">
<span class="w-1.5 h-1.5 rounded-full bg-violet-accent"></span>
                                        Interviewing
                                    </span>
</td>
<td class="py-4 text-right text-label-md font-label-md text-secondary">Oct 24</td>
</tr>
</tbody>
</table>
</div>
</div>
<!-- Analytics Sidebar -->
<div class="glass-panel rounded-3xl p-6 md:p-8 flex flex-col gap-6">
<div class="flex justify-between items-center">
<h2 class="text-headline-md font-headline-md text-on-background">Application Trends</h2>
<button class="text-secondary hover:text-primary transition-colors">
<span class="material-symbols-outlined">more_horiz</span>
</button>
</div>
<div class="flex-1 flex flex-col justify-center relative min-h-[200px]">
<!-- Placeholder for a sleek spline chart -->
<div class="absolute inset-0 flex items-end">
<!-- Decorative minimalist chart bars -->
<div class="w-full flex items-end justify-between gap-2 h-3/4">
<div class="w-full bg-surface-container rounded-t-sm h-[30%]"></div>
<div class="w-full bg-surface-container rounded-t-sm h-[50%]"></div>
<div class="w-full bg-surface-container rounded-t-sm h-[40%]"></div>
<div class="w-full bg-surface-container rounded-t-sm h-[70%]"></div>
<div class="w-full bg-surface-container rounded-t-sm h-[60%]"></div>
<div class="w-full bg-primary/20 rounded-t-sm h-[90%] relative">
<div class="absolute top-0 inset-x-0 h-1 bg-primary rounded-t-sm"></div>
</div>
<div class="w-full bg-surface-container rounded-t-sm h-[80%]"></div>
</div>
</div>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant/20">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-tertiary">trending_up</span>
<p class="font-body-md text-body-md text-on-surface">Applications are up <strong class="text-tertiary">14%</strong> this week compared to last week.</p>
</div>
</div>
</div>
</section>
</main>
</body></html>

<!-- TalentFlow | Employer Dashboard -->
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Candidate Dashboard - TalentFlow</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
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
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "margin-x-desktop": "40px",
                        "container-max-width": "1280px",
                        "section-gap": "80px",
                        "margin-x-mobile": "16px",
                        "base": "8px",
                        "gutter": "24px"
                    },
                    fontFamily: {
                        "label-md": ["Plus Jakarta Sans"],
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "label-md": ["14px", { lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "600" }],
                        "display-lg-mobile": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "800" }],
                        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "label-sm": ["12px", { lineHeight: "16px", fontWeight: "700" }],
                        "display-lg": ["48px", { lineHeight: "56px", letterSpacing: "-0.02em", fontWeight: "800" }],
                        "headline-lg": ["30px", { lineHeight: "38px", letterSpacing: "-0.01em", fontWeight: "700" }],
                        "headline-md": ["24px", { lineHeight: "32px", fontWeight: "700" }],
                        "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }]
                    }
                }
            }
        }
    </script>
<style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.05), 0 2px 4px -1px rgba(99, 102, 241, 0.03);
        }
        .mesh-bg {
            background-color: #faf8ff;
            background-image: 
                radial-gradient(at 40% 20%, hsla(28,100%,74%,0.15) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189,100%,56%,0.15) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(355,100%,93%,0.15) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(340,100%,76%,0.15) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(22,100%,77%,0.15) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(242,100%,70%,0.15) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(343,100%,76%,0.15) 0px, transparent 50%);
        }
        .progress-bar-gradient {
            background: linear-gradient(90deg, #4648d4 0%, #8b5cf6 100%);
        }
    </style>
</head>
<body class="mesh-bg text-on-surface font-body-md min-h-screen flex selection:bg-primary selection:text-white">
<!-- Mobile Nav Override Placeholder (Hidden on Desktop) -->
<div class="md:hidden fixed top-0 w-full z-50 bg-surface-glass backdrop-blur-md border-b border-white/20 shadow-sm h-16 flex items-center justify-center">
<span class="text-headline-md font-headline-md font-extrabold text-primary">TalentFlow</span>
</div>
<!-- Sidebar Navigation -->
<aside class="hidden md:flex fixed left-0 h-full w-[280px] bg-surface-container-low dark:bg-inverse-surface shadow-md flex-col py-8 gap-2 border-r border-outline-variant/30 z-40">
<div class="px-8 mb-8">
<h1 class="text-headline-md font-headline-md text-primary font-extrabold tracking-tight">TalentFlow</h1>
</div>
<nav class="flex-1 flex flex-col gap-2">
<!-- Active State -->
<a class="relative flex items-center gap-3 px-4 py-3 text-primary dark:text-primary-fixed font-bold before:content-[''] before:absolute before:left-0 before:w-1.5 before:h-8 before:bg-gradient-to-b before:from-primary before:to-violet-accent before:rounded-r-full mx-2 bg-surface-container-high rounded-xl transition-all duration-300 ease-in-out" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant dark:text-outline-variant hover:bg-surface-container-high dark:hover:bg-surface-variant/10 rounded-xl mx-2 transition-all duration-300 ease-in-out" href="#">
<span class="material-symbols-outlined">work</span>
<span class="font-label-md text-label-md">My Applications</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant dark:text-outline-variant hover:bg-surface-container-high dark:hover:bg-surface-variant/10 rounded-xl mx-2 transition-all duration-300 ease-in-out" href="#">
<span class="material-symbols-outlined">bookmark</span>
<span class="font-label-md text-label-md">Saved Jobs</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant dark:text-outline-variant hover:bg-surface-container-high dark:hover:bg-surface-variant/10 rounded-xl mx-2 transition-all duration-300 ease-in-out" href="#">
<span class="material-symbols-outlined">chat</span>
<span class="font-label-md text-label-md">Messages</span>
<span class="ml-auto bg-primary text-white text-xs font-bold px-2 py-0.5 rounded-full">3</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant dark:text-outline-variant hover:bg-surface-container-high dark:hover:bg-surface-variant/10 rounded-xl mx-2 transition-all duration-300 ease-in-out" href="#">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">Profile</span>
</a>
</nav>
<div class="mt-auto px-6 pt-6">
<div class="flex items-center gap-3">
<img class="w-10 h-10 rounded-full object-cover border-2 border-surface-container-highest" data-alt="A professional headshot of a young modern professional wearing smart casual clothing against a clean minimal light gray background. High quality photography with soft natural lighting, reflecting a modern tech aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBZqAWkdjKP5Th-ofN2QOx8w6uatswrO6JBE63xCvSKWF1Nke0XIX9Li8sOjmse9-WwYZ25BKCQytWaKnWjedswIfnNbb2Nb8wr3puo3xgGAfKuBCEqZhuelTRr8C-alNtP0hsZs8N6uHkJIgKdrBF7k8JCowRz6lQKb2AbdObFkAwag9VUMfrlhgSC-CsdBlPaVT1Z1AMEnB6g-ZkrsWppRzxxHU4WRK_jwLDxDvJ8ru3zbT-IToFccfYUpTBZyosYGGu2VZ7FCvaa"/>
<div>
<p class="font-label-md text-label-md text-on-surface">Alex Mercer</p>
<p class="text-sm text-on-surface-variant">Senior Developer</p>
</div>
</div>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 md:ml-[280px] p-margin-x-mobile md:p-margin-x-desktop mt-16 md:mt-0 max-w-container-max-width mx-auto w-full">
<!-- Header / Welcome -->
<header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
<div>
<h2 class="text-display-lg-mobile md:text-display-lg font-display-lg-mobile md:font-display-lg text-on-surface mb-2">Welcome back, Alex</h2>
<p class="text-body-lg font-body-lg text-on-surface-variant">Here is what's happening with your job applications today.</p>
</div>
<div class="glass-panel p-4 rounded-xl flex items-center gap-4 min-w-[300px]">
<div class="flex-1">
<div class="flex justify-between mb-1">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Profile Strength</span>
<span class="font-label-md text-label-md text-primary font-bold">85%</span>
</div>
<div class="w-full bg-surface-container-highest rounded-full h-2">
<div class="progress-bar-gradient h-2 rounded-full" style="width: 85%"></div>
</div>
</div>
<button class="bg-surface-container-low hover:bg-surface-container-high text-primary p-2 rounded-lg transition-colors">
<span class="material-symbols-outlined">edit</span>
</button>
</div>
</header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Left Column: Tracker & Recommendations -->
<div class="lg:col-span-2 flex flex-col gap-8">
<!-- Applied Jobs Tracker -->
<section>
<div class="flex justify-between items-end mb-4">
<h3 class="text-headline-md font-headline-md text-on-surface">Applied Jobs Tracker</h3>
<a class="text-primary font-label-md text-label-md hover:underline flex items-center gap-1" href="#">View All <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<!-- Card 1: Interviewing -->
<div class="glass-panel p-6 rounded-xl relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300 cursor-pointer">
<div class="absolute top-0 left-0 w-1 h-full bg-violet-accent"></div>
<div class="flex justify-between items-start mb-4">
<div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center overflow-hidden">
<span class="font-bold text-primary text-xl">F</span>
</div>
<span class="px-2.5 py-1 bg-violet-accent/10 text-violet-accent font-label-sm text-label-sm rounded-full flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-violet-accent"></span> Interviewing
                                </span>
</div>
<h4 class="font-label-md text-label-md text-on-surface mb-1">Frontend Engineer</h4>
<p class="text-sm text-on-surface-variant mb-4">FinTech Solutions</p>
<p class="text-xs text-on-surface-variant mt-auto pt-4 border-t border-outline-variant/20">Applied 2 weeks ago</p>
</div>
<!-- Card 2: Under Review -->
<div class="glass-panel p-6 rounded-xl relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300 cursor-pointer">
<div class="absolute top-0 left-0 w-1 h-full bg-tertiary"></div>
<div class="flex justify-between items-start mb-4">
<div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center overflow-hidden">
<span class="font-bold text-tertiary text-xl">S</span>
</div>
<span class="px-2.5 py-1 bg-tertiary/10 text-tertiary font-label-sm text-label-sm rounded-full flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Under Review
                                </span>
</div>
<h4 class="font-label-md text-label-md text-on-surface mb-1">Full Stack Developer</h4>
<p class="text-sm text-on-surface-variant mb-4">Streamline Inc</p>
<p class="text-xs text-on-surface-variant mt-auto pt-4 border-t border-outline-variant/20">Applied 3 days ago</p>
</div>
<!-- Card 3: Applied -->
<div class="glass-panel p-6 rounded-xl relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300 cursor-pointer">
<div class="absolute top-0 left-0 w-1 h-full bg-secondary"></div>
<div class="flex justify-between items-start mb-4">
<div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center overflow-hidden">
<span class="font-bold text-secondary text-xl">N</span>
</div>
<span class="px-2.5 py-1 bg-secondary/10 text-secondary font-label-sm text-label-sm rounded-full flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span> Applied
                                </span>
</div>
<h4 class="font-label-md text-label-md text-on-surface mb-1">React Native Dev</h4>
<p class="text-sm text-on-surface-variant mb-4">Nova Apps</p>
<p class="text-xs text-on-surface-variant mt-auto pt-4 border-t border-outline-variant/20">Applied yesterday</p>
</div>
</div>
</section>
<!-- Recommended for You -->
<section>
<h3 class="text-headline-md font-headline-md text-on-surface mb-4">Recommended for You</h3>
<div class="flex flex-col gap-4">
<!-- Recommendation 1 -->
<div class="glass-panel p-5 rounded-xl flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:shadow-md transition-shadow">
<div class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary">cloud</span>
</div>
<div class="flex-1">
<h4 class="font-label-md text-label-md text-on-surface">Senior Frontend Engineer</h4>
<p class="text-sm text-on-surface-variant">CloudScale Tech • San Francisco (Hybrid)</p>
<div class="flex gap-2 mt-2">
<span class="px-2 py-0.5 bg-surface-container text-xs rounded-md text-on-surface-variant">React</span>
<span class="px-2 py-0.5 bg-surface-container text-xs rounded-md text-on-surface-variant">$130k - $160k</span>
</div>
</div>
<button class="mt-4 sm:mt-0 w-full sm:w-auto px-4 py-2 bg-primary/10 text-primary hover:bg-primary hover:text-white font-label-md text-label-md rounded-lg transition-colors whitespace-nowrap">
                                Quick Apply
                            </button>
</div>
<!-- Recommendation 2 -->
<div class="glass-panel p-5 rounded-xl flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:shadow-md transition-shadow">
<div class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary">database</span>
</div>
<div class="flex-1">
<h4 class="font-label-md text-label-md text-on-surface">Web Application Developer</h4>
<p class="text-sm text-on-surface-variant">DataDrive • Remote</p>
<div class="flex gap-2 mt-2">
<span class="px-2 py-0.5 bg-surface-container text-xs rounded-md text-on-surface-variant">Vue.js</span>
<span class="px-2 py-0.5 bg-surface-container text-xs rounded-md text-on-surface-variant">$110k - $140k</span>
</div>
</div>
<button class="mt-4 sm:mt-0 w-full sm:w-auto px-4 py-2 bg-primary/10 text-primary hover:bg-primary hover:text-white font-label-md text-label-md rounded-lg transition-colors whitespace-nowrap">
                                Quick Apply
                            </button>
</div>
</div>
</section>
</div>
<!-- Right Column: Interview Schedule -->
<div class="lg:col-span-1">
<div class="glass-panel rounded-xl p-6 h-full flex flex-col">
<div class="flex justify-between items-center mb-6">
<h3 class="text-headline-md font-headline-md text-on-surface">Upcoming Interviews</h3>
<button class="text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined">more_horiz</span>
</button>
</div>
<div class="flex-1 flex flex-col gap-6">
<!-- Interview 1 -->
<div class="relative pl-6 border-l-2 border-primary">
<div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-surface border-2 border-primary"></div>
<p class="text-sm font-bold text-primary mb-1">Today, 2:00 PM</p>
<h4 class="font-label-md text-label-md text-on-surface mb-1">Technical Round - FinTech Solutions</h4>
<p class="text-sm text-on-surface-variant mb-3">With Sarah Jenkins, VP of Engineering</p>
<a class="inline-flex items-center justify-center w-full px-4 py-2 progress-bar-gradient text-white rounded-lg font-label-md text-label-md hover:shadow-lg transition-shadow gap-2" href="#">
<span class="material-symbols-outlined text-sm">videocam</span> Join Meeting
                            </a>
</div>
<!-- Interview 2 -->
<div class="relative pl-6 border-l-2 border-surface-container-highest">
<div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-surface border-2 border-surface-container-highest"></div>
<p class="text-sm font-bold text-on-surface-variant mb-1">Thu, Oct 24 • 10:00 AM</p>
<h4 class="font-label-md text-label-md text-on-surface mb-1">Culture Fit - Nova Apps</h4>
<p class="text-sm text-on-surface-variant mb-3">With HR Team</p>
<a class="inline-flex items-center justify-center w-full px-4 py-2 border border-outline-variant/50 text-on-surface-variant hover:bg-surface-container rounded-lg font-label-md text-label-md transition-colors gap-2" href="#">
<span class="material-symbols-outlined text-sm">calendar_today</span> View Details
                            </a>
</div>
</div>
</div>
</div>
</div>
</main>
<!-- Mobile Bottom Navigation (Visible on Mobile) -->
<nav class="md:hidden fixed bottom-0 w-full bg-surface-glass backdrop-blur-md border-t border-outline-variant/20 h-16 flex justify-around items-center px-4 pb-safe z-50">
<a class="flex flex-col items-center gap-1 text-primary" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
<span class="text-[10px] font-bold">Home</span>
</a>
<a class="flex flex-col items-center gap-1 text-on-surface-variant hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined">work</span>
<span class="text-[10px]">Apps</span>
</a>
<a class="flex flex-col items-center gap-1 text-on-surface-variant hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined">chat</span>
<span class="text-[10px]">Messages</span>
</a>
<a class="flex flex-col items-center gap-1 text-on-surface-variant hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined">person</span>
<span class="text-[10px]">Profile</span>
</a>
</nav>
</body></html>