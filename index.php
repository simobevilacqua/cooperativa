<?php
    
    session_start();
	include "assets/php/funzioni.php";

    if(isset($_SESSION['log'])) {

		if(isset($_SESSION['type']) && $_SESSION['type'] == 'utente') {
			header("Location: user/home.php");
		} else {
			header("Location: amministratore/home.php");
		}

	}

	if(isset($_REQUEST['logout'])) {
		session_unset();
		session_destroy();
		header("Location: index.php");
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
		<title>Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/login.css" />
	</head>
	<body class="subpage">
		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="login-page">
                <h1>PORTALE GESTIONE PROCESSI</h1>
				  <div class="form">
					<form action="#" method="POST" class="login-form">
					  <input type="text" id="username" placeholder="Username" name="username" required>
					  <div class="input-container">
						<input type="password" id="password" placeholder="Password" name="password" required>
						<i class="material-icons visibility">visibility_off</i>
						</div>
					  <input type="submit" id="blue-button" name="submit" value="ACCEDI"/>
					</form>

					<?php
						if(isset($_REQUEST['submit'])) {
							if(!isset($_SESSION["log"])) {
								$_SESSION["log"] = false;
								$conn = connection();

								$user = $_REQUEST['username'];
								$pass = $_REQUEST['password'];

								$query = "SELECT * FROM utente WHERE nome = '{$user}' AND psw = '{$pass}'";
								$res = mysqli_query($conn, $query);
								if(mysqli_num_rows($res) != 0) {

									$row = mysqli_fetch_array($res);

									$_SESSION["user"] = $row["IDutente"];
									$_SESSION["type"] = $row["tipo"];
									$_SESSION["log"] = true;

									if($_SESSION['type'] == 'utente') {
										header("Location: user/home.php");
									} else {
										header("Location: amministratore/home.php");
									}

								} else {
									echo "<p style='text-align: center; color: black;'>Utente o password errati!</p>";
									session_unset();
									session_destroy();
								}
								mysqli_close($conn);
							}
						}
					?>
					
				  </div>
                  <h4>prodotto da CoopWare <br>(5 INB ITT Buonarroti-Pozzo) <br>per Federazione Trentina della Cooperazione</h4>
				</div>
			</section>


		<!-- Scripts -->
			<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
			<script>
				var input = document.getElementById("password");
				var input2 = document.getElementById("username");
				input.addEventListener("keyup", function(event) {
				  if (event.keyCode === 13) {
				   event.preventDefault();
				   document.getElementById("blue-button").click();
				  }
				});
				input.addEventListener("keyup", function(event) {
				  if (event.keyCode === 13) {
				   event.preventDefault();
				   document.getElementById("blue-button").click();
				  }
				});
			</script>
			<script src="assets/js/login.js" type="text/javascript"></script>
			<script src="assets/js/js.js" type="text/javascript"></script>
	</body>
</html>
