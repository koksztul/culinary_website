<!DOCTYPE html>
<html lang="pl" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="./css/examstyle.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans">
		<title></title>
	</head>
	<body>
		<?php
			session_start();

			if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
			{
				?>
				<div id="menu">
			    <ul>
			      <li>
			        <a href="index.php">logo</a>
			      </li>
			      <li>
			        <a href="recipe.php">Przepisy</a>
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
							<a href="recipe.php">Przepisy</a>
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
	$lpytan = $_POST['lpytan'];
	$poprawna = $_POST['poprawna1'];
	$zaznaczone=$_POST['pyt1'];

	$pkt = 0;
	for($i=1; $i <= $lpytan; $i++)
	{
		echo '<div class="row">';
		$pytanie = 'pytanie'.$i;
		$poprawna = 'poprawna'.$i;
		$zaznaczone = 'pyt'.$i;
		$zdjecie = 'zdjecie'.$i;
		if(isset($_POST[$zaznaczone]))
		{
		  if( $_POST[$zaznaczone] == $_POST[$poprawna])
			{
				$pkt++;

				echo $i.".  ". $_POST[$pytanie]."<br>";
				echo '<img src="img/'.trim($_POST[$zdjecie], " ").'.jpg" alt="zdjecie"><br>';
				echo '<font color="green"> Twoja odpowiedź: '. $_POST[$zaznaczone].'</font><br>';
				echo "Poprawna Odpowiedź: ". $_POST[$poprawna]."<br><br>";
			}
			else {
				echo $i.".  ". $_POST[$pytanie]."<br>";
				echo '<img src="img/'.trim($_POST[$zdjecie], " ").'.jpg" alt="zdjecie"><br>';
				echo '<font color="red"> Twoja odpowiedź: '. $_POST[$zaznaczone].'</font><br>';
				echo "Poprawna Odpowiedź: ". $_POST[$poprawna]."<br><br>";
			}
				echo '</div>';
		}
		else{
				header('Location: quiz.php');
		}
	}
	echo "<br><h1>Zdobyte punkty:".$pkt."</h1><br>";

?>
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
