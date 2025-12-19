<?php
require_once 'auth.php';
require_once '../config/db.php';

// Fetch all products with category names
$stmt = $pdo->query("SELECT items.*, categories.name as category_name FROM items LEFT JOIN categories ON items.category_id = categories.id");
$products = $stmt->fetchAll();

// Fetch categories for dropdown
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | NexStore</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav id="navbar" class="scrolled">
        <div class="logo">NexStore Admin</div>
        <ul class="nav-links">
            <li><a href="../index.php">Store</a></li>
            <li><a href="index.php">Dashboard</a></li>
        </ul>
    </nav>

    <div class="admin-container">
        <div class="admin-header">
            <div>
                <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;">Product Management</h1>
                <p style="color: var(--text-secondary);">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
                </p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <button class="btn-primary" onclick="openAddModal()">+ Add Product</button>
                <a href="../api/logout.php" class="btn-logout">Logout</a>
            </div>
        </div>

        <div class="glass" style="padding: 1.5rem;">
            <div class="product-row"
                style="font-weight: 600; border-bottom: 1px solid var(--glass-border); padding-bottom: 1rem;">
                <div>Image</div>
                <div>Name</div>
                <div>Category</div>
                <div>Price</div>
                <div>Stock</div>
                <div>Actions</div>
            </div>
            <div class="admin-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-row glass">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>"
                            onerror="this.src='https://via.placeholder.com/60'">
                        <div><?php echo htmlspecialchars($product['name']); ?></div>
                        <div><?php echo htmlspecialchars($product['category_name']); ?></div>
                        <div>$<?php echo number_format($product['price'], 2); ?></div>
                        <div><?php echo $product['stock']; ?></div>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="btn-edit"
                                onclick='openEditModal(<?php echo json_encode($product); ?>)'>Edit</button>
                            <button class="btn-delete"
                                onclick="deleteProduct(<?php echo $product['id']; ?>)">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <h2 id="modalTitle">Add Product</h2>
            <form id="productForm">
                <input type="hidden" id="productId" name="id">

                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" id="productName" name="name" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea id="productDesc" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label>Price ($)</label>
                    <input type="number" step="0.01" id="productPrice" name="price" required>
                </div>

                <div class="form-group">
                    <label>Image URL</label>
                    <input type="url" id="productImage" name="image_url" required>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select id="productCategory" name="category_id" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" id="productStock" name="stock" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Save Product</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>

</html>