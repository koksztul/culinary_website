<?php

	session_start();
require_once "connect.php";
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
		}
		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
		}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
				echo '<br />Informacja developerska: '.$e;
			}
			$login = $_SESSION['user'];
			$rezultat = $polaczenie->query("SELECT id_group FROM users WHERE user='$login'");
			$row = $rezultat->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
<link rel="stylesheet" type="text/css" href="./css/style1.css">
    <meta charset="utf-8">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans">
    <link rel="stylesheet" type="text/css" href="./css/style1.css">
  </head>
  <body>

		</div>
		<?php

			if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
			{
				?>
				<div id="menu">
			    <ul>
			      <li>
			        <a href="index.php">logo</a>
			      </li>
			      <li>
			        <a href="przepisy.php">Przepisy</a>
			      </li>
						<li>
			        <a href="quiz.php">Quiz</a>
			      </li>
			      <li>
			        <a href="panel.php"><?php echo $_SESSION['user'] ?></a>
			      </li>
						<li>
						<a href="logout.php">Wyloguj się!</a>
						</li>
			    </ul>
			  </div>
					<?php
			}
			else
			{
				?>
				<div id="menu">
					<ul>
						<li>
							<a href="index.php">logo</a>
						</li>
						<li>
							<a href="przepisy.php">Przepisy</a>
						</li>
						<li>
							<a href="quiz.php">Quiz</a>
						</li>
						<li>
							<a href="register.php">Register</a>
						</li>
						<li>
							<a href="login.php">Login</a>
						</li>
					</ul>
				</div>
				<?php
			}
		?>
    <?php


			if($row['id_group'] == 2)
			{
    ?>
		<div id="panele">
		<?php
		if(isset($_POST['dodajmoda'])){
				$login = $_POST['nick'];
				$rezultat = $polaczenie->query("SELECT id_group FROM users WHERE user='$login'");
				$row1 = $rezultat->fetch_assoc();
			if($row1['id_group'] == 1)
			{
				$message = "Użytkownik o nicku ".$login." jest już moderatorem";
			}
			else{
				$polaczenie->query("UPDATE users SET id_group='1' WHERE user='$login'");
				$message = "Użytkownik o nicku ".$login." jest od teraz moderatorem";
			}
				$polaczenie->close();
		}
		 ?>
	</form>
		<h2>Dodaj użytkownikowi moderatora</h2>
		<form action="" method="post" enctype="multipart/form-data">
					Podaj nazwe użytkownika:<br>
					<input type="text" name="nick">
			<br><input type="submit" value="Dodaj moda" name="dodajmoda">
		</form>
		<?php if(isset($message)) {
			echo $message;
		} ?>
		<?php
		if(isset($_POST['zabierzmoda'])){
		$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
		$login = $_POST['nick'];
    $rezultat = $polaczenie->query("SELECT id_group FROM users WHERE user='$login'");
    $row2 = $rezultat->fetch_assoc();
    if($row2['id_group'] == 0)
    {
      $message1 = "Użytkownik o nicku ".$login." nie jest już moderatorem";
    }
    else{
    $polaczenie->query("UPDATE users SET id_group='0' WHERE user='$login'");
      $message1 = "Użytkownik o nicku ".$login." jest od teraz użytkownikiem";
    }
		$polaczenie->close();
	}
		?>
		<h2>Zabierz moderatora</h2>
		<form action="" method="post" enctype="multipart/form-data">
					Podaj nazwe użytkownika:<br>
					<input type="text" name="nick">
			<br><input type="submit" value="Zabierz moda" name="zabierzmoda">
		</form>
		<?php if(isset($message1)) {
			echo $message1;
		} ?>
		<?php
		if(isset($_POST["dodajprzepis"])) {
		require_once "connect.php";
		$target_dir = "img/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image

		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $message2 = "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        $message2 = "File is not an image.";
		        $uploadOk = 0;
		    }

		// Check if file already exists
		if (file_exists($target_file)) {
		    $message2 = "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
		    $message2 = "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" ) {
		    $message2 = "Sorry, only JPG files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $message2 = "Pytanie i zdjecie nie zostalo dodane.";
		// if everything is ok, try to upload file
		} else {
		    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		        $message2 = "Przepis i zdjecie ". basename( $_FILES["fileToUpload"]["name"]). " zostalo dodane.";
						$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
						$nazwa = $_POST['nazwa'];
						$przepis = $_POST['przepis'];
						$skladniki = $_POST['skladniki'];
						$img = substr(basename( $_FILES["fileToUpload"]["name"]), 0, -4);
						$polaczenie->query("INSERT INTO przepisy VALUES (NULL, '$nazwa', '$przepis', '$skladniki', '$img')");


		    }
				else {
		        $message2 = "Sorry, there was an error uploading your file.";
		    }
		}
		}
		?>

		<h2>Dodaj przepis</h2>
		<form action="" method="post" enctype="multipart/form-data">
					Podaj nazwe przepisu:<br>
					<input type="text" name="nazwa">
					<br>Podaj składniki przepisu:<br>
					<input type="text"name="skladniki">
					<br>Podaj przepis:<br>
					<input type="text" name="przepis">
					<br>Wybierz zdjęcie potrawy:<br>
			   	<input type="file" name="fileToUpload" id="fileToUpload">
			<br><input type="submit" value="Dodaj przepis" name="dodajprzepis">
		</form>
		<?php if(isset($message2)) {
			echo $message2;
		} ?>
		<?php
		require_once "connect.php";
		if((isset($_POST['dodajpyt']))) {
		$target_dir = "img/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image

		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $message3 = "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        $message3 = "File is not an image.";
		        $uploadOk = 0;
		    }

		// Check if file already exists
		if (file_exists($target_file)) {
		    $message3 = "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
		    $message3 = "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" ) {
		    $message3 = "Sorry, only JPG files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $message3 = "Zdjecie i pytanie nie zostalo dodane.";
		// if everything is ok, try to upload file
		} else {
		    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		        $message3 = "Pytanie i zdjecie ". basename( $_FILES["fileToUpload"]["name"]). " zostalo dodane.";
						$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
						$pytanie = $_POST['pytanie'];
						$odpa = $_POST['odpa'];
						$odpb = $_POST['odpb'];
						$odpc = $_POST['odpc'];
						$odpd = $_POST['odpd'];
				 	  $poprawna = $_POST['poprawna'];
						$img = substr(basename( $_FILES["fileToUpload"]["name"]), 0, -4);
						$polaczenie->query("INSERT INTO pyt VALUES (NULL, '$pytanie', '$odpa', '$odpb', '$odpc', '$odpd', '$poprawna', '$img')");
		    }
				else {
		        $message3 = "Sorry, there was an error uploading your file.";
		    }
		}
		}
		?>

			<h2>Dodaj Pytanie</h2>
			<form action="" method="post" enctype="multipart/form-data">
						Podaj nazwe pytania:<br>
						<input type="text" name="pytanie">
						<br>Podaj odpA:<br>
						<input type="text"name="odpa">
						<br>Podaj odpB:<br>
						<input type="text"name="odpb">
						<br>Podaj odpC:<br>
						<input type="text"name="odpc">
						<br>Podaj odpD:<br>
						<input type="text"name="odpd">
						<br>Podaj poprawna odpowiedz:<br>
						<input type="text"name="poprawna">
						<br>Dodaj zdjecie do pytania:<br>
						<input type="file" name="fileToUpload" id="fileToUpload">
				<br><input type="submit" value="Dodaj Pytanie" name="dodajpyt">
			</form>
			<?php if(isset($message3)) {
				echo $message3;
			} ?>
