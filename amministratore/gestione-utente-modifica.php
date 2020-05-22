<?php	
	session_start();
	include "../assets/php/funzioni.php";

	//Controllo se l'utente si è loggato
	if(!isset($_SESSION['log'])) {
		session_unset();
		session_destroy();

		header("Location: ../index.php");
	}

	//Controllo se l'utente ha premuto il bottone per fare l'aggiornamento di un utente
	if(isset($_POST["aggiorna"])){

		//Connessione database
		$conn = connection();
		
		//Mi salvo i valori ottenuti nel form in delle variabili
        $id = $_REQUEST["id"];
        $nome = $_REQUEST["nome"];
        $email = $_REQUEST["email"];
        $psw = $_REQUEST["password"];
        $category = $_REQUEST["category"];

		//Faccio il Prepared Statement e poi al posto dei placeholder gli assegno il valore delle varibili
		$stmt = $conn->prepare("UPDATE utente SET psw = ?, nome = ?, email = ?, tipo = ? WHERE IDutente = ?");
		$stmt->bind_param("ssssi", $psw, $nome, $email, $category, $id);
		
		//Eseguo la query e controllo se è andato a buon fine
        if($stmt->execute()){
			$_SESSION["query"] = "'Modifica avvenuta con successo'";
		}else{
			$_SESSION["query"] = "'Modifica fallita'";
		}
		
		//Chiudo la connessione e reindirizzo alla pagina "gestione-utente.php"
		$stmt->close();
		header("location: gestione-utente.php");
	}

	if(isset($_POST["insert"])){

		//Connessione database
		$conn = connection();

		//Mi salvo i valori ottenuti nel form in delle variabili
        $nome = $_REQUEST["nome"];
        $email = $_REQUEST["email"];
        $psw = $_REQUEST["password"];
		$category = $_REQUEST["category"];
		
		//Faccio il Prepared Statement e poi al posto dei placeholder gli assegno il valore delle varibili
		$stmt = $conn->prepare("INSERT INTO utente (psw, nome, email, tipo) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss", $psw, $nome, $email, $category);
		
		//Eseguo la query e controllo se è andato a buon fine
        if($stmt->execute()){
			$_SESSION["query"] = "'Inserimento avvenuto con successo'";
		}else{
			$_SESSION["query"] = "'Inserimento fallito'";
		}
		
		//Chiudo la connessione e reindirizzo alla pagina "gestione-utente.php"
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
		<link rel="stylesheet" href="../assets/css/login.css" />
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

					//Controllo se è stato premuto il bottone per modificare l'utente
					if (isset($_POST["modifica"])) {

						//Connessione database
						$conn = connection();
						
						//Seleziono l'utente con quel determinato IDutente
						$getUser = "SELECT * FROM utente WHERE IDutente = " . $_POST["modifica"] . "";

						//Eseguo la query e stampo a video i risultati
						$res = mysqli_query($conn, $getUser);
						if(mysqli_num_rows($res) != 0) {
							while($row = mysqli_fetch_array($res)) {
				?>

					<!-- Form -->
					<h3>Gestisci l'account</h3>
					<form method="POST" action="gestione-utente-modifica.php" class="login-form">
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
						<div class="input-container" style="width:50%">
							<input type="password" id="password" placeholder="Password" name="password" value="<?php echo $row["psw"]?>" required>
							<i class="material-icons visibility">visibility_off</i>
						</div>
						<br>
						<h4>Conferma Password:</h4>
						<div class="input-container" style="width:50%">
							<input type="password" id="confpassword" placeholder="Password" name="confpassword" required>
							<i class="material-icons visibility">visibility_off</i>
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

							<!--Bottone per aggiornare l'utente-->
							<input type="submit" class="button special fit" name="aggiorna" value="Aggiorna"></a>
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

							<!--Bottone per inserire un nuovo utente-->
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

		<!-- Scripts -->
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
			<script>
				var input = document.getElementById("password");
				var input2 = document.getElementById("confpassword");
				input.addEventListener("keyup", function(event) {
				  if (event.keyCode === 13) {
				   event.preventDefault();
				   document.getElementById("blue-button").click();
				  }
				});
				input2.addEventListener("keyup", function(event) {
				  if (event.keyCode === 13) {
				   event.preventDefault();
				   document.getElementById("blue-button").click();
				  }
				});
			</script>
			<script src="../assets/js/login.js" type="text/javascript"></script>
			<script src="../assets/js/js.js" type="text/javascript"></script>
			
	</body>
</html>