<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $a_id = $_POST["a_id"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Secure hash

    require_once "database.php";

    $sql = "INSERT INTO admins (A_id, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $a_id, $email, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        echo "Admin registered successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Signup</title>
</head>
<body>
    <h2>Admin Signup</h2>
    <form method="POST" action="">
        Admin ID: <input type="text" name="a_id" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Register Admin</button>
    </form>
</body>
</html>
