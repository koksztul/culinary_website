<!DOCTYPE html>
<html lang="pl">
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
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
    <div class="bgphoto2">
      <img src="img/zelki.jpg">
        <div class="overlay2">
        </div>
    </div>
  <div id="logform">
    <form action="loginin.php" method="post">
        <label id="usr"><b>Username</b></label>
        <input type="text" id="username" placeholder="Enter Username" name="login" required>
        <br><label id="pasw"><b>Password</b></label>
        <input type="password" id="password" placeholder="Enter Password" name="haslo" required>
        <div id="lower">
        <br><button class="lgbutton" type="submit">Login</button>
        <label id="">
          <input type="checkbox" checked="checked" name="remember">Remember me
        </label>
        <br><br><button type="button" class="lgbutton">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
  </div>
  </body>
</html>
