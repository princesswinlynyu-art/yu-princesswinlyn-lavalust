<!DOCTYPE html>
<html>
<head>
    <title>Users Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Users Table</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact Number</th>
        <th>Email</th>
    </tr>

    <?php foreach($users as $user): ?>
    <tr>
        <td><?= $user['id']; ?></td>
        <td><?= $user['name']; ?></td>
        <td><?= $user['contact_number']; ?></td>
        <td><?= $user['email']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>