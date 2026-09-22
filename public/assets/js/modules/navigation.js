// Hamburger menü
export function initNavigation() {

    const hamburgerBtn = document.querySelector(".hamburger-menu");
    const mainMenu = document.querySelector(".hamburger-main-menu");

    if (hamburgerBtn && mainMenu) {
        hamburgerBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            hamburgerBtn.classList.toggle("open");
            mainMenu.classList.toggle("open");
        });
    }

    const mobileSubmenuTriggers = document.querySelectorAll(".submenu-trigger");
    mobileSubmenuTriggers.forEach(trigger => {
        trigger.addEventListener("click", (e) => {
        
            e.preventDefault();
            e.stopPropagation();

            const parentLi = trigger.closest("li");

            if (parentLi) {
                parentLi.classList.toggle("open");
            }       
        });
    })


    const desktopServiceLink = document.querySelector(".main-menu > li > a[href='#']");
    if (desktopServiceLink) {
        desktopServiceLink.addEventListener("click", (e) => {
            e.preventDefault();
        });
    }

    // Resize - reset menu
    window.addEventListener("resize", () => {
        if (window.innerWidth > 1200) {

            if (mainMenu) {
                mainMenu.classList.remove("open");
                mainMenu.removeAttribute("style");
            } 

            document.querySelectorAll(".hamburger-main-menu li.open").forEach(li => {
                li.classList.remove("open");
            });

            if (hamburgerBtn) {
                hamburgerBtn.classList.remove("open");
                const icon = hamburgerBtn.querySelector("i");
                if (icon) {
                    icon.classList.remove("fa-times");
                    icon.classList.add("fa-bars");
                }
            }
        }
    });
}