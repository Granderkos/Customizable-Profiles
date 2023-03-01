<?php
session_start();
$bool = false;
if (isset($_SESSION['username'])) {
  $bool = true;
  $user = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/leader.css">
  <link rel="stylesheet" href="css/select.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <title>Leaderboard</title>
  <button id="back" onclick="back()">
    <i class="fas fa-arrow-left"></i>
  </button>
</head>

<body onload="leaderSelect()">
  <div class="leaderboard-container">
    <div class="custom-select">
      <!-- game selection -->
      <div class="game-select">Choose Game</div>
      <div class="search-container">
        <form id="search-form" oninput="findPlayer()">
          <!-- search -->
          <input type="text" name="search" placeholder="Search for players..." id="search-input">
          <button type="submit" id="search-button"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
    <table id="scores-table">
      <thead>
        <!-- main row -->
        <tr>
          <th>Rank</th>
          <th>Player</th>
          <th>Score</th>
          <th>Profile</th>
        </tr>
      </thead>
      <form method="POST">
        <tbody>
          <!-- player rows -->
        </tbody>
      </form>
    </table>
  </div>
  <div class="squares">
    <div class="square1">
      <div class="square-header">
        Aim Trainer
      </div>
    </div>
    <div class="square2">
      <div class="square-header">
        GAME 2
      </div>
    </div>
    <div class="square3">
      <div class="square-header">
        GAME 3
      </div>
    </div>
  </div>
  <!-- jquery -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!-- script for the search bar on the right-->
  <script src="js/search.js"></script>
  <!-- script for the select dropdown menu on the left-->
  <script src="js/select.js"></script>
  <!-- script for the arrow in left upper corner -->
  <script src="js/back.js"></script>
  <!-- script that creates function that takes users from database and puts the leaderboard by score desc-->
  <script src="js/leader.js"></script>
  <?php
  //takes the user
  include('./controller/connectdb.php');
  if (isset($_COOKIE['game'])) {
    if (strlen($_COOKIE['game']) > 0) {
      echo '<script>setInterval(()=>{';
      $game = $_COOKIE['game'];
      $game = str_replace(" ", "", $game);
      $game = strtolower($game);
      $users = mysqli_fetch_all($conn->query('SELECT username, highscore FROM ' . $game . '_data ORDER BY highscore DESC'));
      echo '}, 1)</script>';
      foreach ($users as $index => $user) {
        $names[$index] = $user[0];
        $scores[$index] = $user[1];
      }
      //puts him into leaderboard
      echo '<script>updateLeaderboard([';
      for ($i = 0; $i < count($names); $i++) {
        if ($scores[$i] != 0) {
          echo '{rank: ' . $i + 1 . ', name: "' . $names[$i] . '", score: ' . $scores[$i] . ', profles: "Profiles"},';
        }
      }
      echo ']);</script>';
      //highlights logged user
      if (!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
        for ($i = 0; $i < count($names); $i++) {
          if ($names[$i] == $username) {
            echo '<script>active("';
            echo $username;
            echo '");</script>';
          }
        }
      }
    }
  }
  ?>
</body>

</html>