<style>
#yj-chat-panel.yj-open {
    transform: scale(1) translateY(0);
    opacity: 1;
    pointer-events: auto;
}
.yj-pulse {
    animation: yj-pulse 2s infinite;
}
@keyframes yj-pulse {
    0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
    70% { box-shadow: 0 0 0 6px rgba(74, 222, 128, 0); }
    100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
}
@keyframes yj-bounce {
    0%, 60%, 100% { transform: translateY(0); }
    30%           { transform: translateY(-6px); }
}
</style>

{{-- Chat Panel --}}
<div id="yj-chat-panel" class="fixed bottom-[92px] right-6 z-[9998] w-[380px] max-h-[580px] bg-white/95 border border-blue-600/15 rounded-2xl flex flex-col overflow-hidden transition-all duration-300 shadow-lift backdrop-blur-xl font-sans opacity-0 pointer-events-none translate-y-3 scale-95" role="dialog" aria-label="YourJob Assistant" aria-hidden="true">

    <div id="yj-header" class="bg-gradient-to-r from-blue-600 to-violet-accent px-5 py-4 flex items-center gap-3 shrink-0 border-b border-white/10">
        <div id="yj-avatar" class="w-10 h-10 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm overflow-hidden p-1">
            <img src="{{ site_logo_url() }}" alt="YourJob Logo" class="w-full h-full object-contain">
        </div>
        <div id="yj-header-info" class="flex-1">
            <h3 class="text-white text-[15px] font-bold m-0 mb-0.5 leading-snug tracking-tight">YourJob Assistant</h3>
            <p class="text-white/85 text-xs m-0 font-medium flex items-center">
                <span id="yj-online-dot" class="inline-block w-2 h-2 bg-green-400 rounded-full mr-1.5 relative yj-pulse"></span>
                Online · siap membantu
            </p>
        </div>
        <button id="yj-close-btn" class="bg-transparent border-none cursor-pointer text-white/85 p-1.5 rounded-lg flex items-center transition-all duration-200 hover:text-white hover:bg-white/15 hover:rotate-90" aria-label="Tutup chat">
            <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2.5" fill="none">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <div id="yj-messages" class="flex-1 overflow-y-auto p-4.5 flex flex-col gap-3 scroll-smooth min-h-[240px] bg-slate-50" role="log" aria-live="polite"></div>

    <div id="yj-quick-btns" class="px-4 py-2 pb-3.5 flex flex-wrap gap-2 shrink-0 bg-slate-50" aria-label="Pertanyaan cepat">
        <button class="yj-quick-btn text-xs px-3 py-1.5 rounded-full border border-blue-600/15 bg-blue-50/65 text-blue-600 cursor-pointer transition-all duration-200 font-semibold whitespace-nowrap hover:bg-blue-100 hover:border-blue-200 hover:-translate-y-0.5 hover:shadow-sm">🔍 Cari lowongan</button>
        <button class="yj-quick-btn text-xs px-3 py-1.5 rounded-full border border-blue-600/15 bg-blue-50/65 text-blue-600 cursor-pointer transition-all duration-200 font-semibold whitespace-nowrap hover:bg-blue-100 hover:border-blue-200 hover:-translate-y-0.5 hover:shadow-sm">📝 Cara daftar akun</button>
        <button class="yj-quick-btn text-xs px-3 py-1.5 rounded-full border border-blue-600/15 bg-blue-50/65 text-blue-600 cursor-pointer transition-all duration-200 font-semibold whitespace-nowrap hover:bg-blue-100 hover:border-blue-200 hover:-translate-y-0.5 hover:shadow-sm">🔑 Lupa password</button>
        <button class="yj-quick-btn text-xs px-3 py-1.5 rounded-full border border-blue-600/15 bg-blue-50/65 text-blue-600 cursor-pointer transition-all duration-200 font-semibold whitespace-nowrap hover:bg-blue-100 hover:border-blue-200 hover:-translate-y-0.5 hover:shadow-sm">💡 Tips CV & interview</button>
        <button class="yj-quick-btn text-xs px-3 py-1.5 rounded-full border border-blue-600/15 bg-blue-50/65 text-blue-600 cursor-pointer transition-all duration-200 font-semibold whitespace-nowrap hover:bg-blue-100 hover:border-blue-200 hover:-translate-y-0.5 hover:shadow-sm">📬 Status lamaran</button>
    </div>

    <div id="yj-input-area" class="p-4 pt-3 flex gap-2.5 items-end shrink-0 border-t border-blue-600/10 bg-white">
        <textarea
            id="yj-input"
            rows="1"
            placeholder="Ketik pertanyaan kamu..."
            aria-label="Pesan untuk asisten"
            class="flex-1 resize-none border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 bg-slate-50 outline-none max-h-20 leading-relaxed transition-all duration-200 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-600/15"
        ></textarea>
        <button id="yj-send-btn" class="w-[38px] h-[38px] rounded-full bg-gradient-to-r from-blue-600 to-violet-accent border-none cursor-pointer flex items-center justify-center shrink-0 transition-all duration-200 shadow-sm shadow-blue-600/20 hover:brightness-105 hover:shadow-md hover:shadow-blue-600/30 hover:scale-105 active:scale-95 disabled:bg-blue-200 disabled:cursor-not-allowed disabled:shadow-none disabled:filter-none" aria-label="Kirim pesan">
            <svg viewBox="0 0 24 24" class="w-4 h-4 fill-white"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
        </button>
    </div>

