import { describe, it, expect, beforeEach } from 'vitest';
import { initNavigation } from '../public/assets/js/modules/navigation.js';

describe('Navigáció és Hamburger Menü Kezelése', () => {
    beforeEach(() => {
        document.body.innerHTML = `
            <button class="hamburger-menu">
                <i class="fa fa-bars"></i>
            </button>
            <ul class="hamburger-main-menu" style="display: none;">
                <li id="menu-item-1">
                    <a href="#">Szolgáltatások</a>
                    <ul class="hamburger-submenu" style="display: none;">
                        <li><a href="#">Arckezelés</a></li>
                    </ul>
                </li>
                <li id="menu-item-2">
                    <a href="#">Kezelések</a>
                    <ul class="hamburger-submenu" style="display: none;">
                        <li><a href="#">Masszázs</a></li>
                    </ul>
                </li>
            </ul>
        `;

        initNavigation();
    });

    it('nyitja és csukja a főmenüt a hamburger gombra kattintva', () => {
        const hamburger = document.querySelector('.hamburger-menu');
        const mainMenu = document.querySelector('.hamburger-main-menu');
        const icon = hamburger.querySelector('i');

        // Nyitás
        hamburger.click();
        expect(mainMenu.style.display).toBe('block');
        expect(hamburger.classList.contains('open')).toBe(true);
        expect(icon.classList.contains('fa-times')).toBe(true);

        // Csukás
        hamburger.click();
        expect(mainMenu.style.display).toBe('none');
        expect(hamburger.classList.contains('open')).toBe(false);
    });

    it('megnyitja az almenüt és bezárja a többi nyitott almenüt', () => {
        const item1Link = document.querySelector('#menu-item-1 > a');
        const item2Link = document.querySelector('#menu-item-2 > a');
        const submenu1 = document.querySelector('#menu-item-1 .hamburger-submenu');
        const submenu2 = document.querySelector('#menu-item-2 .hamburger-submenu');

        item1Link.click();
        expect(submenu1.style.display).toBe('block');

        item2Link.click();
        expect(submenu1.style.display).toBe('none');
        expect(submenu2.style.display).toBe('block');
    });

    it('visszaállítja a menüt alaphelyzetbe, ha az ablak szélesebb mint 1200px', () => {
        const hamburger = document.querySelector('.hamburger-menu');
        const mainMenu = document.querySelector('.hamburger-main-menu');
        const icon = hamburger.querySelector('i');

        hamburger.click();
        expect(hamburger.classList.contains('open')).toBe(true);

        Object.defineProperty(window, 'innerWidth', { writable: true, configurable: true, value: 1300 });
        window.dispatchEvent(new Event('resize'));

        expect(mainMenu.getAttribute('style')).toBeNull();
        expect(hamburger.classList.contains('open')).toBe(false);
        expect(icon.classList.contains('fa-bars')).toBe(true);
    });
});