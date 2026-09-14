<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

<form action="<?= site_url('products/store'); ?>" method="POST">

    <p>Product Name</p>
    <input type="text" name="product_name" required>

    <p>Description</p>
    <input type="text" name="description" required>

    <p>Price</p>
    <input type="number" step="0.01" name="price" required>

    <p>Quantity</p>
    <input type="number" name="quantity" required>

    <br><br>

    <button type="submit">
        Save Product
    </button>

</form>

</body>
</html>