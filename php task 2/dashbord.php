<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>

<?php
if (isset($_COOKIE['last_login'])) {
    echo "<p>Last login: " . $_COOKIE['last_login'] . "</p>";
}
?>

<a href="logout.php">Logout</a>