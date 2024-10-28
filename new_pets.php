<?php
require 'config.php';
session_start(); // Start session to access user ID

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in.");
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $bday = $_POST["bday"];
    $vaccinated = isset($_POST["vaccinated"]) ? 1 : 0;

    if ($_FILES["image"]["error"] == 4) {
        echo "<script>alert('Image does not exist.');</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        // Validate the image extension
        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtensions)) {
            echo "<script>alert('Invalid image extension.');</script>";
        } elseif ($fileSize > 10000000) { // Limit to 10MB
            echo "<script>alert('Image size is too large.');</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            // Attempt to move the uploaded file
            if (move_uploaded_file($tmpName, 'img/' . $newImageName)) {
                // Insert into the database with user_id
                $query = "INSERT INTO pets_info (user_id, name, breed, bday, vaccinated, image) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("isssis", $user_id, $name, $breed, $bday, $vaccinated, $newImageName);

                if ($stmt->execute()) {
                    echo "<script>alert('Successfully added pet.'); document.location.href = 'findpets.php';</script>";
                } else {
                    echo "<script>alert('Error adding pet.');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Failed to upload image.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
    <link rel="stylesheet" href="pets.css">
    <style>
        body {
            background-image: url('petsbg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: 100% 100%;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4cae4c;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section>
        <div class="newpet">
            <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="breed">Breed:</label>
                <input type="text" name="breed" id="breed" required>

                <label for="bday">Birthday:</label>
                <input type="date" name="bday" id="bday" required>

                <label for="vaccinated">Vaccinated: If Yes Please Check</label>
                <input type="checkbox" name="vaccinated" id="vaccinated">

                <label for="image">Image:</label>
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </section>
    <br>
    <a href="findpets.php">Find Pets</a>
</body>
</html>
