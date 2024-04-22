<?php

session_start();

include('database/connect.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
}


if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    session_destroy();
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['logged_in']);
    header('location: login.php');
    exit();
  }
}

if (isset($_POST['change_password'])) {
  $new_password = $_POST['new-password'];
  $confirm_password = $_POST['confirm-password'];
  if ($new_password !== $confirm_password) {
    header('location: register.php?error=Password does not match');
  } else if (strlen($new_password) < 8) {
    header('location: register.php?error=Password must be at least 8 characters');
  } else {
    $stmt = $conn->prepare("update users set user_password = ? where user_email = ?");
    $stmt->bind_param("ss", $new_password, $_SESSION['user_email']);
    if ($stmt->execute()) {
      header('location: account.php?password=Password changed successfully');
    } else {
      header('location: account.php?error=Error changing password');
    }
  }
}

if (isset($_SESSION['logged_in'])) {

  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders where user_id = ? ");

  $stmt->bind_param("i", $_SESSION['user_id']);

  $stmt->execute();

  $watch_products = $stmt->get_result();
}

?>

<?php include('partial/header.php') ?>
  <section class="my-5 py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="card account-info p-4">
            <h2 class="text-primary mb-4">Account Information</h2>
            <div class="info-details">
              <p><strong>Name:</strong> <?php echo $_SESSION['user_name']; ?></p>
              <p><strong>Email:</strong> <?php echo $_SESSION['user_email']; ?></p>
              <p><a href="#orders" id="order-btn" class="btn btn-success btn-block">Your Order</a></p>
              <p><a href="account.php?logout=1" id="logout-btn" class="btn btn-danger btn-block">Logout</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mt-4">
          <div class="card change-password p-1">
            <h2 class="text-primary mb-4 text-center">Change Password</h2>
            <form action="" id="account-form" method="post">
              <p style="color:red">
                <?php
                if (isset($_GET['error'])) {
                  echo $_GET['error'];
                }
                ?>
              </p>
              <p style="color:green">
                <?php
                if (isset($_GET['password'])) {
                  echo $_GET['password'];
                }
                ?>
              </p>
              <!-- <div class="form-group mb-2">
                                <label for="old-password">Old Password</label>
                                <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Old password" required>
                            </div> -->
              <div class="form-group mb-2">
                <label for="new-password">New Password</label>
                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="New password" required>
              </div>
              <div class="form-group mb-2">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm password" required>
              </div>
              <div class="form-group">
                <button type="submit" id="change-password-btn" class="btn btn-primary btn-block" name="change_password">Change Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="orders" class="container order my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weight-bold">Your Orders</h2>
      <hr>
    </div>

    <table class="mt-5 py-5">
      <tr>
        <th>Order Id</th>
        <th>Order Cost</th>
        <th>Order Status</th>
        <th>Order Date</th>
        <th>Order Detail</th>
      </tr>

      <?php while($row = $watch_products->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['order_id']; ?></td>
          <td><?php echo $row['order_cost']; ?></td>
          <td><?php echo $row['order_status']; ?></td>
          <td><?php echo $row['order_date']; ?></td>
          <td>
          <form action="order_details.php" method="POST">
            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
           <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
           <input type="submit" name="order_detail_btn" class="btn btn-success" value="View">
          </form>
          </td>
         
        </tr>
      <?php } ?>

    </table>
  </section>


  <footer class="mt-5 py-5 container-fluid">
    <div class="row ">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img src="assests/images/quality.png" alt="" />
        <p>Get the best quality products at the best price</p>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Feature</h5>
        <ul class="text-uppercase">
          <li><a href="">Men</a></li>
          <li><a href="">Women</a></li>
          <li><a href="">Clothes</a></li>
          <li><a href="">Watch</a></li>
          <li><a href="">Shoes</a></li>
        </ul>
      </div>

      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Contact Us</h5>
        <div>
          <i class="fas fa-map-marker-alt"></i>
          <p>123, Main Road, New City, USA</p>
        </div>

        <div>
          <i class="fas fa-envelope"></i>
          <p>info@gmail.com</p>
        </div>

        <div>
          <i class="fas fa-phone-alt"></i>
          <p>+94769225132</p>
        </div>
      </div>

      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Newsletter</h5>
        <p>Subscribe to our newsletter and get 20% off your first purchase</p>
        <form action="">
          <input type="email" placeholder="Enter your email" />
          <button type="submit" name="submit">Subscribe</button>
        </form>
      </div>
    </div>

    <div class="mt-5">
      <p class="text-center">
        &copy; 2024 Fashioner | Designed by <a href="">Oshan</a>
      </p>
    </div>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>