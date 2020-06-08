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


  <title>System Tankowanie</title>
  <script language="javascript" type="text/javascript" src="jquery.js">
function equalHeight(group) {
tallest = 0;
group.each(function() {
thisHeight = $(this).height();
if(thisHeight > tallest) {
tallest = thisHeight;
}
});
group.height(tallest);
}
$(document).ready(function() {
equalHeight($(".kolumna"));
});
  </script>
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

<h1>Panel logowania</h1>


    <form action="zaloguj.php" method="post">
		<div id = "login">
		Nazwa użytkownika:<br/><input type="text" name="login"> </input><br />
		</div>
		<div class = "haslo">
		Hasło: <br /> <input type="password" name="haslo"></input> <br /><br />
		</div>
		<input type="submit" class="zaloguj" value="Zaloguj się"></input>
    <a href="rejestracja.php">Zarejestruj się</a>
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
					<li><a href="#">Privacy policy</a></li>
				</ul>
			</div>
		</div>
	</footer>
	
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>
  

  </body>
</html>