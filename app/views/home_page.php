<!DOCTYPE html>
<html>
<head>
    <title>Princess Winlyn M. Yu - Homepage</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            text-align:center;
            padding:40px;
        }

        .container{
            background:white;
            max-width:700px;
            margin:auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }

        .btn{
            display:block;
            margin:15px auto;
            padding:15px;
            width:250px;
            background:#3498db;
            color:white;
            text-decoration:none;
            border-radius:8px;
        }

        .btn:hover{
            background:#2980b9;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Princess Winlyn M. Yu</h1>
    <h3>BSIT 3F6</h3>

    <a class="btn" href="<?= base_url(); ?>student">
        Student Homepage
    </a>

    <a class="btn" href="<?= base_url(); ?>student/profile">
        Student Profile
    </a>

    <a class="btn" href="<?= base_url(); ?>users">
        Users Database Table
    </a>

</div>

</body>
</html>