</div>

{{-- Floating Bubble --}}
<button id="yj-chat-bubble" class="fixed bottom-6 right-6 z-[9999] w-14 h-14 rounded-full bg-gradient-to-r from-blue-600 to-violet-accent border-none cursor-pointer flex items-center justify-center shadow-lg shadow-blue-600/35 transition-all duration-200 hover:scale-105 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-600/45 active:scale-95" aria-label="Buka asisten YourJob" aria-expanded="false">
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-[26px] h-[26px] fill-white">
        <path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.832-1.438A9.96 9.96 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18a8 8 0 01-4.108-1.132l-.292-.175-3.027.9.9-3.027-.175-.292A8 8 0 1112 20z"/>
    </svg>
    <span id="yj-notif-badge" class="absolute -top-0.5 -right-0.5 bg-red-500 text-white text-[11px] font-semibold w-4.5 h-4.5 rounded-full flex items-center justify-center border-2 border-white shadow-sm shadow-red-500/40" aria-hidden="true">1</span>
</button>

<script>
(function () {
    // ─── CONFIG ────────────────────────────────────────────────────────────────
    const GEMINI_API_KEY = "{{ env('GEMINI_API_KEY', '') }}";
    const GEMINI_MODEL   = "gemini-2.5-flash";

    const SYSTEM_PROMPT = `Kamu adalah asisten virtual YourJob, platform job portal Indonesia.
Jawab dalam Bahasa Indonesia yang ramah, singkat (maks 3-4 kalimat per jawaban), dan helpful.
Selalu arahkan user ke fitur YourJob yang relevan.

=== TENTANG YOURJOB ===
- Website: yourjob.web.id
- Platform: job portal untuk pencari kerja dan perusahaan di Indonesia
- Tech stack: Laravel 11, Google OAuth (Socialite), deploy di Railway

=== FITUR UTAMA ===
1. Pencarian Lowongan — filter lokasi, kategori, gaji, tipe kerja (full-time/part-time/remote/freelance)
2. Profil Pelamar — upload CV, foto, isi pengalaman & keahlian
3. Lamaran — apply langsung, tracking status lamaran real-time
4. Profil Perusahaan — rating dan ulasan dari karyawan
5. Bookmark — simpan lowongan favorit
6. Notifikasi — update status lamaran

=== CARA DAFTAR / LOGIN ===
- Klik "Daftar" atau "Masuk" di navbar
- Login Google: klik "Login dengan Google" (lebih cepat, pakai akun Google)
- Daftar manual: isi nama, email, password → verifikasi email (cek folder spam jika tidak masuk)
- Setelah login, lengkapi profil untuk meningkatkan peluang diterima

=== PANDUAN MELAMAR ===
1. Cari lowongan → gunakan filter sesuai kebutuhan
2. Klik lowongan → baca deskripsi
3. Klik "Lamar Sekarang"
4. Pastikan CV sudah diupload di profil
5. Isi cover letter (opsional tapi disarankan)
6. Submit → pantau status di halaman "Lamaran Saya"

=== FAQ ===
- Lupa password → klik "Lupa Password" di halaman login → cek email reset
- Tidak dapat email verifikasi → cek folder spam, atau minta kirim ulang
- Lamaran tidak bisa submit → pastikan CV sudah diupload di profil kamu
- Akun bermasalah → hubungi support via halaman Kontak di website

=== TIPS KARIR ===
- CV: maks 2 halaman, format ATS-friendly, highlight pencapaian dengan angka
- Cover letter: sesuaikan dengan setiap perusahaan, tunjukkan antusias & kecocokan
- Interview: riset perusahaan, gunakan metode STAR untuk menjawab pertanyaan perilaku
- LinkedIn: perbarui profil, aktif networking dengan profesional di industri kamu

=== BATASAN ===
Hanya jawab pertanyaan seputar YourJob dan topik karir/pekerjaan.
Jika ditanya hal lain (cuaca, politik, dll), tolak dengan sopan dan arahkan kembali ke topik karir.

=== ATURAN FORMAT JAWABAN (WAJIB DIIKUTI) ===
1. JANGAN pernah menjawab dalam satu paragraf panjang.
2. Jika ada poin-poin atau fitur, gunakan bullet list dengan tanda "-" di awal setiap baris.
3. Jika ada langkah-langkah urutan (cara daftar, cara melamar, dll), gunakan angka "1. 2. 3." dst.
4. Jika user tanya tentang halaman/fitur tertentu di website, sertakan link-nya:
   - Halaman utama: https://yourjob.web.id
   - Daftar akun: https://yourjob.web.id/register
   - Login: https://yourjob.web.id/login
   - Cari lowongan: https://yourjob.web.id/jobs
   - Profil saya: https://yourjob.web.id/profile
   - Lamaran saya: https://yourjob.web.id/applications
5. Jawaban singkat dan to the point, maksimal 5 poin per jawaban.
6. Gunakan **teks** hanya untuk judul/label penting saja, jangan semua kalimat di-bold.`;

    // ─── STATE ─────────────────────────────────────────────────────────────────
    let isOpen    = false;
    let isLoading = false;
    let history   = [];   // [{role:'user'|'model', parts:[{text}]}]

    // ─── ELEMENTS ──────────────────────────────────────────────────────────────
    const panel      = document.getElementById('yj-chat-panel');
    const bubble     = document.getElementById('yj-chat-bubble');
    const badge      = document.getElementById('yj-notif-badge');
    const closeBtn   = document.getElementById('yj-close-btn');
    const messagesEl = document.getElementById('yj-messages');
    const inputEl    = document.getElementById('yj-input');
    const sendBtn    = document.getElementById('yj-send-btn');
    const quickBtns  = document.querySelectorAll('.yj-quick-btn');

    // ─── HELPERS ───────────────────────────────────────────────────────────────
    function getTime() {
        return new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    }

    // scroll-behavior handles smooth scrolling natively
    function scrollBottom() {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function formatText(text) {
        // escape HTML dulu
        let s = text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

        // bold **text**
        s = s.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-inherit">$1</strong>');

        // link [label](url) atau url mentah
        s = s.replace(/\[([^\]]+)\]\((https?:\/\/[^\)]+)\)/g, '<a href="$2" target="_blank" rel="noopener" class="text-blue-600 font-semibold no-underline border-b border-dashed border-blue-600 hover:border-solid">$1</a>');
        s = s.replace(/(?<![">])(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" rel="noopener" class="text-blue-600 font-semibold no-underline border-b border-dashed border-blue-600 hover:border-solid">$1</a>');

        // split per baris, deteksi ordered/unordered list
        const lines = s.split('\n');
        let html = '';
        let inOl = false, inUl = false;

        lines.forEach(line => {
            const olMatch = line.match(/^(\d+)\.\s+(.*)$/);
            const ulMatch = line.match(/^[-•*]\s+(.*)$/);

            if (olMatch) {
                if (inUl) { html += '</ul>'; inUl = false; }
                if (!inOl) { html += '<ol class="list-decimal pl-5 my-1.5">'; inOl = true; }
                html += `<li class="mb-1">${olMatch[2]}</li>`;
            } else if (ulMatch) {
                if (inOl) { html += '</ol>'; inOl = false; }
                if (!inUl) { html += '<ul class="list-disc pl-5 my-1.5">'; inUl = true; }
                html += `<li class="mb-1">${ulMatch[1]}</li>`;
            } else {
                if (inOl) { html += '</ol>'; inOl = false; }
                if (inUl) { html += '</ul>'; inUl = false; }
                if (line.trim() === '') {
                    html += '<br>';
                } else {
                    html += line + '<br>';
                }
            }
        });

        if (inOl) html += '</ol>';
        if (inUl) html += '</ul>';

        // hapus trailing <br>
        html = html.replace(/(<br>)+$/, '');
        return html;
    }

    function addMessage(role, text) {
        const wrap   = document.createElement('div');
        wrap.className = role === 'user'
            ? 'self-end flex flex-col items-end max-w-[85%] animate-fade-up'
            : 'self-start flex flex-col items-start max-w-[85%] animate-fade-up';

        const bub = document.createElement('div');
        if (role === 'user') {
            bub.className = 'p-3.5 rounded-2xl rounded-tr-none text-sm leading-relaxed break-words bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-md shadow-blue-600/10';
            bub.textContent = text;
        } else {
            bub.className = 'p-3.5 rounded-2xl rounded-tl-none text-sm leading-relaxed break-words bg-white text-slate-800 border border-blue-600/5 shadow-xs';
            bub.innerHTML = formatText(text);
        }

        const time = document.createElement('div');
        time.className = 'text-[11px] text-slate-400 mt-1 px-1 font-medium';
        time.textContent = getTime();

        wrap.appendChild(bub);
        wrap.appendChild(time);
        messagesEl.appendChild(wrap);
        scrollBottom();
        return wrap;
    }

    function showTyping() {
        const wrap = document.createElement('div');
        wrap.className = 'self-start flex flex-col items-start max-w-[85%] animate-fade-up';
        wrap.id = 'yj-typing-indicator';
        
        const bub = document.createElement('div');
        bub.className = 'p-3.5 rounded-2xl rounded-tl-none text-sm leading-relaxed break-words bg-white text-slate-800 border border-blue-600/5 shadow-xs flex items-center';
        bub.innerHTML = '<span class="inline-block w-1.5 h-1.5 bg-blue-600 rounded-full mx-0.5 animate-[yj-bounce_1.2s_infinite] opacity-70"></span>' +
                        '<span class="inline-block w-1.5 h-1.5 bg-blue-600 rounded-full mx-0.5 animate-[yj-bounce_1.2s_infinite] opacity-70" style="animation-delay: 0.2s"></span>' +
                        '<span class="inline-block w-1.5 h-1.5 bg-blue-600 rounded-full mx-0.5 animate-[yj-bounce_1.2s_infinite] opacity-70" style="animation-delay: 0.4s"></span>';
        
        wrap.appendChild(bub);
        messagesEl.appendChild(wrap);
        scrollBottom();
    }

    function removeTyping() {
        const t = document.getElementById('yj-typing-indicator');
        if (t) t.remove();
    }

    function showWelcome() {
        addMessage('bot',
            'Halo! Saya asisten YourJob 👋\n\n' +
            'Saya bisa membantu kamu:\n' +
            '- Mencari lowongan kerja\n' +
            '- Panduan daftar & login\n' +
            '- Tips CV dan interview\n' +
            '- FAQ seputar YourJob\n\n' +
            'Ada yang bisa saya bantu?'
        );
    }

    // ─── TOGGLE PANEL ──────────────────────────────────────────────────────────
    function togglePanel() {
        isOpen = !isOpen;
        panel.classList.toggle('yj-open', isOpen);
        bubble.setAttribute('aria-expanded', isOpen);
        panel.setAttribute('aria-hidden', !isOpen);

        if (isOpen) {
            badge.style.display = 'none';
            if (history.length === 0) showWelcome();
            setTimeout(() => inputEl.focus(), 280);
        }
    }

    bubble.addEventListener('click', togglePanel);
    closeBtn.addEventListener('click', togglePanel);

    // ─── QUICK REPLY BUTTONS ───────────────────────────────────────────────────
    quickBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // strip emoji prefix
            const txt = btn.textContent.replace(/^[\u{1F300}-\u{1FFFF}\u{2600}-\u{27BF}]\s*/u, '').trim();
            inputEl.value = txt;
            sendMessage();
        });
    });

    // ─── SEND MESSAGE ──────────────────────────────────────────────────────────
    async function sendMessage() {
        const text = inputEl.value.trim();
        if (!text || isLoading) return;

        inputEl.value = '';
        inputEl.style.height = 'auto';
        addMessage('user', text);

        history.push({ role: 'user', parts: [{ text }] });

        isLoading = true;
        sendBtn.disabled = true;
        showTyping();

        try {
            if (!GEMINI_API_KEY) {
                await new Promise(r => setTimeout(r, 700));
                removeTyping();
                addMessage('bot',
                    '⚠️ API key belum dikonfigurasi.\n\n' +
                    'Tambahkan di file .env kamu:\n' +
                    'GEMINI_API_KEY=your_api_key\n\n' +
                    'Dapatkan API key gratis di aistudio.google.com'
                );
            } else {
                const payload = {
                    system_instruction: { parts: [{ text: SYSTEM_PROMPT }] },
                    contents: history,
                    generationConfig: {
                        temperature: 0.7,
                        maxOutputTokens: 512,
                        topP: 0.9
                    },
                    safetySettings: [
                        { category: 'HARM_CATEGORY_HARASSMENT',        threshold: 'BLOCK_MEDIUM_AND_ABOVE' },
                        { category: 'HARM_CATEGORY_HATE_SPEECH',       threshold: 'BLOCK_MEDIUM_AND_ABOVE' },
                        { category: 'HARM_CATEGORY_SEXUALLY_EXPLICIT', threshold: 'BLOCK_MEDIUM_AND_ABOVE' },
                        { category: 'HARM_CATEGORY_DANGEROUS_CONTENT', threshold: 'BLOCK_MEDIUM_AND_ABOVE' }
                    ]
                };

                const res = await fetch(
                    `https://generativelanguage.googleapis.com/v1beta/models/${GEMINI_MODEL}:generateContent?key=${GEMINI_API_KEY}`,
                    {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    }
                );

                const data = await res.json();
                removeTyping();

                if (data.candidates && data.candidates[0]) {
                    const reply = data.candidates[0].content.parts[0].text;
                    history.push({ role: 'model', parts: [{ text: reply }] });
                    addMessage('bot', reply);
                } else if (data.error) {
                    addMessage('bot', `❌ Error: ${data.error.message}`);
                } else {
                    addMessage('bot', 'Maaf, ada gangguan saat memproses. Coba lagi ya!');
                }
            }
        } catch (err) {
            removeTyping();
            addMessage('bot', '❌ Gagal terhubung. Periksa koneksi internet kamu.');
            console.error('[YourJob Chatbot]', err);
        } finally {
            isLoading = false;
            sendBtn.disabled = false;
            inputEl.focus();
        }
    }

    // ─── INPUT EVENTS ──────────────────────────────────────────────────────────
    sendBtn.addEventListener('click', sendMessage);

    inputEl.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    inputEl.addEventListener('input', () => {
        inputEl.style.height = 'auto';
        inputEl.style.height = Math.min(inputEl.scrollHeight, 80) + 'px';
    });

})();
</script>
