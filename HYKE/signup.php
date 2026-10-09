<?php
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = trim($_POST["fullname"]);
    $email    = trim($_POST["email"]);
    $mobile   = trim($_POST["mobile"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm_password"];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $con->prepare("INSERT INTO users (full_name, email, mobile, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $mobile, $hash);
            $stmt->execute();
            header("Location: login.php");
            exit;
        } catch (mysqli_sql_exception $e) {
            $error = "That email is already registered.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>You Kenn Eat Here! — Sign Up</title>

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


        <!-- SIGN UP HEADER -->
        <div class="signup-head">

            <h2>Sign Up</h2>

            <p>
                already have an account?

                <a href="login.php">
                    Log In
                </a>
            </p>

        </div>


        <!-- SIGN UP FORM -->
        <main class="signup-body">

            <p class="creating">
                Creating your account
            </p>


            <!-- BACK TO LOGIN AFTER SIGNING UP -->
            <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

            <form action="signup.php" method="post">

               <div class="field">
    <input
        type="text"
        name="fullname"
        placeholder="Full name"
        required
    >
</div>


                <div class="field">

                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        required
                    >

                    <span class="icon">✉</span>

                </div>


                <div class="field">

                    <input
                        type="tel"
                        placeholder="+63  Mobile number"
                        name="mobile"
                        required
                    >

                    <span class="icon">✆</span>

                </div>


                <div class="field">

                    <input
                        type="password"
                        placeholder="Password"
                        name="password"
                        required
                    >

                    <span class="icon">👁</span>
                    <span class="icon" onclick="togglePassword(this)">👁</span>

                </div>


                <div class="field">

                    <input
                        type="password"
                        placeholder="Confirm password"
                        name="confirm_password"
                        required
                        
                    >

                    <span class="icon">👁</span>
                    <span class="icon" onclick="togglePassword(this)">👁</span>

                </div>


                <button
                    type="submit"
                    class="btn-signup"
                >
                    Sign Up
                </button>

            </form>


            <p class="or">
                Or
            </p>


            <a
                class="social-btn"
                href="#"
            >
                <span class="g">G</span>
                Sign up with Google
            </a>


            <a
                class="social-btn"
                href="#"
            >
                <span class="f">f</span>
                Sign up with Facebook
            </a>

        </main>

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