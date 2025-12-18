<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexStore | Your Cart</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .cart-container {
            padding: 8rem 5% 5rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .cart-item-info h4 {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .cart-item-info p {
            color: var(--text-secondary);
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .quantity-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--glass-border);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
        }

        .cart-summary {
            margin-top: 3rem;
            padding: 2rem;
            text-align: right;
        }

        .total-price {
            font-size: 2rem;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        .btn-checkout {
            width: 100%;
            max-width: 300px;
        }
    </style>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            renderCart();
        });

        function renderCart() {
            const cartList = document.getElementById('cart-list');
            const summary = document.getElementById('cart-summary');
            const totalDisplay = document.getElementById('total-price');

            if (cart.length === 0) {
                cartList.innerHTML = '<p>Your cart is empty. <a href="index.php#products" style="color: var(--primary);">Go shopping!</a></p>';
                summary.style.display = 'none';
                return;
            }

            summary.style.display = 'block';
            cartList.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                total += item.price * item.quantity;
                const itemEl = document.createElement('div');
                itemEl.className = 'glass cart-item';
                itemEl.innerHTML = `
                    <div class="cart-item-info">
                        <h4>${item.name}</h4>
                        <p>$${parseFloat(item.price).toFixed(2)} each</p>
                    </div>
                    <div class="cart-item-actions">
                        <button class="quantity-btn" onclick="updateQty(${item.id}, -1)">-</button>
                        <span>${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQty(${item.id}, 1)">+</button>
                        <span style="font-weight: 700; min-width: 80px; text-align: right;">$${(item.price * item.quantity).toFixed(2)}</span>
                    </div>
                `;
                cartList.appendChild(itemEl);
            });

            totalDisplay.innerText = `$${total.toFixed(2)}`;
        }

        function updateQty(id, delta) {
            const item = cart.find(i => i.id === id);
            if (item) {
                item.quantity += delta;
                if (item.quantity <= 0) {
                    const index = cart.indexOf(item);
                    cart.splice(index, 1);
                }
            }
            saveCart();
            renderCart();
            updateCartCount();
        }

        function checkout() {
            alert('Checkout functionality coming soon! This is a demo.');
        }
    </script>
</body>

</html>