<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexStore | Premium Tech & Lifestyle</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav id="navbar">
        <div class="logo">NexStore</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>Elevate Your <br>Style Journey</h1>
            <p>Discover curated fashion pieces that define your unique aesthetic. From timeless classics to contemporary
                trends.</p>
            <a href="#products" class="btn-primary">Explore Collection</a>
        </div>
    </header>

    <main>
        <section id="products">
            <h2 class="section-title">Featured Products</h2>

            <div class="search-filter-container glass"
                style="margin: 0 5% 3rem; padding: 1.5rem; display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <div style="flex-grow: 1; position: relative;">
                    <input type="text" id="product-search" placeholder="Search products..."
                        style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--glass-border); background: rgba(255,255,255,0.05); color: white; outline: none;">
                </div>
                <select id="category-filter"
                    style="padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--glass-border); background: var(--bg-card); color: white; outline: none;">
                    <option value="all">All Categories</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Accessories">Accessories</option>
                </select>
            </div>

            <div id="product-list" class="grid">
                <p>Loading the future...</p>
            </div>
        </section>
    </main>

    <script src="assets/js/app.js"></script>
    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>