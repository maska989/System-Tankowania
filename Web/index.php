
<?php

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: user.php');
		exit();
	}
?>

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
				<img src="x.svg" alt="Logo.svg" class= "logo">
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
		<section>
			<h1>System tankowania</h1>
			<p class="przypis">Twój prywatny manager tankowania.</p>
		</section>				
	</div>
	
	<div class="green-contener">
		<div class="contener">
			<ul>
				<li>
				<img src="strona4.svg" alt="komora" class= "miniaturki">
					<p>Opis zawartosci strony,ma jakas zawartosc ktora jest wazna i dlatego trzeba miec fajna strone aby ladnie wygladala.</p>
				</li>						
				<li>
				<img src="lupa3.svg" alt="lupa" class= "miniaturki">
					<p>Opis zawartosci Aplikacji, ma jakas zawrtosc ktora warto jest zobaczyc wiec dlatego warto ja pobrac i uzywac dla dobra oszczednosci paliwka.</p>
				</li>			
				<li>
				<img src="komora3.svg" alt="strona" class= "miniaturki">
					<p>Krotki opis dodatkowy jesli bedzie trzeba, dlatego warto miec dodatowy opis aby uzytkownik sobie pomyslal ze jest to bardzo zawansowane i dlatego tyle jest tekstu.</p>
				</li>
			</ul>
		</div>
	</div>
	
	
		<div class="contener">
			<h2>Utwórz konto już teraz!</h2>
			<a href="rejestracja.php" class="zsk">Rejestracja</a>
		</div>
	
	
	<footer>
		<div class="footer-contener">
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
	
 </body>
</html>