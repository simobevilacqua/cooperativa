-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 16, 2020 alle 16:42
-- Versione del server: 10.1.30-MariaDB
-- Versione PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `federazione`
--
CREATE DATABASE IF NOT EXISTS `federazione` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `federazione`;

-- --------------------------------------------------------

--
-- Struttura della tabella `aggiorna`
--

CREATE TABLE `aggiorna` (
  `IDutente` int(11) NOT NULL,
  `IDprogramma` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `autorizzato`
--

CREATE TABLE `autorizzato` (
  `IDutente` int(11) NOT NULL,
  `IDprogramma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `pianificazione`
--

CREATE TABLE `pianificazione` (
  `IDpianificazione` int(11) NOT NULL,
  `tipo` enum('giornaliero','settimanale','mensile') DEFAULT NULL,
  `giorno` varchar(40) DEFAULT NULL,
  `ora` time DEFAULT NULL,
  `IDprogramma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pianificazione`
--

INSERT INTO `pianificazione` (`IDpianificazione`, `tipo`, `giorno`, `ora`, `IDprogramma`) VALUES
(1, 'giornaliero', NULL, NULL, 123);

-- --------------------------------------------------------

--
-- Struttura della tabella `processo`
--

CREATE TABLE `processo` (
  `IDprocesso` int(11) NOT NULL,
  `inizio` date NOT NULL,
  `fine` date DEFAULT NULL,
  `stato` varchar(40) NOT NULL,
  `esito` varchar(40) DEFAULT NULL,
  `IDutente` int(11) DEFAULT NULL,
  `IDprogramma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `programma`
--

CREATE TABLE `programma` (
  `IDprogramma` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `descrizioneLunga` varchar(400) DEFAULT NULL,
  `IDprerequisito` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `programma`
--

INSERT INTO `programma` (`IDprogramma`, `nome`, `descrizioneLunga`, `IDprerequisito`) VALUES
(123, 'programma1', 'Descrizione lunga del programma1', NULL),
(124, 'programma2', 'Descrizione lunga', 123);

-- --------------------------------------------------------

--
-- Struttura della tabella `ricevenotifiche`
--

CREATE TABLE `ricevenotifiche` (
  `IDutente` int(11) NOT NULL,
  `IDprogramma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `IDutente` int(11) NOT NULL,
  `psw` varchar(40) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tipo` enum('utente','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`IDutente`, `psw`, `nome`, `email`, `tipo`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin'),
(2, 'user', 'user', 'user@gmail.com', 'utente');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `aggiorna`
--
ALTER TABLE `aggiorna`
  ADD PRIMARY KEY (`IDutente`,`IDprogramma`),
  ADD KEY `IDprogramma` (`IDprogramma`);

--
-- Indici per le tabelle `autorizzato`
--
ALTER TABLE `autorizzato`
  ADD PRIMARY KEY (`IDutente`,`IDprogramma`),
  ADD KEY `IDprogramma` (`IDprogramma`);

--
-- Indici per le tabelle `pianificazione`
--
ALTER TABLE `pianificazione`
  ADD PRIMARY KEY (`IDpianificazione`),
  ADD KEY `IDprogramma` (`IDprogramma`);

--
-- Indici per le tabelle `processo`
--
ALTER TABLE `processo`
  ADD PRIMARY KEY (`IDprocesso`),
  ADD KEY `IDutente` (`IDutente`),
  ADD KEY `IDprogramma` (`IDprogramma`);

--
-- Indici per le tabelle `programma`
--
ALTER TABLE `programma`
  ADD PRIMARY KEY (`IDprogramma`),
  ADD KEY `IDprerequisito` (`IDprerequisito`);

--
-- Indici per le tabelle `ricevenotifiche`
--
ALTER TABLE `ricevenotifiche`
  ADD PRIMARY KEY (`IDutente`,`IDprogramma`),
  ADD KEY `IDprogramma` (`IDprogramma`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IDutente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `pianificazione`
--
ALTER TABLE `pianificazione`
  MODIFY `IDpianificazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `processo`
--
ALTER TABLE `processo`
  MODIFY `IDprocesso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `programma`
--
ALTER TABLE `programma`
  MODIFY `IDprogramma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `IDutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `aggiorna`
--
ALTER TABLE `aggiorna`
  ADD CONSTRAINT `aggiorna_ibfk_1` FOREIGN KEY (`IDutente`) REFERENCES `utente` (`IDutente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aggiorna_ibfk_2` FOREIGN KEY (`IDprogramma`) REFERENCES `programma` (`IDprogramma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `autorizzato`
--
ALTER TABLE `autorizzato`
  ADD CONSTRAINT `autorizzato_ibfk_1` FOREIGN KEY (`IDutente`) REFERENCES `utente` (`IDutente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `autorizzato_ibfk_2` FOREIGN KEY (`IDprogramma`) REFERENCES `programma` (`IDprogramma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `pianificazione`
--
ALTER TABLE `pianificazione`
  ADD CONSTRAINT `pianificazione_ibfk_1` FOREIGN KEY (`IDprogramma`) REFERENCES `programma` (`IDprogramma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `processo`
--
ALTER TABLE `processo`
  ADD CONSTRAINT `processo_ibfk_1` FOREIGN KEY (`IDutente`) REFERENCES `utente` (`IDutente`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `processo_ibfk_2` FOREIGN KEY (`IDprogramma`) REFERENCES `programma` (`IDprogramma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `programma`
--
ALTER TABLE `programma`
  ADD CONSTRAINT `programma_ibfk_1` FOREIGN KEY (`IDprerequisito`) REFERENCES `programma` (`IDprogramma`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `ricevenotifiche`
--
ALTER TABLE `ricevenotifiche`
  ADD CONSTRAINT `ricevenotifiche_ibfk_1` FOREIGN KEY (`IDutente`) REFERENCES `utente` (`IDutente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ricevenotifiche_ibfk_2` FOREIGN KEY (`IDprogramma`) REFERENCES `programma` (`IDprogramma`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
