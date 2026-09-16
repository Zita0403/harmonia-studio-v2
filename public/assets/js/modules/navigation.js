// Hamburger menü
export function initNavigation() {
    const hamburger = document.querySelector(".hamburger-menu");
    const mainMenu = document.querySelector(".hamburger-main-menu");
    if (hamburger && mainMenu) {
        const hamburgerIcon = hamburger.querySelector("i");
        
        hamburger.addEventListener("click", () => {
            mainMenu.style.display = mainMenu.style.display === "block" ? "none" : "block";
            hamburger.classList.toggle("open");
            if (hamburgerIcon) {
                hamburgerIcon.classList.toggle("fa-times");
            }
        });

        // Almenü toggle
        mainMenu.querySelectorAll(":scope > li").forEach(li => {
            const submenu = li.querySelector(".hamburger-submenu");
            const link = li.querySelector("a");
            if (submenu && link) {
                link.addEventListener("click", (e) => {
                    e.preventDefault();
                    mainMenu.querySelectorAll(".hamburger-submenu").forEach(s => {
                        if (s !== submenu) s.style.display = "none";
                    });
                    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                });
            }
        });

        // Resize - reset menu
        window.addEventListener("resize", () => {
            if (window.innerWidth > 1200) {
                mainMenu.removeAttribute("style");
                document.querySelectorAll(".hamburger-submenu").forEach(sub => sub.removeAttribute("style"));
                hamburger.classList.remove("open");
                if (hamburgerIcon) {
                    hamburgerIcon.classList.remove("fa-times");
                    hamburgerIcon.classList.add("fa-bars");
                }
            }
        });
    }
}