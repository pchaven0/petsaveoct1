<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']); 

    // Selecting the user based on email and password
    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Check user type and set session variables
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location: adminp.php');
            exit();
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_id'] = $row['id']; // Optional: Store user ID if needed
            header('location: dashboard.php');
            exit();
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<navbar class="navbar">
    <ul>
        <li style="float: left; font-size: 20px">
            <a href="index.php">
                <div class="colored-brand"><span class="text-primary">Pet</span>Save</div>
            </a>
        </li>
        <li><a href="faq.php">FAQs</a></li>
        <li><a href="loginf.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</navbar>
<div class="form-container">

    <form action="" method="post">
        <h3>Login Now</h3>
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            }
        }
        ?>
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="submit" name="submit" value="Login Now" class="form-btn">
        <p>Don't have an account? <a href="register.php">Register now</a></p>
    </form>

</div>

</body>
</html>
