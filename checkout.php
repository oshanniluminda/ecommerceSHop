<?php

  session_start();

  
  include('partial/header.php');

  if( !empty($_SESSION['cart'])){

  }
  
  else{
    header('Location: index.php');
  }

?>


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Checkout</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="database/place_order.php" id="checkout-form" class="w-35 mx-auto" method="post" >
              <p class="text-center"><?php if(isset($_GET['message'])){echo $_GET['message']; } ?></p>
                <div class="form-group mb-3 checkout-small-element" >
                    <label for="email">Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group mb-3 checkout-small-element">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group mb-3 checkout-small-element">
                    <label for="mobile">Mobile</label>
                    <input type="tel" class="form-control" id="checkout-mobile" name="mobile" placeholder="Enter your Mobile" required>
                </div>
                <div class="form-group mb-3 checkout-large-element">
                    <label for="text">Address</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
                </div>
                <div class="form-group mb-3 checkout-small-element">
                    <label for="text">City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="city" required>
                </div>
                <div class="form-group mb-2 checkout-btn-container">
                    <p>Total Amount : $<?php echo $_SESSION['cart_total']?></p>
                    <input type="submit" class="btn btn-primary" id="checkout-btn" value="Checkout" name="checkout">
                </div>
               
            </form>
        </div>
    </section>


<?php
    include('partial/footer.php');

?>