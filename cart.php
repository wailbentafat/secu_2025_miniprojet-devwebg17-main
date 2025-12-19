<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexStore | Your Cart</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav id="navbar" class="scrolled">
        <div class="logo">NexStore</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#products">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <main class="cart-container">
        <h1 class="section-title" style="text-align: left; margin-top: 0;">Your Shopping Cart</h1>
        <div id="cart-list">
            <p>Your cart is empty.</p>
        </div>
        <div id="cart-summary" class="glass cart-summary" style="display: none;">
            <div class="total-price" id="total-price">$0.00</div>
            <button class="btn-primary btn-checkout" onclick="checkout()">Proceed to Checkout</button>
        </div>
    </main>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/cart.js"></script>
</body>

</html>