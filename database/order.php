<?php

session_start();

include('connect.php');

if(isset($_POST['checkout'])){
    
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $order_cost = $_SESSION['cart_total'];
    $order_status = 'Pending';
    $order_date = date('Y-m-d H:i:s');
    $user_id = 1;

    // Insert the order data into the database
   $stmt = $conn -> prepare("INSERT INTO orders (user_id, order_cost, order_status, order_date, name, email, mobile, address, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt -> bind_param("idsssssss", $user_id, $order_cost, $order_status, $order_date, $name, $email, $mobile, $address, $city);

    $stmt -> execute();

    // Get the order id





    // Get the cart data

}
?>