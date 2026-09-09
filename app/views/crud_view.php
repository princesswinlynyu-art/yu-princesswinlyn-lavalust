<!DOCTYPE html>
<html>
<head>
    <title>CRUD System</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            padding:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th, td{
            border:1px solid #ccc;
            padding:10px;
            text-align:left;
        }

        th{
            background:#3498db;
            color:white;
        }

        .btn{
            padding:8px 12px;
            text-decoration:none;
            background:#3498db;
            color:white;
            border-radius:5px;
            margin-right:5px;
        }

        .btn:hover{
            background:#2980b9;
        }
    </style>
</head>
<body>

<h1>CRUD System</h1>

<p>
    <p><?= base_url(); ?>crud/create</p>

<a class="btn" href="/LavaLust/public/crud/create">
    Add User
</a>
</p>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Contact Number</th>
    <th>Email</th>
    <th>Actions</th>
</tr>

<?php foreach($users as $user): ?>

<tr>
    <td><?= $user['id']; ?></td>
    <td><?= $user['name']; ?></td>
    <td><?= $user['contact_number']; ?></td>
    <td><?= $user['email']; ?></td>

    <td>
        <a class="btn" href="#">Edit</a>
        <a class="btn" href="#">Delete</a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>