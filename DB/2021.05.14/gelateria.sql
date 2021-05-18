-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 14, 2021 alle 18:10
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gelateria`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `allergene`
--

CREATE TABLE `allergene` (
  `ID` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `allergene`
--

INSERT INTO `allergene` (`ID`, `nome`) VALUES
(15, 'crostacei'),
(11, 'frutta secca'),
(13, 'glutine'),
(3, 'latticini'),
(1, 'uova');

-- --------------------------------------------------------

--
-- Struttura della tabella `ingrediente`
--

CREATE TABLE `ingrediente` (
  `ID` int(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `sigla` varchar(10) DEFAULT NULL,
  `IDAllergene` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ingrediente`
--

INSERT INTO `ingrediente` (`ID`, `nome`, `sigla`, `IDAllergene`) VALUES
(6, 'Sale', '', 0),
(9, 'Noci e mandorle', '', 11),
(10, 'Latte', '', 3),
(36, '', '', 0),
(39, 'Farina', 'E2003', 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `ID` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `quantitaDisponibile` int(3) DEFAULT NULL,
  `immagine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`ID`, `nome`, `quantitaDisponibile`, `immagine`) VALUES
(87, 'Stracciatella', 0, ''),
(91, 'Canoli', 9, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_ingrediente`
--

CREATE TABLE `prodotto_ingrediente` (
  `ID` int(10) NOT NULL,
  `IDProdotto` int(10) NOT NULL,
  `IDIngrediente` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto_ingrediente`
--

INSERT INTO `prodotto_ingrediente` (`ID`, `IDProdotto`, `IDIngrediente`) VALUES
(1, 10, 56),
(2, 10, 56),
(3, 9, 56),
(4, 9, 56),
(5, 9, 69),
(6, 10, 76),
(7, 31, 76),
(10, 82, 10),
(11, 83, 6),
(12, 85, 10),
(13, 85, 32),
(72, 80, 9),
(73, 80, 6),
(89, 90, 6),
(90, 93, 39),
(91, 93, 10),
(92, 87, 36),
(93, 87, 10),
(94, 94, 39),
(95, 97, 39),
(96, 98, 39),
(97, 102, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `Amministratore` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `allergene`
--
ALTER TABLE `allergene`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE NOME` (`nome`);

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE NOME` (`nome`),
  ADD KEY `FOREIGN KEY ALLERGENE` (`IDAllergene`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE NOME` (`nome`);

--
-- Indici per le tabelle `prodotto_ingrediente`
--
ALTER TABLE `prodotto_ingrediente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FOREIGN KEY PRODOTTO` (`IDProdotto`),
  ADD KEY `FOREIGN KEY INGREDIENTE` (`IDIngrediente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE_Utente` (`nome`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `allergene`
--
ALTER TABLE `allergene`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT per la tabella `prodotto_ingrediente`
--
ALTER TABLE `prodotto_ingrediente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
