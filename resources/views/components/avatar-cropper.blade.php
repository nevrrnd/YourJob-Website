@props(['name', 'current' => null, 'shape' => 'square'])
@php $rounded = $shape === 'circle' ? 'rounded-full' : 'rounded-2xl'; @endphp

<div class="js-cropper" data-shape="{{ $shape }}">
    <input type="file" name="{{ $name }}" accept="image/png,image/jpeg,image/webp" class="hidden js-cropper-input">
    <div class="flex items-center gap-4">
        <div class="js-cropper-preview grid h-20 w-20 shrink-0 place-items-center overflow-hidden {{ $rounded }} bg-[#f1f3f9] text-[#9aa1b2] ring-1 ring-[#e5e7eb]">
            @if ($current)
                <img src="{{ $current }}" class="h-full w-full object-cover" alt="Preview">
            @else
                <span class="material-symbols-outlined">image</span>
            @endif
        </div>
        <div class="flex flex-col items-start gap-1">
            <button type="button" class="js-cropper-pick inline-flex items-center gap-2 rounded-lg bg-[#dde1ff] px-3 py-2 text-sm font-bold text-[#003ec7] transition hover:bg-[#c9d0ff]">
                <span class="material-symbols-outlined text-[18px]">crop</span>
                Pilih &amp; Potong Foto
            </button>
            <span class="text-xs text-[#6b7280]">JPG, PNG, atau WEBP. Akan dipotong menjadi persegi.</span>
        </div>
    </div>
</div>

@once
<div class="js-crop-modal fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 p-4">
    <div class="w-full max-w-md rounded-2xl bg-white p-5 shadow-2xl">
        <h3 class="mb-1 text-lg font-extrabold text-[#1a1c1e]">Sesuaikan Foto</h3>
        <p class="mb-4 text-sm text-[#6b7280]">Geser untuk menggeser, gunakan slider untuk memperbesar.</p>

        <div class="js-crop-stage relative mx-auto aspect-square w-full max-w-[320px] cursor-grab touch-none select-none overflow-hidden rounded-xl bg-[#0f1115]">
            <img class="js-crop-image absolute left-0 top-0 max-w-none origin-top-left" draggable="false" alt="">
            <div class="pointer-events-none absolute inset-0 ring-2 ring-inset ring-white/70"></div>
        </div>

        <div class="mt-4 flex items-center gap-3">
            <span class="material-symbols-outlined text-[20px] text-[#6b7280]">zoom_out</span>
            <input type="range" class="js-crop-zoom h-2 w-full cursor-pointer accent-[#003ec7]" min="0" max="100" value="0">
            <span class="material-symbols-outlined text-[20px] text-[#6b7280]">zoom_in</span>
        </div>

        <div class="mt-5 flex justify-end gap-2">
            <button type="button" class="js-crop-cancel rounded-lg px-4 py-2 text-sm font-bold text-[#434656] transition hover:bg-[#f1f3f9]">Batal</button>
            <button type="button" class="js-crop-apply rounded-lg bg-[#003ec7] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#0033a6]">Terapkan</button>
        </div>
    </div>
</div>

