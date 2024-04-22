<?php
// Include the database connection script
include('database/connect.php');

// Start the session
session_start();

// Initialize $_SESSION['cart'] if not set
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Check if the product is already in the cart
  $product_array_ids = array_column($_SESSION['cart'], 'product_id');
  if (!in_array($_POST['product_id'], $product_array_ids)) {
    // If not in cart, add the product to the cart array
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_image = $_POST['product_image'];

    // Create an array for the product
    $product_array = array(
      'product_id' => $product_id,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'product_quantity' => $product_quantity,
      'product_image' => $product_image
    );

    // Add the product array to the cart session
    $_SESSION['cart'][$product_id] = $product_array;
  } else {
    // Product already in cart, show alert
    echo "<script>alert('Product Already In Cart')</script>";
  }

  // Calculate the cart total
  // calculateCartTotal();


} else if (isset($_POST['remove_product'])) {

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);
} else if (isset($_POST['edit_quantity'])) {

  // Edit the product quantity
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  // Update the product quantity in the cart session
  $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
} else {
  // Do nothing

}

calculateCartTotal();

function calculateCartTotal()
{
  $total = 0;
  $total_quantity = 0;

  foreach ($_SESSION['cart'] as $key => $value) {
    $total += $value['product_quantity'] *  $value['product_price'];
    $total_quantity += $value['product_quantity'];
  }

  $_SESSION['cart_total'] = $total;
  $_SESSION['cart_total_quantity'] = $total_quantity;
  
}

?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashioner - Cart</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="assests/css/style.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>

<?php include('partial/header.php') ?>

  <section class="container cart my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weight-bold">Your Cart</h2>
      <hr>
    </div>

    <table class="mt-5 py-5">
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Sub Total</th>
      </tr>
      <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
        <tr>
          <td>
            <div class="product-info">
              <img src="assests/images/<?php echo $value['product_image']  ?>" alt="" />
              <div>
                <p><?php echo $value['product_name']  ?></p>
                <small>Price: $<?php echo $value['product_price']  ?></small>
                <br><br>

                <form action="cart.php" method="post">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']  ?>">
                  <input type="submit" name="remove_product" class="remove-btn" value="Remove">
                </form>

              </div>
            </div>
          </td>
          <td>


            <form action="cart.php" method="post">
              <input type="hidden" name="product_id" value="<?php echo $value['product_id']  ?>">
              <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']  ?>">
              <input type="submit" name="edit_quantity" class="edit-btn" value="Edit">
            </form>

          </td>
          <td>
            <span class="price">$<?php echo $value['product_quantity'] *  $value['product_price']; ?></span>
          </td>
        </tr>
      <?php } ?>
    </table>

    <div class="cart-total">
      <table>

        <tr>
          <td>Total</td>
          <td>$<?php echo $_SESSION['cart_total'];  ?></td>
        </tr>
      </table>
    </div>

    <div class="cart-buttons">

      <form action="">
        <a href="" class="btn btn-primary">Continue Shopping</a>
      </form>

      <form action="checkout.php" method="post">
        <input type="submit" class="btn btn-primary" name="checkout" value="Checkout">
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