<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    if (isset($_SESSION['admin_logged_in'])) {
        unset($_SESSION['admin_logged_in']);
        if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        }
        if (isset($_SESSION['name'])) {
            unset($_SESSION['name']);
        }
        header('location: login.php');
        exit; // Added exit to prevent further execution
    }
}
?>
