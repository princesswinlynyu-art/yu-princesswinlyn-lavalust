<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LAB 5</title>

    <style>
        :root{--ink:#202124;--muted:#6b7280;--line:#e5e7eb}
        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;display:grid;place-items:center;padding:24px;color:var(--ink);background:#fff;font-family:Arial,sans-serif}
        .container{width:min(560px,100%);padding:42px;border:1px solid var(--line);border-radius:6px}
        .eyebrow{margin:0 0 12px;color:var(--muted);font-size:12px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase}
        h1{margin:0 0 30px;font-size:38px;font-weight:600;letter-spacing:-1px}
        .links{display:grid;gap:1px;border:1px solid var(--line);background:var(--line)}
        .btn{padding:17px;background:#fff;color:var(--ink);text-decoration:none;font-size:15px}
        .btn:first-child{background:var(--ink);color:#fff}
        .btn:hover{opacity:.8}
    </style>

</head>
<body>

<div class="container">

<p class="eyebrow">Authentication and products</p>
<h1>Lab 5</h1>

<div class="links">
<a class="btn" href="<?= base_url(); ?>login">
    Login
</a>

<a class="btn" href="<?= base_url(); ?>signup">
    Sign Up
</a>

<a class="btn" href="<?= base_url(); ?>products">
    Product Management
</a>

<a class="btn" href="<?= base_url(); ?>">
    Back Home
</a>
</div>

</div>

</body>
</html>