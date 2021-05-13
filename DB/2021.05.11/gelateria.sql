-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 11, 2021 alle 23:27
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

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore`
--

CREATE TABLE `fornitore` (
  `ID` int(10) NOT NULL,
  `nomeFornitore` varchar(30) NOT NULL,
  `telefonoFornitore` varchar(18) DEFAULT NULL,
  `emailFornitore` varchar(40) DEFAULT NULL,
  `pecFornitore` varchar(40) DEFAULT NULL,
  `sede` varchar(90) DEFAULT NULL,
  `rappresentante` varchar(30) DEFAULT NULL,
  `telefonoRappresentante` varchar(18) DEFAULT NULL,
  `emailRappresentante` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitore_merce`
--

CREATE TABLE `fornitore_merce` (
  `ID` int(10) NOT NULL,
  `data` varchar(10) NOT NULL,
  `prezzo` float NOT NULL,
  `quantità` int(2) NOT NULL,
  `IDFornitore` int(10) NOT NULL,
  `IDMerce` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `merce`
--

CREATE TABLE `merce` (
  `ID` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `quantitaResidua` float NOT NULL,
  `UnitàDiMisura` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `ID` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `immagine` varchar(100) DEFAULT NULL,
  `quantitaDisponibile` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`ID`, `nome`, `immagine`, `quantitaDisponibile`) VALUES
(1, 'Nocciola', NULL, NULL),
(3, 'Damiano', NULL, NULL),
(7, 'Luigi', NULL, NULL),
(8, 'Mario', NULL, NULL);

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
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `allergene`
--
ALTER TABLE `allergene`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE NOME` (`nome`);

--
-- Indici per le tabelle `fornitore`
--
ALTER TABLE `fornitore`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE NOME FORNITORE` (`nomeFornitore`);

--
-- Indici per le tabelle `fornitore_merce`
--
ALTER TABLE `fornitore_merce`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FOREIGN KEY FORNITORE` (`IDFornitore`),
  ADD KEY `FOREIGN KEY MERCE` (`IDMerce`);

--
-- Indici per le tabelle `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE NOME` (`nome`),
  ADD KEY `FOREIGN KEY ALLERGENE` (`IDAllergene`);

--
-- Indici per le tabelle `merce`
--
ALTER TABLE `merce`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE NOME` (`nome`);

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
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `allergene`
--
ALTER TABLE `allergene`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `fornitore`
--
ALTER TABLE `fornitore`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `fornitore_merce`
--
ALTER TABLE `fornitore_merce`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `merce`
--
ALTER TABLE `merce`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `prodotto_ingrediente`
--
ALTER TABLE `prodotto_ingrediente`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
