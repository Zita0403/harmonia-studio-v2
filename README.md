# Harmónia Stúdió – Adminisztrációs rendszer

![Harmónia Stúdió Admin oldal képernyőképe](assets/images/cosmetic_website_v2.png)

Ez a projekt a **Harmónia Stúdió fiktív kozmetikai szalonjának admin felületét** mutatja be, amely a **Full Stack Webfejlesztő képzés** első moduljának (HTML+CSS(+JS alapok) front-end webfejlesztő tanfolyam) végén készített **bemutató weboldalam folytatásaként** készült a második modul (PHP programozás + MySQL adatbázis képzés) záró projektjeként.

---

## Leírás

A projekt célja egy **modern, karbantartható és biztonságos adminisztrációs felület** létrehozása, amely:
- **Adatbázisban tárolja** a szolgáltatásokat és főoldali szakaszokat, kezelési kategóriákat, admin felhasználókat.
- **Admin felület** lehetőséget ad **adatok hozzáadására, módosítására és törlésére (CRUD).**
- **Bejelentkezés** jelszóhasheléssel (password_hash/password_verify) és lejáró session-ökkel.
- **Routing:** .htaccess + front controller (GET/POST útvonalak kezelése).
- **JavaScript visszaszámláló** a session lejárat kezelésére és interaktív frissítésére.
- **Moduláris függvény-orientált szerkezet**, áttekinthető könyvtár struktúrával.

---

## Könyvtárstruktúra

cosmetic_website_v2/ 
│── admin/ # Admin felület 
│── assets/ # Képek, Stílusok (A projekt SASS (.scss) fájlokat használ a stílusok kezelésére.) 
│── config/ # Adatbázis és segédfüggvények 
│── constans/ # Fájl elérési útvonalak
│── controllers/ # Kérések kezelése 
│── includes/ # Fejléc, lábléc, navigáció
│── login_system/ # Bejelentkezés és hitelesítés, kijelentkezés
│── pages/ # További oldalak (kezelések, süti kezelés, árlista, időpontfoglalás) 
│── scripts/ # Dinamikus oldalak (jQuery)
│── cosmetic_website_v2.sql # Adatbázis fájl
│── index.php # Főoldal
│── logo.ico # Az oldal logoja
│── README.md # Dokumentáció

---

## Adatbázis

### Táblák:
1. login_data - admin felhasználók (email, jelszó hash, utolsó ellenőrzés)
2. home_page_section - főoldali szakaszok (cím, tartalom)
3. highlighted_treatment - kiemelt kezelések
4. treatment_categories - kezelések kategóriái
5. argument - főoldal egyéb tartalma

Kapcsolatok: a kiemelt kezelések és a kategóriák egy-a-sokhoz relációval kapcsolódnak a főoldali szakaszon.

---

## Információk a letöltéshez, megnyitáshoz

Másold a `cosmetic_website_v2` mappát a `C:\xampp\htdocs\` könyvtárba.
A végleges elérési út: `C:\xampp\htdocs\cosmetic_website_v2\`

---

## Az adatbázis beállítása

1. Indítsd el a **XAMPP Control Panel** programot.  
2. Kattints az **Apache** és **MySQL** `Start` gombjára.
3. Nyisd meg **phpMyAdmin**-t a böngészőben: [phpMyAdmin](http://localhost/phpmyadmin/)  
4. Hozz létre egy új adatbázist cosmetic_website_v2 néven.  
5. Importáld a mellékelt **`cosmetic_website_v2.sql`** fájlt az adatbázisba.

---

## Weboldalak elérése

- [Főoldal megnyitása:](http://localhost/cosmetic_website_v2/)
- [Admin bejelentkezés:](http://localhost/cosmetic_website_v2/login_system/login.php)

---

## Bejelentkezési adatok:

- **Felhasználónév**: admin@example.com 
- **Jelszó**: Admin!123

---

## Használt technológiák

- **PHP 8.x** - backend logika, session kezelés, függvény-orientált szemlélet
- **MySQL/MariaDB** - adatbázis a tároláshoz
- **JavaScript** - session visszaszámláló, interaktív funkciók
- **HTML5 / CSS3 / SASS** - reszponzív, szematikailag helyes frontend
- **Font Awesome + Google Fonts** - esztétikus megjelenés

---

## Rendszerkövetelmények

PHP verzió: PHP 8.2.12 
Webszerver: Apache (XAMPP 8.2.12)
Adatbázis: MariaDB/MySQL

---

## Készítette
Név: Lukács Zita
Dátum: 2025. február
Modul: PHP programozás + MySQL adatbázis 