<?php
}
if($row['id_group'] == 1)
{
	?>
	<h2>Dodaj przepis</h2>
	<form action="przepis.php" method="post" enctype="multipart/form-data">

				Podaj nazwe przepisu:<br>
				<input type="text" name="nazwa">
				<br>Podaj składniki przepisu:<br>
				<input type="text"name="skladniki">
				<br>Podaj przepis:<br>
				<input type="text" name="przepis">
				<br>Wybierz zdjęcie potrawy:<br>
				<input type="file" name="fileToUpload" id="fileToUpload">
		<br><input type="submit" value="Dodaj przepis" name="submit">
	</form>

		<h2>Dodaj Pytanie</h2>
		<form action="dodajpyt.php" method="post" enctype="multipart/form-data">
					Podaj nazwe pytania:<br>
					<input type="text" name="pytanie">
					<br>Podaj odpA:<br>
					<input type="text"name="odpa">
					<br>Podaj odpB:<br>
					<input type="text"name="odpb">
					<br>Podaj odpC:<br>
					<input type="text"name="odpc">
					<br>Podaj odpD:<br>
					<input type="text"name="odpd">
					<br>Podaj poprawna odpowiedz:<br>
					<input type="text"name="poprawna">
					<br>Dodaj zdjecie do pytania:<br>
					<input type="file" name="fileToUpload" id="fileToUpload">
			<br><input type="submit" value="Dodaj Pytanie" name="submit">
		</form>
		<?php
}

