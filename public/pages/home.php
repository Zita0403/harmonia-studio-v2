<!-- Üdvözlő üzenet, bemutató képekkel -->
<section class="first-section">
    <div class="salon-img-container first-salon-img-container">
    <!-- A szalont bemutató kép -->
    </div>
    <div class="welcome">
        <div class="logo-container-2">
            <a href="#"><img src="./assets/images/HS-logo.png" alt="Harmónia Stúdió logója"></a>
        </div>
            <h1>Harmónia Stúdió</h1>
            <!-- <h3>Szeretettel üdvözöllek az oldalon!</h3> -->
            <h3><?= e($welcome['content'] ?? 'Üdvözöllek az oldalon!'); ?></h3>
        </div>
    <div class="salon-img-container second-salon-img-container">
    <!-- A szalont bemutató kép -->
    </div>
</section>
<!-- Érvek -->
<section class="second-section">
    <div>
        <h2>3 érv az általam biztosított kezelések melett</h2>
        <div>
        <?php if (!empty($arguments)): ?>
            <?php foreach ($arguments as $argument): ?>
                <p><i class="fa-solid fa-seedling"></i><?= e($argument['content']); ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nincsenek elérhető érvek jelenleg.</p>
        <?php endif; ?>
        </div>
    </div>
</section>
<!-- Kiemelt kezelések -->
<section class="third-section">
<h2>Kiemelt kezelések</h2>
    <?php if (!empty($highlightedTreatments)): ?>
        <?php foreach ($highlightedTreatments as $treatment): ?>
            <article>
                <div class="special-treatments" style="background-image: url('./assets/images/<?= e($treatment['image_path']); ?>');">
                </div>
                <h3><?= e($treatment['title']); ?></h3>
                <div class="content">
                    <p><?= e($treatment['description']); ?></p>
                </div>
                <div class="category">
                    <strong>Kategória:</strong> <?= isset($treatment['category_id']) ? e(getCategoryNameById($treatment['category_id'])) : 'Nincs kategória'; ?>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Jelenleg nincsenek kiemelt kezelések.</p>
    <?php endif; ?>
</section>
<!-- Szolgáltatások -->
<section class="fourth-section" id="treatments">
    <div>
        <h2>Szolgáltatások</h2>
        <div class="services">
            <a href="<?php print BASE_URL . '/pages/facial-treatment'; ?>">
                <div class="facial-treatments service hover-effect">
                    <img src="./assets/images/face-care.png" alt="Arckezelések">
                </div>
                <h3>Arckezelések</h3>
            </a>
            <a href="<?php print BASE_URL . '/pages/body-treatment'; ?>">
                <div class="body-treatments service hover-effect">
                    <img src="./assets/images/skin-care.png" alt="Testkezelések">
                </div>
                <h3>Testkezelések</h3>
            </a>
            <a href="<?php print BASE_URL . '/pages/hair-removal'; ?>">
                <div class="hair-removal service hover-effect">
                    <img src="./assets/images/hair-removal.png" alt="Szőreltávolítás">
                </div>
                <h3>Szőreltávolítás</h3>
            </a>
            <a href="<?php print BASE_URL . '/pages/make-up'; ?>">
                <div class="make-up service hover-effect">
                    <img src="./assets/images/make-up.png" alt="Sminkelés">
                </div>
                <h3>Sminkelés</h3>
            </a>
        </div>
    </div>
</section>
<!-- Bemutatkozás -->
<section class="fifth-section" id="about">
    <h2>Rólam</h2>
    <div class="about-section">
        <div class="profile-img-container">

        </div>
            <div class="about-text">
            <?php if (!empty($about['content'])): ?>
                <p><?= nl2br(e($about['content'])); ?></p>
            <?php else: ?>
                <p>A bemutatkozó szöveg jelenleg nem elérhető.</p>
            <?php endif; ?>
            </div>
    </div>
</section>