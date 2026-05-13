<?php include "includes/header.php";?>

 <link rel="stylesheet" href="/SHOP360/assets/css/contact.css">

  <div class="contact-container">

    <!-- LEFT -->

    <div class="contact-info">

      <h1>Trinity Mart</h1>

      <p>
        We'd love to hear from you. 
        Whether you have a question about products, pricing, 
        or anything else, our team is ready to answer all your questions.
      </p>

      <div class="info-box">
        <i class="fas fa-phone"></i>
        <div>
          <h3>Phone</h3>
          <p>+234 812 345 6789</p>
        </div>
      </div>

      <div class="info-box">
        <i class="fas fa-envelope"></i>
        <div>
          <h3>Email</h3>
          <p>support@trinitymart.com</p>
        </div>
      </div>

      <div class="info-box">
        <i class="fas fa-location-dot"></i>
        <div>
          <h3>Location</h3>
          <p>Lagos, Nigeria</p>
        </div>
      </div>

      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-x-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>

    </div>

    <!-- RIGHT -->

    <div class="contact-form">

      <h2>Contact Us</h2>

      <p>Fill out the form and our team will get back to you within 24 hours.</p>

      <form action="process-contact.php" method="POST">

    <div class="input-group">
        <input 
        type="text" 
        name="fullname"
        placeholder="Full Name"
        required>
    </div>

    <div class="input-group">
        <input 
        type="email"
        name="email"
        placeholder="Email Address"
        required>
    </div>

    <div class="input-group">
        <input 
        type="text"
        name="subject"
        placeholder="Subject"
        required>
    </div>

    <div class="input-group">
        <textarea 
        name="message"
        placeholder="Write your message..."
        required></textarea>
    </div>

    <button class="btn" type="submit">
        Send Message
    </button>

</form>

    </div>

  </div>
<?php include "includes/footer.php"; ?>
