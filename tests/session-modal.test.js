import { beforeEach, afterEach, describe, expect, it, vi } from 'vitest';
import { initSessionWarning } from '../public/assets/js/modules/session-warning.js'; 

describe('Session Warning Modal', () => {
    let modal;
    let extendBtn;

    beforeEach(() => {
        // 1. A JSDOM URL-jének beállítása history API-val (ez garantáltan átállítja a pathname-t '/admin'-ra)
        window.history.pushState({}, 'Admin Page', '/admin');

        // 2. DOM elemek inicializálása
        document.body.innerHTML = `
            <div id="session-modal" style="display: none;"></div>
            <button id="extend-session-btn"></button>
        `;

        modal = document.getElementById('session-modal');
        extendBtn = document.getElementById('extend-session-btn');

        // 3. Fake Timers beállítása
        vi.useFakeTimers();
        vi.setSystemTime(new Date('2026-01-01T10:00:00Z'));
        localStorage.clear();
    });

    afterEach(() => {
        vi.useRealTimers();
        vi.restoreAllMocks();
    });

    it('megjeleníti a modalt 13 perc eltelte után', () => {
        initSessionWarning();

        // 13 perc (780 000 ms) előreléptetése
        vi.advanceTimersByTime(780000);

        expect(modal.style.display).toBe('flex');
    });

    it('elrejti a modalt és újraindítja az időzítőt a gombra kattintva', async () => {
        global.fetch = vi.fn().mockResolvedValue({ ok: true });

        initSessionWarning();

        // 13 perc előreléptetése
        vi.advanceTimersByTime(780000);
        expect(modal.style.display).toBe('flex');

        // Kattintás a hosszabbításra
        await extendBtn.click();

        expect(modal.style.display).toBe('none');
    });
});