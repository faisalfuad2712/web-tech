<?php
$message = "";
$file = "users.php";

// Load users
include $file;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user exists
    foreach ($users as $u) {
        if ($u['email'] == $email) {
            $message = "Email already exists!";
            break;
        }
    }

    if ($message == "") {

        // Add new user
        $users[] = [
            "name" => $name,
            "email" => $email,
            "password" => $password
        ];

        // Save back to file
        $data = "<?php\n\$users = " . var_export($users, true) . ";\n?>";
        file_put_contents($file, $data);

        $message = "Registration successful! <a href='login.php'>Login</a>";
    }
}
?>

<h2>Register</h2>
<p><?php echo $message; ?></p>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>

<p><a href="login.php">Already have account? Login</a></p>