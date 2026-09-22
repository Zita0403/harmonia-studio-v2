import { initCurrentYear } from "./modules/current-year.js";
import { initCookieModal } from "./modules/cookie-modal.js";
import { initNavigation } from "./modules/navigation.js";
import { initHoverAnimation } from "./modules/hover-animation.js";
import { initScrollToTop } from "./modules/scroll-to-top.js";
import { initSessionWarning } from "./modules/session-warning.js";
import { initSpaNavigation } from './modules/spa-navigation.js';

document.addEventListener("DOMContentLoaded", () => {
    initCurrentYear();
    initCookieModal();
    initNavigation();
    initHoverAnimation();
    initScrollToTop();
    initSessionWarning();
    initSpaNavigation();
});





