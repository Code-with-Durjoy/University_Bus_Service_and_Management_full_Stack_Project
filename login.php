
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
               if(isset($_POST["submit1"])){
                $s_id = $_POST["s_id"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();
                if (empty($s_id) or empty($email) or empty($password) ){
                    array_push($errors,"All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password)<8) {
                    array_push($errors,"Password must be at least 8 charactes long");
                }
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount>0) {
                 array_push($errors,"Email already exists!");
                }
                   
                if (count($errors)>0) {
                    foreach ($errors as  $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
                else{
                    
                    $sql = "INSERT INTO users (s_id, email, password) VALUES ( ?, ?, ? )";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt,"iss",$s_id, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    }else{
                        die("Something went wrong");
                    }

                }

               }
            ?>

<h1 id="title">Sign Up</h1>
            <form action="login.php" method="post">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="int" placeholder="ID" name="s_id">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="password" name="password">
                    </div>
                    <p>Forgot Password <a href="#">Click Here!</a></p>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupBtn" name="submit1">Sign Up</button>
                    <button type="button" id="signinBtn" name="submit2" class="disable"><a href="index.php">Sign in</a></button>

                </div>


            </form>
        </div>


    </div>
    <script>
        let signupBtn = document.getElementById("signupBtn");
        let signinBtn = document.getElementById("signinBtn");
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");

        signinBtn.onclick = function () {
            nameField.style.maxHeight = "0";
            title.innerHTML = "Sign In";
            signupBtn.classList.add("disable");
            signinBtn.classList.remove("disable");
        }
        signupBtn.onclick = function () {
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Sign Up";
            signupBtn.classList.remove("disable");
            signinBtn.classList.add("disable");
        }




    </script>
</body>

</html>