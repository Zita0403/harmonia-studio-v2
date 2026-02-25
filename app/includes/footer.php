<?php
require_once dirname(__DIR__) . '/constans/constans.php';
?>
</main>
<!-- Modal, demonstráció -->
    <div class="modal">
        <div></div>
            <div>           
                Kedves Látogató! Az oldalunk a felhasználói élmény javítása érdekében sütiket használ. Ezek a sütik segítenek az oldal működésének biztosításában, statisztikai adatok gyűjtésében, valamint az Ön igényeire szabott tartalom megjelenítésében. A böngészés folytatásával hozzájárul a sütik használatához. További információt a <a href="<?php echo BASE_URL . 'cookie-policy'; ?>">Süti szabályzatban</a> talál.
            </div>
            <div class="btns">
                <div>
                    <button class="btn accept">Az összes cookie engedélyezése</button>
                    <button class="btn reject">Az összes cookie elutasítása</button>
                </div>
            </div>
    </div>
    <footer id="contact">
        <div class="footer-top">
            <div class="bottom-logo-container">
                <a href="<?php BASE_URL; ?>"><img src="<?php echo BASE_URL . 'assets/images/HS-logo.png'; ?>" alt="Harmónia Stúdió logója"></a>
            </div>
            <div class="footer-navigation">
                <h4>Elérhetőség</h4>
                <div>
                    <ul>
                        <li>6723 Szeged, Felső Tisza-Part</li>
                        <li>Telefonszám: +36 20 432-1234</li>
                        <li>E-mail: fiktivcim@gmail.com</li>
                    </ul>
                </div>
                <div class="brands-icons">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-pinterest"></i>
                    <i class="fa-brands fa-square-instagram"></i>
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
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2758.5771045272263!2d20.166039275805925!3d46.25863428008429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4744883e02a029df%3A0xed22b73477369d4!2sSzeged%2C%20Fels%C5%91%20Tisza-Part!5e0!3m2!1shu!2shu!4v1721307233808!5m2!1shu!2shu" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="footer-bottom">
            <p>© <script>document.write(new Date().getFullYear())</script> Harmónia Stúdió. All Right Reserved.</p>
        </div>
    </footer>
    <script src="<?= BASE_URL; ?>assets/scripts/scripts.js" defer></script>
</body>
</html>