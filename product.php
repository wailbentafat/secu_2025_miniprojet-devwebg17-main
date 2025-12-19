<?php
require_once 'config/db.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = null;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexStore | <?php echo $product ? htmlspecialchars($product['name']) : 'Product Not Found'; ?></title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/product.css">
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

    <main class="product-detail-container">
        <?php if ($product): ?>
            <div class="glass detail-image">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                    onerror="this.src='https://via.placeholder.com/500x500?text=No+Image'"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="detail-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="stock-tag">In Stock: <?php echo $product['stock']; ?> units</div>
                <div class="detail-price">$<?php echo number_format($product['price'], 2); ?></div>
                <p class="detail-desc"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <button class="btn-primary" style="width: 100%;"
                    onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo addslashes($product['name']); ?>', <?php echo $product['price']; ?>)">
                    Add to Cart
                </button>
            </div>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center;">
                <h1>Product Not Found</h1>
                <p>The item you are looking for does not exist or has been removed.</p>
                <a href="index.php" class="btn-primary" style="margin-top: 2rem;">Return Home</a>
            </div>
        <?php endif; ?>
    </main>

    <script src="assets/js/app.js"></script>
</body>

</html>