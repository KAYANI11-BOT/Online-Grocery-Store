<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$_SESSION['cart'] = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Mini Grocery Store</title>
    <link rel="stylesheet" href="style.css">
     <div class="top-banner">
        <img src="images/main/logo.png" alt="Grocery Banner">
    </div>
</head>
<body>
<header>
    <nav>
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="shop.html">Shop</a>
            <a href="#">Vendor</a>
            <a href="#">Pages</a>
            <a href="blog.html">Blog</a>
            <a href="cart.php">Cart</a>
        </nav>
</header>
<main>
    <div class="sent">
    <h2>Checkout</h2>
    <?php if (count($cart) === 0): ?>
        <p>Your cart is empty.</p>
            <a href="index.html" class="shop-btn">Shop now!</a>
    <?php else: ?>
        <p>Thank you for your purchase! Your order has been received.</p><br>
        <a href="index.html" class="shop-btn">Shop More</a>

    <?php endif; ?>
</div>
</main>
<!-- Different Footer -->
   <footer class="footer">
  <div class="footer-container">
    <!-- Logo & Info -->
    <div class="footer-col">
        <h4>FreshNest</h4>
      <p>Healthy Choices, Happy Nest!!</p>
      <p><strong>Address:</strong>Islamabad</p>
      <p><strong>Call Us:</strong> +1 540-025-124553</p>
      <p><strong>Email:</strong> support@freshnest.com</p>
      <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>
    </div>

     <!-- Company -->
    <div class="footer-col">
      <h4>Company</h4>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="doc/Delivery Information.pdf" download="Delivery Information">Delivery Information</a></li>
        <li><a href="doc/PrivacyPolicy.pdf" download="PrivacyPolicy">Privacy Policy</a></li>
        <li><a href="doc/Terms & Conditions.pdf" download="Terms & Conditions">Terms & Conditions</a></li>
        <li><a href="doc/index.html#contact">Contact Us</a></li>
      </ul>
    </div>



    <!-- Popular -->
    <div class="footer-col">
      <h4>Popular</h4>
      <ul>
        <li><a href="#">Milk & Flavoured Milk</a></li>
        <li><a href="#">Butter & Margarine</a></li>
        <li><a href="#">Egg Substitutes</a></li>
        <li><a href="#">Marmalades</a></li>
        <li><a href="#">Tea & Kombucha</a></li>
        <li><a href="">Cheeze</a></li>
      </ul>
    </div>

    <!-- Install App -->
    <div class="footer-col">
      <h4>Install App</h4>
      <p>From App Store or Google Play</p>
      <a href="#"><img src="images/pay/appstore.png" alt="App Store" width="120"></a>
      <a href="#"><img src="images/pay/googleplay.png" alt="Google Play" width="120"></a>
      <p>Secured Payment Gateways</p>
      <img src="images/pay/visa.jpeg" alt="Visa" width="40">
      <img src="images/pay/mastercard.png" alt="Mastercard" width="40">
      <img src="images/pay/paypal.png" alt="PayPal" width="40">
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 FreshNest. All Rights Reserved.</p>
  </div>
</footer>
</body>
</html><?php
// Load PHPMailer manually
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];  // visitor email
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'emanamirniazi@gmail.com'; // your email
        $mail->Password   = 'fbvf pufi vnya gccx';    // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Who sends & who receives
        $mail->setFrom($email, $name); // visitor’s email
        $mail->addAddress('emanamirniazi@gmail.com', 'FreshNest Team'); // you receive it

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Contact from $name";
        $mail->Body    = "<b>Name:</b> $name<br>
                          <b>Email:</b> $email<br>
                          <b>Message:</b><br>$message";

        $mail->send();
        header("location:sent.html");
    } catch (Exception $e) {
        $messageSent = "❌ Message could not be sent.";
    }
}
?>
