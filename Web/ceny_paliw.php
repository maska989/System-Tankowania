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
		<form method="POST"> 
		<section>
			<h1>Ceny paliw</h1>	
			<p class="przypis">Zarejestrowane ceny paliw użytkowników.</p>			
			<div class="wojewodztwo">
			<label for="woj">Województwo:  </label>
				<select name="woj">
					<option value="*">Wszystkie</option>
					<option value="dolnośląskie">dolnośląskie</option>
					<option value="kujawsko-pomorskie">kujawsko-pomorskie</option>
					<option value="lubuskie">lubuskie</option>
					<option value="lubelskie">lubelskie</option>
					<option value="łódzkie">łódzkie</option>					
					<option value="małopolskie">małopolskie</option>
					<option value="mazowieckie">mazowieckie</option>
					<option value="opolskie">opolskie</option>
					<option value="podkarpackie">podkarpackie</option>
					<option value="podlaskie">podlaskie</option>
					<option value="pomorskie">pomorskie</option>
					<option value="śląskie">śląskie</option>
					<option value="świętokrzyskie">świętokrzyskie</option>
					<option value="warmińsko-mazurskie">warmińsko-mazurskie</option>
					<option value="wielkopolskie">wielkopolskie</option>
					<option value="zachodniopomorskie">zachodniopomorskie</option>
				</select>
		</div>
		</section>
		</br>
		<input type="submit" name="submit" class="zaloguj"  value="Szukaj"></input> <!-- class ma zostac bo to rodziaj formatowania -->
			
		</form>
		 
		
		<?php
 
		
		if(isset($_POST['submit'])){
			$w = $_POST['woj'];
			$_SESSION['sz'] = "SELECT * FROM Tankowania where Wojewodztwo = '$w'";
			
			if($w != '*'){
			$_SESSION['sz'] = "SELECT * FROM Tankowania where Wojewodztwo = '$w'";
			}
			else{$_SESSION['sz'] = "SELECT * FROM Tankowania";}
			header('Location: ceny_paliw.php');
 
		}
					
		
		?>
	<div class="tabela">
		<table class="contener-table" style=" margin-left:auto; margin-right:auto;">
			<thead>
				<tr>
					<th>Województwo</th><th>Cena za litr</th><th>Rodzaj</th>
				</tr>	
			</thead>
			<tbody>
<?php

$sz = $_SESSION['sz'];
$baza=mysqli_connect("projekttankowania.cba.pl","Maska989","BazaProjekt2","maska989");

if (mysqli_connect_errno())

{echo "Wystąpił błąd połączenia z bazą";}

$wynik = mysqli_query($baza,"$sz");
while($row = mysqli_fetch_array($wynik))
{ ?>
	
				<tr >
					<td> <?= $row['Wojewodztwo']; ?></td><td><?= $row['cena']; ?>zł</td><td><?= $row['rodzaj']; ?> </td>
				</tr>
		
<?php

}
?>
			</tbody>
		</table>
	<div class = "wykres">
<?php
	$B95 = 0;
	$B95I = 0;
	$wynik = mysqli_query($baza,"SELECT * FROM Tankowania where rodzaj = 'Benzyna95'");
while($row = mysqli_fetch_array($wynik))
{
	$B95 = $B95 + $row['cena'];
}

$wynik = mysqli_query($baza,"SELECT COUNT(*) FROM Tankowania where rodzaj = 'Benzyna95'");
while($row = mysqli_fetch_array($wynik))
{
	$B95I = $row['COUNT(*)'];
}
	$B95 = $B95 / $B95I;
	
	$B98 = 0;
	$B98I = 0;
	$wynik = mysqli_query($baza,"SELECT * FROM Tankowania where rodzaj = 'Benzyna98'");
while($row = mysqli_fetch_array($wynik))
{
	$B98 = $B98 + $row['cena'];
}

$wynik = mysqli_query($baza,"SELECT COUNT(*) FROM Tankowania where rodzaj = 'Benzyna98'");
while($row = mysqli_fetch_array($wynik))
{
	$B98I = $row['COUNT(*)'];
}
	$B98 = $B98 / $B98I;
	
	
$ON = 0;
	$ONI = 0;
	$wynik = mysqli_query($baza,"SELECT * FROM Tankowania where rodzaj = 'ON'");
while($row = mysqli_fetch_array($wynik))
{
	$ON = $ON + $row['cena'];
}

$wynik = mysqli_query($baza,"SELECT COUNT(*) FROM Tankowania where rodzaj = 'ON'");
while($row = mysqli_fetch_array($wynik))
{
	$ONI = $row['COUNT(*)'];
}
	$ON = $ON / $ONI;	
	
	
	
	$LPG = 0;
	$LPGI = 0;
	$wynik = mysqli_query($baza,"SELECT * FROM Tankowania where rodzaj = 'LPG'");
while($row = mysqli_fetch_array($wynik))
{
	$LPG = $LPG + $row['cena'];
}

$wynik = mysqli_query($baza,"SELECT COUNT(*) FROM Tankowania where rodzaj = 'LPG'");
while($row = mysqli_fetch_array($wynik))
{
	$LPGI = $row['COUNT(*)'];
}
	$LPG = $LPG / $LPGI;	
	
	$dataPoints = array(
	array("label"=> "Benzyna95", "y"=> $B95),
	array("label"=> "Benzyna98", "y"=> $B98),
	array("label"=> "Olej Napędowy", "y"=> $ON),
	array("label"=> "LPG", "y"=> $LPG)
);
?>	
	</div>
		</br>
	
	<script>
		window.onload = function () {
		 
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				theme: "light2",
				title: {
					text: "Średnia cena paliwa w kraju"
					},
				axisY: {
					suffix: "zł",
					scaleBreaks: {
						autoCalculate: true
						}
				},
				data: [{
					type: "column",
					yValueFormatString: "#,##0\"zł\"",
					indexLabel: "{y}",
					indexLabelPlacement: "inside",
					indexLabelFontColor: "white",
					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();
		 
		}
	</script>
	
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		
</div>

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

</body>
</html>
