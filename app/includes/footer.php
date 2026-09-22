<?php
require_once dirname(__DIR__) . '/constans/constans.php';
?>
</main>
    <!-- Modal, alert -->
    <div id="session-modal" class="modal-overlay" style="display: none;">
        <div class="modal-card">
            <h3>Munkamenet lejárata</h3>
            <p>A munkameneted 2 percen belül lejár inaktivitás miatt.</p>
            <button type="button" id="extend-session-btn" class="btn primary">Munkamenet meghosszabbítása</button>
        </div>
    </div>
    <!-- Modal, cookie policy -->
    <div class="modal">
        <div></div>
            <div>           
                Kedves Látogató! Az oldalunk a felhasználói élmény javítása érdekében sütiket használ. Ezek a sütik segítenek az oldal működésének biztosításában, statisztikai adatok gyűjtésében, valamint az Ön igényeire szabott tartalom megjelenítésében. A böngészés folytatásával hozzájárul a sütik használatához. További információt a <a href="<?php echo BASE_URL . 'cookie-policy'; ?>">Süti szabályzatban</a> talál.
            </div>
            <div class="btns">
                <div>
                    <button type="button" class="btn accept" aria-label="Az összes süti elfogadása.">Az összes cookie engedélyezése</button>
                    <button type="button" class="btn reject" aria-label="Az összes süti elutasítása.">Az összes cookie elutasítása</button>
                </div>
            </div>
    </div>
    <footer id="contact">
        <div class="footer-top">
            <div class="bottom-logo-container">
                <a href="<?php BASE_URL; ?>" aria-label="Vissza a főoldalra."><img src="<?php echo BASE_URL . 'assets/images/HS-logo.png'; ?>" alt="Harmónia Stúdió logója"></a>
            </div>
            <div class="footer-navigation">
                <h4>Elérhetőség</h4>
                <div>
                    <ul>
                        <li>0000 Tesztváros, Példa utca 1.</li>
                        <li>Telefonszám: +36 00 000 0000</li>
                        <li>E-mail: fiktivcim@gmail.com</li>
                    </ul>
                </div>
                <div class="brands-icons">
                    <i class="fa-facebook"></i>
                    <i class="fa-pinterest"></i>
                    <i class="fa-square-instagram"></i>
                </div>
            </div>
            <div class="footer-navigation">
                <h4>Nyitvatartás</h4>
                <div>
                    <ul>
                        <li>Hétfő - Péntek: 8:00 - 19:00</li>
                        <li>Szombat: 8:00 - 14:00</li>
                        <li>Vasárnap: Zárva</li>
                    </ul>
                </div>
            </div>
            <div class="footer-navigation">
                <h4>További információk</h4>
                <div>
                    <ul>
                        <li>Ingyenes parkolási lehetőség.</li>
                        <li>Kényelmes tömegközlekedési megközelíthetőség.</li>
                        <li>Ajándékutalványok vásárolhatók.</li>
                        <li>Előjegyzés javasolt.</li>
                        <li>Adatvédelmi nyilatkozat.</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <div class="map"></div> -->
        <div class="footer-bottom">
            <p>© 2024–<span id="current-year"></span> Harmónia Stúdió. Minden jog fenntartva.</p>
        </div>
    </footer>
    <script type="module" src="<?= BASE_URL; ?>assets/js/scripts.js" defer></script>
</body>
</html>