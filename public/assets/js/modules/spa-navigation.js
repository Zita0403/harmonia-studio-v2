export function initSpaNavigation() {
    const contentArea = document.querySelector('main') || document.getElementById('conent');

    if (!contentArea) return;

    contentArea.style.transition = 'opacity 0.2s ease-in-out';

    // Oldalbetöltés SPA Fetch
    async function loadPage(targetUrl, pushToHistory = true) {
        try {
            contentArea.style.opacity = '0.3';

            const urlObj = new URL(targetUrl, window.location.origin);
            const fetchUrl = urlObj.pathname + urlObj.search;
            const targetHash = urlObj.hash.replace('#', '');

            const response = await fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('Az oldal betöltése sikertelen');

            const htmlText = await response.text();
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(htmlText, 'text/html');
            const newContent = newDoc.querySelector('main');

            if (!newContent) {
                window.location.href = targetUrl;
                return false;
            }

            document.title = newDoc.title;
            updateActiveNavLinks(fetchUrl);

            contentArea.innerHTML = newContent.innerHTML;
            contentArea.style.opacity = '1';

            closeMobileMenu();
            
            if (pushToHistory) {
                window.history.pushState({ path: targetUrl }, '', targetUrl);
            }

            if (targetHash) {
                setTimeout(() => {
                    scrollToAnchor(targetHash);
                }, 100);
            } else {
                window.scrollTo({ top: 0, behavior: 'instant' });
            }

            return true;

        } catch (error) {
            console.error('Navigációs hiba:', error);
            window.location.href = targetUrl;
            return false;
        }
    }

    // Navigáció
    function updateActiveNavLinks(currentUrl) {
        const currentPath = new URL(currentUrl, window.location.origin).pathname;

        document.querySelectorAll('nav a').forEach(link => {
            const linkPath = new URL(link.href, window.location.origin).pathname;
            const parentLi = link.closest('li');

            if (parentLi) {
                if (linkPath === currentPath) {
                    parentLi.classList.add('open');
                } else {
                    parentLi.classList.remove('open');
                }
            }
        });
    }

    // Mobil menü bezárása
    function closeMobileMenu() {
        const navMenu = document.querySelector('.hamburger-main-menu');
        const menuToggle = document.querySelector('.hamburger-menu');

        if (navMenu) {
            navMenu.classList.remove("open");
            navMenu.removeAttribute("style");
        }

        if (menuToggle) {
            menuToggle.classList.remove('open');
            const hamburgerIcon = menuToggle.querySelector('i');
            if (hamburgerIcon) {
                hamburgerIcon.className = 'fa-solid fa-bars';
            }
        }   
    }

    // Görgetés a főoldalon belüli anchor tag-el szekcióhoz
    function scrollToAnchor(targetId) {
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            const header = document.querySelector('header') || document.querySelector('nav');
            const headerOffset = header ? header.offsetHeight : 0;
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });

            closeMobileMenu();
            return true;
        }
        return false;
    }

    // Kattintás eseménykezelés
    document.addEventListener('click', (e) => {
        const hamburgerBtn = e.target.closest('.hamburger-menu');
        if (hamburgerBtn) {
            e.preventDefault();
            const navMenu = document.querySelector('.hamburger-main-menu');
            hamburgerBtn.classList.toggle('open');
            if (navMenu) navMenu.classList.toggle('open');
            return;
        }

        const submenuTrigger = e.target.closest('.submenu-trigger');
        if (submenuTrigger) {
            e.preventDefault();
            e.stopPropagation();
            const parentLi = submenuTrigger.closest('li');
            if (parentLi) {
                parentLi.classList.toggle('open');
            }
            return;
        }

        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href');


        if (
            !href || 
            href === '#' || 
            href.startsWith('javascript:') || 
            link.hasAttribute('download') ||
            href.includes('logout') ||
            href.includes('admin') ||
            window.location.pathname.includes('admin')
        ) {
            if (href === '#') e.preventDefault();
            return;
        }

        if (href.includes('#')) {
            e.preventDefault();

            const targetUrl = new URL(link.href, window.location.origin);
            const targetId = targetUrl.hash.replace('#', '');
            
            if (!targetId) return;

            const existingElement = document.getElementById(targetId);
            if (existingElement) {
                scrollToAnchor(targetId);
                
                const newFullUrl = `${window.location.pathname}${window.location.search}#${targetId}`;
                window.history.pushState({ path: newFullUrl }, '', newFullUrl);
                return;
            }

            loadPage(link.href, true);
            return;
        }

        if (link.href.startsWith(window.location.origin)) {
            e.preventDefault();
            loadPage(link.href, true);
        }
    });

    window.addEventListener('popstate', () => {
        loadPage(window.location.pathname, false);
    });
}