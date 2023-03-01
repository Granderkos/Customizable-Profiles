<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../guest/index.php');
}
if (isset($_SESSION['remember'])) {
    if (!($_SESSION['remember'])) {
        if (time() >= $_SESSION['expire']) {
            session_destroy();
        }
    }
}
$username = $_SESSION['username'];
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
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body>
    <div class="action">
        <!-- pfp left upper corner -->
        <div class="profile" onclick="menuToggle();">
            <div class="pfp"></div>
            <?php
                if (file_exists("../images/pfp/$username-pfp.png")) {
                    echo '<script>document.querySelector(".pfp").style.backgroundImage = "url(' . '../images/pfp/'.$username.'-pfp.png' . ')";</script>';
                }
                else if (file_exists("../images/pfp/default_pfp.png")) {
                    echo '<script>document.querySelector(".pfp").style.backgroundImage = "url(' . '../images/pfp/default_pfp.png' . ')";</script>';
                }
             ?>
        </div>
        <div class="menu">
            <h3>
                <?php echo $username; ?>
            </h3>
            <ul>
                <li>
                    <i class="fa-regular fa-circle-user"></i><a
                        href="../profiles/<?php echo $username; ?>-profile.php">My profile</a>
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right-from-bracket"></i><a href="../controller/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- buttons + welcome message -->
    <h1>Welcome
        <?php echo $username; ?>
    </h1>
    <h4>NEW!! you can now customize your profile</h4>
    <form method="POST">
        <button id="login" name="play">Play</button>
        <button id="leader" name="leader">Leaderboard</button>
        <button id="register" name="logout">Logout</button>
    </form>
    <!-- button controls -->
    <?php
    if (isset($_POST['play'])) {
        header("Location: ../user/games.php");
    } else if (isset($_POST['leader'])) {
        header("Location: ../leader.php");
    } else if (isset($_POST['logout'])) {
        header("Location: ../controller/logout.php");
    }
    ?>
    <script src="../js/index.js"></script>
</body>

</html>