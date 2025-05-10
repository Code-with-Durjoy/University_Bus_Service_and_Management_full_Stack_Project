<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: home_bus.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/4a333ea59a.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <h1>GREEN UNIVERSITY BUS SERVICE</h1>
        <div class="form-box">
            <?php
            if (isset($_POST["submit2"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("Location: home_bus.php");
                        die();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }
            }
            ?>

            <h1 id="title">Sign In</h1>
            <form action="index.php" method="post">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="password" name="password">
                    </div>
                    <p>For Admin Log-in<a href="adminlogin.php">Click Here!</a></p>
                </div>
                <div class="btn-field">
                    <button type="button" id="signupBtn" name="submit1" class="disable"> <a href="login.php">Sign Up</a></button>
                    <button type="submit" id="signinBtn" name="submit2">Sign in</button>

                </div>


            </form>
        </div>


    </div>

</body>

</html>