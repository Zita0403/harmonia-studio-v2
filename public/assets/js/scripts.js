document.addEventListener("DOMContentLoaded", function () {
    const currentYear = document.getElementById("current-year");
    if (currentYear) {
        currentYear.textContent = new Date().getFullYear();
    }
    // Cookie elfogadás ellenőrzése
    const cookieConsent = localStorage.getItem("cookieConsent");
    const modal = document.querySelector(".modal");

    if (cookieConsent !== "accepted" && cookieConsent !== "rejected") {
        modal.style.display = "block";
    } else {
        modal.style.display = "none";
    }

    // Cookie modal gombok
    document.querySelectorAll(".btn").forEach(button => {
        button.addEventListener("click", function () {
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

    // Scroll-to-top gomb
    const toTop = document.querySelector(".to-top");

    if (toTop) {
        // Alap stílus beállítása
        toTop.style.opacity = "0";
        toTop.style.visibility = "hidden";
        toTop.style.transition = "opacity 0.3s ease, visibility 0.3s ease";

        // Görgetés figyelése
        window.addEventListener("scroll", function () {
            if (window.scrollY >= 100) {
                toTop.style.opacity = "1";
                toTop.style.visibility = "visible";
            } else {
                toTop.style.opacity = "0";
                toTop.style.visibility = "hidden";
            }
        });

        // Kattintás: lap tetejére
        toTop.addEventListener("click", function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    // Hamburger menü
    const hamburger = document.querySelector(".hamburger-menu");
    const mainMenu = document.querySelector(".hamburger-main-menu");
    const hamburgerIcon = hamburger.querySelector("i");

    hamburger.addEventListener("click", function () {
        if (mainMenu.style.display === "block") {
            mainMenu.style.display = "none";
        } else {
            mainMenu.style.display = "block";
        }
        hamburger.classList.toggle("open");
        // hamburgerIcon.classList.toggle("fa-bars");
        hamburgerIcon.classList.toggle("fa-times");
    });

    // Almenü toggle
    document.querySelectorAll(".hamburger-main-menu > li").forEach(li => {
        const submenu = li.querySelector(".hamburger-submenu");
        const link = li.querySelector("a");
        if (submenu && link) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                document.querySelectorAll(".hamburger-submenu").forEach(s => {
                    if (s !== submenu) s.style.display = "none";
                });
                submenu.style.display = submenu.style.display === "block" ? "none" : "block";
            });
        }
    });

    // Resize - reset menu
    window.addEventListener("resize", function () {
        if (window.innerWidth > 1200) {
            mainMenu.removeAttribute("style");
            document.querySelectorAll(".hamburger-submenu").forEach(sub => sub.removeAttribute("style"));
            hamburger.classList.remove("open");
            hamburgerIcon.classList.remove("fa-times");
            hamburgerIcon.classList.add("fa-bars");
        }
    });

    // Hover animáció
    document.querySelectorAll(".special-treatments").forEach(item => {
        item.addEventListener("mouseenter", () => {
            item.style.transform = "scale(1.1)";
            item.style.transition = "transform 0.3s";
        });
        item.addEventListener("mouseleave", () => {
            item.style.transform = "scale(1)";
        });
    });

    // Session warning
    const sessionTimeout = 900000;
    const warningTime = sessionTimeout - 120000;

    setTimeout(() => {
        alert("A munkamenet 2 percen belül lejár. Kattintson bárhová az oldalon a hosszabbításhoz.");
    }, warningTime);

    // // Session frissítés
    // document.addEventListener("click", function () {
    //     fetch(BASE_URL + 'app/config/refresh_session.php')
    // });
});