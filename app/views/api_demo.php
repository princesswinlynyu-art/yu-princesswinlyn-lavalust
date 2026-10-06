<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LavaLust Product API Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f3f4f6;
            color: #17212a;
        }
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,.08);
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        input, button {
            font: inherit;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }
        button {
            cursor: pointer;
            background: #111827;
            color: white;
            border: none;
        }
        button.secondary {
            background: #6b7280;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 8px;
            text-align: left;
        }
        .hidden { display: none; }
        .notice {
            padding: 12px 14px;
            border-radius: 8px;
            margin-top: 10px;
            background: #e0f2fe;
            color: #0f172a;
        }
        .error {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>LavaLust Product API Demo</h1>
            <div id="authBox">
                <h2>Login</h2>
                <form id="loginForm">
                    <input type="text" id="username" placeholder="Username" required>
                    <input type="password" id="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
            <div id="tokenBox" class="hidden">
                <strong>Token:</strong>
                <span id="tokenValue"></span>
                <button class="secondary" id="logoutBtn" type="button">Logout</button>
            </div>
            <div id="notice" class="notice hidden"></div>
        </div>

        <div class="card hidden" id="productCard">
            <h2>Products</h2>
            <form id="productForm">
                <input type="hidden" id="productId">
                <input type="text" id="productName" placeholder="Product name" required>
                <input type="text" id="description" placeholder="Description">
                <input type="number" step="0.01" id="price" placeholder="Price" required>
                <input type="number" id="quantity" placeholder="Quantity" required>
                <button type="submit">Save product</button>
                <button class="secondary" type="button" id="cancelEditBtn">Cancel</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTableBody"></tbody>
            </table>
        </div>
    </div>

    <script>
        const apiBase = '/api';
        let token = localStorage.getItem('ll_api_token') || '';

        const authBox = document.getElementById('authBox');
        const tokenBox = document.getElementById('tokenBox');
        const productCard = document.getElementById('productCard');
        const notice = document.getElementById('notice');
        const tokenValue = document.getElementById('tokenValue');

        function showNotice(message, error = false) {
            notice.textContent = message;
            notice.classList.toggle('error', error);
            notice.classList.remove('hidden');
        }

        function hideNotice() {
            notice.classList.add('hidden');
        }

        function apiFetch(url, options = {}) {
            const headers = Object.assign({ 'Content-Type': 'application/json' }, options.headers || {});

            if (token) {
                headers['Authorization'] = 'Bearer ' + token;
            }

            return fetch(apiBase + url, Object.assign({ headers }, options))
                .then(async response => {
                    const body = await response.json().catch(() => ({}));
                    if (!response.ok) {
                        throw new Error(body.error || 'Request failed');
                    }
                    return body;
                });
        }

        function updateAuthUI() {
            const loggedIn = !!token;
            authBox.classList.toggle('hidden', loggedIn);
            tokenBox.classList.toggle('hidden', !loggedIn);
            productCard.classList.toggle('hidden', !loggedIn);
            if (loggedIn) {
                tokenValue.textContent = token;
                loadProducts();
            } else {
                document.getElementById('productTableBody').innerHTML = '';
            }
        }

        function loadProducts() {
            apiFetch('/products')
                .then(result => {
                    const tbody = document.getElementById('productTableBody');
                    tbody.innerHTML = '';
                    const products = result.data || [];
                    products.forEach(product => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${product.id}</td>
                            <td>${product.product_name}</td>
                            <td>${product.description || ''}</td>
                            <td>${product.price}</td>
                            <td>${product.quantity}</td>
                            <td>
                                <button type="button" data-id="${product.id}" class="edit-btn">Edit</button>
                                <button type="button" data-id="${product.id}" class="delete-btn secondary">Delete</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });

                    tbody.querySelectorAll('.edit-btn').forEach(button => {
                        button.addEventListener('click', () => editProduct(button.dataset.id));
                    });
                    tbody.querySelectorAll('.delete-btn').forEach(button => {
                        button.addEventListener('click', () => deleteProduct(button.dataset.id));
                    });
                })
                .catch(err => {
                    showNotice(err.message, true);
                });
        }

        document.getElementById('loginForm').addEventListener('submit', function (event) {
            event.preventDefault();
            hideNotice();

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            apiFetch('/login', {
                method: 'POST',
                body: JSON.stringify({ username, password })
            })
                .then(result => {
                    token = result.token;
                    localStorage.setItem('ll_api_token', token);
                    updateAuthUI();
                    document.getElementById('loginForm').reset();
                    showNotice('Login successful.');
                })
                .catch(err => {
                    showNotice(err.message, true);
                });
        });

        document.getElementById('logoutBtn').addEventListener('click', function () {
            token = '';
            localStorage.removeItem('ll_api_token');
            updateAuthUI();
            hideNotice();
        });

        document.getElementById('cancelEditBtn').addEventListener('click', function () {
            document.getElementById('productForm').reset();
            document.getElementById('productId').value = '';
        });

        document.getElementById('productForm').addEventListener('submit', function (event) {
            event.preventDefault();
            hideNotice();

            const productId = document.getElementById('productId').value;
            const payload = {
                product_name: document.getElementById('productName').value.trim(),
                description: document.getElementById('description').value.trim(),
                price: document.getElementById('price').value,
                quantity: Number(document.getElementById('quantity').value)
            };

            const method = productId ? 'PUT' : 'POST';
            const url = productId ? '/products/' + productId : '/products';

            apiFetch(url, {
                method,
                body: JSON.stringify(payload)
            })
                .then(() => {
                    document.getElementById('productForm').reset();
                    document.getElementById('productId').value = '';
                    loadProducts();
                    showNotice(productId ? 'Product updated.' : 'Product created.');
                })
                .catch(err => {
                    showNotice(err.message, true);
                });
        });

        function editProduct(productId) {
            apiFetch('/products/' + productId)
                .then(result => {
                    const product = result.data;
                    document.getElementById('productId').value = product.id;
                    document.getElementById('productName').value = product.product_name;
                    document.getElementById('description').value = product.description || '';
                    document.getElementById('price').value = product.price;
                    document.getElementById('quantity').value = product.quantity;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                })
                .catch(err => {
                    showNotice(err.message, true);
                });
        }

        function deleteProduct(productId) {
            if (!confirm('Delete this product?')) {
                return;
            }

            apiFetch('/products/' + productId, {
                method: 'DELETE'
            })
                .then(() => {
                    loadProducts();
                    showNotice('Product deleted.');
                })
                .catch(err => {
                    showNotice(err.message, true);
                });
        }

        updateAuthUI();
    </script>
</body>
</html>
