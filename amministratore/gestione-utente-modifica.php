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
					<!-- Form -->
					<h3>Gestisci l'account</h3>
					<form method="post" action="#">
						<h4>ID utente:</h4>
						<div class="6u 12u$(xsmall)">
								<input id= "iduser" type="email" placeholder="ID utente" />
							</div>
						<br>
						<h4>Nome Cognome:</h4>
						<div class="6u 12u$(xsmall)">
								<input id = "nomeecognome" type="email" placeholder="Nome Cognome" />
							</div>
						<br>
						<h4>Email:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="email" name="email" id="email" value="" placeholder="Email" />
						</div>
						<br>
						<h4>Password:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="password" name="password" id="password" value="" placeholder="Password" />
						</div>
						<br>
						<h4>Tipo utente:</h4>
						<div class="select-wrapper 6u 12u$(xsmall)">
							<select name="category" id="category">
								<option value="">- Category -</option>
								<option value="am">Amministratore</option>
								<option value="ut">User</option>
							</select>
						</div>
						<br>
						<div class="6u 12u$(xsmall)">
							<br>
							<a href="gestione-utente.php" class="button special fit" onclick = "aggiorna()">Aggiorna</a>
						</div>

					</form>
				</div>
			</section>

		<!-- Footer -->
		<footer id="footer">
			<div class="inner">
				<div class="flex">
					<div class="copyright">
						&copy; 2018 Sito web sviluppato da CoopWare fondata da 4INB ITT Buonarroti-Pozzo per Federazione Trentina della Cooperazione
						<br><a href="https://templated.co">Template</a>.
					</div>
				</div>
			</div>
		</footer>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			<script src="../assets/js/modificautente.js"></script>
	</body>
</html>
