{{-- 
    YourJob AI Chatbot Widget
    Powered by Google Gemini API

    CARA PAKAI:
    1. Taruh file ini di: resources/views/components/chatbot.blade.php
    2. Set GEMINI_API_KEY di file .env kamu:
       GEMINI_API_KEY=your_api_key_here
    3. Include di layouts/app.blade.php sebelum </body>:
       @include('components.chatbot')
    4. Dapatkan API key gratis di: https://aistudio.google.com
--}}

<style>
* { box-sizing: border-box; }

#yj-chat-bubble {
    position: fixed; bottom: 24px; right: 24px; z-index: 9999;
    width: 56px; height: 56px; border-radius: 50%;
    background: #2563eb; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 16px rgba(37,99,235,0.35);
    transition: transform 0.2s, box-shadow 0.2s;
}
#yj-chat-bubble:hover { transform: scale(1.07); box-shadow: 0 6px 20px rgba(37,99,235,0.45); }
#yj-chat-bubble svg { width: 26px; height: 26px; fill: white; }

#yj-notif-badge {
    position: absolute; top: -3px; right: -3px;
    background: #ef4444; color: white; font-size: 11px; font-weight: 500;
    width: 18px; height: 18px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid white;
}

#yj-chat-panel {
    position: fixed; bottom: 90px; right: 24px; z-index: 9998;
    width: 360px; max-height: 520px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    display: flex; flex-direction: column;
    overflow: hidden;
    transform: scale(0.92) translateY(12px);
    opacity: 0; pointer-events: none;
    transition: transform 0.22s cubic-bezier(.34,1.56,.64,1), opacity 0.18s ease;
    box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
#yj-chat-panel.yj-open {
    transform: scale(1) translateY(0);
    opacity: 1; pointer-events: all;
}

#yj-header {
    background: #2563eb;
    padding: 14px 16px;
    display: flex; align-items: center; gap: 10px;
    flex-shrink: 0;
}
#yj-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 19px; flex-shrink: 0;
}
#yj-header-info { flex: 1; }
#yj-header-info h3 { color: white; font-size: 14px; font-weight: 600; margin: 0 0 2px; line-height: 1.3; }
#yj-header-info p { color: rgba(255,255,255,0.78); font-size: 12px; margin: 0; }
#yj-online-dot {
    display: inline-block; width: 7px; height: 7px;
    background: #4ade80; border-radius: 50%; margin-right: 4px;
}
#yj-close-btn {
    background: none; border: none; cursor: pointer;
    color: rgba(255,255,255,0.8); padding: 5px; border-radius: 6px;
    display: flex; align-items: center; transition: background 0.15s;
}
#yj-close-btn:hover { color: white; background: rgba(255,255,255,0.18); }

#yj-messages {
    flex: 1; overflow-y: auto; padding: 14px;
    display: flex; flex-direction: column; gap: 10px;
    scroll-behavior: smooth;
    min-height: 200px;
}
#yj-messages::-webkit-scrollbar { width: 4px; }
#yj-messages::-webkit-scrollbar-track { background: transparent; }
#yj-messages::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 2px; }

.yj-msg { display: flex; flex-direction: column; max-width: 83%; }
.yj-msg.yj-user { align-self: flex-end; align-items: flex-end; }
.yj-msg.yj-bot  { align-self: flex-start; align-items: flex-start; }

.yj-bubble {
    padding: 9px 13px; border-radius: 14px;
    font-size: 13.5px; line-height: 1.55;
    word-break: break-word;
}
.yj-bubble ol, .yj-bubble ul {
    margin: 6px 0 4px; padding-left: 18px;
}
.yj-bubble li { margin-bottom: 3px; }
.yj-bubble strong { font-weight: 600; }
.yj-bubble a {
    color: #2563eb; text-decoration: underline;
    word-break: break-all;
}
.yj-msg.yj-user .yj-bubble a { color: #bfdbfe; }
.yj-msg.yj-user .yj-bubble {
    background: #2563eb; color: white;
    border-bottom-right-radius: 4px;
}
.yj-msg.yj-bot .yj-bubble {
    background: #f3f4f6; color: #111827;
    border-bottom-left-radius: 4px;
    border: 1px solid #e5e7eb;
}
.yj-time {
    font-size: 10.5px; color: #9ca3af;
    margin-top: 3px; padding: 0 3px;
}

.yj-typing-dot {
    display: inline-block; width: 7px; height: 7px;
    background: #9ca3af; border-radius: 50%;
    margin: 0 2px; animation: yj-bounce 1.2s infinite;
}
.yj-typing-dot:nth-child(2) { animation-delay: 0.2s; }
.yj-typing-dot:nth-child(3) { animation-delay: 0.4s; }
@keyframes yj-bounce {
    0%, 60%, 100% { transform: translateY(0); }
    30%           { transform: translateY(-5px); }
}

#yj-quick-btns {
    padding: 0 14px 10px;
    display: flex; flex-wrap: wrap; gap: 6px;
    flex-shrink: 0;
}
.yj-quick-btn {
    font-size: 12px; padding: 5px 10px; border-radius: 20px;
    border: 1px solid #93c5fd;
    background: #eff6ff; color: #1d4ed8;
    cursor: pointer; transition: background 0.15s;
    white-space: nowrap; font-family: inherit;
}
.yj-quick-btn:hover { background: #dbeafe; }

#yj-input-area {
    padding: 10px 14px 14px;
    border-top: 1px solid #e5e7eb;
    display: flex; gap: 8px; align-items: flex-end;
    flex-shrink: 0;
    background: #fff;
}
#yj-input {
    flex: 1; resize: none;
    border: 1px solid #d1d5db;
    border-radius: 10px; padding: 8px 12px;
    font-size: 13.5px; font-family: inherit;
    color: #111827; background: #fff;
    outline: none; max-height: 80px; line-height: 1.5;
    transition: border-color 0.15s;
}
#yj-input:focus { border-color: #2563eb; }
#yj-input::placeholder { color: #9ca3af; }
#yj-send-btn {
    width: 36px; height: 36px; border-radius: 50%;
    background: #2563eb; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: background 0.15s, transform 0.1s;
}
#yj-send-btn:hover   { background: #1d4ed8; }
#yj-send-btn:active  { transform: scale(0.93); }
#yj-send-btn:disabled { background: #93c5fd; cursor: not-allowed; }
#yj-send-btn svg { width: 15px; height: 15px; fill: white; }

