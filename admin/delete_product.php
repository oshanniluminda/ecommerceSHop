<?php 
    session_start();
    include('../database/connect.php');
?>

<?php 

    if(!isset($_SESSION['admin_logged_in']))
    {
        header('location: login.php');
        exit;
    }

    if(isset($_GET['product_id']))
    {
        $product_id = $_GET['product_id'];
        $stmt = $conn->prepare("delete from products where product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->close();
        header('location: product.php?delete_success_message=Product Deleted Successfully');
    }
    else
    {
        header('location: admin_dashboard.php?product');
    }



?>