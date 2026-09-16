import { describe, it, expect, beforeEach, afterEach, vi } from 'vitest';
import { initSessionWarning } from '../public/assets/js/modules/session-warning.js';

describe('Session Warning Modal', () => {
    let modal;
    let extendBtn;

    beforeEach(() => {
        vi.useFakeTimers();

        global.fetch = vi.fn().mockResolvedValue({
            ok: true,
            json: async () => ({ status: 'success' })
        });

        document.body.innerHTML = `
            <div id="session-warning-modal" style="display: none;">
                <button id="session-extend-btn">Munkamenet meghosszabbítása</button>
            </div>
        `;

        modal = document.getElementById('session-warning-modal');
        extendBtn = document.getElementById('session-extend-btn');
    });

    afterEach(() => {
        vi.useRealTimers();
        vi.restoreAllMocks();
    });

    it('megjeleníti a modalt 13 perc eltelte után', () => {
        initSessionWarning();
        expect(modal.style.display).toBe('none');

        vi.advanceTimersByTime(780000);
        expect(modal.style.display).toBe('flex');
    });

    it('elrejti a modalt és újraindítja az időzítőt a gombra kattintva', () => {
        initSessionWarning();

        vi.advanceTimersByTime(780000);
        expect(modal.style.display).toBe('flex');

        extendBtn.click();
        expect(modal.style.display).toBe('none');
    });
});