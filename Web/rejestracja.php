<!doctype html>
<html lang="pl-PL">
  <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <link rel="Stylesheet" type="text/css" href="style.css" />
  <title>System tankowania</title>

</head>

 <body>
	<div class="contener">
		<header>
		<a href="index.php">
			<img src="x.svg" alt="System Logowania" class= "logo">
		</a>
			<nav>
				<a href="#" class="hide-desktop">
					<img src="kreski.svg" alt="menu" class= "menu" id="menu">
				</a>
			
				<ul class="show-desktop hide-mobile" id="nav">
					<li id="exit" class="exit-menu"><img src="x_1.svg" alt="exit"></li>
					<li><a href="logowanie.php">Logowanie</a></li>
					<li><a href="rejestracja.php">Rejestracja</a></li>
				</ul>
			</nav>
		</header>			
	</div>
	<script>
		var menu = document.getElementById('menu');
		var nav = document.getElementById('nav');
		var exit = document.getElementById('exit');
		
		menu.addEventListener('click',function(e){
			nav.classList.toggle('hide-mobile');
			e.preventDefault();
		});
		
		exit.addEventListener('click',function(e){
			nav.classList.add('hide-mobile');
			e.preventDefault();
		});
		
	</script>
	<div id="glowna" class= "glowna">

	<h1>Rejestracja</h1>
	
	<form method="POST">  <!-- sprawdz czy wszystko dobrze jest z przyciskiem jak cos -->
		<div id = "login">
			Nazwa użytkownika:<br/><input type="text" name="login"> </input><br />
		</div>
		<div class = "haslo">
			Hasło: <br /> <input type="password" name="haslo"></input> <br /><br />
		</div>
		<div class = "haslo">
			Powtórz hasło: <br /> <input type="password" name="haslo2"></input> <br /><br />
		</div>
		<div class = "haslo">
			Adres mail: <br /> <input type="text" name="mail"></input> <br /><br />
		</div>
			<input type="submit" name="submit" class="zaloguj" value="Zarejestruj"></input>  <!--przycisk -->
    
    </form>
	
	
	</div>
 
 	<footer>
		<div class="footer-logowanie">
			<div class="contener">
			<a href="">
				<img src="x.svg" class="logo1" alt="logo">
			</a>
				<p class="address">Gdzies na swiecie, 423<br>PL</p>
				<ul class="footer-link">
					<li><a href="#">Terms of Service</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>
			</div>
		</div>
	</footer>
 </body>
 </html>
 
 <?php

	$alert = '';
if(isset($_POST['submit'])){
	
	$Name = $_POST['login'];
	$Password = $_POST['haslo'];
	$Password2 = $_POST['haslo2'];
	$Email = $_POST['mail'];
	$firma = "brak";

	if($Password == $Password2)
	{		
$servername = "projekttankowania.cba.pl";
$username = "Maska989";
$password = "BazaProjekt2";
$dbname = "maska989";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}

$sql = "INSERT INTO Uzytkownik (login, haslo, email, firma, nazwaFirmy, ranga)
VALUES ('$Name','$Password','$Email', '0', 'brak', '0')";

$login = htmlentities($Name, ENT_QUOTES, "UTF-8");
	//$check = "SELECT * FROM Uzytkownik WHERE login = '%s";

	$rezultat = @$conn->query(sprintf("SELECT * FROM Uzytkownik WHERE login = '%s'",mysqli_real_escape_string($conn,$login)));
	$rezultat2 = @$conn->query(sprintf("SELECT * FROM Uzytkownik WHERE email = '%s'",mysqli_real_escape_string($conn,$mail)));
	$ilu_userow = $rezultat->num_rows;
	$ile_maili = $rezultat2->num_rows;



		if($ilu_userow>0){
			?>
			<p style = "color: red; text-align: center; margin-top: 2em;">Login zajęty</p>
			<?php
			$rezultat->free_result();
			$rezultat2->free_result();	
		}
		else {
			if($ile_maili>0){
					?>
					<p style = "color: red; text-align: center; margin-top: 2em;">Adres email został już zarejestrowany</p>
					<?php
					$rezultat2->free_result();
					$rezultat->free_result();
				}
			else{
					if ($conn->query($sql) === TRUE) { ?>
							<p style = "color: blue; text-align: center; margin-top: 2em;">Konto zarejestrowane pomyślnie</p>
							<?php
					} else { ?>
							<p style = "color: red; text-align: center; margin-top: 2em;">Błąd rejestracji</p>
							<?php
						}	
				}
			}
			$conn->close();
}
	else{
			?>
			<p style = "color: red; text-align: center; margin-top: 2em;">Hasła nie są takie same</p>
			<?php
		}
}
?>