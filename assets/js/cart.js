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

async function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    try {
        const response = await fetch('api/checkout.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ items: cart })
        });

        const result = await response.json();

        if (result.success) {
            alert('✅ ' + result.message);
            // Clear cart
            cart.length = 0;
            saveCart();
            renderCart();
            updateCartCount();
        } else {
            let errorMsg = result.message;
            if (result.errors && result.errors.length > 0) {
                errorMsg += '\n\n' + result.errors.join('\n');
            }
            alert('❌ Checkout Failed:\n\n' + errorMsg);
        }
    } catch (error) {
        alert('Server error. Please try again.');
    }
}
