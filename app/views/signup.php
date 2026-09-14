<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>

    <style>

        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;display:grid;place-items:center;padding:24px;background:#fff;color:#202124;font-family:Arial,sans-serif}
        .container{width:min(420px,100%);padding:36px;border:1px solid #e5e7eb;border-radius:6px}
        h2{margin:0 0 26px;font-size:30px;font-weight:600;letter-spacing:-.7px}
        label{display:block;margin:16px 0 7px;color:#6b7280;font-size:13px}
        input{width:100%;padding:11px 12px;border:1px solid #dfe3e8;border-radius:4px;font:inherit}
        button{width:100%;margin-top:24px;padding:11px;border:0;border-radius:4px;background:#202124;color:#fff;font:inherit}
        .back{display:block;margin-top:18px;color:#6b7280;text-align:center;font-size:13px;text-decoration:none}

    </style>
</head>
<body>

<div class="container">

<h2>Sign Up</h2>

<form action="<?= site_url('signup/store'); ?>" method="POST">

    <label for="fullname">Full name</label>
    <input id="fullname" type="text"
        name="fullname"
        required>

    <label for="username">Username</label>
    <input id="username" type="text"
        name="username"
        required>

    <label for="password">Password</label>
    <input id="password" type="password"
        name="password"
        required>

    <button type="submit">
        Register
    </button>

</form>

<a class="back" href="<?= site_url('lab5'); ?>">Back to Lab 5</a>

</div>

</body>
</html>