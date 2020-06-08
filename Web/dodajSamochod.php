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
					<li><a href="index.php">Wyloguj</a></li>  <!-- improwizorka trzeba zrobic obsluge tego  -->
				</ul>
			</nav>
		</header>
		<section>
			<h1>Dodaj samochód użytkownika</h1>
	
	<form method="POST">  
		<div id = "marka">
				<label for="marka">Marka:  </label>		 
				<select name="rodzaj">
					<option value="Abarth">Abarth</option> 
					<option value="Alfa Romeo">Alfa Romeo</option>
					<option value="Aston Martin">Aston Martin</option>
					<option value="Audi">Audi</option>
					<option value="Bentley">Bentley</option>
					<option value="BMW">BMW</option> 
					<option value="Bugatti">Bugatti</option>
					<option value="Cadillac">Cadillac</option>
					<option value="Chevrolet">Chevrolet</option>
					<option value="Chrysler">Chrysler</option>
					<option value="Citroen">Citroen</option> 
					<option value="Dacia">Dacia</option>
					<option value="Daewoo">Daewoo</option>
					<option value="Daihatsu">Daihatsu</option>
					<option value="Dodge">Dodge</option>
					<option value="Ferrari">Ferrari</option> 
					<option value="Fiat">Fiat</option>
					<option value="Ford">Ford</option>
					<option value="FSO">FSO</option>
					<option value="Honda">Honda</option>
					<option value="Hummer">Hummer</option> 
					<option value="Hyundai">Hyundai</option>
					<option value="Infiniti">Infiniti</option>
					<option value="Jaguar">Jaguar</option>
					<option value="Jeep">Jeep</option>
					<option value="Kia">Kia</option> 
					<option value="Koenigsegg">Koenigsegg</option>
					<option value="Lamborghini">Lamborghini</option>
					<option value="Lancia">Lancia</option>
					<option value="Land Rover">Land Rover</option>
					<option value="Lexus">Lexus</option> 
					<option value="Łada">Łada</option>
					<option value="Lotus">Lotus</option>
					<option value="Lincoln">Lincoln</option>
					<option value="Maserati">Maserati</option>
					<option value="Maybach">Maybach</option> 
					<option value="Mazda">Mazda</option>
					<option value="McLaren">McLaren</option>
					<option value="Mercedes-Benz">Mercedes-Benz</option>
					<option value="MG">MG</option>
					<option value="Mini">Mini</option> 
					<option value="Mitsubishi">Mitsubishi</option>
					<option value="Nissan">Nissan</option>
					<option value="Opel">Opel</option>
					<option value="Peugeot">Peugeot</option>
					<option value="Porsche">Porsche</option> 
					<option value="Renault">Renault</option>
					<option value="Rolls-Royce">Rolls-Royce</option>
					<option value="Saab">Saab</option>
					<option value="Rover">Rover</option>
					<option value="Seat">Seat</option> 
					<option value="Skoda">Skoda</option>
					<option value="Smart">Smart</option>
					<option value="SsangYong">SsangYong</option>
					<option value="Subaru">Subaru</option>
					<option value="Suzuki">Suzuki</option> 
					<option value="Syrena">Syrena</option>
					<option value="TATA">TATA</option>
					<option value="UAZ">UAZ</option>
					<option value="Toyota">Toyota</option>
					<option value="Trabant">Trabant</option> 
					<option value="Volkswagen">Volkswagen</option>
					<option value="Volvo">Volvo</option>
					<option value="Wartburg">Wartburg</option>
					
				</select>
		</div>
<br />		
		<div class = "model">
			Model :<br/><input type="text" name="model"> </input><br />
		</div>
<br />
		<div class = "komentarz">
			Komentarz: <br /> <textarea type="text" name="komentarz" class="kom" style="margin: 0px; height: 300px; width: 390px; resize: none;" ></textarea> <br /><br />
		</div>
		<div class = "model">
			Numer Rejestracyjny :<br/><input type="text" name="numer"> </input><br />
		</div>
		<br />			
			<input type="submit" name="submit" onClick= "alert('Samochód dodany');" class="zaloguj" value="Dodaj"></input> <!-- class ma zostac bo to rodziaj formatowania -->
			
			
    </form>
		<div class="contener">
		<a href="samochodyuzytkownika.php" class="zaloguj" style="background: #2f6ced; width:250px">Samochody</a>
		</div>
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


	<footer>
		<div class="footer-contener">
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

	$rodzaj = $_POST['rodzaj'];
	$model = $_POST['model'];
	$komentarz = $_POST['komentarz'];
	$numer = $_POST['numer'];
	



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

$sql = "INSERT INTO Samochody (idUzytkownika, marka, model, nr_rej, komentarz)
VALUES ('$id','$rodzaj','$model', '$numer', '$komentarz')";

if ($conn->query($sql) === TRUE) {
    echo "Samochod zostal dodany";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


}
?>



</body>
</html>
