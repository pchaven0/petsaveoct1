<?php
session_start();
require 'config.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $pet_id = $_POST['pet_id'];
    $user_id = 1; // Replace with the actual user ID as needed
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message']; // Assuming 'reason' is renamed to 'message'

    // Handle image upload
    $id_image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $id_image = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $id_image);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO adoption_applications (pet_id, user_id, name, email, id_image, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $pet_id, $user_id, $name, $email, $id_image, $message);

    if ($stmt->execute()) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

