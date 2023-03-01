<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Login</title>
    <button id="back" onclick="back()">
        <i class="fas fa-arrow-left"></i>
    </button>
</head>

<body>
    <!-- login form -->
    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username" class="label-control">Username:</label>
                <input type="text" class="form-control input-field" id="username" name="username"  placeholder="Username"required>
            </div>
            <div class="form-group">
                <label for="password" class="label-control">Password:</label>
                <input type="password" class="form-control input-field" id="password" name="password" placeholder="Password"required>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label" for="remember">Remember me
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <span class="checkmark"></span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="login_btn">Submit</button>
        </form>
    </div>
    <!-- checks if user exists -->
    <?php
    if (isset($_POST['login_btn'])) {
        include('connectdb.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (mysqli_fetch_row($conn->query("SELECT * FROM userdata Where username = '$username'")) != null) {
            $pass = mysqli_fetch_row($conn->query("SELECT pass FROM userdata Where username = '$username'"));
            if (password_verify($password, $pass[0])) {
                //login was successful
                if (empty($_POST['remember'])) {
                    $_SESSION['remember'] = false;
                } else {
                    $_SESSION['remember'] = true;
                }
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
                $_SESSION['username'] = strtolower($username);
                header('location: ../user/index.php');
                $conn->close();
            } else {
                //wrong password
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            //wrong username
            $error_message = "Incorrect username. Please try again.";
        }
        if (!empty($error_message)) {
            echo "<p class='text-danger'>" . $error_message . "</p>";
        }
    }
    ?>
    <!-- script for arrow in left upper corner -->
    <script src="../js/back.js"></script>
</body>

</html>