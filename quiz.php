<!DOCTYPE html>
<html lang="pl-PL">
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/examstyle.css">
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
  <div id="examform">
    <form action="endquiz.php" method="post">
      <?php
      require_once "connect.php";

        // Create connection
        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query("SET NAMES utf8");
        $sql = "SELECT * FROM pyt ORDER BY rand() limit 5";
        $sql2 = "SELECT * FROM pyt";
        $zapytanie=mysqli_query($conn,$sql2);
        $rowcount=mysqli_num_rows($zapytanie);
        $result = $conn->query($sql);
        $licz=1;
        echo "<br><h1>Wylosowano 5 z " .$rowcount." pytań</h1>";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              //  echo "id: " . $row["id"]. " - Pytanie: " . $row["pytanie"]. " " . $row["odpa"]. "<br>";

                ?>
                <div class="row">
                <h3><?php echo $licz.". ".$row["pytanie"] ?> :<h3>
                <img src="img/<?php echo $row["img"]; ?>.jpg" alt="zdjecie">
                <label>
                  <br><input type="radio" name="pyt<?php echo $licz; ?>" value="<?php echo $row["odpa"] ?>"> <?php echo $row["odpa"] ?>
                </label>
                <label>
                  <br><input type="radio" name="pyt<?php echo $licz; ?>" value="<?php echo $row["odpb"] ?>"> <?php echo $row["odpb"] ?>
                </label>
                <label>
                  <br><input type="radio" name="pyt<?php echo $licz; ?>" value="<?php echo $row["odpc"] ?>"> <?php echo $row["odpc"] ?>
                </label>
                <label>
                  <br><input type="radio" name="pyt<?php echo $licz; ?>" value="<?php echo $row["odpd"] ?>"> <?php echo $row["odpd"] ?>
                </label>
                <label>
                <br>  <input id="hiddenrad" type="pyt<?php echo $licz; ?>" name="poprawna<?php echo $licz; ?>" value="<?php echo $row["poprawna"] ?>">
                </label>
                <input id="lpytan" type="text" name="lpytan" value="<?php echo $licz; ?>">
                <input id="pytanie" type="text" name="pytanie<?php echo $licz?>" value="<?php echo $row["pytanie"] ?> ">
                <input id="zdjecie" type="text" name="zdjecie<?php echo $licz?>" value="<?php echo $row["img"] ?> ">
              </div>
            <?php
              $licz++;
            }
            ?>


            </div>
              <button class="button" name="food" value="Sprawdź">Sprawdź</button>
              <?php
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
      </div>

    </form>
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
