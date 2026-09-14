<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <style>
        *{box-sizing:border-box}
        body{margin:0;padding:48px 24px;background:#fff;color:#202124;font-family:Arial,sans-serif}
        .form-page{width:min(560px,100%);margin:0 auto}
        h1{margin:0 0 28px;font-size:30px;font-weight:600}
        label{display:block;margin:18px 0 7px;color:#6b7280;font-size:13px}
        input{width:100%;padding:11px 12px;border:1px solid #dfe3e8;border-radius:4px;font:inherit}
        .actions{display:flex;gap:8px;margin-top:26px}
        button,.back{padding:10px 14px;border:1px solid #202124;border-radius:4px;background:#202124;color:#fff;text-decoration:none;font:inherit;font-size:14px}
        .back{border-color:#e5e7eb;background:#fff;color:#202124}
    </style>
</head>
<body>

<main class="form-page">
<h1>Add product</h1>

<form action="<?= site_url('products/store'); ?>" method="POST">

    <label for="product_name">Product name</label>
    <input id="product_name" type="text" name="product_name" required>

    <label for="description">Description</label>
    <input id="description" type="text" name="description" required>

    <label for="price">Price</label>
    <input id="price" type="number" step="0.01" name="price" required>

    <label for="quantity">Quantity</label>
    <input id="quantity" type="number" name="quantity" required>

    <div class="actions">
        <button type="submit">Save product</button>
        <a class="back" href="<?= site_url('products'); ?>">Cancel</a>
    </div>

</form>
</main>

</body>
</html>