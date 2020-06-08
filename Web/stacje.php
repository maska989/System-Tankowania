<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


  <link rel="Stylesheet" type="text/css" href="style.css" />



  <title>Tankowanie</title>

</head>


<body>
<!-- sessja -->
<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
$nazwa = $_SESSION['user'];
$id = $_SESSION['id'];
?>
<?php
$data = date('d-m-Y');
?>

	<div class="contener">
		<header>
		<a href="user.php">
			<img src="x.svg" alt="System Logowania" class= "logo">
		</a>
			<nav>
				<a href="#" class="hide-desktop">
					<img src="kreski.svg" alt="menu" class= "menu" id="menu">
				</a>
			
				<ul class="show-desktop hide-mobile" id="nav">
					<li id="exit" class="exit-menu"><img src="x_1.svg" alt="exit"></li>
					<li><a href="ceny_paliw.php">Ceny paliw</a></li>
					<li><a href="stacje.php">Stacje</a></li>
					<li><a href="raport.php">Tankowania</a></li>	
					<li><a href="samochodyuzytkownika.php">Samochody</a></li>
					<li><a href="index.php">Wyloguj</a></li> <!-- improwizorka trzeba zrobic obsluge tego  -->
				</ul>
			</nav>
		</header>
		<section>
			<h1>Stacje</h1>	
			<p class="przypis">Dodane tankowania użytkowników aplikacji.</p>	
		</section>	
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
	<?php
$calosc=0;
$baza=mysqli_connect("projekttankowania.cba.pl","Maska989","BazaProjekt2","maska989");

if (mysqli_connect_errno())

{echo "Wystąpił błąd połączenia z bazą";}
$wynik = mysqli_query($baza,"SELECT * FROM Tankowania");

while($row = mysqli_fetch_array($wynik))
{ 
	$nazwaUzytkownika = mysqli_query($baza, "SELECT * FROM Uzytkownik, Tankowania WHERE $row[idUzytkownika] = Uzytkownik.idUzytkownika");
	$log = mysqli_fetch_array($nazwaUzytkownika);
	?><div class="tabela">
		<br/>
		<div class="calosc">	
			<!--<img src="xczarny.jpg" alt="System Logowania" style="	width:  15px; cursor: pointer;"> -->
			<table class="contener-table" style=" margin-left:auto; margin-right:auto;">
			
				<thead>
					<tr>
						<th>Cena</th><th>Rodzaj</th><th>Ilość</th><th>Kwota</th>
					</tr>	
				</thead>
				<tbody>
					<tr>
						<td><?= $row['cena']; ?>zł</td><td><?= $row['rodzaj']; ?> </td><td><?= $row['ilosc']; ?>l</td><td> <?= $row['kwota']; ?></td>
					</tr>
				</tbody>
			
			</table>
		<p align="left" style="font-weight: bold; margin-left: 10% ">
		Dodane przez: <?= $log['login'];?></br>
		Woj.: <?= $row['Wojewodztwo'];?></br>
		Miasto: <?= $row['miasto'];?>
		</p>
		<p align="left" style="font-weight: bold; margin-left: 10% ">Komentarz:</p><p align="center"><?= $row['kom'];?></p>
		</div>	
<?php
}
?>
</div>


</br>


	<footer>
		<div class="footer-contener" >
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
