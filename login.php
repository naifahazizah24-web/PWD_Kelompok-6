<?php

session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email)) {

        $message = "Email wajib diisi";

    }
    elseif (empty($password)) {

        $message = "Password wajib diisi";

    }
    elseif (
        isset($_SESSION["registered_email"]) &&
        $email === $_SESSION["registered_email"] &&
        $password === $_SESSION["registered_password"]
    ) {

        $_SESSION["user"] = $_SESSION["registered_name"];

        $_SESSION["success"] =
        "🎉 Login berhasil. Selamat datang di Rhythm Nation Festival!";

        header("Location: dashboard.php");
        exit();

    }
    else {

        $message = "Email atau password salah";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login Festival</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="auth-container">

    <div class="auth-card">

        <h1>🎵 Login Festival</h1>

        <?php if(!empty($message)): ?>

            <div class="error-box">

                <?php echo $message; ?>

            </div>

        <?php endif; ?>

        <form method="POST">

            <label>Email</label>

            <input
                type="email"
                name="email"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                required
            >

            <button type="submit">

                Login

            </button>

        </form>

        <p class="auth-link">

            Belum punya akun?

            <a href="register.php">

                Register

            </a>

        </p>

    </div>

</div>

</body>

</html>
