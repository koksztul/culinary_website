-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Lip 2019, 15:44
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kuchnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przepisy`
--

CREATE TABLE `przepisy` (
  `id_przep` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `przygotowanie` text COLLATE utf8_polish_ci NOT NULL,
  `skladniki` text COLLATE utf8_polish_ci NOT NULL,
  `img` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `przepisy`
--

INSERT INTO `przepisy` (`id_przep`, `nazwa`, `przygotowanie`, `skladniki`, `img`) VALUES
(1, 'CHŁODNIK', 'Warzywa umyć i osuszyć. Ogórki obrać ze skórki i zetrzeć na tarce o większych oczkach. Rzodkiewki tak samo zetrzeć. Włożyć do miski.;\r\nDodać drobo poszatkowane liście sałaty, szczypiorek, koperek oraz obrany i przeciśnięty przez praskę lub drobno starty czosnek.;\r\nDodać kefir, doprawić solą oraz pieprzem i wymieszać. Schłodzić w lodówce.', '2 mniejsze ogórki gruntowe, 4 rzodkiewki, 2 liście sałaty, 3 łyżki posiekanego szczypiorku, 2 łyżki posiekanego koperku, 1 mały ząbek czosnku, 500 ml kefiru (schłodzony), sól i pieprz', 'chlodnik'),
(2, 'SAŁATKA Z TRUSKAWKAMI I RICOTTĄ', 'Truskawki umyć, osuszyć, oderwać szypułki, pokroić na ćwiartki.;\r\nRoszponkę umyć i osuszyć. Ułożyć na 2 salaterkach i posypać truskawkami, łyżeczką wyłożyć ser.;\r\nWymieszać składniki winegretu, doprawić solą i świeżo zmielonym pieprzem, polać do sałatce.;\r\nPosypać zrumienionymi na suchej patelni płatkami migdałów.', '300 g truskawek,3 garście roszponki,150 g sera ricotta,4 łyżki płatków migdałów,2 łyżki miodu,3 łyżki oliwy extra vergine,4 łyżki soku z cytryny,2 łyżeczki świeżo startego imbiru', 'salatka_z_truskawkami'),
(3, 'ZUPA Z SOCZEWICY Z ZIEMNIAKAMI I KURCZAKIEM', 'Truskawki umyć, osuszyć, oderwać szypułki, pokroić na ćwiartki.;\r\nRoszponkę umyć i osuszyć. Ułożyć na 2 salaterkach i posypać truskawkami, łyżeczką wyłożyć ser.;\r\nWymieszać składniki winegretu, doprawić solą i świeżo zmielonym pieprzem, polać do sałatce.;\r\nPosypać zrumienionymi na suchej patelni płatkami migdałów.', '2 łyżki oliwy,\r\n1 cebula,\r\n1 marchewka,\r\n2 litry bulionu,\r\n1/2 szklanki czerwonej soczewicy,\r\n3 ziemniaki,\r\npo 1/2 łyżeczki pieprzu, kurkumy, papryki, słodkiej i oregano,\r\n1 pojedynczy filet z kurczaka,\r\n2/3 szklanki przecieru pomidorowego', 'zupa_z_soczewicy'),
(4, 'BURGERY Z KURCZAKA Z PAPRYKĄ I KUKURYDZĄ', 'Filety oczyścić z błonek i kostek, pokroić na kawałki, rozdrobnić w melakserze lub pojemniku rozdrabniacza lub posiekać na desce.;\r\nWłożyć do miski, dodać przeciśnięty przez praskę czosnek oraz drobno posiekaną natkę pietruszki. Doprawić solą, pieprzem, oregano i papryką w proszku. Dokładnie wymieszać.;\r\nDodać pokrojoną w kosteczkę paprykę, odcedzoną kukurydzę oraz jajko i ponownie wyrobić. Uformować nieduże kotleciki mocząc ręce w chłodnej wodzie.;\r\nRozgrzać patelnię z olejem i smażyć burgery po ok. 5 minut z każdej strony, lub też obtoczyć je w oleju / oliwie i kłaść na suchą patelnię.', '1 podwójny filet z kurczaka (ok. 450 g),\r\n2 ząbki czosnku,\r\n1 łyżka oregano, 1 łyżeczka słodkiej ,papryki, 1/2 łyżeczki ostrej (lub do smaku),\r\n4 gałązki natki pietruszki,\r\n1 czerwona papryka,\r\n1/2 szklanki kukurydzy,\r\n1 jajko,\r\nolej roślinny do smażenia', 'burgery_z_kurczaka'),
(5, 'KOTLETY MIELONE Z INDYKA', 'Filet indyka zmielić w maszynce do mielenia mięsa z sitkiem o większych oczkach (lub poprosić o zmielenie w sklepie).;\r\nBułkę namoczyć w mleku (ok. 1 szklanka, ok. 10 - 15 minut w zależności od twardości pieczywa). Odcisnąć i przełożyć do miski z mięsem.;\r\nDodać cebulę - obraną i startą na tarce o małych oczkach oraz jajko. Doprawić solą, pieprzem i dokładnie wyrobić ręką na dość luźną masę.;\r\nNabierać porcje mięsa, uformować zgrubnie w dłoniach, obtoczyć w bułce tartej, ponownie poprawić kształt kotleta i kłaść na rozgrzaną patelnię z tłuszczem.;\r\nSmażyć za złoty kolor przez kilka minut, delikatnie przewrócić na łopatce i powtórzyć smażenie z drugiej strony. Powtórzyć z resztą mięsa.', '700 g mielonego filetu z indyka,\r\n1 bułka np. czerstwa kajzerka,\r\nmleko do namoczenia,\r\n1 cebula,\r\n1 jajko,\r\nsól i pieprz,\r\nbułka tarta,\r\ntłuszcz do smażenia', 'kotlety_mielone_z_indyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przep_users`
--

