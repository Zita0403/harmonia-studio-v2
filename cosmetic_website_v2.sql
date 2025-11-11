-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Feb 03. 18:53
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cosmetic_website_v2`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `argument`
--

CREATE TABLE `argument` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `argument`
--

INSERT INTO `argument` (`id`, `content`) VALUES
(1, 'A kezelés menetét minden esetben a bőrődnek és igényeidnek megfelelően állítom fel.'),
(2, 'Kizárólag prémium minőségű, bio- és organikus kozmetikumokkal dolgozom.'),
(3, 'Rendszeresen szakmai továbbképzéseken veszek részt, hogy mindig a lehető legjobbat nyújthassam.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `highlighted_treatment`
--

CREATE TABLE `highlighted_treatment` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `highlighted_treatment`
--

INSERT INTO `highlighted_treatment` (`id`, `title`, `description`, `image_path`, `category_id`, `position`) VALUES
(1, 'Mezoterápia', 'A mezoterápia egy olyan kozmetikai kezelés, amely során vitaminokat, ásványi anyagokat, aminosavakat és egyéb hatóanyagokat tartalmazó mikroinjekciókat juttatnak közvetlenül a bőr középső rétegébe (mezodermába). Ez a technika segít a bőr fiatalításában, hidratálásában és feszesítésében, valamint csökkenti a finom ráncokat és a bőr elszíneződését. A mezoterápia nemcsak az arc, hanem a nyak, a dekoltázs és a kézfej bőrének kezelésére is alkalmazható. Eredményei már néhány kezelés után láthatók, hosszabb távú hatásai pedig kúraszerű alkalmazással érhetők el.', 'treatment_1738351851.jpg', 1, 0),
(2, 'Cellulitkezelés', 'A cellulitkezelés célja a bőr alatti zsírsejtek felhalmozódásának és a kötőszövetek egyenetlenségeinek csökkentése, hogy simább és feszesebb bőrfelületet érjünk el. A rádiófrekvenciás kezelések serkentik a vér- és nyirokkeringést, fokozzák a zsírsejtek lebontását és javítják a bőr textúráját. A cellulitkezelés hatékonysága egyénenként változhat, és több kezelésre is szükség lehet a kívánt hatás eléréséhez.', 'treatment_1738351898.jpg', 2, 0),
(3, 'Lézeres szőrtelenítés', 'A lézeres szőrtelenítés egy hosszú távú szőrtelenítési módszer, amely során koncentrált fénysugarakat (lézert) használnak a szőrtüszők elpusztítására. A lézer energiája a szőrszálak pigmentjében (melanin) nyelődik el, ami a szőrtüszők károsodásához és végül a szőr növekedésének megállításához vezet. A tartós eredmény eléréséhez több kezelési alkalom szükséges, mivel a szőrszálak különböző növekedési fázisokban vannak. A lézeres szőrtelenítés gyors, és az alkalmazott technológiától függően általában kevés fájdalommal jár, bár néhányan enyhe kellemetlenséget vagy bőrpírt tapasztalhatnak a kezelés után.', 'treatment_1738351941.jpg', 3, 0),
(4, 'Alkalmi smink', 'Tökéletes smink különleges alkalmakra.', 'treatment_1738351953.jpg', 4, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `home_page_section`
--

CREATE TABLE `home_page_section` (
  `id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `home_page_section`
--

INSERT INTO `home_page_section` (`id`, `section_name`, `content`) VALUES
(1, 'welcome', 'Szeretettel üdvözöllek az oldalon!'),
(2, 'about', 'Mindig is közel állt hozzám a szépségápolás, célul tűztem ki, hogy munkámat mindig vendégeim teljes megelégedettségére, személyre szabottan végezzem. Hiszem, hogy az élet minden területén fontos a minőség, éppen ezért a professzionális kozmetikai gépek és eszközök mellett a bio- és organikus, magyar kozmetikumok mellett tettem le a voksomat. Szakmám folyamatos, dinamikus fejlődésre sarkall, így rendszeresen veszek részt továbbképzéseken, ezzel biztosítva, hogy a leginnovatívabb és legjobb megoldásokat, eljárásokat nyújthassam vendégeim számára.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `login_data`
--

CREATE TABLE `login_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `login_data`
--

INSERT INTO `login_data` (`id`, `email`, `password`) VALUES
(1, 'admin@example.com', '$2y$10$2wuDgdBM.JuRLF1lxJECv.3X9qGwNXq5xC2n3hWEkqzdoM0C7C7VO');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `treatment_categories`
--

CREATE TABLE `treatment_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `treatment_categories`
--

INSERT INTO `treatment_categories` (`id`, `name`) VALUES
(1, 'Arckezelések'),
(4, 'Sminkelés'),
(3, 'Szőreltávolítás'),
(2, 'Testkezelések');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `argument`
--
ALTER TABLE `argument`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `highlighted_treatment`
--
ALTER TABLE `highlighted_treatment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- A tábla indexei `home_page_section`
--
ALTER TABLE `home_page_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_name` (`section_name`);

--
-- A tábla indexei `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `treatment_categories`
--
ALTER TABLE `treatment_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `argument`
--
ALTER TABLE `argument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `highlighted_treatment`
--
ALTER TABLE `highlighted_treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `home_page_section`
--
ALTER TABLE `home_page_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `login_data`
--
ALTER TABLE `login_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `treatment_categories`
--
ALTER TABLE `treatment_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `highlighted_treatment`
--
ALTER TABLE `highlighted_treatment`
  ADD CONSTRAINT `highlighted_treatment_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `treatment_categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
