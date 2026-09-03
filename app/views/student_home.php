<!DOCTYPE html>
<html>
<head>
    <title>Princess Winlyn Student Information System</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            text-align:center;
            margin-top:100px;
        }

        .container{
            background:white;
            width:600px;
            margin:auto;
            padding:30px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,.2);
        }

        a{
            display:inline-block;
            margin-top:20px;
            padding:12px 20px;
            background:#3498db;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Princess Winlyn Student Information System</h1>

    <p>BSIT 3F6 Student Profile Portal</p>

    <a href="<?= site_url('student/profile'); ?>">
        View Student Profile
    </a>

</div>

</body>
</html>