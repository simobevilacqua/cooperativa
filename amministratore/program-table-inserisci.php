<?php

session_start();
include "../assets/php/funzioni.php";

if(!isset($_SESSION['log'])) {
	session_unset();
	session_destroy();

	header("Location: ../index.php");
}

$connessione = connection();

$result = mysqli_query($connessione, "SELECT * FROM utente");

$stringa_utenti = "";
$i = 0;
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		if($i == (mysqli_num_rows($result)-1)){
			$stringa_utenti .= $row["IDutente"] . "," . $row["nome"] . "," . $row["tipo"];
		}else{
			$stringa_utenti .= $row["IDutente"] . "," . $row["nome"] . "," . $row["tipo"] . ",";
		}
		$i++;
	}
}

if(isset($_POST["salva"])){

	$nome = $_POST["nome"];
	$descrizioneLunga = $_POST["descrizioneLunga"];
	$idprerequisito = $_POST["idprerequisito"];

	if($idprerequisito == "---"){
		mysqli_query($connessione, "INSERT INTO programma (IDprogramma, nome, descrizioneLunga, IDprerequisito) VALUES (NULL, '$nome', '$descrizioneLunga', NULL);");

		$result = mysqli_query($connessione, "SELECT IDprogramma FROM programma WHERE nome = '$nome' AND descrizioneLunga = '$descrizioneLunga' AND IDprerequisito is NULL");
	}else{
		mysqli_query($connessione, "INSERT INTO programma (IDprogramma, nome, descrizioneLunga, IDprerequisito) VALUES (NULL, '$nome', '$descrizioneLunga', '$idprerequisito');");

		$result = mysqli_query($connessione, "SELECT IDprogramma FROM programma WHERE nome = '$nome' AND descrizioneLunga = '$descrizioneLunga' AND IDprerequisito = '$idprerequisito'");
	}

	
	//ID del programma appena caricato
	$id = "";
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$id = $row["IDprogramma"];
		}
	}

	//Prendo i giorni per la calendarizzazione
	$giorni = $_POST["calendario"];
	$tipo = $_POST["tipo"];

	//Variabili che mi servono per prendere il giorno, l'ora
	$giorno = "";
	$ora = "";
	$i = 0;
	$try = explode(",", $giorni);
	foreach($try as $valore){
		if($i % 2 == 0){
			$giorno = $valore;
		}else{
			$ora = $valore;
			if(mysqli_query($connessione, "INSERT INTO pianificazione (IDpianificazione, tipo, giorno, ora, IDprogramma) VALUES (NULL, '$tipo', '$giorno', '$ora', $id)")){
			}else{
			}
		}
		$i++;
	}

}

//stampa utenti
$utenti = "";
$result = mysqli_query($connessione, "SELECT IDutente, nome FROM utente");

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$utenti .= '<option  value="' . $row["IDutente"] . '">' . $row["nome"] . '</option>';
	}
}

//stampa programmi
$output = "";
$result = mysqli_query($connessione, "SELECT IDprogramma FROM programma ORDER BY IDprogramma");

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$output .= '<option  value="' . $row["IDprogramma"] . '">' . $row["IDprogramma"] . '</option>';
	}
}

mysqli_close($connessione);

?>
<!DOCTYPE HTML>
<!--
	Theory by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>

<head>
	<title>Configurazione programma</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="../assets/css/main.css" />
	<style>
		td {
			vertical-align: middle;
		}
	</style>
</head>

