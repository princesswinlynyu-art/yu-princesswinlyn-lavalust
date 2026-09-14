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

        th{
            background:#3498db;
            color:white;
        }

        .btn{
            padding:8px 12px;
            background:#3498db;
            color:white;
            text-decoration:none;
            border-radius:5px;
            display:inline-block;
        }

        .delete{
            background:#e74c3c;
        }

        .logout{
            background:#555;
        }
    </style>
</head>
<body>

<h1>Products</h1>

<p>
    <a class="btn" href="<?= site_url('products/create'); ?>">
        Add Product
    </a>
    <a class="btn logout" href="<?= site_url('logout'); ?>">
        Log Out
    </a>
</p>

<?php if ($product_error): ?>
<p>Products are not available yet. Please make sure the products table has been migrated.</p>
<?php endif; ?>

<table>

<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Actions</th>
</tr>

<?php foreach($products as $product): ?>

<tr>
    <td><?= $product['id']; ?></td>
    <td><?= $product['product_name']; ?></td>
    <td><?= $product['description']; ?></td>
    <td><?= $product['price']; ?></td>
    <td><?= $product['quantity']; ?></td>

    <td>
        <a class="btn"
           href="<?= site_url('products/edit/'.$product['id']); ?>">
           Edit
        </a>

        <a class="btn delete"
           href="<?= site_url('products/delete/'.$product['id']); ?>"
           onclick="return confirm('Delete this product?')">
           Delete
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>