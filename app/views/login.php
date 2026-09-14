<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body{
            font-family:Arial;
            background:#f4f6f9;
            padding:40px;
        }

        .container{
            max-width:500px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:10px;
        }

        input{
            width:100%;
            padding:10px;
            margin-bottom:15px;
        }

        button{
            width:100%;
            padding:12px;
            background:#3498db;
            color:white;
            border:none;
        }
    </style>
</head>
<body>

<div class="container">

<h2>Login</h2>

<form action="<?= site_url('login/authenticate'); ?>" method="POST">

    <input type="text"
           name="username"
           placeholder="Username"
           required>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <button type="submit">
        Login
    </button>

</form>

</div>

</body>
</html>