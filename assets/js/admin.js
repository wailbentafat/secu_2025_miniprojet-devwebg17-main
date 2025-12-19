function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add Product';
    document.getElementById('productForm').reset();
    document.getElementById('productId').value = '';
    document.getElementById('productModal').classList.add('active');
}

function openEditModal(product) {
    document.getElementById('modalTitle').textContent = 'Edit Product';
    document.getElementById('productId').value = product.id;
    document.getElementById('productName').value = product.name;
    document.getElementById('productDesc').value = product.description;
    document.getElementById('productPrice').value = product.price;
    document.getElementById('productImage').value = product.image_url;
    document.getElementById('productCategory').value = product.category_id;
    document.getElementById('productStock').value = product.stock;
    document.getElementById('productModal').classList.add('active');
}

function closeModal() {
    document.getElementById('productModal').classList.remove('active');
}

document.getElementById('productForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    const isEdit = data.id !== '';
    const url = isEdit ? '../api/update_product.php' : '../api/add_product.php';

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            alert(result.message);
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Server error');
    }
});

async function deleteProduct(id) {
    if (!confirm('Are you sure you want to delete this product?')) return;

    try {
        const response = await fetch('../api/delete_product.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });

        const result = await response.json();

        if (result.success) {
            alert(result.message);
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        alert('Server error');
    }
}
