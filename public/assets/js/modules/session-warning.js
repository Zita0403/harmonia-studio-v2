// Session warning, munkamenet lejárta
export function initSessionWarning() {

    if (window.location.pathname.includes('/login')) {
        if (window.location.search.includes('reason=timeout')) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        return;
    }

    const modal = document.getElementById("session-modal");
    const extendBtn = document.getElementById("extend-session-btn");

    if (!modal || !extendBtn) return;

    const TIMEOUT_MS = 15 * 60 * 1000; // 15 perc (kijelentkeztetés)
    const WARNING_MS = 13 * 60 * 1000; // 13 perc (figyelmeztetés)
    const CHECK_INTERVAL = 5000;   // 5 mp-enként ellenőriz

    let isWarningActive = false;
    
    localStorage.setItem("lastActivity", Date.now().toString());
 
    // Aktivitás frissítése (legfeljebb 5 mp-enként ír a localStorage-ba)
    let lastThrottle = 0;
    const recordActivity = () => {
        if (isWarningActive) return;

        const now = Date.now();
        if (now - lastThrottle > 5000) {
            lastThrottle = now;
            localStorage.setItem("lastActivity", now.toString());
        }
    };

    // Eseményfigyelők az inaktivitás törlésére
    ["mousemove", "keydown", "click", "scroll"].forEach(evt => {
        window.addEventListener(evt, recordActivity, { passive: true });
    });

    // Időzítő ciklus az inaktivitás ellenőrzésére
    const sessionInterval = setInterval(() => {
        const lastActivity = parseInt(localStorage.getItem("lastActivity") || Date.now().toString(), 10);
        const idleTime = Date.now() - lastActivity;

        if (idleTime >= TIMEOUT_MS) {
            clearInterval(sessionInterval);
            localStorage.removeItem("lastActivity");
            window.location.href = "/login?reason=timeout";
        } else if (idleTime >= WARNING_MS) {
            isWarningActive = true;
            modal.style.display = "flex";
        } else {
            isWarningActive = false;
            modal.style.display = "none";
        }
    }, CHECK_INTERVAL);

    // Munkamenet meghosszabbítása gomb
    if (extendBtn) {
        extendBtn.addEventListener("click", async () => {
            try {
                const response = await fetch('/refresh_session');
                if (response.ok) {
                    localStorage.setItem("lastActivity", Date.now().toString());
                    modal.style.display = "none";
                } else {
                    window.location.href = '/login';
                }
            } catch (error) {
                console.error("Hiba a session frissítésekor:", error);
            }
        });
    }
}