<script>
(() => {
    const OUTPUT = 512;
    const modal = document.querySelector('.js-crop-modal');
    if (!modal) return;
    const stage = modal.querySelector('.js-crop-stage');
    const image = modal.querySelector('.js-crop-image');
    const zoom = modal.querySelector('.js-crop-zoom');

    let active = null; // { input, preview, naturalW, naturalH, V, minScale, maxScale, scale, offsetX, offsetY, objectUrl }

    const clampOffsets = () => {
        const dispW = active.naturalW * active.scale;
        const dispH = active.naturalH * active.scale;
        active.offsetX = Math.min(0, Math.max(active.V - dispW, active.offsetX));
        active.offsetY = Math.min(0, Math.max(active.V - dispH, active.offsetY));
    };

    const render = () => {
        image.style.width = (active.naturalW * active.scale) + 'px';
        image.style.height = (active.naturalH * active.scale) + 'px';
        image.style.transform = `translate(${active.offsetX}px, ${active.offsetY}px)`;
    };

    const openModal = (input, preview, file) => {
        const objectUrl = URL.createObjectURL(file);
        const img = new Image();
        img.onload = () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            const V = stage.clientWidth;
            const minScale = Math.max(V / img.naturalWidth, V / img.naturalHeight);
            active = {
                input, preview, objectUrl,
                naturalW: img.naturalWidth,
                naturalH: img.naturalHeight,
                V,
                minScale,
                maxScale: minScale * 4,
                scale: minScale,
                offsetX: (V - img.naturalWidth * minScale) / 2,
                offsetY: (V - img.naturalHeight * minScale) / 2,
            };
            image.src = objectUrl;
            zoom.value = '0';
            render();
        };
        img.onerror = () => { URL.revokeObjectURL(objectUrl); alert('Gambar tidak dapat dibaca.'); };
        img.src = objectUrl;
    };

    const closeModal = () => {
        if (active) URL.revokeObjectURL(active.objectUrl);
        active = null;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    // Zoom centered on the viewport middle.
    zoom.addEventListener('input', () => {
        if (!active) return;
        const t = parseInt(zoom.value, 10) / 100;
        const newScale = active.minScale + (active.maxScale - active.minScale) * t;
        const cx = (active.V / 2 - active.offsetX) / active.scale;
        const cy = (active.V / 2 - active.offsetY) / active.scale;
        active.scale = newScale;
        active.offsetX = active.V / 2 - cx * newScale;
        active.offsetY = active.V / 2 - cy * newScale;
        clampOffsets();
        render();
    });

    // Drag to pan.
    let dragging = false, startX = 0, startY = 0, startOX = 0, startOY = 0;
    stage.addEventListener('pointerdown', (e) => {
        if (!active) return;
        dragging = true;
        stage.setPointerCapture(e.pointerId);
        stage.style.cursor = 'grabbing';
        startX = e.clientX; startY = e.clientY;
        startOX = active.offsetX; startOY = active.offsetY;
    });
    stage.addEventListener('pointermove', (e) => {
        if (!dragging || !active) return;
        active.offsetX = startOX + (e.clientX - startX);
        active.offsetY = startOY + (e.clientY - startY);
        clampOffsets();
        render();
    });
    const endDrag = () => { dragging = false; stage.style.cursor = 'grab'; };
    stage.addEventListener('pointerup', endDrag);
    stage.addEventListener('pointercancel', endDrag);

    modal.querySelector('.js-crop-cancel').addEventListener('click', () => {
        if (active) active.input.value = '';
        closeModal();
    });

    modal.querySelector('.js-crop-apply').addEventListener('click', () => {
        if (!active) return;
        const { naturalW, scale, offsetX, offsetY, V } = active;
        const srcSize = V / scale;
        const srcX = -offsetX / scale;
        const srcY = -offsetY / scale;

        const canvas = document.createElement('canvas');
        canvas.width = OUTPUT;
        canvas.height = OUTPUT;
        const ctx = canvas.getContext('2d');
        ctx.imageSmoothingQuality = 'high';
        ctx.drawImage(image, srcX, srcY, srcSize, srcSize, 0, 0, OUTPUT, OUTPUT);

        const input = active.input;
        const preview = active.preview;
        canvas.toBlob((blob) => {
            if (!blob) { alert('Gagal memotong gambar.'); return; }
            const file = new File([blob], 'foto.jpg', { type: 'image/jpeg' });
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;

            const url = URL.createObjectURL(blob);
            preview.innerHTML = '';
            const out = new Image();
            out.className = 'h-full w-full object-cover';
            out.src = url;
            preview.appendChild(out);

            closeModal();
        }, 'image/jpeg', 0.9);
    });

    // Wire up every cropper instance on the page.
    document.querySelectorAll('.js-cropper').forEach((root) => {
        const input = root.querySelector('.js-cropper-input');
        const preview = root.querySelector('.js-cropper-preview');
        root.querySelector('.js-cropper-pick').addEventListener('click', () => input.click());
        input.addEventListener('change', () => {
            const file = input.files && input.files[0];
            if (!file) return;
            if (!/^image\/(png|jpe?g|webp)$/i.test(file.type)) {
                alert('Format tidak didukung. Gunakan JPG, PNG, atau WEBP.');
                input.value = '';
                return;
            }
            openModal(input, preview, file);
        });
    });
})();
</script>
@endonce
