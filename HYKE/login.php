<?php
session_start();
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $con->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($_POST["password"], $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: home.php");
        exit;
    }
    $error = "Wrong email or password.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>You Kenn Eat Here! — Log In</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="phone">

        <!-- MAIN LOGO -->
        <header class="brand">
            <img
                class="brand-logo"
                src="logo.jpg"
                alt="Here, You Kenn Eat"
            >
        </header>


        <!-- LOGIN -->
        <main class="login-body">

            <h2>Log In</h2>

<form action="login.php" method="post">
    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

    <div class="field">
        <input type="email" name="email" placeholder="Email" required>
        <span class="icon">✉</span>
    </div>

    <div class="field">
        <input type="password" name="password" placeholder="Password" required>
        <span class="icon">👁</span>
        <span class="icon" onclick="togglePassword(this)">👁</span>
    </div>

    <button type="submit" class="btn-primary">Log In</button>
</form>

        </main>


        <!-- SIGN UP LINK -->
        <footer class="login-footer">

            First time here?

            <a href="signup.php">
              Sign Up
            </a>

        </footer>

     <script>
function togglePassword(icon) {
    const input = icon.parentElement.querySelector("input");

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈";
    } else {
        input.type = "password";
        icon.textContent = "👁";
    }
}
</script>

        <!-- HYKE FOOTER -->
        <div class="hyke">

            <div class="hyke-box">

                <img
                    src="HYKE.jpg"
                    alt="HYKE — Here You Kenn Eat"
                >

                <a
                    class="soc soc-fb"
                    href="https://facebook.com"
                    target="_blank"
                    rel="noopener"
                    aria-label="Facebook"
                ></a>

                <a
                    class="soc soc-ig"
                    href="https://instagram.com"
                    target="_blank"
                    rel="noopener"
                    aria-label="Instagram"
                ></a>

                <a
                    class="soc soc-tw"
                    href="https://twitter.com"
                    target="_blank"
                    rel="noopener"
                    aria-label="Twitter"
                ></a>

            </div>

        </div>

    </div>

</body>
</html>