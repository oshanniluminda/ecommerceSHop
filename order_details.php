<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['order_btn'])) {
  $order_total = $_POST['order_total'];
  $order_status = $_POST['order_status'];

  echo "Order Total: " . $order_total . "<br>"; // Debug info
  echo "Order Status: " . $order_status . "<br>"; // Debug info

  if ($order_status == "Pending") {
    echo "Order status is pending. Redirecting to payment page..."; // Debug info
    header("Location: payment.php?order_status=" . $order_status);
  } else {
    echo "Order status is not pending. Redirecting to home page..."; // Debug info
    header("Location: index.php");
  }
} else {
  echo "Order button not clicked."; // Handle order button not clicked
}


// Function to calculate total order

function calculateTotalOrder($result)
{
  $total = 0;

    while ($row = $result->fetch_assoc()) {
      $total += $row['product_quantity'] * $row['product_price'];
    }

    return $total;

}



include('database/connect.php');

session_start();

$watch_products = array();

// Check if user ID is set
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  // Check if order details button and order ID are submitted
  if (isset($_POST['order_detail_btn']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    echo "User ID: " . $user_id . "<br>"; // Debug info
    echo "Order ID: " . $order_id . "<br>"; // Debug info

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);

    if (!$stmt->execute()) {
      echo "Error: " . $conn->error;
      exit();
    }

    $result = $stmt->get_result();

    $order_total = calculateTotalOrder($result);


    // Check if any records found
    if ($result->num_rows > 0) {
      // Fetch records and store them in the $watch_products array
      while ($row = $result->fetch_assoc()) {
        $watch_products[] = $row;
      }
    } else {
      echo "No orders found for this user.";
    }
   // You need to retrieve this from your database or elsewhere

    // Display button based on order status
    if (isset($order_status)) {
        if ($order_status == "Pending") {
            $button_text = "Pay Now";
        } else {
            $button_text = "Order Delivered";
        }
    } else {
        echo "Order status not set!";
    }
  } else {
    echo "Missing form data."; // Handle missing form data
  }
} else {
  echo "Invalid user session."; // Handle invalid user session
}
?>

<?php include('partial/header.php') ?>


    <section id="orders" class="container order my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Orders</h2>
            <hr>
        </div>

        <table class="mt-5 py-5">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php if (!empty($watch_products)) { ?>
                <?php foreach ($watch_products as $row) { ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="assests/images/<?php echo $row['product_image']; ?>" alt="" />
                                <div>
                                    <p class="mt-3"><?php echo $row['product_name']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $row['product_price']; ?></td>
                        <td><?php echo $row['product_quantity']; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3">No orders found.</td>
                </tr>
            <?php } ?>
        </table>

        <?php if (!empty($button_text)) { ?>
            <form action="">
                <input type="hidden" name="order_total" value="<?php echo $total_order; ?>">
                <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
                <input type="submit" name="order_btn" class="btn btn-primary" value="<?php echo $button_text; ?>">
                
            </form>
        <?php } ?>
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
