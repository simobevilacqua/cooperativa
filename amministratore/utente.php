<?php

	session_start();
	include "../assets/php/funzioni.php";

	if(isset($_REQUEST['logout'])) {
		session_unset();
		session_destroy();

		header("Location: ../index.php");
	}

	if(isset($_REQUEST['aggiornaProfilo'])) {
		$conn = connection();

		$stmt = $conn->prepare("UPDATE utente SET nome = ?, email = ? WHERE IDutente = ?");
		$stmt->bind_param("ssi", $_REQUEST['nome'], $_REQUEST['email'], $_REQUEST['IDutente']);
		$stmt->execute();

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
		<title>Gestione utente</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../assets/css/login.css" />
		<link rel="stylesheet" href="../assets/css/main.css">
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
					<h3>Gestisci il tuo account</h3>
					
					<?php

						$conn = connection();

						$utente = $_SESSION['user'];
						$query = "SELECT * FROM utente WHERE IDutente = '{$utente}'";
						$res = mysqli_query($conn, $query);
						$row = mysqli_fetch_array($res);
							
						if(!isset($_REQUEST['modificaProfilo'])) {

					?>

					<h4>ID utente:</h4>
					<h4><?php echo $row['IDutente'];?></h4>
					<br>
					<h4>Nome Cognome:</h4>
					<h4><?php echo $row['nome'];?></h4>
					<br>
					<h4>Email:</h4>
					<h4><?php echo $row['email'];?></h4>
					<br>
					<h4>Tipo utente:</h4>
					<h4><?php echo $row['tipo'];?></h4>
					<br>
					<form action="#" method="POST">
						<input type="submit" class="button special fit" name="modificaProfilo" value="MODIFICA PROFILO">
					</form>

					<?php

						} else {

					?>
						
					<form action="#" method="POST" name="modulo" onsubmit="return controlla();">
						<h4>ID utente:</h4>
						<input type="text" name="IDutente" value="<?php echo $row['IDutente'];?>" readonly>
						<br>
						<h4>Nome Cognome:</h4>
						<input type="text" name="nome" value="<?php echo $row['nome'];?>" required>
						<br>
						<h4>Email:</h4>
						<input type="text" name="email" value="<?php echo $row['email'];?>" required>
						<br>
						<h4>Tipo utente:</h4>
						<input type="text" name="tipo" value="<?php echo $row['tipo'];?>" readonly>
						<br>
						<h4>Password:</h4>
						<div class="input-container">
							<input type="password" id="psw" placeholder="Password" name="psw" value="<?php echo $row["psw"]?>" required>
							<i class="material-icons visibility" style="margin-left: -30px; margin-bottom: 15px;">visibility_off</i>
						</div>
						<br>
						<h4>Conferma Password:</h4>
						<div class="input-container2">
							<input type="password" id="confpsw" placeholder="Conferma Password" name="confpsw" required>
							<i class="material-icons visibility2" style="margin-left: -30px;">visibility_off</i>
						</div><br>
						<input type="submit" class="button special fit" name="aggiornaProfilo" value="AGGIORNA PROFILO">
					</form>

					<?php

						}
						mysqli_close($conn);
					?>
					
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
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			<!--<script src="../assets/js/modificautente.js"></script>-->
			<script src="../assets/js/utente.js"></script>
	</body>
</html>
