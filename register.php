<?php

	session_start();

	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;

		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];

		//Sprawdzenie długości nicka
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		}

		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}

		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}

		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];

		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}

		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

		//Czy zaakceptowano regulamin?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
		}

		//Bot or not? Oto jest pytanie!


		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id_user FROM users WHERE email='$email'");

				if (!$rezultat) throw new Exception($polaczenie->error);

				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id_user FROM users WHERE user='$nick'");

				if (!$rezultat) throw new Exception($polaczenie->error);

				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
				}

				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy

					if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$nick', '$haslo_hash', '$email', 0)"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: login.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}

				}

				$polaczenie->close();
			}

		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}

	}


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="./css/style.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
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
  <div class="bgphoto2">
    <img src="img/zelki.jpg">
      <div class="overlay2">
      </div>
  </div>
	<div id="regform">
	<form method="post">

		 <label id="usr"><b>Wybierz nazwe użytkownika:</b></label><input type="text" id="username" placeholder="Enter Username" value="<?php
			if (isset($_SESSION['fr_nick']))
			{
				echo $_SESSION['fr_nick'];
				unset($_SESSION['fr_nick']);
			}
		?>" name="nick" /></label><br />

		<?php
			if (isset($_SESSION['e_nick']))
			{
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?>

		<label id="pasw"><b>Podaj swój email:</b></label> <input id="email" placeholder="Enter email" type="text" value="<?php
			if (isset($_SESSION['fr_email']))
			{
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
		?>" name="email" /><br />

		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>

		<label id="pasw"><b>Wybierz swoje hasło: </b></label><input type="password" id="password" placeholder="Enter Password" value="<?php
			if (isset($_SESSION['fr_haslo1']))
			{
				echo $_SESSION['fr_haslo1'];
				unset($_SESSION['fr_haslo1']);
			}
		?>" name="haslo1" /><br />

		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>

		<label id="pasw"><b>Powtórz hasło: </b></label> <input type="password" id="password" placeholder="Enter Password" value="<?php
			if (isset($_SESSION['fr_haslo2']))
			{
				echo $_SESSION['fr_haslo2'];
				unset($_SESSION['fr_haslo2']);
			}
		?>" name="haslo2" /><br />

		<label>
			<input type="checkbox" name="regulamin" <?php
			if (isset($_SESSION['fr_regulamin']))
			{
				echo "checked";
				unset($_SESSION['fr_regulamin']);
			}
				?>/> Akceptuję regulamin
		</label>

		<?php
			if (isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
		?>


		<?php
			if (isset($_SESSION['e_bot']))
			{
				echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
				unset($_SESSION['e_bot']);
			}
		?>

		<br />

		<br><button class="regbutton"type="submit" />Zarejestruj się</button>
		</div>
	</form>

</body>
</html>
