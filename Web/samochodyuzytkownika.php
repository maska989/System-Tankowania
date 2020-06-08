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
		
			<h1>Samochody użytkownika</h1>		

		
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
<!--div class contener end -->


<div class="tabela">
		<table class="contener-table" style=" margin-left:auto; margin-right:auto;">
			<thead>
				<tr>
					<th>Marka</th><th>Model</th><th>Rejestracja</th><th>Id</th><th>Komentarz</th>
				</tr>	
			</thead>
<?php
$baza=mysqli_connect("projekttankowania.cba.pl","Maska989","BazaProjekt2","maska989");

if (mysqli_connect_errno())

{echo "Wystąpił błąd połączenia z bazą";}

$wynik = mysqli_query($baza,"SELECT * FROM Samochody where idUzytkownika = '$id'");
while($row = mysqli_fetch_array($wynik))
{ ?>
	<tbody>
		<tr>
			<td> <?= $row['marka']; ?></td><td><?= $row['model']; ?></td><td><?= $row['nr_rej']; ?> </td><td><?= $row['idSamochodu']; ?>l</td><td><?= $row['komentarz']; ?></td>
		</tr>
	</tbody>	
<?php
}
?>
	</table>	
</div>
	

<div class="contener">
		<a href="dodajSamochod.php" class="zaloguj">Dodaj samochód</a>
</div>




<footer>
		<div class="footer-logowanie" >
			<div class="contener">
			<a href="">
				<img src="x.svg" class="logo1" alt="logo">
			</a>
				<p class="address">Gdzies na swiecie, 423<br>PL</p>
				<ul class="footer-link">
					<li><a href="#">Tems of Service</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>
			</div>
		</div>
</footer>
</body>
</html>