<?php 
session_start(); 
require 'config.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: loginf.php");
    exit();
}

// Pagination variables
$limit = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$filtervalue = '';
if (isset($_GET['search'])) {
    $filtervalue = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM pets_info WHERE name LIKE ? OR breed LIKE ? LIMIT ?, ?");
    $searchTerm = "%" . $filtervalue . "%";
    $stmt->bind_param("ssii", $searchTerm, $searchTerm, $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Get total records for pagination
    $countStmt = $conn->prepare("SELECT COUNT(*) FROM pets_info WHERE name LIKE ? OR breed LIKE ?");
    $countStmt->bind_param("ss", $searchTerm, $searchTerm);
    $countStmt->execute();
    $countStmt->bind_result($totalRecords);
    $countStmt->fetch();
} else {
    $stmt = $conn->prepare("SELECT * FROM pets_info ORDER BY pet_id DESC LIMIT ?, ?");
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $totalRecords = $conn->query("SELECT COUNT(*) FROM pets_info")->fetch_row()[0];
}

// Calculate total pages
$totalPages = ceil($totalRecords / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Pets</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('petsbg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: 100% 100%;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .grid-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            overflow: hidden; 
        }
        .grid-item img {
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
            border-radius: 5px;
        }
        .btn {
            margin-top: 10px;
        }
        .pagination {
            justify-content: center;
        }
        #adoptionForm {
            display: none; 
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background-color: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.5); 
            z-index: 1000; 
            max-width: 400px; 
            width: 90%;
        }

        /* Button styling */
.btn {
    padding: 10px 20px;
    color: white;
    background-color: #28a745; /* Bootstrap success color */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

.btn:hover {
    background-color: #218838; /* Darker green on hover */
}

#adoptionForm {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    max-width: 400px;
    margin: auto;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

#adoptionForm h2 {
    text-align: center;
    color: #333;
}

#adoptionForm label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

#adoptionForm input[type="text"],
#adoptionForm input[type="email"],
#adoptionForm input[type="tel"],
#adoptionForm textarea,
#adoptionForm select,
#adoptionForm input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px; /* Added margin for spacing */
}

#adoptionForm textarea {
    resize: vertical;
}

#adoptionForm button {
    width: 48%;
    padding: 10px;
    margin-top: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#adoptionForm button.btn-success {
    background-color: #28a745;
    color: white;
}

#adoptionForm button.btn-danger {
    background-color: #dc3545;
    color: white;
}

#adoptionForm button:hover {
    opacity: 0.9;
}

/* Responsive Styles */
@media (max-width: 600px) {
    #adoptionForm {
        padding: 15px;
        max-width: 90%;
    }

    #adoptionForm button {
        width: 100%; /* Stack buttons on small screens */
        margin: 5px 0;
    }
}


    </style>
</head>
<body>
<div class="container">
    <h1>Find Pets</h1>
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search for pets..." class="form-control mb-3" value="<?php echo htmlspecialchars($filtervalue); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="grid-container">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="grid-item">
            <h5><?php echo htmlspecialchars($row['name']); ?></h5>
            <p><strong>Breed:</strong> <?php echo htmlspecialchars($row['breed']); ?></p>
            <p><strong>Birthday:</strong> <?php echo htmlspecialchars($row['bday']); ?></p>
            <p><strong>Vaccinated:</strong> <?php echo $row['vaccinated'] ? 'Yes' : 'No'; ?></p>
            <?php $imagePath = 'img/' . htmlspecialchars($row['image']); ?>
            <img src="<?php echo $imagePath; ?>" alt="Pet Image"> 
            <a href="javascript:void(0);" onclick="openAdoptionForm(<?php echo $row['pet_id']; ?>)" class="btn btn-success">Adopt</a>
        </div>
    <?php endwhile; ?>
</div>

    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($filtervalue); ?>">Previous</a></li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($filtervalue); ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($filtervalue); ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<div id="adoptionForm" style="display:none;">
    <h2>Adoption Application Form</h2>
    <form id="applicationForm" enctype="multipart/form-data">
        <input type="hidden" name="pet_id" id="pet_id" value="">

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Why do you want to adopt this pet?</label>
        <textarea id="message" name="message" required></textarea>

        <label for="image">Upload Your Valid ID</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit" class="btn btn-success">Submit Application</button>
        <button type="button" class="btn btn-danger" onclick="closeAdoptionForm()">Cancel</button>
    </form>
</div>

</body>
<script>
document.getElementById('applicationForm').onsubmit = async function(event) {
    event.preventDefault(); 

    const formData = new FormData(this); // Create a FormData object from the form

    try {
        const response = await fetch('submit_application.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            const result = await response.text();
            alert(result); // Show success message
            closeAdoptionForm(); // Close the form
            // Optionally reset the form
            document.getElementById('applicationForm').reset();
        } else {
            alert('Error submitting the application. Please try again.'); // Handle error
        }
    } catch (error) {
        console.error('Error:', error);
        alert('There was a problem with the submission. Please check your connection.');
    }
};

function openAdoptionForm(petId) {
    document.getElementById('pet_id').value = petId;
    document.getElementById('adoptionForm').style.display = 'block';
}

function closeAdoptionForm() {
    document.getElementById('adoptionForm').style.display = 'none';
}

</script>
</html>
