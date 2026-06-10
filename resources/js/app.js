import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Parallax halus untuk floating chips di hero landing page.
// Hanya aktif di perangkat pointer (mouse) dan jika user tidak meminta reduced motion.
(() => {
    const canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!canHover || reduceMotion) return;

    const chips = document.querySelectorAll('#chip-container .chip[data-speed]');
    if (!chips.length) return;

    let frame = null;
    let mouseX = 0;
    let mouseY = 0;

    const apply = () => {
        frame = null;
        chips.forEach((chip) => {
            const speed = parseFloat(chip.dataset.speed) || 1;
            const scale = chip.dataset.pressed === 'true' ? 0.95 : (chip.dataset.hovered === 'true' ? 1.1 : 1);
            chip.style.transform = `translate(${mouseX * 22 * speed}px, ${mouseY * 22 * speed}px) scale(${scale})`;
        });
    };

    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX / window.innerWidth - 0.5;
        mouseY = e.clientY / window.innerHeight - 0.5;
        if (!frame) frame = requestAnimationFrame(apply);
    });

    chips.forEach((chip) => {
        chip.addEventListener('mouseenter', () => {
            chip.dataset.hovered = 'true';
            if (!frame) frame = requestAnimationFrame(apply);
        });
        chip.addEventListener('mouseleave', () => {
            chip.dataset.hovered = 'false';
            chip.dataset.pressed = 'false';
            if (!frame) frame = requestAnimationFrame(apply);
        });
        chip.addEventListener('mousedown', () => {
            chip.dataset.pressed = 'true';
            if (!frame) frame = requestAnimationFrame(apply);
        });
        chip.addEventListener('mouseup', () => {
            chip.dataset.pressed = 'false';
            if (!frame) frame = requestAnimationFrame(apply);
        });
    });
})();

(() => {
    const setFieldValue = (selector, value) => {
        document.querySelectorAll(selector).forEach((field) => {
            field.value = value || '';
        });
    };

    if (!navigator.userAgentData?.getHighEntropyValues) {
        return;
    }

    navigator.userAgentData
        .getHighEntropyValues(['model', 'platform', 'platformVersion', 'architecture'])
        .then((data) => {
            setFieldValue('.js-device-model', data.model);
            setFieldValue('.js-client-platform', data.platform);
            setFieldValue('.js-client-platform-version', data.platformVersion);
            setFieldValue('.js-client-architecture', data.architecture);
        })
        .catch(() => {});
})();
