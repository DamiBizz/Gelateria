-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 24, 2021 alle 23:54
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 8.0.6

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
(19, 'Arachidi'),
(22, 'Frutta a guscio'),
(17, 'Glutine'),
(21, 'Latte'),
(20, 'Soia'),
(18, 'Uova');

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
(41, 'Latte', '', 21),
(42, 'Zucchero', '', 0),
(43, 'Cioccolato', '', 0),
(44, 'Burro', '', 21),
(45, 'Yogurt', '', 21),
(46, 'Fragola', '', 0),
(47, 'Mela', '', 0),
(48, 'Melone', '', 0),
(49, 'Limone', '', 0),
(50, 'Lampone', '', 0),
(51, 'Cocco', '', 0),
(52, 'Menta', '', 0),
(53, 'Destrosio', '', 0),
(54, 'Acqua', '', 0),
(55, 'Tourlo', '', 18),
(56, 'Albume', '', 18),
(57, 'Caffè', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `ID` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `estensione_img` varchar(10) NOT NULL,
  `text` varchar(500) DEFAULT NULL,
  `disponibile` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_ingrediente`
--

CREATE TABLE `prodotto_ingrediente` (
  `ID` int(10) NOT NULL,
  `IDProdotto` int(10) NOT NULL,
  `IDIngrediente` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `ruolo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `nome`, `pwd`, `ruolo`) VALUES
(4, 'Damiano', '1fbfce0adf5096c4c51c526903bf58bb904db31c9f2ee1fdebd50227ed9fade1', 1),
(6, 'gab', '1c3f28b9d0988172ca778c8afa2b0746c7856d2e3dc6993135f0af1b6ee44705', 1),
(15, 'a', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 0),
(16, 'b', '3e23e8160039594a33894f6564e1b1348bbd7a0088d42c4acb73eeaed59c009d', 1),
(17, 'Giulia', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 0);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT per la tabella `prodotto_ingrediente`
--
ALTER TABLE `prodotto_ingrediente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
