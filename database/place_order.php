<?php

    session_start();

    include('connect.php');

    if(isset($_SESSION['logged_in'])){
        header('location: ../index.php?message=Please Login to Continue Shopping');
        exit();
    }else{
        if(isset($_POST['checkout'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $order_cost = $_SESSION['cart_total'];
            $order_status = "Pending";
            $order_date = date("Y-m-d H:i:s");
            $user_id = $_SESSION['user_id'];
    
            $stmt = $conn -> prepare("INSERT INTO orders (order_id, user_phone, user_address, user_city, order_cost, order_status, order_date, user_id ) VALUES (?,?,?,?,?,?,?,?)");
    
            $stmt -> bind_param("isssissi", $order_id, $mobile, $address, $city, $order_cost, $order_status, $order_date, $user_id);
    
            $stmt -> execute();
    
            // issue new order id
    
            $order_id = $stmt -> insert_id;
    
            echo $order_id;
    
    
            // get the product details from the cart session
    
            foreach($_SESSION['cart'] as $product_id => $product_array){ // this get from cart.php
                $product = $_SESSION['cart'][$product_id];
                $product_id = $product_array['product_id'];
                $product_name = $product_array['product_name'];
                $product_price = $product_array['product_price'];
                $product_quantity = $product_array['product_quantity'];
                $product_image = $product_array['product_image'];
    
                $stmt = $conn -> prepare("INSERT INTO order_items (order_id, product_id, product_name, product_price, product_quantity, product_image, user_id, order_date) VALUES (?,?,?,?,?,?,?,?)");
    
                $stmt -> bind_param("iisdisis", $order_id, $product_id, $product_name, $product_price, $product_quantity, $product_image, $user_id, $order_date);
    
                $stmt -> execute();
    
            }
    
            // clear the cart
    
            // unset($_SESSION['cart']);
    
            header('location: ../payment.php?order_status=Order Placed Successfully');
        }
    }



    // get user info and store in database

   

?>