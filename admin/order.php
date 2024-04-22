<?php
include ('../database/connect.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        th, td{
            background-color: #f8f8f8;
            border: 1px solid;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">

    <h2 class="ru">Order Items</h2>
    <?php
            $sql = "SELECT * FROM `order_items`";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if($num>0)
            {
                echo"
                <table class='register_table'>
       
                <thead>
                <th>Item ID</th>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Product Image</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Action</th>
            
            </thead>
                
            <tbody>
                ";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "
                    <tr>
                    <td>".$row['item_id']."</td>
                    <td>".$row['order_id']."</td>
                    <td>".$row['product_id']."</td>
                    <td>".$row['product_name']."</td>
                    <td>".$row['product_price']."</td>
                    <td>".$row['product_quantity']."</td>
                    <td>".$row['product_image']."</td>
                    <td>".$row['user_id']."</td>
                    <td>".$row['order_date']."</td>
               

                    <td>
                    <form method='post'>
                    <input type='hidden' name='id' value='".$row['user_id']."'>
                   
                    <a href='delete_order.php?product_id=" . $row['product_id'] . "' class='btn btn-danger'>Delete</a>
                    </form>
                    </td>
                    </tr>
                    ";
                }
                echo "
            </tbody>
            </table>
                ";
            }
            else{
                echo "No record found";
            }
            ?>
            
</body>
</html>

<?php
// include('../php/connect.php');

if (isset($_POST['accept'])) {
    $id = $_POST['id'];
    $select_user = "SELECT * FROM register_user WHERE id = '$id'";
    $result_user = mysqli_query($con, $select_user);

    if ($row = mysqli_fetch_assoc($result_user)) {
        // $id = $_POST['id'];
        $title = $row['title'];
        $full_name = $row['full_name'];
        $address = $row['address'];
        $email = $row['email'];
        $image = $row['image'];
        $mobile = $row['mobile'];
        $nic = $row['nic'];
        $organization = $row['organization'];
        $profession = $row['profession'];
        $faculty = $row['faculty'];
        $degree = $row['degree'];
        $graduate_year = $row['graduate_year'];

        $insert_query = "INSERT INTO approve_user (id,title, full_name, address, email, image, mobile, nic, organization, profession, faculty, degree, graduate_year) VALUES ('$id','$title','$full_name','$address','$email','$image','$mobile','$nic','$organization','$profession','$faculty','$degree','$graduate_year')";
        
        $result = mysqli_query($con, $insert_query);
        
        if ($result) {
            echo "<script>alert('User Approved')</script>";
            echo "<script>window.open('approve_user.php','_self')</script>";
        } else {
            echo "<script>alert('Error approving user')</script>";
        }
    } else {
        echo "<script>alert('User not found')</script>";
    }
}
?>

