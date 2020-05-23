<?php

	session_start();
	include "../assets/php/funzioni.php";

	if(!isset($_SESSION['log'])) {
		session_unset();
		session_destroy();

		header("Location: ../index.php");
	}
	
	$connessione = connection();

	//prende i dati del programma selezionato
	$id = $_REQUEST['modifica'];
	$query = "SELECT IDprogramma, nome, descrizioneLunga, IDprerequisito, (SELECT nome FROM programma AS pr2 WHERE pr1.IDprerequisito = pr2.IDprogramma) AS nomePrerequisito FROM programma AS pr1 WHERE IDprogramma = $id";
	$res = mysqli_query($connessione, $query);
	$datiProgramma = mysqli_fetch_array($res);

	//stampa programmi
	$output = "";
	$result = mysqli_query($connessione, "SELECT IDprogramma FROM programma ORDER BY IDprogramma");
	$ok = false;

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			if($row['IDprogramma'] == $datiProgramma['IDprerequisito']) {
				$output .= '<option  value="' . $row["IDprogramma"] . '" selected>' . $row["IDprogramma"] . '</option>';
				$ok = true;
			} else {
				$output .= '<option  value="' . $row["IDprogramma"] . '">' . $row["IDprogramma"] . '</option>';
			}
		}
		if(!$ok) {
			$output .= '<option  value="" selected>---</option>';
		} else {
			$output .= '<option  value="">---</option>';
		}
	}

	//stampa calendarizzazione
	$result = mysqli_query($connessione, "SELECT giorno, ora FROM pianificazione WHERE IDprogramma = $id");
	$cal = "";

	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$cal .= '<tr><td>' . $row["giorno"] . '</td><td>' . $row["ora"] . '</td><td><a href="#" class="button special fit" onclick="eliminaGiorno(' . $i . ');">Elimina</a></td></tr>';
			$i++;
		}
	}

	//stampa utenti avvio
	$result = mysqli_query($connessione, "SELECT utente.IDutente AS IDutente, utente.nome AS nome FROM utente, autorizzato, programma WHERE utente.IDutente = autorizzato.IDutente AND programma.IDprogramma = autorizzato.IDprogramma");
	$utentiAvvio = "";

	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$utentiAvvio .= '<tr><td>' . $row["IDutente"] . '</td><td>' . $row["nome"] . '</td><td><a href="#" class="button special fit" onclick="eliminaUtentiAvvio(' . $i . ');">Elimina</a></td></tr>';
			$i++;
		}
	}

	//stampa utenti notifiche
	$result = mysqli_query($connessione, "SELECT utente.IDutente AS IDutente, utente.nome AS nome FROM utente, riceveNotifiche, programma WHERE utente.IDutente = riceveNotifiche.IDutente AND programma.IDprogramma = riceveNotifiche.IDprogramma");
	$utentiNotifiche = "";

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$utentiNotifiche .= '<tr><td>' . $row["IDutente"] . '</td><td>' . $row["nome"] . '</td><td><a href="#" class="button special fit" onclick="eliminaUtentiNotifiche(' . $i . ');">Elimina</a></td></tr>';
			$i++;
		}
	}

	//stampa utenti
	$utenti = "";
	$result = mysqli_query($connessione, "SELECT IDutente, nome FROM utente");

	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while ($row = mysqli_fetch_array($result)) {
			$utenti .= '<option  value="' . $row["IDutente"] . '">' . $row["nome"] . '</option>';
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
					<h2>Configurazione programma</h2>
				</header>
				<div class="table-wrapper">
					<table class="alt">
						<thead>
							<tr>
								<th>ID programma</th>
								<th>Nome</th>
								<th>Descrizione</th>
								<th>ID prerequisito</th>
								<th>Nome prerequisito</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input type="text" name="IDprogramma" value="<?php echo $datiProgramma['IDprogramma'] ?>" readonly>
								</td>
								<td>
									<input type="text" name="nome" value="<?php echo $datiProgramma['nome'] ?>">
								</td>
								<td>
									<input type="text" name="descrizioneLunga" value="<?php echo $datiProgramma['descrizioneLunga'] ?>">
								</td>
								<td>
									<select>
										<?php echo $output; ?>
									</select>
								</td>
								<td>
									<input type="text" name="descrizionePrerequisito" value="<?php echo $datiProgramma['nomePrerequisito'] ?>">
								</td>
								<!-- In teoria questo non serve
								<td>
									<div class="select-wrapper">
										<select id="configurazione_tipoprogramma">
											<option selected>---</option>
											<option value="Giornaliero" >Giornaliero</option>
											<option value="Settimanale">Settimanale</option>
											<option value="Mensile">Mensile</option>
										</select>
									</div>
								</td>-->
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
													<option value="" selected>------</option>
													<option value="Lunedì">Lunedì</option>
													<option value="Martedì">Martedì</option>
													<option value="Mercoledì">Mercoledì</option>
													<option value="Giovedì">Giovedì</option>
													<option value="Venerdì">Venerdì</option>
													<option value="Sabato">Sabato</option>
													<option value="Domenica">Domenica</option>
													<option value="Tutti i giorni">Tutti i giorni</option>
													<option value="Fine settimana">Fine settimana</option>
													<option value="Fine mese">Fine mese</option>
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
										</td>	
									</tr>
								</tbody>
							</table>

							<br><br><br>
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
								<tbody id="id_elenco_data">
									<?php echo $cal;?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="row 200%">
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
									<?php echo $utentiAvvio;?>
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
									<?php echo $utentiNotifiche;?>
								</tbody>
							</table>
						</div>
					</div>
					<input type="button" onclick="salvaProgramma()" class="button special fit" value="Salva programma"></input>
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
		<script src="../assets/js/main.js"></script>
		<script src="../assets/js/program-table-modifica.js"></script>
		<script src="../assets/js/table.js"></script>
	</body>
</html>
