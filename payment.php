<?php

  session_start();

  include('partial/header.php');


?>

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <p><?php if(isset($_GET['order_status']))  {echo $_GET['order_status'];}?></p>
            <p>Total Payment : $ <?php if(isset($_SESSION['cart_total'])) echo $_SESSION['cart_total'];?></p>
            <?php if(isset($_SESSION['cart_total']) && $_SESSION['cart_total'] != 0 ) { ?>
            <input type="Submit" class="btn btn-primary" value="Pay Now">
            <?php } ?>

            <?php if(isset($_GET['order_status']) && $_GET['order_status'] == "Pending") { ?>
            <input type="Submit" class="btn btn-primary" value="Pay Now">
            <?php }else { ?>
              <p>You Dont Have Anything</p>
            <?php } ?>
        </div>
    </section>

    <?php



include('partial/footer.php');


?>
