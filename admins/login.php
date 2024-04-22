<?php

session_start();

include('../database/connect.php');

if (isset($_SESSION['admin_logged_in'])) {
  header('location: admin_dashboard.php');
}


if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("select id, name, email, password from adminlogin where email = ? and password = ?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $stmt->bind_result($id, $name, $email, $password);
  $stmt->store_result();
  $stmt->fetch();

  if ($stmt->num_rows > 0) {
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['admin_logged_in'] = true;
    header('location: admin_dashboard.php');
//   } else {
//     header('location: login.php?error=Invalid email or password');
//   }
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

  <section class="my-1 py-1">
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
      </form>
    </div>
  </section>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>