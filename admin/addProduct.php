<?php
include('../database/connect.php');

if(isset($_POST['addProduct'])){
    $product_name = $_POST['title'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_category = $_POST['category'];
    $product_color = $_POST['color'];
    $product_special_offer = $_POST['offer'];

    $image01 = $_FILES['image01']['tmp_name'];
    $image02 = $_FILES['image02']['tmp_name'];
    $image03 = $_FILES['image03']['tmp_name'];
    $image04 = $_FILES['image04']['tmp_name'];

    $image_name1 = $product_name."_1.jpg";
    $image_name2 = $product_name."_2.jpg";
    $image_name3 = $product_name."_3.jpg";
    $image_name4 = $product_name."_4.jpg";

    move_uploaded_file($image01, "../images/products/".$image_name1);
    move_uploaded_file($image02, "../images/products/".$image_name2);
    move_uploaded_file($image03, "../images/products/".$image_name3);
    move_uploaded_file($image04, "../images/products/".$image_name4);
   
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_category, product_color, product_special_offer, product_image, product_image2, product_image3, product_image4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    // Error handling for prepare() method failure
    echo "Error preparing statement: " . $conn->error;
    exit();
}

// Bind parameters
$stmt->bind_param("ssdsssssss", $product_name, $product_description, $product_price, $product_category, $product_color, $product_special_offer, $image_name1, $image_name2, $image_name3, $image_name4);



// Execute the statement
if($stmt->execute()){
    header('location: admin_dashboard.php?add_success_message=Product Added Successfully');
} else {
    header('location: admin_dashboard.php?add_failure_message=Product Add Failed');
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


    <div class="container">

        <form action="" method="post" enctype="multipart/form-data">
            <h2 class="ru">Add Product</h2>


                <input type="hidden" name="product_id" >
                <label for="">Title :</label><br>
                <input type="text" name="title" id="title"  required><br>
                <label for="">Description:</label><br>
                <input type="text" name="description" id="description" required><br>
                <label for="">Price :</label><br>
                <input type="text" name="price" id="price"  required><br>
                <label for="">Category :</label><br>

                <select name="category" id="category" required class="form-select">
                    <option value="bags">Bags</option>
                    <option value="shoes">Shoes</option>
                    <option value="watches">Watches</option>
                    <option value="clothes">Clothes</option>
                </select><br>
                <label for="">Color :</label><br>
                <input type="text" name="color" id="color"  required><br>
                <label for="">Special Offer :</label><br>
                <input type="text" name="offer" id="offer"  required><br>

                <label for="">Image 01 :</label><br>
                <input type="file" name="image01" id="image01"  required><br>

                <label for="">Image 02 :</label><br>
                <input type="file" name="image02" id="image02"  required><br>

                <label for="">Image 03 :</label><br>
                <input type="file" name="image03" id="image03"  required><br>

                <label for="">Image 04 :</label><br>
                <input type="file" name="image04" id="image04"  required><br>

                



                <button type="submit" name="addProduct">Add Products </button>
     
        </form>

    </div>
</body>

</html>