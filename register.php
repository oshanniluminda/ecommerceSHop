<?php

session_start();

include('database/connect.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
}


// get user info and store in database

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];

  if ($password !== $confirm_password) {
    header('location: register.php?error=Password does not match');
  }

  else if (strlen($password) < 8) {
    header('location: register.php?error=Password must be at least 8 characters');
  }
  else{
    $stmt1 = $conn->prepare("select count(*) from users where user_email = ?");
    $stmt1->bind_param("s", $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();
  
    if ($num_rows > 0) {
      header('location: register.php?error=Email already exists');
      exit();
    }
    else{
      $stmt = $conn->prepare("insert into users (user_name, user_email, user_password) values (?,?,?)");
      $stmt->bind_param("sss", $name, $email, $password);
      if($stmt->execute()){
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        header('location: account.php?register=Account created successfully');
      }
      else{
        header('location: register.php?error=Error creating account');
      }
    }
  
  }

}else if(isset( $_SESSION['logged_in'] )){
  header('location: account.php');
}
// else{
//   header('location: register.php?error=Error creating account');

// }

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashioner - Register</title>

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
      <h2 class="form-weight-bold">Registeer</h2>
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
          <label for="text">Name</label>
          <input type="text" class="form-control" id="register-name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="register-email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group mb-3">
          <label for="password">Confirm Password</label>
          <input type="password" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="Confirm password" required>
        </div>
        <div class="form-group mb-2">
          <input type="submit" class="btn btn-primary" id="register-btn" value="Register" name="register">
        </div>
        <div class="form-group">
          <p>Already have an account? <a href="login.php" id="login-url">Login</a></p>
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