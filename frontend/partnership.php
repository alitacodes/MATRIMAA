<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $company = mysqli_real_escape_string($conn, $_POST['company']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $sql = "INSERT INTO partnership_enquiries (company_name, contact_person, email, phone, partnership_type, message) 
            VALUES ('$company', '$name', '$email', '$phone', '$type', '$message')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Submitted successfully!'); window.location.href='partnership.php';</script>";
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
  <title>Partner With Us - Matrimaa</title>
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
      <h2>Partnership Inquiry Form</h2>
      <form action="partnership.php" method="POST" class="glass-form">
        <div class="form-group">
          <label for="company">Organization / Brand Name *</label>
          <input type="text" id="company" name="company" required>
        </div>
        <div class="form-group">
          <label for="name">Contact Person *</label>
          <input type="text" id="name" name="name" required>
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
          <label for="type">Partnership Category *</label>
          <select id="type" name="type" required>
            <option value="">Select Category</option>
            <option value="Title Sponsor">Title Sponsor</option>
            <option value="Powered By">Powered By</option>
            <option value="Associate Sponsor">Associate Sponsor</option>
            <option value="Grooming & Styling">Grooming & Styling Partner</option>
            <option value="Media & PR">Media & PR Partner</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="message">Message / Proposal Details</label>
          <textarea id="message" name="message" rows="4"></textarea>
        </div>
        <button type="submit" class="spl-btn">Submit Proposal</button>
      </form>
    </section>
  </main>
</body>

</html>