if($row['id_group'] == 0){
echo '<br><h1> Twoje zapisane przepisy</h1>';
	if ($polaczenie->connect_error) {
			die("Connection failed: " . $polaczenie->connect_error);
	}
	$login = $_SESSION['user'];
	$rezultat = $polaczenie->query("SELECT id_user FROM users WHERE user='$login'");
	$row1 = $rezultat->fetch_assoc();


	$zmienna = $row1['id_user'];
	$sql = "SELECT * FROM przep_users WHERE id_user='$zmienna'";
	$result = $polaczenie->query($sql);

	$koszyk= array();
	$i=0;
	  while($row = $result->fetch_assoc()) {
			$koszyk[$i] = $row['id_przep'];
			$i++;
		}
		$ile = count($koszyk);
		$licz = 1;
		for($i=0; $i < $ile; $i++)
		{
		$sql = "SELECT * FROM przepisy WHERE id_przep='$koszyk[$i]'";
		$result = $polaczenie->query("SET NAMES utf8");
		$result = $polaczenie->query($sql);

				while($row = $result->fetch_assoc()) {
					$skladniki  = $row["skladniki"];
					$pieces = explode(",", $skladniki);
					$liczba = count($pieces);
					$opis  = $row["przygotowanie"];
					$opis2 = explode(";", $opis);
					$ile2 = count($opis2);
					?>
					<form action="" method="post">
					<div class="row">
					<h3><?php echo $licz.'. '.$row["nazwa"]; ?></h3>
					<div class="column">
					<br><img src="img/<?php echo $row["img"]; ?>.jpg" width="300" height="300" alt="zdjecie">
				</div>
					<div class="column">
						<p>Składniki</p>
					<ul>
						<?php
						for ($x = 0; $x < $liczba; $x++) {
								echo "<li>".$pieces[$x]."</li>";
						}
						?>

					</ul>
					</div>
				<div class="column">
					<p>Opis przygotwania</p>
				<ul>
					<?php
					for ($y = 0; $y < $ile2; $y++) {
							echo "<li>".$opis2[$y]."</li>";
					}
					?>
				</ul>
					</div>
				</div>
			</form>
					<?php
					$licz++;
				}
	}

}
?>
</div>
<div class="big-foot">
  <div class="footer-social-icons">
    <ul>
      <li><a href="#" target="blank"><i class="fab fa-facebook"></i></a></li>
      <li><a href="#" target="blank"><i class="fab fa-twitter"></i></a></li>
      <li><a href="#" target="blank"><i class="fab fa-google-plus"></i></a></li>
      <li><a href="#" target="blank"><i class="fab fa-youtube"></i></a></li>
    </ul>
  </div>
  <div class="footer-menu">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">About us</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Products</a></li>
      <li><a href="#">Contact us</a></li>
    </ul>
  </div>
</div>
</body>
</html>
