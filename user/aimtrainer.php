<?php
session_start();
$bool = false;
if (!isset($_SESSION['username'])) {
    header('location: ../guest/index.php');
} else {
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/game.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Aim game</title>
    <button type="submit" id="back" onclick="back()">
        <i class="fas fa-arrow-left"></i>
    </button>
</head>

<body>
    <!-- timer + score + start + countdown-->
    <h2 id="score">Score: 0</h2>
    <div class="content"><button id="start">Start</button>
        <div class="counter" id="count">3</div>
    </div>
    <div id="timer" class="timer">
        10
    </div>
    <button id="hit" name="hit"></button>
    <!-- popup -->
    <div class="popup-box" id="hide">
        <div class="popup-content">
            <div class="popup-icon">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <h2>Congratulations!</h2>
            <p>A NEW HIGHSCORE!</p>
            <p id="score">
                <?php echo $_COOKIE['finalscore'];
                ; ?>
            </p>
            <button class="close-btn" onclick="hide()">Close</button>
        </div>
        <!-- popup functions-->
        <script src="../js/popup.js"></script>
        <!-- sending new highscore to database-->
        <?php
        include('../controller/connectdb.php');
        $username = $_SESSION['username'];
        $cookie = $_COOKIE['finalscore'];
        $games = $_COOKIE['games'];
        $lastScore = mysqli_fetch_row($conn->query("SELECT highscore FROM aimtrainer_data WHERE username = '$username'"));
        if ($cookie == 0) {

        } else {
            $arr = explode(" ", $cookie);
            $score = $arr[1];
            if($games)
            {
                $g = mysqli_fetch_row($conn->query("SELECT games FROM aimtrainer_data WHERE username = '$username'"));
                $game = $g[0] + 1;
                $conn->query("UPDATE aimtrainer_data SET games = '$game' WHERE username = '$username'");
            }
            if ($lastScore[0] < $score) {
                echo '<script>show();</script>';
                echo '<script>celebrate();</script>';
                $conn->query("UPDATE aimtrainer_data SET highscore = '$score' WHERE username = '$username'");
            }
        }
        ?>
        <!-- script for arrow in left upper corner -->
        <script src="../js/back.js"></script>
        <!-- game brain-->
        <script src="../js/game.js"></script>
        <!-- confetti url-->
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
</body>

</html>