import { describe, it, expect, beforeEach, afterEach, vi } from 'vitest';
import { initCurrentYear } from '../public/assets/js/modules/current-year.js';

describe('Aktuális Évszám Frissítése', () => {
    beforeEach(() => {
        vi.useFakeTimers();
        vi.setSystemTime(new Date('2026-01-15'));
        
        document.body.innerHTML = `
            <footer>
                <span id="current-year"></span>
            </footer>
        `;
    });

    afterEach(() => {
        vi.useRealTimers();
    });

    it('beállítja a jelenlegi évszámot a #current-year elembe', () => {
        initCurrentYear();
        const currentYearEl = document.getElementById('current-year');

        expect(currentYearEl.textContent).toBe('2026');
    });

    it('nem dob hibát, ha a #current-year elem nem található az oldalon', () => {
        document.body.innerHTML = '<footer></footer>';

        expect(() => initCurrentYear()).not.toThrow();
    });
});