// Scroll-to-top
export function initScrollToTop() {
    const toTop = document.querySelector(".to-top");
    if (toTop) {
        // Alap stílus beállítása
        toTop.style.opacity = "0";
        toTop.style.visibility = "hidden";
        toTop.style.transition = "opacity 0.3s ease, visibility 0.3s ease";

        // Görgetés figyelése
        window.addEventListener("scroll", () => {
            const isScrolled = window.scrollY >= 100;
            toTop.style.opacity = isScrolled ? "1" : "0";
            toTop.style.visibility = isScrolled ? "visible" : "hidden";
        });

        // Kattintás: lap tetejére
        toTop.addEventListener("click", function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }
}  