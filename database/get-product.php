<?php

include ('connect.php');

// Get the product id
$stmt = $conn->prepare("SELECT * FROM products LIMIT 3");

$stmt->execute();

$featured_products = $stmt->get_result();