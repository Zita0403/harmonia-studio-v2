<!-- Időpontfoglalás -->
<header>
    <h1>Időpontfoglalás</h1>
</header>
<form action="booking.php" method="post" target="_blank" id="appointmentForm">
    <div class="form-group">
        <label for="name">Név:</label>
        <input type="text" id="name" name="name" placeholder="Vezetéknév Keresztnév" required>
    </div>
    <div class="form-group">
        <label for="phoneNumber">Telefonszám:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" pattern="^\+36\s?1?\s?\d{1,2}\s?\d{6,7}$|^\+36\s?(20|30|70)\s?\d{3}\s?\d{4}$" placeholder="+36204321234" required>
    </div>
    <div class="form-group">
        <label for="email">E-mail cím:</label>
        <input type="email" id="email" name="email" placeholder="fiktivcim@gmail.com" required>
    </div>
    <div class="form-group">
        <label for="subject">Tárgy:</label>
        <select name="subject" id="subject" size="1" required>
            <option value="" disabled selected>Válasszon egy lehetőséget</option>
            <option value="arckezeles">Arckezelés</option>
            <option value="testkezeles">Testkezelés</option>
            <option value="szoreltavolitas">Szőreltávolítás</option>
            <option value="smink">Smink</option>
        </select>
    </div>
    <div class="form-group">
        <label for="message">Pontosan milyen kezelést szeretnél?</label>
        <textarea name="message" id="message" required></textarea>
    </div>
    <div class="form-group">
        <label for="date">Melyik időpont lenne alkalmas?</label>
        <input type="datetime-local" id="date" name="date" required>
    </div>
    <input type="submit" value="Küldés" class="btn click hover-effect">
</form>
<div class=" button hover-effect">
    <a href="<?= BASE_URL . 'home'; ?>">Vissza a főoldalra</a>
</div>