#yj-powered {
    text-align: center; font-size: 10.5px; color: #9ca3af;
    padding: 0 0 8px; flex-shrink: 0;
}
</style>

{{-- Chat Panel --}}
<div id="yj-chat-panel" role="dialog" aria-label="YourJob Assistant" aria-hidden="true">

    <div id="yj-header">
        <div id="yj-avatar">💼</div>
        <div id="yj-header-info">
            <h3>YourJob Assistant</h3>
            <p><span id="yj-online-dot"></span>Online · siap membantu</p>
        </div>
        <button id="yj-close-btn" aria-label="Tutup chat">
            <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2.5" fill="none">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <div id="yj-messages" role="log" aria-live="polite"></div>

    <div id="yj-quick-btns" aria-label="Pertanyaan cepat">
        <button class="yj-quick-btn">🔍 Cari lowongan</button>
        <button class="yj-quick-btn">📝 Cara daftar akun</button>
        <button class="yj-quick-btn">🔑 Lupa password</button>
        <button class="yj-quick-btn">💡 Tips CV & interview</button>
        <button class="yj-quick-btn">📬 Status lamaran</button>
    </div>

    <div id="yj-input-area">
        <textarea
            id="yj-input"
            rows="1"
            placeholder="Ketik pertanyaan kamu..."
            aria-label="Pesan untuk asisten"
        ></textarea>
        <button id="yj-send-btn" aria-label="Kirim pesan">
            <svg viewBox="0 0 24 24"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
        </button>
    </div>

    <div id="yj-powered">⚡ Powered by Gemini AI</div>
</div>

{{-- Floating Bubble --}}
<button id="yj-chat-bubble" aria-label="Buka asisten YourJob" aria-expanded="false">
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.832-1.438A9.96 9.96 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18a8 8 0 01-4.108-1.132l-.292-.175-3.027.9.9-3.027-.175-.292A8 8 0 1112 20z"/>
    </svg>
    <span id="yj-notif-badge" aria-hidden="true">1</span>
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
        s = s.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

        // link [label](url) atau url mentah
        s = s.replace(/\[([^\]]+)\]\((https?:\/\/[^\)]+)\)/g, '<a href="$2" target="_blank" rel="noopener">$1</a>');
        s = s.replace(/(?<![">])(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" rel="noopener">$1</a>');

        // split per baris, deteksi ordered/unordered list
        const lines = s.split('\n');
        let html = '';
        let inOl = false, inUl = false;

        lines.forEach(line => {
            const olMatch = line.match(/^(\d+)\.\s+(.*)$/);
            const ulMatch = line.match(/^[-•*]\s+(.*)$/);

            if (olMatch) {
                if (inUl) { html += '</ul>'; inUl = false; }
                if (!inOl) { html += '<ol>'; inOl = true; }
                html += `<li>${olMatch[2]}</li>`;
            } else if (ulMatch) {
                if (inOl) { html += '</ol>'; inOl = false; }
                if (!inUl) { html += '<ul>'; inUl = true; }
                html += `<li>${ulMatch[1]}</li>`;
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
        wrap.className = `yj-msg ${role === 'user' ? 'yj-user' : 'yj-bot'}`;

        const bub = document.createElement('div');
        bub.className = 'yj-bubble';
        if (role === 'user') {
            bub.textContent = text;
        } else {
            bub.innerHTML = formatText(text);
        }

        const time = document.createElement('div');
        time.className = 'yj-time';
        time.textContent = getTime();

        wrap.appendChild(bub);
        wrap.appendChild(time);
        messagesEl.appendChild(wrap);
        scrollBottom();
        return wrap;
    }

    function showTyping() {
        const wrap = document.createElement('div');
        wrap.className = 'yj-msg yj-bot';
        wrap.id = 'yj-typing-indicator';
        const bub = document.createElement('div');
        bub.className = 'yj-bubble';
        bub.innerHTML = '<span class="yj-typing-dot"></span><span class="yj-typing-dot"></span><span class="yj-typing-dot"></span>';
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
