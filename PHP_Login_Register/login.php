<?php
session_start();
include 'db.php';

$email_cookie = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : "";

if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

 
    $stmt = mysqli_prepare($conn, "SELECT id, name, password FROM users WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Cookies
            setcookie("user_email", $email, time() + (86400 * 30));
            setcookie("last_login", date("Y-m-d H:i:s"), time() + (86400 * 30));

            header("Location: dashboard.php");
            exit();

        } else {
            echo "Wrong password!";
        }

    } else {
        echo "User not found!";
    }
}
?>

<form method="POST">
    Email: <input type="email" name="email" value="<?php echo $email_cookie; ?>" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button name="login">Login</button>


    <p>Don't have an account?</p>
    <a href="registration.php">Register Here</a>
</form>