<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Collect and sanitize form inputs
  $fullName = filter_var(trim($_POST['fullName'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
  $phone = filter_var(trim($_POST['phone'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
  $city = filter_var(trim($_POST['city'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
  $age = filter_var(trim($_POST['age'] ?? ''), FILTER_SANITIZE_NUMBER_INT);
  $occupation = filter_var(trim($_POST['occupation'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
  $socialLink = filter_var(trim($_POST['socialLink'] ?? ''), FILTER_VALIDATE_URL) ? trim($_POST['socialLink']) : filter_var(trim($_POST['socialLink'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
  $motivation = filter_var(trim($_POST['motivation'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
  $date = date("Y-m-d H:i:s");

  // File target (Excel CSV)
  $filename = "auditions.csv";
  $file_exists = file_exists($filename);

  // Open file in append mode
  $file = fopen($filename, "a");

  if ($file) {
    // Create table header columns if the file doesn't exist yet
    if (!$file_exists) {
      fputcsv($file, [
        "Registration Date",
        "Full Name",
        "Email Address",
        "Phone / WhatsApp Number",
        "Preferred City",
        "Age",
        "Occupation",
        "Social Media Link",
        "Motivation / Story"
      ]);
    }

    // Write the submission row
    fputcsv($file, [
      $date,
      $fullName,
      $email,
      $phone,
      $city,
      $age,
      $occupation,
      $socialLink,
      $motivation
    ]);

    fclose($file);

    // Success popup and page reload
    echo "<script>
                alert('Thank you! Your audition registration has been submitted successfully.');
                window.location.href = 'join-us.php';
              </script>";
    exit();
  } else {
    echo "<script>
                alert('Error saving registration. Please try again.');
                window.location.href = 'join-us.php';
              </script>";
    exit();
  }
} else {
  header("Location: join-us.php");
  exit();
}
?>








<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Join Us | Matrimaa Season 5</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="join-us.css" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Zalando+Sans:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet" />
</head>

<body class="join-body">
  <!-- NAVBAR -->
  <div id="navbar">
    <a href="index.html">
      <img src="matrimaa-logo.png" alt="Matrimaa Logo" />
    </a>

    <div id="nav-buttons">
      <a href="index.html"><button type="button">HOME</button></a>
      <a href="index.html#stats-section"><button type="button">JOURNEY</button></a>
      <a href="index.html#gallery-section"><button type="button">GALLERY</button></a>
      <a href="index.html#red-bg"><button type="button">ABOUT US</button></a>
      <a href="join-us.html"><button type="button">JOIN US</button></a>
    </div>

    <div class="spl-btn">
      <a href="partnership.html">
        <button type="button">PARTNER WITH US</button>
      </a>
    </div>
  </div>

  <!-- MAIN REGISTRATION CONTENT -->
  <main class="join-container">
    <section class="join-form-section">
      <div class="form-glass-card">
        <div class="form-header">
          <h2>AUDITION REGISTRATION</h2>
          <p>
            Fill out your details below to secure your audition slot across
            various locations.
          </p>
        </div>

        <form class="participant-form" action="#" method="POST" onsubmit="event.preventDefault()">
          <div class="form-row">
            <div class="form-group">
              <label for="full-name">FULL NAME</label>
              <input type="text" id="full-name" name="fullName" placeholder="Enter your full name" required />
            </div>

            <div class="form-group">
              <label for="email">EMAIL ADDRESS</label>
              <input type="email" id="email" name="email" placeholder="name@example.com" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="phone">PHONE / WHATSAPP NUMBER</label>
              <input type="tel" id="phone" name="phone" placeholder="+91 XXXXX XXXXX" required />
            </div>

            <div class="form-group">
              <label for="city">PREFERRED AUDITION CITY</label>
              <select id="city" name="city" required>
                <option value="" disabled selected>Select city</option>
                <option value="Kolkata">Kolkata</option>
                <option value="Durgapur">Durgapur</option>
                <option value="Siliguri">Siliguri</option>
                <option value="Bangalore">Bangalore</option>
                <option value="Online">Other / Online Audition</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="age">AGE</label>
              <input type="number" id="age" name="age" min="18" max="99" placeholder="e.g. 28" required />
            </div>

            <div class="form-group">
              <label for="occupation">OCCUPATION / PROFESSION</label>
              <input type="text" id="occupation" name="occupation" placeholder="e.g. Entrepreneur, Teacher, Homemaker"
                required />
            </div>
          </div>

          <div class="form-group">
            <label for="social-link">INSTAGRAM / SOCIAL MEDIA LINK (OPTIONAL)</label>
            <input type="url" id="social-link" name="socialLink" placeholder="https://instagram.com/yourprofile" />
          </div>

          <div class="form-group">
            <label for="motivation">YOUR STORY / MOTIVATION TO JOIN</label>
            <textarea id="motivation" name="motivation" rows="4"
              placeholder="Share a short summary of your journey and what Matrimaa means to you..."></textarea>
          </div>

          <div class="form-submit-wrapper">
            <button type="submit" class="spl-btn-submit">
              REGISTER FOR AUDITIONS
            </button>
          </div>
        </form>
      </div>
    </section>
  </main>

  <!-- FOOTER SECTION -->
  <footer id="footer-section">
    <div class="footer-container">
      <div class="footer-col brand-col">
        <div class="footer-logo">
          <img src="matrimaaLogoInverted.png" alt="matrimaa logo" />
        </div>
        <p class="footer-tagline">
          Honoring Motherhood — From Regional to Global Recognition.
        </p>

        <div class="social-links">
          <a href="#" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="35" height="35" fill="currentColor">
              <path
                d="M320.3 205C256.8 204.8 205.2 256.2 205 319.7C204.8 383.2 256.2 434.8 319.7 435C383.2 435.2 434.8 383.8 435 320.3C435.2 256.8 383.8 205.2 320.3 205zM319.7 245.4C360.9 245.2 394.4 278.5 394.6 319.7C394.8 360.9 361.5 394.4 320.3 394.6C279.1 394.8 245.6 361.5 245.4 320.3C245.2 279.1 278.5 245.6 319.7 245.4zM413.1 200.3C413.1 185.5 425.1 173.5 439.9 173.5C454.7 173.5 466.7 185.5 466.7 200.3C466.7 215.1 454.7 227.1 439.9 227.1C425.1 227.1 413.1 215.1 413.1 200.3zM542.8 227.5C541.1 191.6 532.9 159.8 506.6 133.6C480.4 107.4 448.6 99.2 412.7 97.4C375.7 95.3 264.8 95.3 227.8 97.4C192 99.1 160.2 107.3 133.9 133.5C107.6 159.7 99.5 191.5 97.7 227.4C95.6 264.4 95.6 375.3 97.7 412.3C99.4 448.2 107.6 480 133.9 506.2C160.2 532.4 191.9 540.6 227.8 542.4C264.8 544.5 375.7 544.5 412.7 542.4C448.6 540.7 480.4 532.5 506.6 506.2C532.8 480 541 448.2 542.8 412.3C544.9 375.3 544.9 264.5 542.8 227.5zM495 452C487.2 471.6 472.1 486.7 452.4 494.6C422.9 506.3 352.9 503.6 320.3 503.6C287.7 503.6 217.6 506.2 188.2 494.6C168.6 486.8 153.5 471.7 145.6 452C133.9 422.5 136.6 352.5 136.6 319.9C136.6 287.3 134 217.2 145.6 187.8C153.4 168.2 168.5 153.1 188.2 145.2C217.7 133.5 287.7 136.2 320.3 136.2C352.9 136.2 423 133.6 452.4 145.2C472 153 487.1 168.1 495 187.8C506.7 217.3 504 287.3 504 319.9C504 352.5 506.7 422.6 495 452z" />
            </svg>
          </a>

          <a href="#" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="33" height="33" fill="currentColor">
              <path
                d="M576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 440 146.7 540.8 258.2 568.5L258.2 398.2L205.4 398.2L205.4 320L258.2 320L258.2 286.3C258.2 199.2 297.6 158.8 383.2 158.8C399.4 158.8 427.4 162 438.9 165.2L438.9 236C432.9 235.4 422.4 235 409.3 235C367.3 235 351.1 250.9 351.1 292.2L351.1 320L434.7 320L420.3 398.2L351 398.2L351 574.1C477.8 558.8 576 450.9 576 320z" />
            </svg>
          </a>

          <a href="#" aria-label="mail">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="34" height="34" fill="currentColor">
              <path
                d="M125.4 128C91.5 128 64 155.5 64 189.4C64 190.3 64 191.1 64.1 192L64 192L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 192L575.9 192C575.9 191.1 576 190.3 576 189.4C576 155.5 548.5 128 514.6 128L125.4 128zM528 256.3L528 448C528 456.8 520.8 464 512 464L128 464C119.2 464 112 456.8 112 448L112 256.3L266.8 373.7C298.2 397.6 341.7 397.6 373.2 373.7L528 256.3zM112 189.4C112 182 118 176 125.4 176L514.6 176C522 176 528 182 528 189.4C528 193.6 526 197.6 522.7 200.1L344.2 335.5C329.9 346.3 310.1 346.3 295.8 335.5L117.3 200.1C114 197.6 112 193.6 112 189.4z" />
            </svg>
          </a>
        </div>
      </div>

      <div class="footer-col contact-col">
        <h4>C O N T A C T</h4>
        <ul class="contact-list">
          <li><span class="icon">📞</span> +91 98300 06595</li>
          <li><span class="icon">📍</span> Kolkata: BIA, Chinar Park</li>
          <li>
            <span class="icon">🌐</span>
            <a href="https://groomingdestination.com/" target="_blank" rel="noopener noreferrer">
              https://groomingdestination.com/
            </a>
          </li>
        </ul>
      </div>

      <div class="footer-col cta-col">
        <h4>B E G I N &nbsp; Y O U R &nbsp; J O U R N E Y</h4>
        <p>
          Auditions open across Kolkata, Durgapur, Siliguri &amp; Bangalore
          for Season 6.
        </p>
        <a href="join-us.html">
          <button type="button" class="footer-btn">REGISTER NOW</button>
        </a>
      </div>
    </div>

    <div class="footer-bottom">
      <hr class="footer-divider" />
      <p>
        © 2026 MATRIMAA. All rights reserved. Crafted in honor of every
        mother's story.
      </p>
    </div>
  </footer>

  <script>
    const navbar = document.querySelector("#navbar");

    window.addEventListener("scroll", () => {
      if (window.scrollY > 20) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });
  </script>
</body>

</html>