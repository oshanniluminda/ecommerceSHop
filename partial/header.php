<?php 

session_start();

include('database/connect.php') 


?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashioner</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="assests/css/style.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <!-- Navbar -->

  <nav class="navbar navbar-expand-lg bg-body-tertiary py-5 fixed-top mb-5">
    <div class="container">
      <a class="navbar-brand" href="index.php">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-buttons">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown" href="shop.php">
            <a class="nav-link dropdown-toggle" href="shop.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Shop
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Men</a></li>
              <li><a class="dropdown-item" href="#">Women</a></li>
              <li><a class="dropdown-item" href="#">Kids</a></li>
              <li><a class="dropdown-item" href="#">Watch</a></li>
              <li><a class="dropdown-item" href="#">Shoe</a></li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blog.php">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="cart.php"><i class="fas fa-shopping-cart">
              <?php if(isset($_SESSION['cart_total_quantity']) && $_SESSION['cart_total_quantity'] != 0){ ?>

              <sup><?php echo $_SESSION['cart_total_quantity']; ?></sup>

              <?php } ?>
            </i></a>
            <a href="account.php"><i class="fas fa-user"></i></a>
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