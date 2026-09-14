<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>

    <style>
        :root{
            color-scheme:light;
            --ink:#202124;
            --muted:#6b7280;
            --line:#e5e7eb;
            --soft:#f8f9fa;
            --accent:#202124;
        }

        *{box-sizing:border-box}

        body{
            margin:0;
            padding:48px 24px;
            color:var(--ink);
            background:#fff;
            font-family:Arial,sans-serif;
        }

        .page{
            width:min(1100px,100%);
            margin:0 auto;
        }

        .header{
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
            gap:24px;
            margin-bottom:28px;
        }

        h1{
            margin:0 0 6px;
            font-size:30px;
            font-weight:600;
            letter-spacing:-.5px;
        }

        .subtitle{
            margin:0;
            color:var(--muted);
            font-size:14px;
        }

        .actions{display:flex;gap:8px;flex-wrap:wrap}

        .btn{
            display:inline-block;
            padding:9px 14px;
            border:1px solid var(--accent);
            border-radius:4px;
            background:var(--accent);
            color:#fff;
            text-decoration:none;
            font-size:14px;
        }

        .btn.secondary{
            background:#fff;
            color:var(--ink);
            border-color:var(--line);
        }

        .table-wrap{overflow-x:auto;border:1px solid var(--line);border-radius:5px}

        table{width:100%;border-collapse:collapse;min-width:700px}

        th,td{
            padding:14px 16px;
            border-bottom:1px solid var(--line);
            text-align:left;
            font-size:14px;
        }

        th{
            background:var(--soft);
            color:var(--muted);
            font-size:12px;
            font-weight:600;
            letter-spacing:.4px;
            text-transform:uppercase;
        }

        tr:last-child td{border-bottom:0}

        .number{text-align:right;white-space:nowrap}

        .row-actions{display:flex;gap:6px;white-space:nowrap}

        .row-actions .btn{padding:6px 10px;font-size:13px}

        .delete{background:#fff;color:#b42318;border-color:#f0c5c0}

        .notice{
            margin:0 0 20px;
            padding:12px 14px;
            border:1px solid var(--line);
            border-radius:4px;
            color:var(--muted);
            font-size:14px;
        }
    </style>
</head>
<body>

<main class="page">
    <header class="header">
        <div>
            <h1>Products</h1>
            <p class="subtitle">Manage your product catalog</p>
        </div>
        <div class="actions">
            <a class="btn" href="<?= site_url('products/create'); ?>">Add product</a>
            <a class="btn secondary" href="<?= site_url('logout'); ?>">Log out</a>
        </div>
    </header>

<?php if ($product_error): ?>
    <p class="notice">Products are not available yet. Please make sure the products table has been migrated.</p>
<?php endif; ?>

    <div class="table-wrap">
        <table>
            <tr>
                <th>ID</th>
                <th>Product name</th>
                <th>Description</th>
                <th class="number">Price</th>
                <th class="number">Quantity</th>
                <th>Actions</th>
            </tr>

<?php foreach($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['id']); ?></td>
                <td><?= htmlspecialchars($product['product_name']); ?></td>
                <td><?= htmlspecialchars($product['description']); ?></td>
                <td class="number"><?= htmlspecialchars($product['price']); ?></td>
                <td class="number"><?= htmlspecialchars($product['quantity']); ?></td>
                <td>
                    <div class="row-actions">
                        <a class="btn secondary" href="<?= site_url('products/edit/'.$product['id']); ?>">Edit</a>
                        <a class="btn delete"
                           href="<?= site_url('products/delete/'.$product['id']); ?>"
                           onclick="return confirm('Delete this product?')">Delete</a>
                    </div>
                </td>
            </tr>
<?php endforeach; ?>
        </table>
    </div>
</main>

</body>
</html>