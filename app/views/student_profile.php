<!DOCTYPE html>
<html>
<head>
    <title>Princess Winlyn - Student Profile</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#ecf0f1;
            margin:40px;
        }

        .card{
            max-width:700px;
            margin:auto;
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,.2);
        }

        h1{
            text-align:center;
            color:#2c3e50;
        }

        p{
            font-size:18px;
        }

        .btn{
            display:inline-block;
            margin-top:20px;
            padding:10px 15px;
            background:#2ecc71;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }
    </style>
</head>
<body>

<div class="card">

    <h1>Princess Winlyn's Student Information Page</h1>

    <p><strong>Student ID:</strong> <?= $student_id ?></p>

    <p><strong>Name:</strong> <?= $name ?></p>

    <p><strong>Course:</strong> <?= $course ?></p>

    <p><strong>Year Level:</strong> <?= $year ?></p>

    <p><strong>Section:</strong> <?= $section ?></p>

    <p><strong>Address:</strong> <?= $address ?></p>

    <p><strong>Skills:</strong> <?= $skills ?></p>

    <a href="<?= site_url('student'); ?>" class="btn">
        Back to Home
    </a>

</div>

</body>
</html>