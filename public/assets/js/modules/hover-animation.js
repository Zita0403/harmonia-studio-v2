// Hover animáció
export function initHoverAnimation() {
    document.querySelectorAll(".special-treatments").forEach(item => {
        item.addEventListener("mouseenter", () => {
            item.style.transform = "scale(1.1)";
            item.style.transition = "transform 0.3s";
        });
        item.addEventListener("mouseleave", () => {
            item.style.transform = "scale(1)";
        });
    });
}