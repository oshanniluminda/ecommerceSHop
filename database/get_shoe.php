<?php

include ('connect.php');

// Get the product id
$stmt = $conn->prepare("SELECT * FROM products where product_category = 'shoe' LIMIT 3");

$stmt->execute();

$shoes = $stmt->get_result();