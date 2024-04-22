<?php
include('../database/connect.php');
?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $products = $stmt->get_result();
} else if(isset($_POST['add'])) {
 
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $color = $_POST['color'];
    $offer = $_POST['offer'];
    $product_id = $_POST['product_id'];
    
    $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?, product_category = ?, product_color = ?, product_special_offer = ? WHERE product_id = ?");
    $stmt->bind_param("ssdsssi", $title, $description, $price, $category, $color, $offer, $product_id);
    if ($stmt->execute()) {
        header('location: admin_dashboard.php?edit_success_message=Product Edited Successfully');
    } else {
        header('location: admin_dashboard.php?edit_failure_message=Product Edit Failed');
    }
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link rel="stylesheet" href="adminStyle.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        form {
            margin-top: 50px;
            margin-left: 50px;
        }

        /* h1{
    text-align: center;
    margin-top: 50px;
    margin-bottom: 50px;
} */

        label {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        input {
            margin-top: 10px;
            margin-bottom: 10px;

        }

        button {
            margin-top: 20px;
            margin-bottom: 10px;
            padding: 8px 30px;
            background-color: #0d6efd;
            font-size: 20px;
            color: white;

        }
    </style>

</head>

<body>

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
    <div class="container">

        <form action="" method="post">
            <h2 class="ru">Edit Product</h2>




            <?php foreach ($products as $product) { ?>


                <input type="hidden" name="product_id" value="<?php echo $product['product_name'] ?>">
                <label for="">Title :</label><br>
                <input type="text" name="title" id="title" value="<?php echo $product['product_name'] ?>" required><br>
                <label for="">Description:</label><br>
                <input type="text" name="description" id="description" value="<?php echo $product['product_description'] ?>" required><br>
                <label for="">Price :</label><br>
                <input type="text" name="price" id="price" value="<?php echo $product['product_price'] ?>" required><br>
                <label for="">Category :</label><br>

                <select name="category" id="category" required class="form-select">
                    <option value="bags">Bags</option>
                    <option value="shoes">Shoes</option>
                    <option value="watches">Watches</option>
                    <option value="clothes">Clothes</option>
                </select><br>
                <label for="">Color :</label><br>
                <input type="text" name="color" id="color" value="<?php echo $product['product_color'] ?>" required><br>
                <label for="">Special Offer :</label><br>
                <input type="text" name="offer" id="offer" value="<?php echo $product['product_special_offer'] ?>" required><br>

                <button type="submit" name="add">Edit </button>
            <?php } ?>
        </form>

    </div>
</body>

</html>