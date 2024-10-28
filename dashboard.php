<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Access denied. Please log in.";
    exit;
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user data
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div>
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
        <div class="sidebar">
            <header>Petsave</header>
            <ul>
                <li><a href="index.php"><i class="fas fa-qrcode"></i>Home</a></li>
                <li><a href="findpets.php"><i class="fas fa-stream"></i>Find Pets</a></li>
                <li><a href="new_pets.php"><i class="fas fa-calendar-week"></i>New Pets</a></li>
                <li><a href="services.php"><i class="fas fa-sliders-h"></i>Services</a></li>
                <li><a href="#"><i class="far fa-envelope"></i>Contact</a></li>
            </ul>
        </div>

        <section>
            <div class="container">
                <div class="content">
                    <h1>Welcome <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></h1>
                    <a href="logout.php" class="btn">Logout</a>
                </div>
            </div>
        </section>

        <div>
            <center>
                <div class="content">
                    <h2>Your Pets</h2>
                    <?php
                    // Fetch pets belonging to the user
                    $query = "SELECT * FROM pets_info WHERE user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $pets = $stmt->get_result();

                    if ($pets->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Name</th><th>Breed</th><th>Birthday</th><th>Vaccinated</th><th>Image</th></tr>";
                        while ($pet = $pets->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($pet['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($pet['breed']) . "</td>";
                            echo "<td>" . htmlspecialchars($pet['bday']) . "</td>";
                            echo "<td>" . ($pet['vaccinated'] ? 'Yes' : 'No') . "</td>";
                            echo "<td><img src='img/" . htmlspecialchars($pet['image']) . "' alt='Pet Image' width='100'></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>You have no pets listed.</p>";
                    }

                    $stmt->close();
                    ?>
                </div>
            </center>
        </div>
    </div>
</body>
</html>
