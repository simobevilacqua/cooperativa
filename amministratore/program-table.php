<?php	
	session_start();
	include "../assets/php/funzioni.php";

	if(!isset($_SESSION['log'])) {
		session_unset();
		session_destroy();

		header("Location: ../index.php");
	}

	if(isset($_REQUEST['elimina'])) {

		$conn = connection();

		$id = $_REQUEST['elimina'];

		$query = "DELETE FROM programma WHERE IDprogramma = $id";
		$res = mysqli_query($conn, $query);

		mysqli_close($conn);

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
		<title>Elenco programmi</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<style>
		td {
			vertical-align: middle;
		}
	</style>
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
					<h2>Tabella programmi</h2>
				</header>
				<div class="table-wrapper">
                    <form name="mod" id="mod" method="POST">
                        <table class="alt">
                            <thead>
                                <tr>
                                    <th>Modalità ricerca</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
										<select name="mode">
											<option value="IDprogramma">ID Programma</option>
											<option value="nome">Nome</option>
											<option value="descrizioneLunga">Descrizione</option>
											<option value="IDprerequisito">ID Prerequisito</option>
										</select>
									</td>
									<td>
										<input type="text" name="scelta" required>
									</td>
                                    <td><input type="submit" name="cerca" value="Cerca" class="button special fit"></td>
                                </tr>
                            </tbody>
                        </table>
					</form>

					<a href="program-table-inserisci.php" class="button special fit" onClick="impostaID('')">Aggiungi programma</a>
					<br>
					<table id="alt" class="alt">
					<thead>
						<tr>
							<th><a id="id">ID Programma</a></th>
							<th><a id="nome">Nome</a></th>
							<th><a id="descrizione">Descrizione</a></th>
							<th><a id="id">ID Prerequisito</a></th>
							<th><a id="modifica">Modifica</a></th>
							<th><a id="elimina">Elimina</a></th>
						</tr>
					</thead>
					<?php
						$conn = connection();

						$query = "SELECT * FROM programma";

						if(isset($_REQUEST['cerca'])) {
							$mode = $_REQUEST['mode'];
							$scelta = $_REQUEST['scelta'];

							$query .= " WHERE $mode LIKE '%$scelta%'";
						}

						$res = mysqli_query($conn, $query);

						$ok = false;
						while($row = mysqli_fetch_array($res)) {

							$ok = true;

							echo("<tbody><tr>");
							echo("<td>" . $row['IDprogramma'] . "</td>");
							echo("<td>" . $row['nome'] . "</td>");
							echo("<td>" . $row['descrizioneLunga'] . "</td>");
							echo("<td>" . $row['IDprerequisito'] . "</td>");
							echo("<td><form action='program-table-modifica.php' method='POST'><button type='submit' name='modifica' value='" . $row['IDprogramma'] . "'>Modifica</button></form></td>");
							echo("<td><form action='#' method='POST'><button type='submit' name='elimina' value='" . $row['IDprogramma'] . "' onclick='return confirm(\"Sei sicuro di voler eliminare questo programma?\");'>Elimina</button></form></td>");
							echo("</tr></tbody>");
						}

						if(!$ok) {
							echo("<tbody><tr>");
							echo("<td style='text-align: center' colspan='6'>Nessun programma trovato</td>");
							echo("</tr></tbody>");
						}

						mysqli_close($conn);
					?>
					</table>
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
        <script src="../assets/js/skel.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>
	</body>
</html>