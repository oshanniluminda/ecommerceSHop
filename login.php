<?php

session_start();

include('database/connect.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
}


if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("select user_id, user_name, user_email, user_password from users where user_email = ? and user_password = ?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
  $stmt->store_result();
  $stmt->fetch();

  if ($stmt->num_rows > 0) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['logged_in'] = true;
    header('location: account.php');
  } else {
    header('location: login.php?error=Invalid email or password');
  }
}

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashioner - Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="assests/css/style.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg bg-body-tertiary py-3 fixed-top mb-5">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-buttons">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item">
            <i class="fas fa-shopping-cart"></i>
            <i class="fas fa-user"></i>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav>

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Login</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form action="" id="login-form" class="w-25 mx-auto" method="post">
        <p style="color:red">
          <?php
          if (isset($_GET['error'])) {
            echo $_GET['error'];
          }
          ?>
        </p>
        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="login-email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group mb-2">
          <input type="submit" class="btn btn-primary" id="login-btn" value="Login" name="login">
        </div>
        <div class="form-group">
          <p>Don't have an account? <a href="register.php" id="register-url">Register</a></p>
        </div>
      </form>
    </div>
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