<?php

session_start();

include('../database/connect.php');


    // Get the product id
    // $stmt = $conn->prepare("SELECT * FROM products");
  
    // $stmt->execute();
  
    // $products = $stmt->get_result();
  
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
      $page_no = $_GET['page_no'];
    }else{
      $page_no = 1;
    }
    $stmt1 = $conn->prepare("SELECT COUNT(*) as total_record FROM order_items");
    $stmt1->execute();
    $stmt1->bind_result($total_record);
    $stmt1->store_result();
    $stmt1->fetch();
  
  
    $total_record_per_page = 8;
  
    $off = ($page_no - 1) * $total_record_per_page;
  
    $prev = $page_no - 1;
    $next = $page_no + 1;
  
    $addjacents = 4;
  
    $total_no_of_page = ceil($total_record / $total_record_per_page);
  
  
    $stmt2 = $conn->prepare("SELECT * FROM order_items LIMIT $off, $total_record_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result(); 

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminStyle.css">
</head>

<body>
    <div class="dashboard-container">
        <header>
            <h1> <a href="../php/index.php">Fashioner</a> </h1>
            <a href="logout.php?logout=1" name="logout" id="logout">Logout</a>
        </header>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php?dashboard">Dashboard</a></li>
                <li><a href="admin_dashboard.php?order">Orders</a></li>
                <li><a href="admin_dashboard.php?product">Products</a></li>
                <li><a href="admin_dashboard.php?customer">Customers</a></li>
                <li><a href="admin_dashboard.php?addProduct">Add Products</a></li>

            </ul>
        </nav>
        <main>
            <section class="overview">

                <?php
                if (isset($_GET['order'])) {
                    include 'order.php';
                }
                // else{
                //     include 'overview.php';
                // }
                ?>
                <?php
                if (isset($_GET['product'])) {
                    include 'product.php';
                }
                // else{
                //     include 'overview.php';
                // }
                ?>
                <?php
                if (isset($_GET['customer'])) {
                    include 'customer.php';
                }
                // else{
                //     include 'overview.php';
                // }
                ?>
               
                <?php
                if (isset($_GET['addProduct'])) {
                    include 'addProduct.php';
                } ?>

                <?php
                if (isset($_GET['product_id'])) {
                    include 'edit_product.php';
                } ?>


            </section>
            <!-- Add more sections for different functionalities -->
        </main>
        <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?>">
          <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{echo "?page_no=".$page_no-1;}?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="?page_no=1">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="?page_no=2">2</a>
        </li>
       

        <?php if($page_no>=3){ ?>
        <li class="page-item">
          <a class="page-link" href="#">...</a>
          <a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no; ?></a>
        </li>
        <?php } ?>

        <li class="page-item <?php if($page_no>=$total_no_of_page){echo 'disabled';} ?>">
          <a class="page-link" href="<?php if($page_no >=$total_no_of_page ){echo '#';}else{echo "?page_no=".$page_no+1;}?>"
 aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    </div>
   
</body>

</html>

<?php


if (isset($_GET['logout'])) {
    include 'login.php';
}