<?php
	echo "<body class='subpage' onload='utenti_disponibili(\"$stringa_utenti\")'>";
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
	<form method="POST" action="#" name="modulo" onsubmit="return prendi_giorni();">
		<section id="main" class="wrapper">
			<div class="inner">
				<header class="align-center">
					<h2>Configurazione programma</h2>
				</header>
				<div class="table-wrapper">
					<table class="alt">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Descrizione</th>
								<th>ID Programma prerequisito</th>
								<th>Nome prerequisito</th>
								<th>Tipologia</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input type="text" name="nome" required>
								</td>
								<td>
									<input type="text" name="descrizioneLunga">
								</td>
								<td>
									<div class="select-wrapper" id="selezionePrerequisito">
										<select name="idprerequisito">
											<option selected>---</option>
											<?php echo $output ?>
										</select>
									</div>
								</td>
								<!-- da vedere -->
								<td>
									<input type="text" name="nome_prerequisito">
								</td>
								<td>
									<div class="select-wrapper">
										<select name="tipo">
											<option selected>---</option>
											<option value="giornaliero">Giornaliero</option>
											<option value="settimanale">Settimanale</option>
											<option value="mensile">Mensile</option>
										</select>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="row 200%">
						<div class="6u 12u$(medium)">
							<br>
							<h4>Seleziona calendario</h4>
							<table class="alt">
								<thead>
									<tr>
										<th>Giorno</th>
										<th>Ora</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="select-wrapper">
												<select id="configurazione_giorni">
													<option selected>---</option>
													<option value="Lunedi">Lunedì</option>
													<option value="Martedi">Martedì</option>
													<option value="Mercoledi">Mercoledì</option>
													<option value="Giovedi">Giovedì</option>
													<option value="Venerdi">Venerdì</option>
													<option value="Sabato">Sabato</option>
													<option value="Domenica">Domenica</option>
												</select>
											</div>
										</td>
										<td>
											<div class="6u$ 12u$(small)">
												<input type="time" name="ora" id="id_ora_data">
											</div>
										</td>
										<td>
											<a class="button special fit" onclick="aggiorna_data();">Aggiungi</a>
											<!--<input type="submit" name="calendarizzazione" class="button special fit" value="Aggiungi">-->
										</td>
									</tr>
								</tbody>
							</table>

						</div>

						<div class="6u$ 12u$(medium)">
							<br>
							<h4>Calendarizzazione</h4>
							<table class="alt">
								<thead>
									<tr>
										<th>Giorno</th>
										<th>Ora</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="id_elenco_data"></tbody>
							</table>
							<input type="text" name="calendario" style="display:none">
						</div>
					</div>

					<div class="row 200%">
						<h4>Seleziona utenti</h4>
						<table class="alt">
							<thead>
								<tr>
									<th colspan="2">Utente con autorizzazione di avvio</th>
									<th colspan="2">Utente che riceverà notifiche</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="select-wrapper" id="seleziona_utente1">
											<select id="configurazione_idutente">
												<option selected>---</option>
												<?php echo $utenti; ?>
											</select>
										</div>

									</td>
									<td>
										<a class="button special fit" onclick="aggiorna_autorizzazioneAvvio();">Aggiungi</a>
									</td>

									<td>
										<div class="select-wrapper" id="seleziona_utente2">
											<select id="configurazione_idutente1">
												<option selected>---</option>
												<?php echo $utenti; ?>
											</select>
										</div>
									</td>
									<td>
										<a class="button special fit" onclick="aggiorna_autorizzazioneNotifiche();">Aggiungi</a>
									</td>
								</tr>
							</tbody>
						</table>

						<div class="6u 12u$(medium)">
							<h4>Elenco utenti autorizzati</h4>
							<table class="alt">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nome</th>
										<th>Tipo</th>
									</tr>
								</thead>
								<tbody id="elenco_utentiAvvio">
								</tbody>
							</table>
						</div>

						<div class="6u$ 12u$(medium)">
							<h4>Elenco utenti che riceveranno le notifiche</h4>
							<table class="alt">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nome</th>
										<th>Tipo</th>
									</tr>
								</thead>
								<tbody id="elenco_utentiNotifiche">
								</tbody>
							</table>
						</div>
					</div>
					<input type="submit" class="button special fit" value="Salva programma" name="salva">
				</div>
			</div>
		</section>
	</form>

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="../assets/js/skel.min.js"></script>
	<script src="../assets/js/main.js"></script>
	<!--<script src="../assets/js/program-table-inserisci.js"></script>-->
	<script src="../assets/js/table.js"></script>
</body>
</html>