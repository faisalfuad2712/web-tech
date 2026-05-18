<?php
session_start();

include "users.php";

$message = "";
$savedEmail = $_COOKIE['user_email'] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    foreach ($users as $user) {
        if ($user['email'] == $email && password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user['name'];

            // Cookies
            setcookie("user_email", $email, time() + 604800, "/", "", false, true);
            setcookie("last_login", date("Y-m-d H:i:s"), time() + 604800);

            header("Location: dashboard.php");
            exit();
        }
    }

    $message = "Invalid login!";
}
?>

<h2>Login</h2>
<p><?php echo $message; ?></p>

<form method="POST">
    Email: <input type="email" name="email" value="<?php echo $savedEmail; ?>" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<p><a href="register.php">Create account</a></p>