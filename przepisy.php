<!DOCTYPE html>
<html lang="pl-PL">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/style1.css">
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
      <?php
      require_once "connect.php";

        // Create connection
        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if(isset($_SESSION['user']))
        {
        $login = $_SESSION['user'];
        $rezultat = $conn->query("SELECT id_user FROM users WHERE user='$login'");

        $row1 = $rezultat->fetch_assoc();
      }
        $result = $conn->query("SET NAMES utf8");
        $sql = "SELECT * FROM przepisy";
        $sql2 = "SELECT * FROM pyt";
        $zapytanie=mysqli_query($conn,$sql2);
        $rowcount=mysqli_num_rows($zapytanie);
        $result = $conn->query($sql);
        $licz=1;
        if(isset($_POST['id_przep'], $_POST['id_user'], $_POST['submit'])){
        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
        $id_user = $_POST['id_user'];
        $id_przep = $_POST['id_przep'];
        $rezultat2 = $polaczenie->query("SELECT * FROM przep_users WHERE (id_przep='$id_przep' AND id_user='$id_user')");
        $czyzapisany = $rezultat2->num_rows;
        if($czyzapisany > 0)
        {
          $msg = "Zapisaleś już ten przepis";
        }
        else{
          $rezultat = $polaczenie->query("INSERT INTO przep_users VALUES (NULL, '$id_user', '$id_przep')");
          $msg = "Zapisano przepis na twoim koncie";
        }


       }

       if(isset($msg))
       {
       echo '<br><h3>'.$msg.'</h3>';
       }
        if ($result->num_rows > 0) {


            while($row = $result->fetch_assoc()) {
              //  echo "id: " . $row["id"]. " - Pytanie: " . $row["pytanie"]. " " . $row["odpa"]. "<br>";
              $skladniki  = $row["skladniki"];
              $pieces = explode(",", $skladniki);
              $ile = count($pieces);
              $opis  = $row["przygotowanie"];
              $opis2 = explode(";", $opis);
              $ile2 = count($opis2);



                ?>

                <form action="" method="post">
                <div class="row">
                <h3><?php echo $licz.'. '.$row["nazwa"]; ?></h3>
                <div class="column">
                <br><img src="img/<?php echo $row["img"]; ?>.jpg" width="300" height="300" alt="zdjecie">
                <input type="hidden" name="id_przep" value="<?php echo $row["id_przep"]; ?>">
                <input type="hidden" name="id_user" value="<?php echo $row1['id_user']; ?>">
                </div>
                <div class="column">
                  <p>Składniki</p>
                <ul>
                  <?php
                  for ($i = 0; $i < $ile; $i++) {
                      echo "<li>".$pieces[$i]."</li>";
                  }
                  ?>

                </ul>
                </div>
                <div class="column">
                  <p>Opis przygotwania</p>
                <ul>
                  <?php
                  for ($i = 0; $i < $ile2; $i++) {
                      echo "<li>".$opis2[$i]."</li>";
                  }
                  ?>
                </ul>
                  </div>
                  <?php

                  if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){

                    ?>
                    <br><button class="button" name="submit" value="Sprawdź">Zapisz Przepis</button>

                      <?php
                  }
                    ?>
                </div>
              </div>

            </form>
            <?php
              $licz++;
            }
            ?>

              <?php
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
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
