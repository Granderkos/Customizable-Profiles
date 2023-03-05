<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <button id="back" onclick="back()">
        <i class="fas fa-arrow-left"></i>
    </button>
</head>

<body>
    <!-- register from -->
    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username" class="label-control">Username:</label>
                <input type="text" class="form-control input-field" id="username" name="username" placeholder="Username"required>
            </div>
            <div class="form-group">
                <label for="password" class="label-control">Password:</label>
                <input type="password" class="form-control input-field" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="passworda" class="label-control">Password again:</label>
                <input type="password" class="form-control input-field" id="passworda" name="passworda" placeholder="Password"required>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label" for="login">Log me in
                    <input type="checkbox" class="form-check-input" id="login" name="login">
                    <span class="checkmark"></span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="login_btn">Submit</button>
        </form>
    </div>
    <!-- makes the user into database -->
    <?php
    if (isset($_POST['login_btn'])) {
        include('connectdb.php');
        $username = ($_POST['username']);
        $password = $_POST['password'];
        $passworda = $_POST['passworda'];
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $q = $conn->query("SELECT * FROM userdata WHERE username = '$username'");
        $num = mysqli_num_rows($q);
        if ($num >= 1) {
            //user already exists so guest goes back to guest gui
            echo "<p class='text-danger'>Username already exists</p>";
        } else if ($password != $passworda) {
            //password is different that password again or vice versa
            echo "<p class='text-danger'>Passwords don't match</p>";
        } else if (strlen($username) > 20) {
            //username is longer that 20 characters
            echo "<p class='text-danger'>Username is too long</p>";
        } else {
            $date = date("Y-m-d");
            // sends sends logged user into user gui
            $conn->query("INSERT INTO userdata (username, pass, creation) values('$username','$pass','$date')");
            $conn->query("INSERT INTO aimtrainer_data (username, highscore) values('$username',0)");
            $conn->query("INSERT INTO game2_data (username, highscore) values('$username',0)");
            if (!empty($_POST['login'])) {
                $_SESSION['username'] = strtolower($username);
                header('location: ../user/index.php');
                echo '<script> sessionStorage.setItem("username", ' . strtolower($username) . ') </script>';
            } else {
                header('location: ../guest/index.php');
            }
            if (!file_exists('../profiles/')) {
                mkdir('../profiles/', 0777, true);
            }
            //HTML and PHP creation for new users profile
            $File = fopen("../profiles/" . $username . "-profile.php", "w");
            fwrite($File, '<?php
            session_start();
            include("../controller/connectdb.php");
            $username = explode("-", basename(__FILE__, ".php"))[0];
            $creation = mysqli_fetch_row($conn->query("SELECT * FROM userdata WHERE username = '."'$username'".'"))[3];
            $format = explode("-", $creation);
            $bool = false;
            $select = false;
            if (isset($_SESSION["username"])) {
                $bool = true;
                $user = $_SESSION["username"];
            }
            $creationDate = $format[1] . "/" . $format[2] . "/" . $format[0]
                ?>
            <!DOCTYPE html>
            <html lang="en" >
            
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../css/style.css">
                <link rel="stylesheet" href="../css/profiles.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
                <title>
                    Profile of <?php echo $username; ?>
                </title>
                <button id="back" onclick="back()">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </head>
            
            <body onload="selectedGame()">
                <div class="container">
                    <div class="banner">
                        <?php
                        if (isset($user)) {
                            if ($user == $username) {
                                ?>
                                <form method="POST" enctype="multipart/form-data">
                                    <label for="changebanner">
                                        <i class="fa-solid fa-pencil"></i>
                                    </label>
                                    <input type="file" id="changebanner" name="changebanner" style="display: none;"
                                        onchange="this.form.submit();">
                                </form>
                                <?php
                                if (file_exists("../images/banner/$username-banner.png")) {
                                    echo '."'<script>document.querySelector(`.banner`).style.backgroundImage = `url(' . '../images/banner/$username-banner.png' . ')`;</script>'".';
                                }
                                else if (file_exists("../images/banner/default_banner.png")) {
                                    echo '."'<script>document.querySelector(`.banner`).style.backgroundImage = `url(' . '../images/banner/default_banner.png' . ')`;</script>'".';
                                }
                            }
                            else
                            {
                                if (file_exists("../images/banner/$username-banner.png")) {
                                    echo '."'<script>document.querySelector(`.banner`).style.backgroundImage = `url(' . '../images/banner/pp-banner.png' . ')`;</script>'".';
                                }
                                else if (file_exists("../images/banner/default_banner.png")) {
                                    echo '."'<script>document.querySelector(`.banner`).style.backgroundImage = `url(' . '../images/banner/default_banner.png' . ')`;</script>'".';
                                }
                            }
                        }
                        else
                        {
                            if (file_exists("../images/banner/$username-banner.png")) {
                                echo '."'<script>document.querySelector(`.banner`).style.backgroundImage = `url(' . '../images/banner/$username-banner.png' . ')`;</script>'".';
                            }
                            else if (file_exists("../images/banner/default_banner.png")) {
                                echo '."'<script>document.querySelector(`.banner`).style.backgroundImage = `url(' . '../images/banner/default_banner.png' . ')`;</script>'".';
                            }
                        } ?>
                    </div>
                    <nav>
                        <ul>
                            <?php
                            //change banner 
                            if (isset($_FILES["changebanner"])) {
                                if ($_FILES["changebanner"]["error"] == 0) {
                                    $allowedTypes = array("image/jpeg", "image/png", "image/gif");
                                    if (!in_array($_FILES["changebanner"]["type"], $allowedTypes)) {
                                    } else if ($_FILES["changebanner"]["size"] > 10485760) {
                                    } else {
                                        $_FILES["changebanner"]["name"] = $username."-banner.png";
                                        move_uploaded_file($_FILES["changebanner"]["tmp_name"], "../images/banner/" . $_FILES["changebanner"]["name"]);
                                        echo '."'<script>document.querySelector(`.banner`).style.backgroundImage = `url(' . '../images/banner/$username-banner.png' . ')`;</script>'".';
                                    }
                                }
                            }
                            //checks if user is profile owner or not 
                            if (isset($user)) {
                                if ($user == $username) {
            
                                    ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <label for="changepfp">
                                            <div class="pfp" onclick="change()"></div>
                                        </label>
                                        <input type="file" id="changepfp" name="changepfp" style="display: none;"
                                            onchange="this.form.submit();">
                                    </form>
                                    <script>document.querySelector(".pfp").style.cursor = "pointer";</script>
                                    <?php
                                    
                                } else {
                                    ?>
                                    <div class="pfp"></div>
                                    <script>document.querySelector(".pfp").style.cursor = "default";</script>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="pfp"></div>
                                <script>document.querySelector(".pfp").style.cursor = "default";</script>
                                <?php
                            }
                            if (file_exists("../images/pfp/$username-pfp.png")) {
                                echo '."'<script>document.querySelector(`.pfp`).style.backgroundImage = `url(' . '../images/pfp/$username-pfp.png' . ')`;</script>'".';
                            }
                            else if (file_exists("../images/pfp/default_pfp.png")) {
                                echo '."'<script>document.querySelector(`.pfp`).style.backgroundImage = `url(' . '../images/pfp/default_pfp.png' . ')`;</script>'".';
                            }
                            //pfp change
                            if (isset($_FILES["changepfp"])) {
                                if ($_FILES["changepfp"]["error"] == 0) {
                                    $allowedTypes = array("image/jpeg", "image/png", "image/gif");
                                    if (!in_array($_FILES["changepfp"]["type"], $allowedTypes)) {
                                    } else if ($_FILES["changepfp"]["size"] > 10485760) {
                                    } else {
                                        $_FILES["changepfp"]["name"] = $username."-pfp.png";
                                        move_uploaded_file($_FILES["changepfp"]["tmp_name"], "../images/pfp/" . $_FILES["changepfp"]["name"]);
                                        echo '."'<script>document.querySelector(`.pfp`).style.backgroundImage = `url(' . '../images/pfp/$username-pfp.png' . ')`;</script>'".';
                                    }
                                }
                            }
                            ?>
                            <h2 class="name">
                                <?php echo $username; ?>
                            </h2>
                        </ul>
                    </nav>
                    <main>
                        <section id="time-played">
                            <h2>Time played</h2>
                            <select name="played-time" onchange="profileSelected()">
                                <option value="aimtrainer">Aim Trainer</option>
                                <option value="game2">Game 2</option>
                                <option value="game3">Game 3</option>
                            </select>
                            <div class="tStat">
                                <p class="tStat-title">Time Played:</p>
                                <p class="stat-value" id="times-played">Not added yet, working on it</p>
                            </div>
                        </section>
                        <section id="user-stats">
                            <h2>User Stats</h2>
                                <select name="user-stats" id="select-stats" onchange="profileSelect()">
                                    <option hidden selected="selected">Choose game</option>
                                    <option id="1" value="aimtrainer">Aim Trainer</option>
                                    <option id="2" value="game2">Game 2</option>
                                    <option id="3" value="game3">Game 3</option>
                                </select>
                            <div class="uStat">
                                <p class="uStat-title">Games Played:</p>
                                <p class="stat-value" id="games-played">
                                <?php
                                    if(isset($_COOKIE["selected"]))
                                    {
                                        if(strlen($_COOKIE["selected"]) > 0)
                                        {
                                            $name = $_COOKIE["selected"];
                                            echo mysqli_fetch_row($conn->query("SELECT games FROM ".$name."_data WHERE username = '."'$username'".'"))[0]; 
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="uStat">
                                <p class="uStat-title">Win Ratio:</p>
                                <p class="stat-value" id="win-ratio">Not added yet, working on it</p>
                            </div>
                            <div class="uStat-last">
                                <p class="uStat-title">High Score:</p>
                                <p class="stat-value" id="high-score">
                                <?php 
                                    if(isset($_COOKIE["selected"]))
                                    {
                                    if (strlen($_COOKIE["selected"]) > 0) {
                                        $name = $_COOKIE["selected"];
                                        echo mysqli_fetch_row($conn->query("SELECT highscore FROM " . $name . "_data WHERE username = '."'$username'".'"))[0];
                                    }
                                    }
                                    ?>
                                </p>
                            </div>
                        </section>
                        <section id="recent-plays">
                            <p class="recent-plays-text">Recent plays: Not added yet, working on it</p>
                        </section>
                    </main>
                    <h2>Member since</h2>
                    <p class="creation">
                        <?php echo $creationDate ?>
                    </p>
                </div>
                <script src="../js/back.js"></script>
                <script src="../js/submit.js"></script>
                <script src="../js/select.js"></script>
            </body>
            
            </html>');
            fclose($File);
        }
        $conn->close();
    }
    ?>
    <!-- script for arrow in left upper corner -->
    <script src="../js/back.js"></script>
</body>

</html>