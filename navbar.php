<?php

    include_once('style.php');
    require_once('connection.php');

?>

<header>
    <div class="navbar">
      <a href="index.php">Home</a>
      <a href="about_us.php">About Us</a>
      <a href="contact.php">Contact</a>
      <div class="dropdown">
        <button class="dropbtn">Napravite nalog</button>
        <div class="dropdown-content">
          <a href="login.php" id="loginLink">Login</a>
          <a href="register.php" id="registerLink">Register</a>
        </div>
      </div>
    </div>
  </header>