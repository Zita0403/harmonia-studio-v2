import { describe, it, expect, beforeEach } from 'vitest';
import { initHoverAnimation } from '../public/assets/js/modules/hover-animation.js';

describe('Special Treatments Hover Animáció', () => {
    beforeEach(() => {
        document.body.innerHTML = `
            <div class="special-treatments">Kezelés 1</div>
            <div class="special-treatments">Kezelés 2</div>
        `;

    initHoverAnimation();
    });

    it('nagyítja az elemet és átmenetet állít be egeres rámutatáskor (mouseenter)', () => {
        const item = document.querySelector('.special-treatments');

        item.dispatchEvent(new MouseEvent('mouseenter'));

        expect(item.style.transform).toBe('scale(1.1)');
        expect(item.style.transition).toBe('transform 0.3s');
    });

    it('visszaállítja az eredeti méretet az egér elvételekor (mouseleave)', () => {
        const item = document.querySelector('.special-treatments');

        item.dispatchEvent(new MouseEvent('mouseenter'));
        item.dispatchEvent(new MouseEvent('mouseleave'));

        expect(item.style.transform).toBe('scale(1)');
    });
});