

<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans">
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

	<div class="bgphoto">
		<img src="img/zelki.jpg">
			<div class="overlay">
				<div class="content1">
					the title <a> read more</a>
				</div>
			</div>
	</div>

	<div class="box1">
		<div class="hint1photo"><img src="img/zelki1.jpg"></div>
		<div class="hint1text">
			<h1>Welcome to our project page!</h1>
			<p>Page is about food so now im writting some stuff to cover that div lol</p>
			<p>Page is about food so now im writting some stuff to cover that div lol</p>
		</div>
	</div>

  <div class="divers">
  	<div class="container">
<?php

require_once "connect.php";
// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SET NAMES utf8");
$sql = "SELECT * FROM przepisy ORDER BY rand() limit 3";
$result = $conn->query($sql);
$licz=1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $skladniki  = $row["skladniki"];
      $pieces = explode(",", $skladniki);
      $ile = count($pieces);
      $opis  = $row["przygotowanie"];
      $opis2 = explode(";", $opis);
      $ile2 = count($opis2);


    //  explode(',', $string);
 ?>

		<div class="box">
			<div class="icon"></div>
			<div class="content">
				<h3><?php echo $row["nazwa"]; ?></h3>
				<p><?php echo substr($row["przygotowanie"], 0, 200); ?></p>
				<div class="adivers">
				<a href=".php">Read more</a>
			</div>
			</div>
		</div>



<?php
  }
}
?>
</div>
</div>

<div class="box2">
<div class="hint2photo"><img src="img/zelki1.jpg"></div>
<div class="hint2text">
	<h1>Welcome to our project page!</h1>
	<p>Page is about food so now im writting some stuff to cover that div lol</p>
	<p>Page is about food so now im writting some stuff to cover that div lol</p>
</div>
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
