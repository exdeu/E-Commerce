document.getElementById('checkout').addEventListener('click', async function() {
    try {
        const response = await fetch('checkout.php', {
            method: 'POST'
        });

        const res = await response.json();

        if (res.success) {
            alert('Checkout successful!');
            window.location.href = '../prod/products.html';
        } else {
            alert('Checkout failed: ' + res.message);
        }

    } catch (error) {
        console.error('Checkout error:', error);
    }
});
