<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pl-PL" xmlns="http://www.w3.org/1999/xhtml">
<head>


  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta charset="UTF-8">


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
			<h1>Dodaj tankowanie</h1>
	
	<form method="POST">  
		
		<div id = "cenaL">
			Cena za L: <br /> <input type="text" id= "cenaLitra" name="cenaL"></input> <br /><br />
		</div>
		<p id="values"></p>
		</br>
		<div class = "rodzaj">
		<label for="paliwo">Paliwo:  </label>
		 
		<select name="rodzaj">
			<option value="Benzyna95">Benzyna95</option> 
			<option value="Benzyna95+">Benzyna95+</option> 
			<option value="Benzyna98">Benzyna98</option>
			<option value="Benzyna98+">Benzyna98+</option>
			<option value="ON">ON</option>
			<option value="ON+">ON+</option>
			<option value="LPG">LPG</option>
			<option value="CNG">CNG</option>
		</select>
		</div>
		</br>
		<div class = "ilosc">
			Ilość: <br /> <input type="text" name="ilosc"></input> <br /><br />
		</div>
		<div id = "cena">
			Cena całkowita:<br/><input type="text" name="cena"> </input><br />
		</div>
		</br>
		<div class = "miasto">
			Miasto: <br /> <input type="text" name="miasto"></input> <br /><br /> <!-- opcjonalne -->
		</div>		
	
		<div class="wojewodztwo">
			<label for="woj">Województwo:  </label>
				<select name="woj">
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
		</br>
		
		<div class = "komentarz">
			Komentarz: <br /> <textarea type="text" name="komentarz" class="kom" style="margin: 0px; height: 141px; width: 390px; resize: none;" ></textarea> <br /><br />
		</div>
		<div class = "samochod">
			<label for="samochod">Samochod:  </label>
			<select name="samochod">
				<option value="brak">brak</option>
							<?php
			$baza=mysqli_connect("projekttankowania.cba.pl","Maska989","BazaProjekt2","maska989");

			if (mysqli_connect_errno())

			{echo "Wystąpił błąd połączenia z bazą";}

			$wynik = mysqli_query($baza,"SELECT * FROM Samochody where idUzytkownika='$id'");
			while($row = mysqli_fetch_array($wynik))
			{ ?>
	
					<option value="<?= $row['idSamochodu']; ?>"><?= $row['marka']; ?> <?= $row['model']; ?> </option>
					 
			<?php
			}
			?>
			</select>
		</div>
		</br>
		<div class = "przebieg">
			Przebieg Samochodu: <br /> <input type="text" name="przebieg"></input> <br /><br />
		</div>
			<input type="submit" name="submit" onClick= "alert('Tankowanie dodane');" class="zaloguj" value="Dodaj"></input> <!-- class ma zostac bo to rodziaj formatowania -->
			
			
    </form>
		<div class="contener">
		<a href="raport.php" class="zaloguj" style="background: #2f6ced; width:250px">Moje raporty</a>
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

<script type="text/javascript">
	const input = document.querySelectorAll('input')[1];
	const input2 = document.querySelectorAll('input')[0];
	const wynik = document.querySelectorAll('input')[2];


	input.addEventListener('input', updateValue);

	function updateValue(e) {
	var zmiana = parseFloat(e.target.value);
	console.log(zmiana);
	var z = parseFloat(input2.value);
	//wynik.value = zmiana * z;
	var suma = parseFloat(zmiana * z);
	wynik.value = suma;
}


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
	$kwota = 0;
	$cena = $_POST['cenaL'];
	$rodzaj = $_POST['rodzaj'];
	$ilosc = $_POST['ilosc'];
	$miasto = $_POST['miasto'];
	$kom = $_POST['komentarz'];
	$woj = $_POST['woj'];
	$przebieg = $_POST['przebieg'];
	$id_Poj = $_POST['samochod'];
	$kwota =  $_POST['cena'];

$servername = "projekttankowania.cba.pl";
$username = "Maska989";
$password = "BazaProjekt2";
$dbname = "maska989";

if($kwota <= 0)
{
	$kwota = $cena * $ilosc;
}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Tankowania (cena, rodzaj, ilosc, miasto, kom, idUzytkownika, idSamochodu, Przebieg, Wojewodztwo, kwota)
VALUES ('$cena','$rodzaj','$ilosc', '$miasto', '$kom', '$id', '$id_Poj', '$przebieg', '$woj', '$kwota')";

if ($conn->query($sql) === TRUE) {
    echo "Raport zostal dodany";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


}

?>
</body>
</html>
