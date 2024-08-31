function removeFromCart(cartId) {
    fetch(`/cart/remove/${cartId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Assuming each cart item has a unique element ID like "cart-item-1"
            document.getElementById(`cart-item-${cartId}`).remove();
        } else {
            alert('Failed to remove item. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}
