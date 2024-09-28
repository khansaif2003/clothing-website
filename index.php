<?php
require_once("include/initialize.php");

$content = 'home.php';
$view = (isset($_GET['q']) && $_GET['q'] != '') ? $_GET['q'] : '';

switch ($view) {
    case 'product':
        $title = "Products";
        $content = 'menu.php';
        break;
    
    case 'cart':
        $title = "Cart List";
        $content = 'cart.php';
        break;
    
    case 'profile':
        $title = "Profile";
        $content = 'customer/profile.php';
        break;
    
    case 'trackorder':
        $title = "Track Order";
        $content = 'customer/trackorder.php';
        break;
    
    case 'orderdetails':
        // Ensure $_SESSION['orderdetails'] is always an array
        if (!isset($_SESSION['orderdetails']) || !is_array($_SESSION['orderdetails'])) {
            $_SESSION['orderdetails'] = [];  // Initialize as an empty array
        }

        $content = 'customer/orderdetails.php';
        
        // Now safely use count() after ensuring it's an array
        if (count($_SESSION['orderdetails']) > 0) {
            $title = 'Cart List | <a href="">Order Details</a>';
        }
        break;

    case 'billing':
        // Ensure $_SESSION['billingdetails'] is always an array
        if (!isset($_SESSION['billingdetails']) || !is_array($_SESSION['billingdetails'])) {
            $_SESSION['billingdetails'] = [];  // Initialize as an empty array
        }

        $content = 'customer/customerbilling.php';

        // Now safely use count() after ensuring it's an array
        if (count($_SESSION['billingdetails']) > 0) {
            $title = 'Cart List | <a href="">Billing Details</a>';
        }
        break;
    
    case 'contact':
        $title = "Contact Us";
        $content = 'contact.php';
        break;
    
    case 'single-item':
        $title = "Product";
        $content = 'single-item.php';
        break;
    
    case 'recoverpassword':
        $title = "Recover Password";
        $content = 'passwordrecover.php';
        break;

    default:
        $title = "Home";
        $content = 'home.php';
        break;
}

require_once("theme/templates.php");
?>
