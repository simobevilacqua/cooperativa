<?php	
	session_start();
	include "../assets/php/funzioni.php";

	//Controllo se l'utente si è loggato
	if(!isset($_SESSION['log'])) {
		session_unset();
		session_destroy();

		header("Location: ../index.php");
	}

	if(isset($_POST["elimina"])){

		//Connessione database
		$conn = connection();

		//Mi salvo i valori ottenuti nel form in delle variabili
		$id = $_REQUEST["elimina"];

		//Faccio il Prepared Statement e poi al posto dei placeholder gli assegno il valore delle varibili
		$stmt = $conn->prepare("DELETE FROM utente WHERE IDutente = ?");
		$stmt->bind_param("i", $id);
		
		//Eseguo la query e controllo se è andato a buon fine
        if($stmt->execute()){
			$_SESSION["query"] = "'Eliminazione avvenuta con successo'";
		}else{
			$_SESSION["query"] = "'Eliminazione fallita'";
		}
		
		//Chiudo la connessione
		$stmt->close();
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
		<title>Elenco utenti</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>

	<?php
	
	//Controllo se la query contiene qualche stringa
	if(isset($_SESSION["query"])){
		$rtn = "query";

		//Stampo cosa contine la query
		echo "<body class='subpage' onload=\"alert($_SESSION[$rtn])\">";
		$_SESSION["query"] = null;

	//Se non contiene nessuna stringa entra qui
	}else{
		echo "<body class='subpage'>";
	}

	?>

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
						<h2>Elenco utenti</h2>
					</header>
                    <div class="table-wrapper">
						<table class="alt" id="alt">
							<thead>
								<tr>
									<th><a id="username" onclick="sort(this.id)">ID utente</a></th>
									<th><a id="nome" onclick="sort(this.id)">Nome Cognome</a></th>
									<th><a id="email" onclick="sort(this.id)">Email</a></th>
									<th><a id="permesso" onclick="sort(this.id)">Tipo utente</a></th>
									<th><a id="modifica">Modifica</a></th>
									<th><a id="elimina">Elimina</a></th>
								</tr>
							</thead>

							<?php
								//Connessione database
								$conn = connection();

								//Query per ottenere tutti gli utenti presenti nel database
								$query = "SELECT * FROM utente ORDER BY IDutente";
								$res = mysqli_query($conn, $query);

								//Stampo tutti gli utenti presenti
								while($row = mysqli_fetch_array($res)) {

									echo("<tbody><tr>");
									echo("<td>" . $row['IDutente'] . "</td>");
									echo("<td>" . $row['nome'] . "</td>");
									echo("<td>" . $row['email'] . "</td>");
									echo("<td>" . $row['tipo'] . "</td>");

									//Due form che servono per modificare o eliminare un utente, entrambi i bottoni hanno come valore l'id dell'utente della riga in cui sono
									echo("<td><form action='gestione-utente-modifica.php' method='POST'><button type='submit' name='modifica' value='" . $row['IDutente'] . "'>Modifica</button></form></td>");
									echo("<td><form action='gestione-utente.php' method='POST' onclick='return control();'><button type='submit' name='elimina' value='" . $row['IDutente'] . "'>Elimina</button></form></td>");
									echo("</tr></tbody>");
								}

								mysqli_close($conn);
							?>

						</table>
						<!--Bottone per aggiungere un utente-->
						<td><a href="gestione-utente-modifica.php" class="button special fit">Aggiungi utente</a></td>
                    </div>
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