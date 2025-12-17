document.addEventListener("DOMContentLoaded", () => {
    loadProducts();
});

function loadProducts() {
    const productContainer = document.getElementById('product-list');

    fetch('api/get_products.php')
        .then(response => response.json())
        .then(data => {
            productContainer.innerHTML = ''; 
            data.forEach(item => {
                const productCard = `
                    <div class="product-card">
                        <h3>${item.name}</h3>
                        <p>${item.description}</p>
                        <span>$${item.price}</span>
                        <button onclick="addToCart(${item.id})">Add to Cart</button>
                    </div>
                `;
                productContainer.innerHTML += productCard;
            });
        })
        .catch(error => console.error('Error fetching products:', error));
}