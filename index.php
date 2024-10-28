<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSave</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<style>
     nav {
  background-color: #333;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
}

.logo {
  color: white;
}

.text-primary {
  color: lime; 
}

/* Navigation Links */
nav ul {
  list-style: none;
  display: flex;
  align-items: center;
  margin-left: auto;
}

nav ul li {
  margin: 0 1rem;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  font-size: 18px;
  padding: 0.5rem;
  transition: color 0.3s;
}

nav ul li a:hover {
  color: #ddd;
}

/* Hamburger Menu Styling */
.hamburger {
  display: none;
  flex-direction: column;
  cursor: pointer;
}

.hamburger span {
  width: 25px;
  height: 3px;
  background: #fff;
  margin: 4px 0;
  transition: all 0.3s;
}

/* Responsive Styles */
@media (max-width: 768px) {
  nav ul {
    display: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 100%;
    background-color: #333;
    flex-direction: column;
    text-align: center;
  }

  nav ul li {
    margin: 1rem 0;
  }

  .hamburger {
    display: flex;
  }

  /* Display menu when active */
  nav.active ul {
    display: flex;
  }
}
</style>

<nav class="navbar">
    <a href="index.php"><div class="logo"><span class="text-primary">Pet</span>Save</div></a>
    <ul>
      <li><a href="loginf.php">Login</a></li>
      <li><a href="register.php">Register</a></li>
      <li><a href="faq.php">FAQs</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

<body>
<center>
<div class="txthm">
    <h1>Find Your New Bestfriend</h1> <br>
    <p>#AdoptDontShop</p>
</div>
</center>

    <center>
        <div class="home_btn">
            <button class="find_pets"><a href="findpets.php">Find Pets</a></button>
            <button class="learn_more"><a href="services.php">Learn More</a></button>
        </div>
    </center>

</body>
<script>
    function toggleMenu() {
      document.querySelector('.navbar').classList.toggle('active');
    }
  </script>
</html>
