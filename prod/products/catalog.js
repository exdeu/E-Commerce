
let logged = false;
async function loadCatalog() {
    try {
        const response = await fetch('catalog.json');
        const products = await response.json();
        displayCategories(products.categories);
    } catch (error) {
        console.error('Error loading catalog:', error);
    }
}
function displayCategories(categories) {
    const categoryContainer = document.getElementById('catalog-container');
    categoryContainer.innerHTML = '';

    const title = document.createElement('h1');
    title.className = 'mb-4';
    title.textContent = 'Hablon Product Catalog';
    categoryContainer.appendChild(title);

    categories.forEach(category => {
        const categoryDiv = document.createElement('div');
        categoryDiv.className = 'category-section';

        const categoryTitle = document.createElement('h2');
        categoryTitle.className = 'category-title';
        categoryTitle.textContent = category.title;
        categoryDiv.appendChild(categoryTitle);

        const categoryDescription = document.createElement('p');
        categoryDescription.className = 'category-description';
        categoryDescription.textContent = category.description;
        categoryDiv.appendChild(categoryDescription);

        categoryDiv.appendChild(displayProducts(category.items));
        categoryContainer.appendChild(categoryDiv);
    });
}

function displayProducts(items) {
    const row = document.createElement('div');
    row.className = 'row g-4';
    
    items.forEach(product => {
        const col = document.createElement('div');
        col.className = 'col-md-6 col-lg-4';
        
        col.innerHTML = `
            <div class="card product-card">
                <img src="${product.image_url}" class="card-img-top product-image" alt="${product.name}">
                <div class="card-body">
                    <h5 class="card-title">${product.name}</h5>
                    <p class="card-text">${product.description}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">$${product.price}</span>
                        <button class="btn btn-primary btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
        `;
        col.children[0].querySelector('button').addEventListener('click', () => {   
            if(document.getElementById('log_stat').logged === false) {
                alert('Please log in to place an order.');
                return;
            }
            fetch('products/orders.php', {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(product)
            })
            .then(async response => {
                let data;
                try {
                    data = await response.json();
                } catch (e) {
                    throw new Error('Server returned invalid JSON');
                }
                if (!response.ok) {
                    throw new Error(data.message || 'Server error');
                }
                return data;
            })
            .then(data => {
                if (data.success) {
                    alert('Order placed successfully!');
                } else {
                    alert('Failed to place order: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong: ' + error.message);
            });
        });
        row.appendChild(col);
    });
    return row;
}

document.addEventListener('DOMContentLoaded', loadCatalog);