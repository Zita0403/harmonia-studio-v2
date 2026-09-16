import { describe, it, expect, beforeEach, afterEach, vi } from 'vitest';
import { initCookieModal } from '../public/assets/js/modules/cookie-modal.js';

describe('Cookie Modal Kezelés', () => {
    beforeEach(() => {
        vi.useFakeTimers();
        localStorage.clear();
        document.body.innerHTML = `
            <div class="modal" style="display: none;">
                <button class="btn accept">Elfogadom</button>
                <button class="btn reject">Elutasítom</button>
            </div>
        `;
    });

    afterEach(() => {
        vi.useRealTimers();
    });

    it('megjeleníti a modalt, ha nincs mentett döntés', () => {
        initCookieModal();
        const modal = document.querySelector('.modal');
        expect(modal.style.display).toBe('block');
    });

    it('rejtve hagyja a modalt, ha már el van fogadva a cookie', () => {
        localStorage.setItem('cookieConsent', 'accepted');
        initCookieModal();
        const modal = document.querySelector('.modal');
        expect(modal.style.display).toBe('none');
    });

    it('elfogadáskor ment a localStorage-ba és 500ms után elrejti a modalt', () => {
        initCookieModal();
        const modal = document.querySelector('.modal');
        const acceptBtn = document.querySelector('.btn.accept');

        acceptBtn.click();


        expect(localStorage.getItem('cookieConsent')).toBe('accepted');
        expect(modal.style.opacity).toBe('0');

        vi.advanceTimersByTime(500);
        expect(modal.style.display).toBe('none');
    });

    it('elutasításkor "rejected" értéket ment', () => {
        initCookieModal();
        const rejectBtn = document.querySelector('.btn.reject');

        rejectBtn.click();

        expect(localStorage.getItem('cookieConsent')).toBe('rejected');
    });
});