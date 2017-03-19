-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 mrt 2017 om 10:41
-- Serverversie: 10.1.19-MariaDB
-- PHP-versie: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` text,
  `description` text,
  `removed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `title`, `url`, `description`, `removed`) VALUES
(2, 'Classic', 'classic', 'Laat kinderen hun creativiteit ontplooien met LEGO® Classic. Sets bieden ideeën waarmee ze aan de slag kunnen en ze zijn leuk voor de hele familie!', 0),
(3, 'Creator', 'creator', 'Met de LEGO® Creator serie kan je kind eindeloos experimenteren met huizen, auto\\''s, vliegtuigen en wezens! Elke set kan op drie verschillende manieren worden gebouwd voor onbeperkt speelplezier.', 0),
(4, 'Ideas', 'ideas', 'Producten van LEGO® Ideas zijn geïnspireerd en gekozen door LEGO fans. De sets omvatten originele concepten en scènes die gebaseerd zijn op de films!', 0),
(5, 'Marvel Super Heroes', 'marvel-super-heroes', 'Met LEGO® Marvel Super Heroes wekt je kind superhelden tot leven. Ze zullen genieten van het bedenken van nieuwe avonturen voor de gekke personages.', 0),
(10, 'Test titel', 'test-titel', 'een beschrijving', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `geplaatst` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aanhef` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `naam` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tussenvoegsel` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `achternaam` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `bedrijfsnaam` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telefoonnummer` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `straat` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `huisnummer` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `woonplaats` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `geplaatst`, `aanhef`, `naam`, `tussenvoegsel`, `achternaam`, `bedrijfsnaam`, `email`, `telefoonnummer`, `straat`, `huisnummer`, `postcode`, `woonplaats`) VALUES
(144118207, '2017-03-17 14:09:20', 'dhr', 'Erik', 'van', 'Achter', 'KPN KLM', 'mail@hotmail.com', '0612094200', 'straat', '1337', '4213ET', 'Amersfoort'),
(182648251, '2017-03-17 14:13:16', 'dhr', 'asdf', 'as', 'asdf', '', 'asdf@asdfasdf.co', 'asdf', 'straat', 'asdf', 'asdf', 'asdf'),
(245757761, '2017-03-18 09:33:11', 'mvr', 'Erica', 'Van', 'Achtererica', 'NASA', 'mail@mail.com', '123124124', 'rietvelderf', '52', '3822et', 'amersfoort');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `order_products`
--

INSERT INTO `order_products` (`order_id`, `product_id`, `amount`) VALUES
(144118207, 3570561, 1),
(182648251, 5845496, 6),
(245757761, 3570561, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `removed` int(1) NOT NULL DEFAULT '0',
  `category_id` varchar(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  `ean` varchar(13) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `removed`, `category_id`, `name`, `url`, `description`, `ean`, `price`) VALUES
(9, 0, '2', 'Lego Wow', 'lego-wow', 'Een geweldige lego wow set', 'wow1234', '12.22'),
(3202500, 0, '2', 'een naam', 'lego-wow1', 'asdfasdf', 'asdfasdf', '12.00'),
(3570561, 0, '3', 'Nieuwe naam', 'nieuwe-naam', 'asjdfljasdkf', 'asdjfaskdf', '12.03'),
(5845496, 0, '2', 'Een random naam', 'een-random-naam', 'Een hele lange beschrijving', 'eannummerding', '9.99'),
(7107014, 1, '2', 'Testtttt', 'test-titel', 'Test ë <script>alert(123);</script>', '123', '10.44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$Jrh2PhQbRsfRRo9HzJb3U.0zFyWrxPe36h29RHx//bsQUVLRE8MrS', 'mail@mail.com');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_id`,`product_id`) USING BTREE;

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `products` ADD FULLTEXT KEY `price` (`price`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245757762;
--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7107015;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
