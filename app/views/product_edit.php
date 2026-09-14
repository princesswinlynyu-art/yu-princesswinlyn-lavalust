<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<form action="<?= site_url('products/update/'.$product['id']); ?>" method="POST">

    <p>Product Name</p>
    <input type="text"
           name="product_name"
           value="<?= $product['product_name']; ?>"
           required>

    <p>Description</p>
    <input type="text"
           name="description"
           value="<?= $product['description']; ?>"
           required>

    <p>Price</p>
    <input type="number"
           step="0.01"
           name="price"
           value="<?= $product['price']; ?>"
           required>

    <p>Quantity</p>
    <input type="number"
           name="quantity"
           value="<?= $product['quantity']; ?>"
           required>

    <br><br>

    <button type="submit">
        Update Product
    </button>

</form>

</body>
</html>