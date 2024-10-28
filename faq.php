<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption FAQ</title>
    <link href="style.css" rel="stylesheet">
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
        /* FAQ Section with Grid Layout */
.faq-section {
    width: 80%;
    margin: 50px auto;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

.faq-section::before {
    content: "";
    display: block;
    height: 5px;
    background: linear-gradient(45deg, greenyellow, purple);
    width: 50px;
    margin: 0 auto 20px auto;
    border-radius: 10px;
}

/* Main Heading */
.faq-section h1 {
    text-align: center;
    color: #222;
    font-size: 40px;
    text-transform: uppercase;
    margin-bottom: 15px;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.1);
}

/* FAQ Grid */
.faq-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Each FAQ Item */
.faq-item {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.faq-item:hover {
    transform: translateY(-5px);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
}

/* Question Titles */
.faq-item h2 {
    color: #333;
    font-size: 22px;
    margin-bottom: 10px;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.05);
}

/* FAQ Text */
.faq-item p {
    color: #555;
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 15px;
}

.faq-item a {
    color: #0073e6;
    font-weight: bold;
    text-decoration: underline;
}

.faq-item a:hover {
    color: #005bb5;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .faq-section {
        width: 95%;
        padding: 20px;
    }

    .faq-item h2 {
        font-size: 20px;
    }

    .faq-item p {
        font-size: 15px;
    }
}

    </style>
</head>

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
<div class="faq-section">
    <h1>Pet Adoption FAQ</h1>
    <div class="faq-grid">
        <div class="faq-item">
            <h2>How can I adopt from PAWS?</h2>
            <p>Applicants go through a screening process to ensure that our rescued animals go to loving homes. Apply <a href="#">here</a>.</p>
        </div>
        <div class="faq-item">
            <h2>Can you adopt my pet?</h2>
            <p>PAWS does NOT adopt owned pets. We already have 300+ shelter animals rescued from cruelty and neglect.</p>
        </div>
        <div class="faq-item">
            <h2>Why is there an adoption fee?</h2>
            <p>The adoption fee is a token of your commitment and a demonstration of your financial capacity to care for a pet.</p>
        </div>
        <div class="faq-item">
            <h2>Can my adoption application get denied?</h2>
            <p>Yes. Some reasons include incompatibility with the household or unsafe conditions for pets.</p>
        </div>
        <div class="faq-item">
            <h2>Do you have purebred cats or dogs?</h2>
            <p>It is rare that purebred animals are admitted. Please consider adopting a local breed.</p>
        </div>
        <div class="faq-item">
            <h2>Can I adopt more than one pet?</h2>
            <p>Yes, but it depends on the situation. Some animals may be part of a bonded pair.</p>
        </div>  
    </div>
</div>

</body>
<script>
    function toggleMenu() {
      document.querySelector('.navbar').classList.toggle('active');
    }
  </script>
</html>
