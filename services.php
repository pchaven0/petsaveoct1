<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSave</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
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

<div class="service">

    <h1 class="heading">Our services</h1>

    <div class="box-service">

        <div class="box">
            <img src="petfind.png" alt="">
            <h3>Pet Finder</h3>
            <p>You can use our Search and Filter Bar to easily find your desired Pets</p>
            <a href="findpets.php" class="btn">Find Pets</a>
        </div>

        <div class="box">
            <img src="rehome.png" alt="">
            <h3>Rehoming</h3>
            <p>You can help us upload pets information through this website. We can also help you for rehoming your Pets</p>
            <a href="loginf.php" class="btn">Add Pet</a>
        </div>

        <div class="box">
            <img src="comms.png" alt="">
            <h3>Communication</h3>
            <p>Communication features to easily communicate with your applications to other users</p>
            <a href="#" class="btn">Working on it</a>
        </div>
    </div>
</div>

</body>
<script>
    const hamburger = document.querySelector('.hamburger');
const nav = document.querySelector('nav');

hamburger.addEventListener('click', () => {
  nav.classList.toggle('active');
});
</script>
</html>