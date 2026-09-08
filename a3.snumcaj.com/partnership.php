<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$statusMsg = '';
$statusType = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {
    if (!file_exists('db.php')) {
      throw new Exception("db.php file was not found on the server.");
    }

    require_once 'db.php';

    if (!isset($conn) || !$conn) {
      throw new Exception("Database connection \$conn is not defined or failed.");
    }

    $companyName = trim($_POST['company_name'] ?? '');
    $contactPerson = trim($_POST['contact_person'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $partnershipType = trim($_POST['partnership_type'] ?? '');
    $message = !empty($_POST['message']) ? trim($_POST['message']) : NULL;

    if (!empty($companyName) && !empty($contactPerson) && $email !== false && !empty($phone) && !empty($partnershipType)) {
      $sql = "INSERT INTO partnership_enquiries (company_name, contact_person, email, phone, partnership_type, message) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);

      if (!$stmt) {
        throw new Exception("Prepare failed: " . mysqli_error($conn));
      }

      mysqli_stmt_bind_param($stmt, "ssssss", $companyName, $contactPerson, $email, $phone, $partnershipType, $message);

      if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Execute failed: " . mysqli_stmt_error($stmt));
      }

      mysqli_stmt_close($stmt);

      header("Location: partnership.php?status=success");
      exit();
    } else {
      echo "<script>alert('Validation failed: Please make sure all required fields are filled correctly.');</script>";
    }
  } catch (Exception $e) {
    die("<div style='color: red; background: #fff; padding: 20px; font-family: sans-serif; border: 2px solid red;'><strong>Error processing form submission:</strong><br>" . htmlspecialchars($e->getMessage()) . "</div>");
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>Partner With Us | Matrimaa</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="styles.css?v=2.0">
  <link rel="stylesheet" href="partnership.css?v=2.0">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Zalando+Sans:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet" />
</head>

<body class="partnership-body">
  <!-- NAVBAR -->
  <div id="navbar">
    <a href="index.php">
      <img src="matrimaa-logo.png" alt="Matrimaa Logo" />
    </a>

    <!-- Hamburger Menu Icon -->
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- Navigation Buttons -->
    <div id="nav-buttons">
      <a href="index.php"><button type="button">HOME</button></a>
      <a href="journey.php"><button type="button">JOURNEY</button></a>
      <a href="media.php"><button type="button">GALLERY</button></a>
      <a href="about.php"><button type="button">ABOUT US</button></a>
      <a href="join-us.php"><button type="button">JOIN US</button></a>
      <div class="spl-btn mobile-only">
        <a href="#partner-form-section">
          <button type="button">PARTNER WITH US</button>
        </a>
      </div>
    </div>

    <!-- Special Button for Desktop Header -->
    <div class="spl-btn desktop-only">
      <a href="#partner-form-section">
        <button type="button">PARTNER WITH US</button>
      </a>
    </div>
  </div>

  <!-- HERO SECTION -->
  <header id="partnership-hero">
    <div class="hero-container">
      <!-- Text Content -->
      <div class="hero-left">
        <h1 class="page-title">OUR SPONSORS</h1>
        <p class="hero-subtitle">
          COLLABORATE WITH EAST INDIA'S PREMIER PLATFORM CELEBRATING
          MOTHERHOOD
        </p>
      </div>

      <!-- Floating & Draggable Sponsors -->
      <div class="hero-right">
        <div class="floating-sponsors-container">
          <div class="circular-sponsor sp-1">
            <img src="iihm-logo.jpg" alt="IIHM Logo" />
          </div>
          <div class="circular-sponsor sp-2">
            <img src="kolkatanama-logo.jpg" alt="Kolkatanama Logo" />
          </div>
          <div class="circular-sponsor sp-3">
            <img src="skinbee-logo.webp" alt="Skin Bee Logo" />
          </div>
          <div class="circular-sponsor sp-4">
            <img src="addyafoods-logo.jpg" alt="Addya Foods Logo" />
          </div>
          <div class="circular-sponsor sp-5">
            <img src="tani-logo.jpg" alt="Tani's Creations Logo" />
          </div>
          <div class="circular-sponsor sp-6">
            <img src="debdipa-logo.png" alt="Debdipa's Nature Hub Logo" />
          </div>
          <div class="circular-sponsor sp-7">
            <img src="tandra-logo.webp" alt="Tandra's Logo" />
          </div>
          <div class="circular-sponsor sp-8">
            <img src="decohome-logo.png" alt="Decohome Logo" />
          </div>
          <div class="circular-sponsor sp-9">
            <img src="groomingdestination-logo.jpg" alt="Grooming Destination Logo" />
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- MAIN PARTNERSHIP CONTENT -->
  <main class="partnership-container">
    <!-- WHY PARTNER SECTION -->
    <section class="partner-benefits-section">
      <div class="section-title-wrapper">
        <h2><span>Why Partner With Us?</span></h2>
      </div>

      <div class="benefits-grid">
        <div class="card benefit-card">
          <h4>ENGAGEMENT</h4>
          <h2>DIRECT REACH</h2>
          <p>
            Connect directly with thousands of mothers, families, and
            decision-makers across key East Indian metros.
          </p>
        </div>

        <div class="card benefit-card">
          <h4>BRANDING</h4>
          <h2>HIGH VISIBILITY</h2>
          <p>
            Gain extensive coverage across digital, print, outdoor, and live
            stage media throughout Season 5.
          </p>
        </div>

        <div class="card benefit-card">
          <h4>COMMUNITY</h4>
          <h2>SOCIAL IMPACT</h2>
          <p>
            Align your brand with empowerment, social recognition, and
            meaningful cultural initiatives.
          </p>
        </div>
      </div>
    </section>

    <!-- INQUIRY FORM SECTION -->
    <section id="partner-form-section" class="partner-form-section">
      <div class="form-glass-card">
        <div class="form-header">
          <h2>BECOME A PARTNER</h2>
          <p>
            Fill out the form below and our team will get in touch with a
            customized sponsorship package.
          </p>
        </div>

        <form class="partner-form" action="partnership.php" method="POST">
          <div class="form-row">
            <div class="form-group">
              <label for="company_name">COMPANY NAME</label>
              <input type="text" id="company_name" name="company_name" placeholder="Enter company name" required>
            </div>
            <div class="form-group">
              <label for="contact_person">CONTACT PERSON</label>
              <input type="text" id="contact_person" name="contact_person" placeholder="Enter contact person name"
                required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email">EMAIL ADDRESS</label>
              <input type="email" id="email" name="email" placeholder="Enter business email" required>
            </div>
            <div class="form-group">
              <label for="phone">PHONE NUMBER</label>
              <input type="tel" id="phone" name="phone" placeholder="Enter contact number" required>
            </div>
          </div>

          <div class="form-group">
            <label for="partnership_type">PARTNERSHIP TYPE</label>
            <select id="partnership_type" name="partnership_type" required>
              <option value="" disabled selected>Select partnership type</option>
              <option value="Title Sponsor">Title Sponsor</option>
              <option value="Associate Sponsor">Associate Sponsor</option>
              <option value="In-Kind Partner">In-Kind Partner</option>
              <option value="Media Partner">Media Partner</option>
            </select>
          </div>

          <div class="form-group">
            <label for="message">MESSAGE / PROPOSAL</label>
            <textarea id="message" name="message" rows="4"
              placeholder="Briefly describe your partnership proposal..."></textarea>
          </div>

          <div class="form-submit-wrapper">
            <button type="submit" class="spl-btn-submit">BECOME A PARTNER</button>
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
          <li><span class="icon">📞</span> +91 9830006595</li>
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
        <a href="join-us.php">
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

  <!-- SCRIPTS -->
  <script>
    <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
      alert("Form submitted successfully!");
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
      }
    <?php endif; ?>

    // Hamburger Menu Toggle
    const hamburger = document.getElementById("hamburger");
    const navButtons = document.getElementById("nav-buttons");

    if (hamburger && navButtons) {
      hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        navButtons.classList.toggle("active");
      });

      // Close menu when any option inside #nav-buttons is clicked
      document.querySelectorAll("#nav-buttons a").forEach((link) => {
        link.addEventListener("click", () => {
          hamburger.classList.remove("active");
          navButtons.classList.remove("active");
        });
      });
    }

    // Navbar scroll effect
    const navbar = document.querySelector("#navbar");
    window.addEventListener("scroll", () => {
      if (window.scrollY > 20) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });

    // Interactive Drag & Drop Script for Sponsors
    document.querySelectorAll(".circular-sponsor").forEach((el) => {
      let isDragging = false;
      let startX, startY, initialLeft, initialTop;

      const onStart = (e) => {
        isDragging = true;
        el.style.zIndex = "100";
        el.classList.add("dragging");

        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        const clientY = e.touches ? e.touches[0].clientY : e.clientY;

        startX = clientX;
        startY = clientY;
        initialLeft = el.offsetLeft;
        initialTop = el.offsetTop;

        document.addEventListener("mousemove", onMove);
        document.addEventListener("touchmove", onMove, { passive: false });
        document.addEventListener("mouseup", onEnd);
        document.addEventListener("touchend", onEnd);
      };

      const onMove = (e) => {
        if (!isDragging) return;
        if (e.cancelable) e.preventDefault();

        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        const clientY = e.touches ? e.touches[0].clientY : e.clientY;

        const deltaX = clientX - startX;
        const deltaY = clientY - startY;

        el.style.left = `${initialLeft + deltaX}px`;
        el.style.top = `${initialTop + deltaY}px`;
      };

      const onEnd = () => {
        if (isDragging) {
          isDragging = false;
          el.classList.remove("dragging");
          document.removeEventListener("mousemove", onMove);
          document.removeEventListener("touchmove", onMove);
          document.removeEventListener("mouseup", onEnd);
          document.removeEventListener("touchend", onEnd);
        }
      };

      el.addEventListener("mousedown", onStart);
      el.addEventListener("touchstart", onStart, { passive: true });
    });
  </script>
</body>

</html>