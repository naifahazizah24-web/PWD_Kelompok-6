<?php

session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($name)) {
        $message = "Nama wajib diisi";
    }
    elseif (empty($email)) {
        $message = "Email wajib diisi";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format email tidak valid";
    }
    elseif (strlen($password) < 8) {
        $message = "Password minimal 8 karakter";
    }
    else {

        $_SESSION["registered_name"] = $name;
        $_SESSION["registered_email"] = $email;
        $_SESSION["registered_password"] = $password;

        header("Location: login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-container">

    <div class="auth-card">

        <h1>🎫 Create Account</h1>

        <form method="POST">

            <label>Full Name</label>
            <input type="text" name="name">

            <label>Email</label>
            <input type="email" name="email">

            <label>Password</label>
            <input type="password" name="password">

            <button type="submit">
                Register
            </button>

        </form>

        <p class="message">
            <?php echo $message; ?>
        </p>

        <p class="auth-link">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </p>

    </div>

</div>

</body>
</html>