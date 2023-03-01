<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: ../user/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <!-- welcome message with buttons -->
    <h1>Welcome</h1>
  <h4>Please login/register to play</h4>
  <form method="POST">
    <button id="login" name="login">Login</button>
    <button id="leader" name="leader">Leaderboard</button>
    <button id="register" name="register">Register</button>
  </form>
    <!-- buttons controls -->
    <?php
    if(isset($_POST['register']))
    {
        header("Location: ../controller/register.php");
    }
    else if (isset($_POST['login']))
    {
        header("Location: ../controller/login.php");
    }
    else if (isset($_POST['leader']))
    {
        header("Location: ../leader.php");
    }
    ?>
</body>

</html>