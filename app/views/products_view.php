<!DOCTYPE html>
<html>
<head>
    <title>Products</title>

    <style>
        body{
            font-family:Arial;
            padding:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #ccc;
            padding:10px;
        }

        .btn{
            padding:8px 12px;
            background:#3498db;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }
    </style>
</head>
<body>

<h1>Products</h1>

<p>
    <a class="btn" href="<?= site_url('products/create'); ?>">
        Add Product
    </a>
</p>

<table>

<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Quantity</th>
</tr>

<?php foreach($products as $product): ?>

<tr>
    <td><?= $product['id']; ?></td>
    <td><?= $product['product_name']; ?></td>
    <td><?= $product['description']; ?></td>
    <td><?= $product['price']; ?></td>
    <td><?= $product['quantity']; ?></td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>