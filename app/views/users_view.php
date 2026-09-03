<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>

    <style>
        body{
            font-family: Arial;
            padding:20px;
        }

        table{
            border-collapse: collapse;
            width:100%;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:10px;
            text-align:left;
        }

        th{
            background:#f2f2f2;
        }
    </style>
</head>
<body>

<h2>Users Table</h2>

<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Username</th>
    </tr>

    <?php foreach($users as $user): ?>
    <tr>
        <td><?= $user['id']; ?></td>
        <td><?= $user['firstname']; ?></td>
        <td><?= $user['lastname']; ?></td>
        <td><?= $user['email']; ?></td>
        <td><?= $user['username']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>