<?php	
	session_start();
	include "../assets/php/funzioni.php";

	if(!isset($_SESSION['log'])) {
		session_unset();
		session_destroy();

		header("Location: ../index.php");
	}

	if(isset($_POST["aggiorna"])){
		$conn = connection();
		
        $id = $_REQUEST["id"];
        $nome = $_REQUEST["nome"];
        $email = $_REQUEST["email"];
        $psw = $_REQUEST["password"];
        $category = $_REQUEST["category"];

		$stmt = $conn->prepare("UPDATE utente SET psw = ?, nome = ?, email = ?, tipo = ? WHERE IDutente = ?");
		$stmt->bind_param("ssssi", $psw, $nome, $email, $category, $id);
		
        if($stmt->execute()){
			$_SESSION["query"] = "'Modifica avvenuta con successo'";
		}else{
			$_SESSION["query"] = "'Modifica fallita'";
		}
		
		$stmt->close();
		header("location: gestione-utente.php");
	}

	if(isset($_POST["delete"])){
		$conn = connection();

		$id = $_REQUEST["id"];

		$stmt = $conn->prepare("DELETE FROM utente WHERE IDutente = ?");
		$stmt->bind_param("i", $id);
		
        if($stmt->execute()){
			$_SESSION["query"] = "'Eliminazione avvenuta con successo'";
		}else{
			$_SESSION["query"] = "'Eliminazione fallita'";
		}
		
		$stmt->close();
		header("location: gestione-utente.php");
	}

	if(isset($_POST["insert"])){
		$conn = connection();

        $nome = $_REQUEST["nome"];
        $email = $_REQUEST["email"];
        $psw = $_REQUEST["password"];
		$category = $_REQUEST["category"];
		
		$stmt = $conn->prepare("INSERT INTO utente (psw, nome, email, tipo) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss", $psw, $nome, $email, $category);
		
        if($stmt->execute()){
			$_SESSION["query"] = "'Inserimento avvenuto con successo'";
		}else{
			$_SESSION["query"] = "'Inserimento fallito'";
		}
		
		$stmt->close();
		header("location: gestione-utente.php");
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

				<?php

					if (isset($_POST["modifica"])) {
						$conn = connection();
						
						$getUser = "SELECT * FROM utente WHERE IDutente = " . $_POST["modifica"] . "";

						$res = mysqli_query($conn, $getUser);
						if(mysqli_num_rows($res) != 0) {
							while($row = mysqli_fetch_array($res)) {
				?>

					<!-- Form -->
					<h3>Gestisci l'account</h3>
					<form method="POST" action="gestione-utente-modifica.php">
						<h4>ID utente:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="id" value="<?php echo $row["IDutente"]?>" readonly/>
						</div>
						<br>
						<h4>Nome:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="nome" value="<?php echo $row["nome"]?>" required/>
						</div>
						<br>
						<h4>Email:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="email" name="email" value="<?php echo $row["email"]?>" required/>
						</div>
						<br>
						<h4>Password:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="password" value="<?php echo $row["psw"]?>" required/>
						</div>
						<br>
						<h4>Tipo utente:</h4>
						<div class="select-wrapper 6u 12u$(xsmall)">
						<select name="category">
								<?php
									if($row["tipo"] == "utente") {
								?>
										<option value="admin">Amministratore</option>
										<option value="utente" selected>Utente</option>
								<?php
									} else {
								?>
										<option value="admin" selected>Amministratore</option>
										<option value="utente">Utente</option>
								<?php
									}
								?>
							</select>
						</div>
						<br>
						<div class="6u 12u$(xsmall)">
							<br>
							<input type="submit" class="button special fit" name="aggiorna" value="Aggiorna"></a>
						</div>

					</form>
			</div>
		</section>

				<?php
							}
						}
					} else if (isset($_POST["elimina"])){
							$conn = connection();
							
							$getUser = "SELECT * FROM utente WHERE IDutente = " . $_POST["elimina"] . "";

							$res = mysqli_query($conn, $getUser);
							if(mysqli_num_rows($res) != 0) {
								while($row = mysqli_fetch_array($res)) {
				?>

					<!-- Form -->
					<h3>Gestisci l'account</h3>
					<form method="POST" action="gestione-utente-modifica.php">
						<h4>ID utente:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="id" value="<?php echo $row["IDutente"]?>" readonly/>
						</div>
						<br>
						<h4>Nome:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="nome" value="<?php echo $row["nome"]?>" readonly/>
						</div>
						<br>
						<h4>Email:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="email" name="email" value="<?php echo $row["email"]?>" readonly/>
						</div>
						<br>
						<h4>Password:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="password" value="<?php echo $row["psw"]?>" readonly/>
						</div>
						<br>
						<h4>Tipo utente:</h4>
						<div class="select-wrapper 6u 12u$(xsmall)">
							<input type="text" name="category" value="<?php echo $row["tipo"]?>" readonly/>
						</div>
						<br>
						<div class="6u 12u$(xsmall)">
							<br>
							<input type="submit" class="button special fit" name="delete" value="Elimina"></a>
						</div>

					</form>
			</div>
		</section>

				<?php
							}
						}
					}else{
				?>

					<!-- Form -->
					<h3>Gestisci l'account</h3>
					<form method="POST" action="gestione-utente-modifica.php">
						<h4>Nome:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="nome" required/>
						</div>
						<br>
						<h4>Email:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="email" name="email" required/>
						</div>
						<br>
						<h4>Password:</h4>
						<div class="6u 12u$(xsmall)">
							<input type="text" name="password" required/>
						</div>
						<br>
						<h4>Tipo utente:</h4>
						<div class="select-wrapper 6u 12u$(xsmall)">
							<select name="category">
								<option value="" disabled="disabled">Scegli un tipo di utente</option>
								<option value="admin">Amministratore</option>
								<option value="utente">Utente</option>
							</select>
						</div>
						<br>
						<div class="6u 12u$(xsmall)">
							<br>
							<input type="submit" class="button special fit" name="insert" value="Aggiugi"></a>
						</div>

					</form>
			</div>
		</section>

				<?php
					}
				?>

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