CREATE TABLE `przep_users` (
  `id_przepuser` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_przep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `przep_users`
--

INSERT INTO `przep_users` (`id_przepuser`, `id_user`, `id_przep`) VALUES
(93, 2, 1),
(94, 2, 2),
(95, 4, 1),
(96, 4, 3),
(97, 4, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pyt`
--

CREATE TABLE `pyt` (
  `id_pyt` int(11) NOT NULL,
  `pytanie` text COLLATE utf8_polish_ci NOT NULL,
  `odpa` text COLLATE utf8_polish_ci NOT NULL,
  `odpb` text COLLATE utf8_polish_ci NOT NULL,
  `odpc` text COLLATE utf8_polish_ci NOT NULL,
  `odpd` text COLLATE utf8_polish_ci NOT NULL,
  `poprawna` text COLLATE utf8_polish_ci NOT NULL,
  `img` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pyt`
--

INSERT INTO `pyt` (`id_pyt`, `pytanie`, `odpa`, `odpb`, `odpc`, `odpd`, `poprawna`, `img`) VALUES
(1, 'Jak nazywał się amerykański lekarz który wynalazł masło orzechowe oraz płatki śniadaniowe?', 'Joseph A. Campbell', 'Sylvester Graham', 'Henri Nestlé', 'John Harvey Kellogg', 'John Harvey Kellogg', 'platki'),
(3, 'Piwa Trapistów to tradycyjne piwa klasztorne wywodzące się z których krajów?', 'Niemiec i Czech', 'Austrii i Węgier', 'Belgii i Holandii', 'Portugalii i Hiszpanii', 'Belgii i Holandii', 'piwo'),
(5, 'Od imienia której królowej pochodzi nazwa pizzy Margherita?', 'Małgorzata II z Hainaut', 'Małgorzata Parmeńska', 'Małgorzata Habsburg', 'Małgorzata Sabaudzka', 'Małgorzata Sabaudzka', 'pizza'),
(6, '&#34;Hiszpański ptaszek&#34; to danie kuchni...?', 'czeskiej', 'hiszpańskiej', 'niemieckiej', 'peruwiańskiej', 'czeskiej', 'ptaszek'),
(8, 'Bryzol to gatunek?', 'mięsa', 'sera oscypka', 'kiełbasy', 'knedla zawijańca', 'mięsa', 'bryzol'),
(9, 'Ci panowie wytwarzają Mochi co to takiego?', 'kluski', 'makaron', 'wino z ryżu', 'kiszą/szatkują kapustę', 'kluski', 'kluski'),
(12, 'Gdzie się udasz by zjeść deser Cannolo?', 'Sycylia', 'Rzym', 'Wenecja', 'Ateny', 'Sycylia', 'Cannolo'),
(13, 'Z której rośliny przyrządza się salep, napój popularny w kuchni tureckiej i bałkańskiej?', 'storczyk męski\r\n', 'topinambur', 'imbir lekarski\r\n', 'ostryż długi\r\n', 'storczyk męski', 'storczyk'),
(15, 'Jak nazywamy metalową rurkę przeznaczoną do picia yerba mate?', 'cigni', 'chawan', 'bombilla', 'matero', 'bombilla', 'bombilla');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `pass` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `user`, `pass`, `email`, `id_group`) VALUES
(1, 'janusz', 'qwe321', 'janusz@o2.pl', 0),
(2, 'admin', '$2y$10$7AimCHiEfOvr5Omk2sY64O1dMD5qkq2TI3YipFl8mZTYqCnWdDcia', 'sdfsdf@o2.pl', 2),
(3, 'moderator', '$2y$10$W/Yp8wRc3Svq4jauDMzhouqWJ52a5lr26JfStDXM4LTrA5qORoVDS', 'moderator@o2.pl', 1),
(4, 'user', '$2y$10$200a7KmRZd7of03/IbNK/e4tthb/5ktRpuRtv7dTNg.sZnsGldlQa', 'user@o2.p', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `przepisy`
--
ALTER TABLE `przepisy`
  ADD PRIMARY KEY (`id_przep`);

--
-- Indeksy dla tabeli `przep_users`
--
ALTER TABLE `przep_users`
  ADD PRIMARY KEY (`id_przepuser`);

--
-- Indeksy dla tabeli `pyt`
--
ALTER TABLE `pyt`
  ADD PRIMARY KEY (`id_pyt`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `przepisy`
--
ALTER TABLE `przepisy`
  MODIFY `id_przep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `przep_users`
--
ALTER TABLE `przep_users`
  MODIFY `id_przepuser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT dla tabeli `pyt`
--
ALTER TABLE `pyt`
  MODIFY `id_pyt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
