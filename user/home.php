<?php

	session_start();
	include "../assets/php/funzioni.php";

	if(isset($_REQUEST['logout'])) {
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
		<title>Gestione utente</title>
		<meta charset="utf-8" />
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
						<a href="utente.php">Profilo</a>
						<a href="../index.php?logout=true">Disconnetti</a>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner"  style="text-align:center;">
					<img src="../img/user1.png" alt="utente" height="30%" width="30%">
					<a href="../index.php?logout=true" class="button special fit">Disconnetti</a>
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
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/main.js"></script>
		<script src="../assets/js/program-table-user.js"></script>
	</body>
</html>
