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
  
  
    $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $off, $total_record_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result(); 

?>





<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Ecommerce Admin Panel</h1>
    <nav>
      <ul>
        <li><a href="#" id="ordersLink">Orders</a></li>
        <li><a href="#" id="productsLink">Products</a></li>
        <li><a href="#" id="customersLink">Customers</a></li>
        <li><a href="#" id="settingsLink">Settings</a></li>
 
        <li><a href="logout.php?logout=1" name="logout" id="logout">Logout</a></li>
       
      </ul>
    </nav>
  </header>
  <main>
    <section id="content">
      <h2>Welcome to the Admin Dashboard!</h2>
      <p>This is a sample dashboard to get you started. You can use the navigation links above to view different sections.</p>
      
    </section>
  </main>
  <script src="scripts.js"></script>
</body>
</html>
