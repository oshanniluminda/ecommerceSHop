<?php
    include('partial/Header.php');

?>

  <!-- Contact Us Section -->
  <div class="container mt-5 py-5">
    
    <div class="row">
      <div class="col-md-6">
        <h3 class="text-uppercase">Contact Information</h3>
        <hr>
        <p><strong>Address:</strong><br>
        Your Company Name<br>
        Street Address<br>
        City, State, Zip Code<br>
        Country</p>
        
        <p><strong>Phone:</strong><br>
        Main: Main Phone Number<br>
        Support: Support Phone Number<br>
        Fax: Fax Number</p>
        
        <p><strong>Email:</strong><br>
        General Inquiries: General Email Address<br>
        Support: Support Email Address<br>
        Sales: Sales Email Address</p>
      </div>
      
      <div class="col-md-6 py-5">
        <h3 class="text-uppercase">Contact Form</h3>
        <form id="contactForm" action="submit_contact_form.php" method="POST">
          <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
      </div>
    </div>

</div>
<?php
    include('partial/footer.php');

?>