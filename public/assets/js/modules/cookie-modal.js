// Cookie elfogadás
export function initCookieModal() {
    const modal = document.querySelector(".modal");
    if (modal) {
        const cookieConsent = localStorage.getItem("cookieConsent");
        modal.style.display = cookieConsent !== "accepted" && cookieConsent !== "rejected" ? "block" : "none";

        modal.querySelectorAll(".btn").forEach(button => {
            button.addEventListener("click", () => {
                if (button.classList.contains("accept")) {
                    localStorage.setItem("cookieConsent", "accepted");
                } else if (button.classList.contains("reject")) {
                    localStorage.setItem("cookieConsent", "rejected");
                }
                modal.style.transition = "opacity 0.5s";
                modal.style.opacity = "0";
                setTimeout(() => modal.style.display = "none", 500);
            });
        });
    }
}