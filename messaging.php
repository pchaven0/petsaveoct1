<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginf.php");
    exit;
}

if (isset($_GET['user_id']) && isset($_GET['pet_id'])) {
    $reciever_id = intval($_GET['user_id']);
    $pet_id = intval($_GET['pet_id']);

    if (isset($_POST['send'])) {
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $sender_id = $_SESSION['user_id'];

        $insertQuery = "INSERT INTO messages (sender_id, recipient_id, pet_id, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iiis", $sender_id, $reciever_id, $pet_id, $message);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message User</title>
</head>
<body>
    <h1>Message User</h1>
    <form method="POST">
        <textarea name="message" required placeholder="Type your message here..."></textarea>
        <input type="submit" name="send" value="Send">
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
