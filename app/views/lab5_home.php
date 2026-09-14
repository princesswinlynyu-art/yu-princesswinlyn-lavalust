<!DOCTYPE html>
<html>
<head>
    <title>LAB 5</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f6f9;
            text-align:center;
            padding:40px;
        }

        .container{
            background:white;
            max-width:600px;
            margin:auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }

        .btn{
            display:block;
            width:250px;
            margin:15px auto;
            padding:15px;
            background:#3498db;
            color:white;
            text-decoration:none;
            border-radius:8px;
        }

    </style>

</head>
<body>

<div class="container">

<h1>LAB 5</h1>

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

</body>
</html>