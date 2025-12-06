async function loadCart(){
    try {
        const response = await fetch('cart/cart.php', {
            method: 'POST'
        });

        const carts = await response.json();

        if (carts.success === false) {
            console.error('Server error:', carts.message);
            alert('Failed to load cart: ' + carts.message);
            return;
        }

        displayCartItems(carts.data);
    } catch (error) {
        console.error('Error loading cart:', error);
    }   
}
async function removeCart(cart){
    const response = await fetch('cart/removecart.php', { method: 'POST',body: JSON.stringify(cart)});
    updatePrice();
}

function displayCartItems(carts) {
    const cartTableBody = document.querySelector('tbody');
    cartTableBody.innerHTML = ''; 

    carts.forEach(cart => {
        const price = Number(cart.price);
        const count = Number(cart.count);

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${cart.prod_name}</td>
            <td>$${price.toFixed(2)}</td>
            <td><input type="number" class="form-control" value="${count}" style="width: 70px;"></td>
            <td>$${(price * count).toFixed(2)}</td>
            <td><button class="btn btn-sm btn-danger">Remove</button></td>
        `;
        row.children[4].querySelector('button').addEventListener('click', () => {
            removeCart(cart);
            row.remove();
            updatePrice();
        });
        cartTableBody.appendChild(row);
    });
    updatePrice();
}

function updatePrice(){
    const cartTableBody = document.querySelector('tbody');
    let total = 0;
    cartTableBody.querySelectorAll('tr').forEach(row => {
        const price = parseFloat(row.children[1].textContent.replace('$', ''));
        const count = parseInt(row.children[2].querySelector('input').value);
        total += price * count;
        row.children[3].textContent = `$${(price * count).toFixed(2)}`;
    });
    document.getElementById('subtotal').textContent = `$${total.toFixed(2)}`;
    document.getElementById('total_price').textContent = `$${total.toFixed(2)}`;
}

document.addEventListener('DOMContentLoaded', loadCart);