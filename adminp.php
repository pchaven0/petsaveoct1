<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:loginform.php');
}

$sql = "SELECT * FROM adoption_applications";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>
   <link rel="stylesheet" href="user.css">

</head>

<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .application-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .application-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .application-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
    </style>

<body>
   
<div class="container">

   <div class="content">
      <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>this is an admin page</p>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

<h2>Submitted Applications</h2>
<div class="application-grid">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="application-card">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p>Email: ' . htmlspecialchars($row['email']) . '</p>';
            echo '<p>Message: ' . nl2br(htmlspecialchars($row['message'])) . '</p>';
            echo '<p>Pet ID: ' . htmlspecialchars($row['pet_id']) . '</p>';
            if ($row['id_image']) {
                echo '<img src="' . htmlspecialchars($row['id_image']) . '" alt="Application Image">';
            }
            echo '</div>';
        }
    } else {
        echo '<p>No applications found.</p>';
    }
    ?>
</div>

</body>
</html>

<?php
$conn->close();
?>


</body>
</html>