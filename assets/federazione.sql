-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 16, 2020 alle 19:34
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE IF NOT EXISTS `aggiorna` (
  `IDutente` int(11) NOT NULL,
  `IDprogramma` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`IDutente`,`IDprogramma`),
  KEY `IDprogramma` (`IDprogramma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `autorizzato`
--

CREATE TABLE IF NOT EXISTS `autorizzato` (
  `IDutente` int(11) NOT NULL,
  `IDprogramma` int(11) NOT NULL,
  PRIMARY KEY (`IDutente`,`IDprogramma`),
  KEY `IDprogramma` (`IDprogramma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `autorizzato` (`IDutente`, `IDprogramma`) VALUES
(1, 124);

-- --------------------------------------------------------

--
-- Struttura della tabella `pianificazione`
--

CREATE TABLE IF NOT EXISTS `pianificazione` (
  `IDpianificazione` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('giornaliero','settimanale','mensile') DEFAULT NULL,
  `giorno` varchar(40) DEFAULT NULL,
  `ora` time DEFAULT NULL,
  `IDprogramma` int(11) NOT NULL,
  PRIMARY KEY (`IDpianificazione`),
  KEY `IDprogramma` (`IDprogramma`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pianificazione`
--

INSERT INTO `pianificazione` (`IDpianificazione`, `tipo`, `giorno`, `ora`, `IDprogramma`) VALUES
(1, 'giornaliero', 'Martedi', '15:00:00', 124);

-- --------------------------------------------------------

--
-- Struttura della tabella `processo`
--

CREATE TABLE IF NOT EXISTS `processo` (
  `IDprocesso` int(11) NOT NULL AUTO_INCREMENT,
  `inizio` date NOT NULL,
  `fine` date DEFAULT NULL,
  `stato` varchar(40) NOT NULL,
  `esito` varchar(40) DEFAULT NULL,
  `IDutente` int(11) DEFAULT NULL,
  `IDprogramma` int(11) NOT NULL,
  PRIMARY KEY (`IDprocesso`),
  KEY `IDutente` (`IDutente`),
  KEY `IDprogramma` (`IDprogramma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `programma`
--

CREATE TABLE IF NOT EXISTS `programma` (
  `IDprogramma` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `descrizioneLunga` varchar(400) DEFAULT NULL,
  `IDprerequisito` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDprogramma`),
  KEY `IDprerequisito` (`IDprerequisito`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `programma`
--

INSERT INTO `programma` (`IDprogramma`, `nome`, `descrizioneLunga`, `IDprerequisito`) VALUES
(123, 'programma1', 'Descrizione lunga del programma1', NULL),
(124, 'programma2', 'Descrizione lunga', 123),
(125, 'programma3', 'Descrizione programma3', NULL),
(126, 'programma4', 'Descrizione programma4', 123),
(127, 'programma5', 'Descrizione programma5', 124),
(128, 'programma6', 'Descrizione programma6', 126),
(129, 'programma7', 'Descrizione programma7', 127),
(130, 'programma8', 'Descrizione programma8', NULL),
(131, 'programma9', 'Descrizione programma9', 130),
(132, 'programma10', 'Descrizione diversa', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `ricevenotifiche`
--

CREATE TABLE IF NOT EXISTS `ricevenotifiche` (
  `IDutente` int(11) NOT NULL,
  `IDprogramma` int(11) NOT NULL,
  PRIMARY KEY (`IDutente`,`IDprogramma`),
  KEY `IDprogramma` (`IDprogramma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ricevenotifiche` (`IDutente`, `IDprogramma`) VALUES
(2, 124);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `IDutente` int(11) NOT NULL AUTO_INCREMENT,
  `psw` varchar(40) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tipo` enum('utente','admin') DEFAULT NULL,
  PRIMARY KEY (`IDutente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`IDutente`, `psw`, `nome`, `email`, `tipo`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin'),
(2, 'user', 'user', 'user@gmail.com', 'utente');

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
