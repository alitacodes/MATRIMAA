<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $age = (int) $_POST['age'];
  $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
  $has_passport = (isset($_POST['has_passport']) && $_POST['has_passport'] === '1') ? 1 : 0;

  $passport_number = ($has_passport === 1 && !empty($_POST['passport_number']))
    ? "'" . mysqli_real_escape_string($conn, $_POST['passport_number']) . "'"
    : "NULL";

  $social_link = mysqli_real_escape_string($conn, $_POST['social_link']);
  $motivation = mysqli_real_escape_string($conn, $_POST['motivation']);

  $sql = "INSERT INTO join_us_registrations (full_name, email, phone, city, age, occupation, has_passport, passport_number, social_link, motivation) 
            VALUES ('$full_name', '$email', '$phone', '$city', $age, '$occupation', $has_passport, $passport_number, '$social_link', '$motivation')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registered successfully!'); window.location.href='join_us.php';</script>";
  } else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Us - Matrimaa</title>
  <link rel="stylesheet" href="styles_2.css">
</head>

<body>
  <header id="navbar">
    <div class="nav-container">
      <a href="index.php" class="logo">Matrimaa</a>
      <nav class="nav-links">
        <a href="index.php">Home</a>
        <a href="journey.php">Journey</a>
        <a href="gallery.php">Gallery</a>
        <a href="about.php">About Us</a>
        <a href="join_us.php">Join Us</a>
        <a href="partnership.php" class="spl-btn">Partner With Us</a>
      </nav>
    </div>
  </header>

  <main id="main-bg">
    <section id="partner-form-section">
      <h2>Join Us Registration</h2>
      <form action="join_us.php" method="POST" class="glass-form">
        <div class="form-group">
          <label for="full_name">Full Name *</label>
          <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address *</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number *</label>
          <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
          <label for="city">City *</label>
          <input type="text" id="city" name="city" required>
        </div>
        <div class="form-group">
          <label for="age">Age *</label>
          <input type="number" id="age" name="age" min="1" max="120" required>
        </div>
        <div class="form-group">
          <label for="occupation">Occupation *</label>
          <input type="text" id="occupation" name="occupation" required>
        </div>

        <div class="form-group">
          <label for="has_passport">Do you have a valid passport? *</label>
          <select id="has_passport" name="has_passport" onchange="togglePassportInput(this.value)" required>
            <option value="">Select Option</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>

        <div class="form-group" id="passport_number_group" style="display: none;">
          <label for="passport_number">Passport Number *</label>
          <input type="text" id="passport_number" name="passport_number" placeholder="Enter your passport number">
        </div>

        <div class="form-group">
          <label for="social_link">Social Media Profile Link (Optional)</label>
          <input type="url" id="social_link" name="social_link" placeholder="https://instagram.com/username">
        </div>
        <div class="form-group">
          <label for="motivation">Motivation</label>
          <textarea id="motivation" name="motivation" rows="4"></textarea>
        </div>
        <button type="submit" class="spl-btn">Register Now</button>
      </form>
    </section>
  </main>

  <script>
    function togglePassportInput(value) {
      const passportGroup = document.getElementById('passport_number_group');
      const passportInput = document.getElementById('passport_number');

      if (value === '1') {
        passportGroup.style.display = 'block';
        passportInput.required = true;
      } else {
        passportGroup.style.display = 'none';
        passportInput.required = false;
        passportInput.value = '';
      }
    }
  </script>
</body>

</html>