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
            chip.style.transform = `translate(${mouseX * 22 * speed}px, ${mouseY * 22 * speed}px)`;
        });
    };

    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX / window.innerWidth - 0.5;
        mouseY = e.clientY / window.innerHeight - 0.5;
        if (!frame) frame = requestAnimationFrame(apply);
    });
})();
