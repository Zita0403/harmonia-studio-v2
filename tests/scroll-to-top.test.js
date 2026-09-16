import { describe, it, expect, beforeEach, vi } from 'vitest';
import { initScrollToTop } from '../public/assets/js/modules/scroll-to-top.js';

describe('Scroll-to-Top Gomb Kezelése', () => {
    beforeEach(() => {
        document.body.innerHTML = `
            <a href="#" class="to-top">Tetejére</a>
        `;

        window.scrollTo = vi.fn();

        Object.defineProperty(window, 'scrollY', {
            writable: true,
            configurable: true,
            value: 0
        });
    });

    it('alapértelmezés szerint rejtve van a gomb', () => {
        initScrollToTop();
        const toTop = document.querySelector('.to-top');

        expect(toTop.style.opacity).toBe('0');
        expect(toTop.style.visibility).toBe('hidden');
    });

    it('megjelenik, ha a görgetési pozíció eléri a 100px-t', () => {
        initScrollToTop();
        const toTop = document.querySelector('.to-top');

        window.scrollY = 150;
        window.dispatchEvent(new Event('scroll'));

        expect(toTop.style.opacity).toBe('1');
        expect(toTop.style.visibility).toBe('visible');
    });

    it('elrejtődik, ha a felhasználó visszagörget 100px alá', () => {
        initScrollToTop();
        const toTop = document.querySelector('.to-top');

        window.scrollY = 150;
        window.dispatchEvent(new Event('scroll'));
        expect(toTop.style.opacity).toBe('1');

        window.scrollY = 50;
        window.dispatchEvent(new Event('scroll'));

        expect(toTop.style.opacity).toBe('0');
        expect(toTop.style.visibility).toBe('hidden');
    });

    it('kattintásra meghívja a window.scrollTo függvényt smooth opcióval', () => {
        initScrollToTop();
        const toTop = document.querySelector('.to-top');

        toTop.click();

        expect(window.scrollTo).toHaveBeenCalledWith({ top: 0, behavior: 'smooth' });
    });
});