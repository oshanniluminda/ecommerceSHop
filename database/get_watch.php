<?php

include ('connect.php');

// Get the product id
$stmt = $conn->prepare("SELECT * FROM products where product_category = 'watch' LIMIT 3");

$stmt->execute();

$watch_products = $stmt->get_result();