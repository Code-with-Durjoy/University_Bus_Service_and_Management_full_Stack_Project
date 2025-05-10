<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: admin_dashboard.php");
}

require_once "database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit2"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL to avoid SQL injection
    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Debug line (optional): echo the hash
        // echo "Hash in DB: " . $user["password"];

        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["email"];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "❌ Incorrect password";
        }
    } else {
        $error = "❌ Email not found";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/4a333ea59a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>GREEN UNIVERSITY BUS SERVICE</h1>
        <div class="form-box">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <h1 id="Atitle">Admin Sign In</h1>
            <form method="post" action="adminlogin.php">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Admin Email" required>
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Admin Password" required>
                    </div>
                    <p>For Student Log-in  <a href="index.php">Click Here!</a></p>
                </div>
                <div class="btn-field">
                   <!-- <button type="button" class="disable">
                        <a href="adminsignup.php" style="text-decoration: none;">Admin Sign Up</a>
                    </button>-->
                    <button type="submit" name="submit2">Admin Sign In</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
