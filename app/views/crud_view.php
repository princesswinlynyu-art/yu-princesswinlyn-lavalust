<!DOCTYPE html>
<html>
<head>
    <title>CRUD System</title>

    <style>
        body{
            font-family: Arial;
            padding:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #ccc;
            padding:10px;
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
            display:inline-block;
        }
    </style>
</head>
<body>

<h1>CRUD System</h1>

<p>
    <a class="btn" href="<?= site_url('crud/create'); ?>">Add User</a>
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

    <a class="btn"
       href="<?= site_url('crud/edit/' . $user['id']); ?>">
       Edit
    </a>

    <a class="btn"
       href="<?= site_url('crud/delete/' . $user['id']); ?>"
       onclick="return confirm('Delete this user?')">
       Delete
    </a>

</td>

<?php endforeach; ?>

</table>

</body>
</html>