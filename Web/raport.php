<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pl-PL" xmlns="http://www.w3.org/1999/xhtml">
<head>


  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="refresh" content="s">

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
		
			<h1>Raporty tankowań</h1>		
			<p class="przypis">Twoja dotychczasowa historia tankowań.</p>	
		
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

<div class="contener">
		
		
		<a href="tankowania.php" class="zaloguj" style="background: #2f6ced; width:250px">Dodaj tankowanie</a>

</div>

<?php
$calosc=0;
$baza=mysqli_connect("projekttankowania.cba.pl","Maska989","BazaProjekt2","maska989");

if (mysqli_connect_errno())

{echo "Wystąpił błąd połączenia z bazą";}

$wynik = mysqli_query($baza,"SELECT * FROM Tankowania where idUzytkownika = '$id'");
while($row = mysqli_fetch_array($wynik))
{ $calosc = $calosc + $row['kwota'];

	?><div class="tabela">
		</br>
		<div class="calosc">
			<!--<img src="xczarny.jpg" alt="System Logowania" style="	width:  15px; cursor: pointer;"> -->
			<table class="contener-table" style=" margin-left:auto; margin-right:auto;">
				<thead>
					<tr>
						<th>Miasto</th><th>Cena</th><th>Rodzaj</th><th>Ilość</th>
					</tr>	
				</thead>
				<tbody>
					<tr>
						<td> <?= $row['miasto']; ?></td><td><?= $row['cena']; ?>zł</td><td><?= $row['rodzaj']; ?> </td><td><?= $row['ilosc']; ?>l</td>
					</tr>
				</tbody>
			</table>
		<p align="center" style="font-weight: bold;">Komentarz</p><p align="center"><?= $row['kom'];?></p>
		<form  name = "myform" method="POST">
		<div >
			<button  name="submit" value="<?= $row['idTankowania']; ?>" style="align: center; font-size: 15px;" class="zsk2">Usuń</button>
		
		</div>
		</div>
		</form>
		
<?php
}
?>
</div>

	<p align="center" style="font-weight: bold;">Łączny koszt paliwa:</p><p align="center"><?=$calosc;?> zł</p>	

</br>
</br>
</br>
</br>
</br>
<footer>
		<div class="footer-contener" >
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
<?php
if(isset($_POST['submit'])){
	
	$usun = $_POST['submit'];
	
	
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

$sql = "DELETE FROM Tankowania where idTankowania = '$usun'";



$conn->close();

header("Location: raport.php");


}

?>



</body>
</html>