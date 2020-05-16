<?php

	session_start();
	include "../assets/php/funzioni.php";

	if(!isset($_SESSION['log'])) {
		session_unset();
		session_destroy();

		header("Location: ../index.php");
	}
	
?>
<!DOCTYPE HTML>
<!--
	Theory by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Tabella processi</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
		<header id="header">
				<div class="inner">
					<a href="home.php" class="logo">Portale Gestione Processi</a>
					<nav id="nav">
						<a href="program-table.php">Gestione programmi</a>
						<a href="process-table.php">Visualizza processi</a>
						<a href="gestione-utente.php">Gestione utenti</a>
						<a href="utente.php">Profilo</a>
						<a href="../index.php?logout=true">Disconnetti</a>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
		</header>

		<!-- Main -->
		<section id="main" class="wrapper">
			<div class="inner">
				<header class="align-center">
					<h2>Elenco processi</h2>
				</header>
				<div class="table-wrapper">
                    <form name="mod" id="mod">
                        <table class="alt">
                            <thead>
                                <tr>
                                    <th>ID Programma</th>
                                    <th>Stato</th>
                                    <th>Utente</th>
                                    <th>Tipo</th>
                                    <th>Data Avvio</th>
                                    <th>Data Fine</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type = "text" value = "" name="idProg"></td>
                                    <td>
                                        <div class="select-wrapper">
                                            <select name = "stato">
                                                <option value = "" selected>--</option>
                                                <option value = "esecuzione">In esecuzione</option>
                                                <option value = "terminato">Terminato</option>
                                                <option value = "attesa">In Attesa</option>
                                                <option value = "interrotto">Interrotto</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type = "text" value = "" name="utente"></td>
                                    <td>
                                        <div class="select-wrapper">
                                            <select name = "tipo">
                                                <option value = "" selected>--</option>
                                                <option value = "periodico">Periodico</option>
                                                <option value = "richiesta">A Richiesta</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="date" id="meeting-timeA" name="dataAvvio" value=""/></td>
                                    <td><input type="date" id="meeting-timeF" name="dataFine" value=""/></td>
                                    <td><input type="button" value="Cerca" onclick="return search()" class="button special fit"/></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>		
					<form name="modulo">
						<table id="alt" class="alt">
						</table>
					</form>
				</div>
			</div>
		</section>
		
		<!-- Footer -->
		<footer id="footer">
			<div class="inner">
				<div class="flex">
					<div class="copyright">
						&copy; 2018 Sito web sviluppato da CoopWare fondata da 3INB ITT Buonarroti-Pozzo per Federazione Trentina della Cooperazione
						<br><a href="https://templated.co">Template</a>.
					</div>
				</div>
			</div>
		</footer>

		<!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/skel.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/process-table.js"></script>
	</body>
</html>